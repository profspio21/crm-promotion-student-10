<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SpreadsheetReader;
use App\Models\Expo;
use App\Models\Registrant;

trait CsvImportTrait
{
    public function processCsvImport(Request $request)
    {
        try {
            $filename = $request->input('filename', false);
            $path     = storage_path('app/csv_import/' . $filename);

            $hasHeader = $request->input('hasHeader', false);

            $fields = $request->input('fields', false);
            $fields = array_flip(array_filter($fields));

            $modelName = $request->input('modelName', false);
            $model     = "App\Models\\" . $modelName;

            $reader = new SpreadsheetReader($path);
            $insert = [];

            if($modelName === 'DetailExpo') {
                $expo = Expo::create(['tanggal' => $request->tanggal, 'tempat' => $request->tempat, 'pic' => $request->pic, 'type' => $request->type]);
            }

            if($modelName === 'Registrant') {
                $all_registrants = Registrant::pluck('nomor_daftar');
            }

            foreach ($reader as $key => $row) {
                if ($hasHeader && $key == 0) {
                    continue;
                }

                $tmp = [];
                foreach ($fields as $header => $k) {
                    if (isset($row[$k])) {
                        if($modelName === 'DetailExpo') {
                            $tmp[$header] = $row[$k];
                            $tmp['expo_id'] = $expo->id;
                        }
                        if($modelName === 'Registrant') {
                            if (!in_array($row[$k], $all_registrants)) {
                                $tmp[$header] = $row[$k];
                                $tmp['status'] = $request->status;
                            }
                            if (in_array($row[$k], $all_registrants)) {
                                $tmpUpdate[$header] = $row[$k];
                                $tmpUpdate['status'] = $request->status;
                                $registrant = Registrant::where('nomor_daftar', $tmp['nomor_daftar'])->first();
                                $registrant->update($tmpUpdate);
                            }
                        }
                    }
                }

                if (count($tmp) > 0) {
                    $insert[] = $tmp;
                }
            }

            $for_insert = array_chunk($insert, 100);

            foreach ($for_insert as $insert_item) {
                $model::insert($insert_item);
            }

            $rows  = count($insert);
            $table = Str::plural($modelName);

            File::delete($path);

            session()->flash('message', trans('global.app_imported_rows_to_table', ['rows' => $rows, 'table' => $table]));

            return redirect($request->input('redirect'));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function parseCsvImport(Request $request)
    {
        $type = $request->type;
        $file = $request->file('csv_file');
        $request->validate([
            'csv_file' => 'mimes:csv,txt',
        ]);

        $path      = $file->path();
        $hasHeader = $request->input('header', false) ? true : false;

        $reader  = new SpreadsheetReader($path);
        $headers = $reader->current();
        $lines   = [];

        $i = 0;
        while ($reader->next() !== false && $i < 5) {
            $lines[] = $reader->current();
            $i++;
        }

        $filename = Str::random(10) . '.csv';
        $file->storeAs('csv_import', $filename);

        $modelName     = $request->input('model', false);
        $fullModelName = "App\Models\\" . $modelName;

        $model     = new $fullModelName();
        $fillables = $model->getFillable();

        $redirect = url()->previous();

        $routeName = 'admin.' . strtolower(Str::plural(Str::kebab($modelName))) . '.processCsvImport';
        if ($routeName = 'admin.detail-expos.processCsvImport') {
            $routeName = 'admin.expos.processCsvImport';
        }

        return view('csvImport.parseInput', compact('headers', 'filename', 'fillables', 'hasHeader', 'modelName', 'lines', 'redirect', 'routeName', 'type'));
    }
}
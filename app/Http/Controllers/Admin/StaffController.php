<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStaffRequest;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffs = Staff::with(['user'])->get();

        return view('admin.staffs.index', compact('staffs'));
    }

    public function create()
    {
        abort_if(Gate::denies('staff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.staffs.create', compact('users'));
    }

    public function store(StoreStaffRequest $request)
    {
        
        $staff = Staff::create($request->only(['name', 'nip']));

        // Buat user baru
        if($request->username && $request->password && $request->email) {
            $user = User::create([
                'username' => $request->username,
                'email'    => $request->email,
                'password' => $request->password
                ]);
            $user->roles()->sync(2);  // set roles, 2 untuk staff
            $staff->update(['user_id' => $user->id]); // set user_id ke staff
        }

        return redirect()->route('admin.staffs.index');
    }

    public function edit(Staff $staff)
    {
        abort_if(Gate::denies('staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff->load('user');

        return view('admin.staffs.edit', compact('staff'));
    }

    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $staff->update($request->only(['name', 'nip']));

        // Buat user baru
        if($request->username && $request->password && $request->email) {
            if(!empty($staff->user_id)) {
                $user = $staff->user;
                $user->update([
                    'username' => $request->username,
                    'email'    => $request->email,
                    'password' => $request->password
                    ]);
            }
            if(empty($staff->user_id)) {
                $user = User::create([
                    'username' => $request->username,
                    'email'    => $request->email,
                    'password' => $request->password
                    ]);
                $user->roles()->sync(2);  // set roles, 2 untuk staff
                $staff->update(['user_id' => $user->id]); // set user_id ke staff
            }
            
        }

        return redirect()->route('admin.staffs.index');
    }

    public function show(Staff $staff)
    {
        abort_if(Gate::denies('staff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff->load('user');

        return view('admin.staffs.show', compact('staff'));
    }

    public function destroy(Staff $staff)
    {
        abort_if(Gate::denies('staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = $staff->user;
        $user->delete();

        $staff->delete();

        return back();
    }

    public function massDestroy(MassDestroyStaffRequest $request)
    {
        $staffs = Staff::find(request('ids'));

        foreach ($staffs as $staff) {
            $user = $staff->user;
            $user->delete();
            $staff->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
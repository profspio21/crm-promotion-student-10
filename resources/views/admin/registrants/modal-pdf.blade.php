<div id="pdfModal" class="modal fade" role="dialog">
    <form method="POST" action="{{ route("admin.registrants.report") }}" enctype="multipart/form-data" target="_blank">
        @method('POST')
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ App\Models\Registrant::STATUS_SELECT[$status]}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title">Pilih Rentang Tanggal Daftar</h5>
                    <form id="pdfForm">
                        <div class="form-group">
                            <label for="startDate">Dari :</label>
                            <input type="date" class="form-control" id="startDate" name="startDate">
                        </div>
                        <div class="form-group">
                            <label for="endDate">Sampai :</label>
                            <input type="date" class="form-control" id="endDate" name="endDate">
                        </div>
                        <div class="form-group">
                            <input type="status" class="form-control" id="status" name="status" value={{$status}} hidden>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="downloadPDF">Generate PDF</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
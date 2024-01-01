<div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">حذف فاتورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('invoice.destroy') }}" autocomplete="off">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="del_id" id="del_id" value="archive">
                    <strong>هل انت متاكد من ارشفة هذه الفاتورة...؟ </strong>
                    <br>
                    <input type="text" id="invoice_number" readonly
                        style="border: none; outline: none;font-size: 20px; text-align: end">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">اغلاق</button>
                <button type="submit" class="btn mb-2 btn-success">ارشفة</button>
            </div>
            </form>
        </div>
    </div>
</div>

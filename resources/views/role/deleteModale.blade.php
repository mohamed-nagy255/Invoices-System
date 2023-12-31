<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">حذف صلاحية</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('role.destroy', $role->id) }}" autocomplete="off">
                    @method('delete')
                    @csrf
                    <strong>هل انت متاكد من حذف هذه الصلاحية...؟ </strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">اغلاق</button>
                <button type="submit" class="btn mb-2 btn-danger">حذف</button>
            </div>
            </form>
        </div>
    </div>
</div>

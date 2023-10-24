<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">تعديل قسم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('section.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <label for="section_name" class="col-sm-3 col-form-label">اسم القسم</label>
                        <div class="col-sm-9">
                            <input type="text" name="section_name" class="form-control" id="section_name"
                                placeholder=" ادخل اسم القسم">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">الملاحظات</label>
                        <div class="col-sm-9">
                            <textarea name="description" class="form-control" id="description" rows="2">
              </textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">اغلاق</button>
                <button type="submit" class="btn mb-2 btn-primary">حفظ التعديل</button>
            </div>
            </form>
        </div>
    </div>
</div>

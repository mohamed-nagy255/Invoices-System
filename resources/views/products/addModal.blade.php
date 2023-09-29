<div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="varyModalLabel">اضافة منتج</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route ('product.store') }}" autocomplete="off">
          @csrf
          <div class="form-group row">
            <label for="inputproduct" class="col-sm-3 col-form-label">اسم المنتج</label>
            <div class="col-sm-9">
              <input type="text" name="product_name" class="form-control" id="inputproduct" placeholder=" ادخل اسم القسم">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputproduct" class="col-sm-3 col-form-label">القسم</label>
            <div class="col-sm-9">
              <select name="section_id" id="inputproduct" class="form-control">
                <option selected>اختر القسم</option>
                @foreach ($sections as $row)
                  <option value="{{ $row -> id }}">{{ $row -> section_name }}</option>
                @endforeach
              </select>
              {{-- <input type="text" name="product_name" class="form-control" id="inputproduct" placeholder=" ادخل اسم القسم"> --}}
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleFormControlTextarea1" class="col-sm-3 col-form-label">الملاحظات</label>
            <div class="col-sm-9">
              <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">اغلاق</button>
          <button type="submit" class="btn mb-2 btn-primary">حفظ</button>
        </div>
      </form>
    </div>
  </div>
</div>
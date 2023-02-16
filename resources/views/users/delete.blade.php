<!-- delete_modal_city -->
<div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                    حذف الموظف
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form action="{{ route('users.destroy',$item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                   <p> هل أنت متأكد من عملية الحذف ؟</p>
{{--                   <p> سيتم نقل  هذه المحافظة إلى سلة المهملات</p>--}}
                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- delete_modal_city -->
<div class="modal fade" id="add_wraning{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   اضافه تحذير
               </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

           </div>
           <div class="modal-body">
               <form action="{{ route('add-wraning') }}" method="post">
                   @csrf
                   @method('POST')
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">اختر الشركه</label>
                            <select name="company_id" class="form-control w-100" id="">
                                <option value="0">اختر الشركه</option>
                                @isset($companies)
                                   @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                   @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="">الرساله</label>
                            <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                            <input id="id" type="hidden" name="user_id" class="form-control" value="{{ $item->id }}">
                        </div>
                    </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                       <button type="submit" class="btn btn-warning">حفظ</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
</div>

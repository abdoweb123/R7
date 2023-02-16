<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    تعديل بيانات المدينة
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('cities.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">اسم المدينة باللغة العربية</label>
                            <input id="name_ar" type="text" name="name_ar" value="{{ $item->getTranslation('name', 'ar') }}" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">اسم المدينة باللغة الإنجليزية</label>
                            <input id="name_en" type="text" name="name_en" value="{{ $item->getTranslation('name', 'en') }}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="image" class="mr-sm-2">الحالة</label>
                            <select name="active" class="form-control">
                                @if($item->active == 1)
                                    <option value="1" selected>نشط</option>
                                    <option value="2">غير نشط</option>
                                @else
                                    <option value="1">نشط</option>
                                    <option value="2" selected>غير نشط</option>
                                @endif
                            </select>
                        </div>
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">اسم الدولة</label>
                            <select name="country_id" class="form-control">
                                <option disabled selected>-- اختر --</option>
                                @foreach($countries as $country)
                                    <option value="{{@$country->id}}" {{@$country->id == @$item->country->id ? 'selected' : ''}}>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-success">إرسال</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

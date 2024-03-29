<!-- add_modal_city -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    إضافة مدينة
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('cities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">اسم المدينة باللغة العربية</label>
                            <input id="name_ar" type="text" name="name_ar" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">اسم المدينة باللغة الإنجليزية</label>
                            <input id="name_en" type="text" name="name_en" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">اسم الدولة</label>
                            <select name="country_id" class="form-control">
                                <option value=" " selected>-- اختر --</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-warning">إرسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

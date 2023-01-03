<div class="modal fade" id="createOffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    إضافة مهمة
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                  <form action="{{ route('makeJobTaskFromOffer') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_id" value="{{$job->id}}">
                        <input type="hidden" name="company_id" value="{{$job->company_id}}">
                        <input type="hidden" name="user_id" value="{{$job->user_id}}">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">اسم المهمة باللغة العربية</label>
                                <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">اسم المهمة باللغة الإنجليزية</label>
                                <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">وصف المهمة باللغة العربية</label>
                                <input type="text" name="description_ar" value="{{old('description_ar')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">وصف المهمة باللغة الإنجليزية</label>
                                <input type="text" name="description_en" value="{{old('description_en')}}" class="form-control">
                            </div>
                        </div>

                        <br>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-success">حفظ</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

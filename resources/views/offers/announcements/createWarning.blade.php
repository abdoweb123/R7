<!-- add_modal_city -->
<div class="modal fade" id="createWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                   إضافة خصم
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="job_id" value="{{$job->id}}">
                        @if($job->user)
                            <input type="hidden" name="user_id" value="{{$job->user->id}}">
                        @endif
                        <input type="hidden" name="type" value="2"> {{-- warning --}}
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">الخصم</label>
                            <input type="number" name="amount" value="{{old('amount')}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="mr-sm-2">ملاحظات</label>
                            <textarea name="notes" class="form-control">{{old('notes')}}</textarea>
                        </div>
                    </div>

                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@extends('layouts.master')
@section('css')
@section('title')
    إضافة موظف
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   إضافة موظف
@stop
<!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @foreach(['danger','warning','success','info'] as $msg)
        @if(Session::has('alert-'.$msg))
            <div class="alert alert-{{$msg}}">
                {{Session::get('alert-'.$msg)}}
            </div>
        @endif
    @endforeach


    <!-- row mb-3 -->
    <div class="row mb-3">
        <div class="col-xl-12 mb-30">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">تعديل موظف </h4>
                    {{-- <h6 class="box-subtitle">You can us the validation like what we did</h6> --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body wizard-content">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">الاسم بالكامل</label>
                                <input id="name_ar" type="text" name="full_name" value="{{old('full_name')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الرقم القومي</label>
                                <input type="number" name="id_number" value="{{old('id_number')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الصورة الشخصية</label>
                                <input type="file" name="profile_image" value="{{old('profile_image')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">صورة بطاقة الهوية</label>
                                <input type="file" name="identity_image" value="{{old('identity_image')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الجنسية</label>
                                <select name="nationality_id" class="form-control">
                                    <option value=" " selected>-- اختر --</option>
                                    @foreach($data['nationalities'] as $nationality)
                                        <option value="{{$nationality->id}}" {{old('nationality_id') == $nationality->id ? 'selected' : ''}}>{{$nationality->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الدولة</label>
                                <select name="country_id" class="form-control">
                                    <option value=" " selected>-- اختر --</option>
                                    @foreach($data['countries'] as $country)
                                        <option value="{{$country->id}}" {{old('country_id') == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">المدينة</label>
                                <select name="city_id" class="form-control">
                                    <option value=" " selected>-- اختر --</option>
                                    @foreach($data['cities'] as $city)
                                        <option value="{{$city->id}}" {{old('city_id') == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">البريد الإلكتروني</label>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">العنوان بالتفصيل</label>
                                <input type="text" name="area" value="{{old('area')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">منطقة العمل</label>
                                <select name="workingArea_id" class="form-control">
                                    <option value=" " selected>-- اختر --</option>
                                    @foreach($data['workingAreas'] as $workingArea)
                                        <option value="{{$workingArea->id}}" {{old('workingArea_id') == $workingArea->id ? 'selected' : ''}}>{{$workingArea->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">التخصص</label>
                                <select name="specialty_id" class="form-control">
                                    <option value=" " selected>-- اختر --</option>
                                    @foreach($data['specialties'] as $specialty)
                                        <option value="{{$specialty->id}}" {{old('specialty_id') == $specialty->id ? 'selected' : ''}}>{{$specialty->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الهاتف الشخصي</label>
                                <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">هاتف قريب أو صاحب</label>
                                <input type="text" name="relative_phone" value="{{old('relative_phone')}}" class="form-control">
                            </div>
                            <div class="col ichack-input">
                                <label class="mr-sm-2">النوع</label>
                                <div class="form-control row mb-3" style="display:flex !important; margin:0;">
                                   <div class="col">
                                      <input type="radio" class="minimal-red" name="gender" value="1" {{old('gender')=='1' ? 'checked='.'"'.'checked='.'"' : ''}}> ذكر
                                   </div>
                                   <div class="col">
                                       <input type="radio" class="minimal-red" name="gender" value="2" {{old('gender')=='2' ? 'checked='.'"'.'checked='.'"' : ''}}> أنثى
                                   </div>
                                </div>
                            </div>
                           
                            <div class="col">
                                <label class="mr-sm-2">تاريخ الميلاد</label>
                                <input type="date" name="birthDate" value="{{old('birthDate')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col  ichack-input">
                                <label class="mr-sm-2 d-block">الشهادة الصحية</label>
                                <div class="form-control row mb-3" style="display:flex !important; margin:0;">
                                    <div class="col">
                                        <input type="radio" class="minimal-red" name="health_insurance" value="1" {{old('health_insurance')=='1' ? 'checked='.'"'.'checked='.'"' : ''}}>  يوجد
                                    </div>
                                    <div class="col">
                                        <input type="radio" class="minimal-red" name="health_insurance" value="2" {{old('health_insurance')=='2' ? 'checked='.'"'.'checked='.'"' : ''}}> لا يوجد
                                    </div>
                                </div>
                            </div>
                            <div class="col  ichack-input">
                                <label class="mr-sm-2 d-block">الفيش و التشبيه</label>
                                <div class="form-control row mb-3" style="display:flex !important; margin:0;">
                                    <div class="col">
                                        <input type="radio" class="minimal-red" name="antecedents" value="1" {{old('antecedents')=='1' ? 'checked='.'"'.'checked='.'"' : ''}}> يوجد
                                    </div>
                                    <div class="col">
                                        <input type="radio" class="minimal-red" name="antecedents" value="2" {{old('antecedents')=='2' ? 'checked='.'"'.'checked='.'"' : ''}}> لا يوجد
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">كيف عرفتنا؟</label>
                                <select name="reachedUs_id" class="form-control">
                                    <option value=" " selected>-- اختر --</option>
                                    @foreach($data['reachedUs'] as $reachedUs)
                                        <option value="{{$reachedUs->id}}" {{old('reachedUs_id') == $reachedUs->id ? 'selected' : ''}}>{{$reachedUs->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">فيديو التقديم بالعربية</label>
                                <input type="file" name="arabic_video_url" value="{{old('arabic_video_url')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">فيديو التقديم بالإنجليزية</label>
                                <input type="file" name="english_video_url" value="{{old('english_video_url')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label for="image" class="mr-sm-2">الحالة</label>
                                <select name="active" class="form-control">
                                    <option value="1" selected>نشط</option>
                                    <option value="2">غير نشط</option>
                                </select>
                            </div>
                        </div>
                       
                        <br><br>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary me-1">
                                <i class="ti-trash"></i> مسح
                              </button>
                            <button type="submit" class="btn btn-warning">
                               <i class="ti-save-alt"></i> حفظ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script src="{{ url('admin_new/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ url('admin_new/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ url('admin_new/assets/vendor_plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/moment/min/moment.min.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{ url('admin_new/assets/vendor_plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ url('admin_new/js/pages/advanced-form-element.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".alert").delay(5000).slideUp(300);
        });
    </script>
@endsection

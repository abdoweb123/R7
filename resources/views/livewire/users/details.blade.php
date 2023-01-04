<div>
    <div class="container">
      <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Top-->
                <div class="d-flex" style="justify-content: space-between">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7 d-flex">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img alt="Pic" src="{{ url('assets/images/'.$result->profile_image) }}" style="width: 100px; height:100%;    margin-left: 21px;" />
                        </div>
                         <!--begin: Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                <!--begin::User-->
                                <div class="mr-3" style="width: 100%">
                                    <div class="parent" style="display: flex; align-items:center; justify-content: space-between;">
                                        <div class="box">
                                            <!--begin::Name-->
                                            <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><h5> {{ @$result->name }}</h5>
                                                <i class="flaticon2-correct text-success icon-md ml-2"></i>
                                            </a>
                                            <!--end::Name-->
                                        </div>

                                    </div>
                                    <!--begin::Contacts-->
                                    <div class="d-flex flex-wrap">
                                        <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                </g>
                                            </svg> --}}
                                            <!--end::Svg Icon-->
                                            {{-- {{ @$result->email }} --}}
                                        </span></a>
                                    </div>
                                    <!--end::Contacts-->
                                </div>
                                <!--begin::User-->

                            </div>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <div class="d-flex align-items-center flex-wrap justify-content-between">
                                <!--begin::Description-->
                                <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5 " >
                                    <!--begin::Info-->
                                    <div class="mb-7">
                                      <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-dark-75 font-weight-bolder mr-2">الاسم :</span>
                                            <span class="text-muted font-weight-bold">{{@$result->full_name}}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-dark-75 font-weight-bolder mr-2">رقم الهاتف:</span>
                                            <span class="text-muted font-weight-bold">{{@$result->phone}}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-dark-75 font-weight-bolder mr-2">الايميل:</span>
                                            <a href="#" class="text-muted text-hover-primary">{{ @$result->email }}</a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-cente my-1 mb-2">
                                            <span class="text-dark-75 font-weight-bolder mr-2">الجنسيه:</span>
                                            <a href="#" class="text-muted text-hover-primary">{{ @$result->nationality->name }}</a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-cente my-1">
                                            <span class="text-dark-75 font-weight-bolder mr-2">البلده:</span>
                                            <a href="#" class="text-muted text-hover-primary">{{ @$result->country->name }}</a>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Description-->
                                <!--end::Progress-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Pic-->

                    <div class="box">
                        <!--begin::Actions-->
                        <div class="my-lg-0 my-1">
                                {{-- <button type="button" class="btn btn-sm btn-warning font-weight  mr-2" data-toggle="modal" data-target="#exampleModal" wire:click='defin_student_id({{ @$result->id}})'>
                                    {{ __('ms_lang.wraning') }}
                                </button> --}}
                                <a href="{{route('users.edit',$result->id)}}" class="btn btn-sm btn-primary font-weight"  title="تعديل"  > تعديل</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger font-weight" wire:click='make_delete({{ $result->id }})'> حذف</a>
                                <a href="{{ url('users/'.$result->id) }}" class="btn btn-sm btn-info font-weight"> CV</a>
                            </div>
                        <!--end::Actions-->
                    </div>
                </div>
                <!--end::Top-->
                <!--begin::Separator-->
                <div class="separator separator-solid my-7"></div>
                <!--end::Separator-->
            </div>
        </div>
        <!--end::Card-->
        <div class="cv-guide py-5">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="head text-center">
                        <h3>تفاصيل  الموظف</h3>
                    </div>
                    <div class="container">
                        <div class="btn-box text-center my-5">
                            <button  class="btn btn-{{$showJobs== true ? 'success' : 'primary' }}" wire:click='call_jobs' style="background-color: " id="btn1">الوظائف</button>
                            <button  class="btn btn-{{$showOrders== true ? 'success' : 'primary' }}" wire:click='call_orders' style="background-color: " id="btn1">المهام</button>
                            <button  class="btn btn-{{$showWallet== true ? 'success' : 'primary' }}" wire:click='call_show_wallet' style="background-color: " id="btn1">تاريخ المحفظه</button>
                            <button  class="btn btn-{{$showWraning== true ? 'success' : 'primary' }}" wire:click='call_wraning' style="background-color: " id="btn1"> التنبيهات</button>
                        </div>
                    </div>
                    <div class="container">
                        <div class="content">
                            <div class="table-responsive">
                               @if ($showOrders == true)
                                 <livewire:users.taskes : id="{{ $this->user_id}}"/>
                                @elseif ($showJobs == true)
                                 <livewire:users.jobs : id="{{ $this->user_id}}"/>
                               @elseif ($showWraning == true)
                                 <livewire:users.wranings : id="{{ $this->user_id}}"/>
                                @else
                                {{--  <livewire:deliveries.pull-request : id="{{ $this->user_id}}"/>  --}}
                               @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 <div wire:ignore.self class="modal fade" id="delete" tabindex="-1" role="dialog"
                aria-labelledby="delete" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                               id="delete">
                               حذف مستخدم
                           </h5>
                           <button type="button" class="close" data-dismiss="modal"
                                   aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           <form wire:submit.prevent='delete_at'>
                              <p> هل أنت متأكد من عملية الحذف ؟</p>
                              <p> سيتم نقل  إلى سلة المهملات</p>
                               {{-- <input id="id" type="hidden" name="id" class="form-control""> --}}
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                   <button type="submit" class="btn btn-danger">حذف</button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
            </div>
</div>
{{--  @include('livewire.deliveries.form')  --}}
@section('js')
@toastr_js
@toastr_render
<script>
    $(document).ready(function(){
        $(".alert").delay(5000).slideUp(300);
    });
</script>
 <script>
    $(document).ready(function(){
    window.livewire.on('remove_modal', () => {
    $('#delete').modal('hide');
    });
    window.livewire.on('showDelete', () => {
        console.log('good');
    $('#delete').modal('show');
    });
});
</script>
@endsection
</div>

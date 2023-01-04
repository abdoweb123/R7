<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="content" class="mr-sm-2">المحتوي</label>
                    <input id="content" type="text" name="content" class="form-control" wire:model.lazy='content'>
                    @error('content')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-5">
                    <label for="provided_by" class="mr-sm-2"> مقدمه بواسطه </label>
                    <input id="provided_by" type="text"  class="form-control" wire:model.lazy='provided_by'>
                    @error('provided_by')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                 <div class="col-md-12 mb-5">
                    <label for="provided_by_type">نوع المقدم</label>
                    <select class="form-control mr-sm-2 p-2" name="provided_by_type" wire:model.lazy='provided_by_type'>
                        <option selected >choose</option>
                        <option value="1">الشركه</option>
                        <option value="2">التطبيق</option>
                    </select>
                    @error('provided_by_type')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                @if ($provided_by_type == 1)
                    <div class="col-md-12 mb-5">
                        <label for="company_id">الشركه</label>
                        <select class="form-control mr-sm-2 p-2" name="company_id" wire:model.lazy='company_id'>
                        <option selected >choose</option>
                            @if(count($companies))
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('company_id')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="company_cost" class="mr-sm-2"> تكلفه الشركه </label>
                        <input id="company_cost" type="number"  class="form-control" wire:model.lazy='company_cost'>
                        @error('company_cost')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                @else
                    <div class="col-md-12 mb-5">
                        <label for="app_cost" class="mr-sm-2"> تكلفه التطبيق </label>
                        <input id="app_cost" type="number"  class="form-control" wire:model.lazy='app_cost'>
                        @error('app_cost')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                @endif
                <div class="col-md-12 mb-5">
                    <label for="start_date" class="mr-sm-2">تاريخ البدايه</label>
                    <input id="start_date" type="date"  class="form-control" wire:model.lazy='start_date'>
                    @error('start_date')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-5">
                    <label for="end_date" class="mr-sm-2">تاريخ النهايه </label>
                    <input id="end_date" type="date"  class="form-control" wire:model.lazy='end_date'>
                    @error('end_date')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-5">
                    <label for="total_cost" class="mr-sm-2">  اجمالي التكلفه</label>
                    <input id="total_cost" type="number"  class="form-control" wire:model.lazy='total_cost'>
                    @error('total_cost')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-5">
                    <label for="employee_cost" class="mr-sm-2">  تكلفه الموظف</label>
                    <input id="employee_cost" type="number"  class="form-control" wire:model.lazy='employee_cost'>
                    @error('employee_cost')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <br><br>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">close</button>
            {{-- <button type="submit" class="btn btn-success">إرسال</button> --}}
            <button type="submit" class="btn btn-success">{{ $ids != null ? 'تعديل' : 'حفظ' }}</button>
        </div>
    </form>
</div>

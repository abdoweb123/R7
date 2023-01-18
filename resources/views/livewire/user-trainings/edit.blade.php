<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-12 mb-2">
                    <label for="company_id">الشركه</label>
                    <select class="form-control mr-sm-2 p-2" name="company_id" wire:model.lazy='company_id'>
                    <option selected >choose</option>
                        @if(count($companies))
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->company_name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('company_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-2">
                    <label for="employee_id">الموظفين</label>
                    <select class="form-control mr-sm-2 p-2" name="employee_id" wire:model.lazy='employee_id'>
                    <option selected >choose</option>
                        @if(count($employees))
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->full_name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('employee_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-2">
                    <label for="traning_id">التدريبات</label>
                    <select class="form-control mr-sm-2 p-2" name="traning_id" wire:model.lazy='traning_id'>
                    <option selected >choose</option>
                        @if(count($tranings))
                            @foreach($tranings as $traning)
                                <option value="{{$traning->id}}">{{$traning->content}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('traning_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">close</button>
            {{-- <button type="submit" class="btn btn-success">إرسال</button> --}}
            <button type="submit" class="btn btn-success">{{ $ids != null ? 'تعديل' : 'حفظ' }}</button>
        </div>
    </form>
</div>

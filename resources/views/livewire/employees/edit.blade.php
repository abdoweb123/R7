<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="name" class="mr-sm-2">الاسم</label>
                    <input id="name" type="text" name="name" class="form-control" wire:model.lazy='name'>
                    @error('name')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="phone" class="mr-sm-2">رقم الهاتف</label>
                    <input id="phone" type="text" name="phone" class="form-control" wire:model.lazy='phone'>
                    @error('phone')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email" class="mr-sm-2"> الايميل  </label>
                    <input id="email" type="text"  class="form-control" wire:model.lazy='email'>
                    @error('email')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="city_id">المدينه</label>
                    <select class="form-control mr-sm-2 p-2" name="city_id" wire:model.lazy='city_id'>
                    <option selected >choose</option>
                        @if(count($cities))
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('city_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
              
                <div class="col-md-6 mb-2">
                    <label for="password" class="mr-sm-2">الرقم السري </label>
                    <input id="password" type="password"  class="form-control" wire:model.lazy='password'>
                    @error('password')<span style="color: red"> {{ $message }}</span>@enderror
                </div> 

                <div class="col-md-12">
                    <label for="">اختر الصلاحيات</label>
                    <div class="form-group ichack-input" >
                        @if (isset($permissions))
                            @foreach ($permissions as $index=>$permission)
                            <input type="checkbox" id="vehicle{{ $index }}" value="{{ $permission->id }}" wire:model='permission_users'>
                            <label for="vehicle{{ $index }}">{{ $permission->name}}</label><br>
                                {{-- <label>
                                    <input type="checkbox" class="minimal" value="{{ $permission->id }}" wire:model='permission_users[]'>
                                    {{ $permission->name}}
                                </label> --}}
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="box-footer">
            <button type="button"  class="btn btn-primary me-1"
            data-dismiss="modal"><i class="ti-trash"></i>غلق</button>
        <button type="submit" class="btn btn-warning"><i class="ti-save-alt"></i>{{ $ids != null ? 'تعديل' : 'حفظ' }}</button>
        </div>  
    </form>
</div>

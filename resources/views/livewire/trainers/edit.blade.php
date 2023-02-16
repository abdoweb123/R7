<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="name" class="mr-sm-2">الاسم</label>
                    <input id="name" type="text" name="name" class="form-control" wire:model.lazy='name'>
                    @error('name')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
            
                 <div class="col-md-6 mb-2">
                    <label for="kind">نوع</label>
                    <select class="form-control mr-sm-2 p-2" name="kind" wire:model.lazy='kind'>
                        <option selected >choose</option>
                        <option value="P">مدرب شخصي</option>
                        <option value="I">معهد</option>
                    </select>
                    @error('kind')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
             
                <div class="col-md-6 mb-2">
                    <label for="certificate" class="mr-sm-2">الشهاده</label>
                    <input id="certificate" type="file"  class="form-control" wire:model.lazy='certificate'>
                    @error('certificate')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="training_license" class="mr-sm-2">رخصة التدريب  </label>
                    <input id="training_license" type="file"  class="form-control" wire:model.lazy='training_license'>
                    @error('training_license')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="commercial_register" class="mr-sm-2">السجل التجاري</label>
                    <input id="commercial_register" type="file"  class="form-control" wire:model.lazy='commercial_register'>
                    @error('commercial_register')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="mobile" class="mr-sm-2">رقم الهاتف </label>
                    <input id="mobile" type="number"  class="form-control" wire:model.lazy='mobile'>
                    @error('mobile')<span style="color: red"> {{ $message }}</span>@enderror
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

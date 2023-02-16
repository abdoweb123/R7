<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="name" class="mr-sm-2">الاسم بالعربيه</label>
                    <input id="name" type="text" name="name" class="form-control" wire:model.lazy='name'>
                    <input type="hidden" wire:model.lazy='type'>
                    @error('name')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="name_en" class="mr-sm-2"> الاسم ب الانجليزيه</label>
                    <input id="name_en" type="text" name="name_en" class="form-control" wire:model.lazy='name_en'>
                    <input type="hidden" wire:model.lazy='type'>
                    @error('name_en')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <br><br>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">علق</button>
            {{-- <button type="submit" class="btn btn-success">إرسال</button> --}}
            <button type="submit" class="btn btn-success">{{ $ids != null ? 'تعديل' : 'حفظ' }}</button>
        </div>
    </form>
</div>

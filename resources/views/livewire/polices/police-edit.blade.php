<div>
    <div class="box">
        <div class="box-body">
            <form wire:submit.prevent='store_update'>
                <div class="card-body col-md-8 offset-2">
                    <div class="form-group row">
                        <div class="col-md-6 mb-3">
                            <label for="title_ar" class="mr-sm-2">العنوان بالعربيه</label>
                            <input id="title_ar" type="text" name="title_ar" class="form-control" wire:model.lazy='title_ar'>
                            @error('title_ar')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="title_en" class="mr-sm-2">العنوان ب الانجليزيه</label>
                            <input id="title_en" type="text" name="title_en" class="form-control" wire:model.lazy='title_en'>
                            @error('title_en')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="date" class="mr-sm-2"> تاريخ السريان </label>
                            <input id="date" type="date" name="date" class="form-control" wire:model.lazy='date'>
                            @error('date')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        {{-- <div class="col-md-12">
                            <label for="details" class="mr-sm-2">  المحتوي ب العربيه  </label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control editor1" wire:model.lazy='details'></textarea>
                            @error('details')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12">
                            <label for="details_en" class="mr-sm-2">  المحتوي ب الانجليزيه  </label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control editor1" wire:model.lazy='details_en'></textarea>
                            @error('details_en')<span style="color: red"> {{ $message }}</span>@enderror
                        </div> --}}
                        <div class="form-group col-md-12 mb-3" wire:ignore>
                            {{-- {!! Form::label('details', __('ms_lang.details_t'), []) !!} --}}
                            <label for="details" class="mr-sm-2 mb-2">  المحتوي ب العربيه  </label>
                            <textarea wire:model="details" class="form-control" name="details" id="details"></textarea>
                        </div>
                        <div class="form-group col-md-12 mb-3" wire:ignore>
                            <label for="details_en" class="mr-sm-2 mb-2">  المحتوي ب الانجليزيه  </label>
                            <textarea wire:model="details_en" class="form-control" name="details_en" id="details_en"></textarea>
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
    </div>
    @section('js')
        {{-- <script src="{{ url('editor_html/ckeditor.js')}}"></script>
        <script src="{{ url('editor_html/adapters/jquery.js')}}"></script> --}}
        <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>

        <script>
        $( document ).ready( function() {
            $( 'textarea.editor1' ).ckeditor();
        } );
        
        </script>
      <script>
        editor = CKEDITOR.replace('details_en');
       editor.on('change', function(event){
           @this.set('details_en', event.editor.getData());
       })
   </script>
   <script>
            editor = CKEDITOR.replace('details');
           editor.on('change', function(event){
               @this.set('details', event.editor.getData());
           })
   </script>
    @endsection
</div>

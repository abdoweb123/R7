<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-12 mb-3">
                    <label for="question" class="mr-sm-2">السؤال</label>
                    <input id="question" type="text" name="question" class="form-control" wire:model.lazy='question'>
                    @error('question')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="question_en" class="mr-sm-2">السؤال بالانجليزيه</label>
                    <input id="question_en" type="text" name="question_en" class="form-control" wire:model.lazy='question_en'>
                    @error('question_en')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="answer" class="mr-sm-2">الاجابه</label>
                    <textarea name="" id="" cols="15" rows="5" class="form-control editor1" wire:model.lazy='answer'></textarea>
                    @error('answer')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="answer_en" class="mr-sm-2">  الاجابه ب الانجليزيه  </label>
                    <textarea name="" id="" cols="15"  rows="5" class="form-control editor1" wire:model.lazy='answer_en'></textarea>
                    @error('answer_en')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">close</button>
            <button type="submit" class="btn btn-warning">{{ $ids != null ? 'تعديل' : 'حفظ' }}</button>
        </div>
    </form>
</div>

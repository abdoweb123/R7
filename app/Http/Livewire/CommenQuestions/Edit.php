<?php

namespace App\Http\Livewire\CommenQuestions;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\CommonQuestion;
use App\Models\Company;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$question,$question_en,$answer,$answer_en;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        return view('livewire.commen-questions.edit')->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'question'=>'required',
            'answer'=>'required',
        ]);
        if($this->ids != null){
            $data=CommonQuestion::find($this->ids);
        }else{
            $data= new CommonQuestion();
        }

        $data->question=$this->question;
        $data->question_en=$this->question_en;
        $data->answer=$this->answer;
        $data->answer_en=$this->answer_en;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('commen-questions');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->question=$edit_object['question'];
        $this->question_en=$edit_object['question_en'];
        $this->answer=$edit_object['answer'];
        $this->answer_en=$edit_object['answer_en'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->question=null;
        $this->question_en=null;
        $this->answer=null;
        $this->answer_en=null;
    }
}

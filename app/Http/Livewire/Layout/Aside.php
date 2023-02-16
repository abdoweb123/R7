<?php

namespace App\Http\Livewire\Layout;

use Livewire\Component;
use App\Models\Company;
class Aside extends Component
{
    public function render()
    {
        return view('livewire.layout.aside');
    }

    public function change_mood()
    {
        $data=Company::find(auth('company')->user()->id);
        if($data->dark_mode == 'Y'){
            $data->dark_mode ='N';
        }else{
            $data->dark_mode ='Y';
        }
        $data->save();
        return redirect(request()->header('Referer'));
    }

    public function change_lang()
    {
        $data=Company::find(auth('company')->user()->id);
        if($data->lang == 'ar'){
            $data->lang ='en';
        }else{
            $data->lang ='ar';
        }
        $data->save();
        return redirect(request()->header('Referer'));
    }
}

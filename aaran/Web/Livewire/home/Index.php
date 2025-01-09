<?php

namespace Aaran\Web\Livewire\home;

use Aaran\Web\Models\HomeSlide;
use Livewire\Component;

class Index extends Component
{
    public $slides;

    public function getData(){
        $this->slides = HomeSlide::take(4)->latest()->get();
}
    public function render()
    {
        $this->getData();
        return view('web::home.index')->layout('layouts.web');
    }


}

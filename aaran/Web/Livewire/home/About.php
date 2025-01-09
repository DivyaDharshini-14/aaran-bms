<?php

namespace Aaran\Web\Livewire\home;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('web::home.about')->layout('layouts.web');
    }
}

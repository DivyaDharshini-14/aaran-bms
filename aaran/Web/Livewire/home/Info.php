<?php

namespace Aaran\Web\Livewire\home;

use Livewire\Component;

class Info extends Component
{
    public function render()
    {
        return view('web::home.info')->layout('layouts.web');
    }
}

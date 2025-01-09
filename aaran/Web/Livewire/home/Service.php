<?php

namespace Aaran\Web\Livewire\home;

use Livewire\Component;

class Service extends Component
{
    public function render()
    {
        return view('web::home.service')->layout('layouts.web');
    }
}

<?php

namespace App\Livewire\Test;

use Livewire\Component;

class Index extends Component
{
    public $searches;

    public function render()
    {
        return view('livewire.test.index');
    }
}

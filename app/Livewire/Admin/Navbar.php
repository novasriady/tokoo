<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Navbar extends Component
{
    public bool $isOpenProfileBox = false;

    public function toggleProfileBox () {
        $this->isOpenProfileBox = !$this->isOpenProfileBox;
    }

    public function render()
    {
        return view('livewire.admin.navbar');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class Signup extends Component
{
    public $hello = "Hello";
    public bool $signup_part_one = true;
    public bool $signup_part_two = false;
    public bool $signup_part_three = false;

    public function showPartOne()
    {   
        $this->signup_part_one = true;
        $this->signup_part_two = false;
        $this->signup_part_three = false;
    }
    public function showPartTwo()
    {   
        $this->signup_part_one = false;
        $this->signup_part_two = true;
        $this->signup_part_three = false;
    }

    public function showPartThree()
    {   
        $this->signup_part_one = false;
        $this->signup_part_two = false;
        $this->signup_part_three = true;
    }

    public function mount()
    {
        
    }

    public function render()
    {
        return view('livewire.signup');
    }
}

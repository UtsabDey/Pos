<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Section extends Component
{
    public $addMore = [1];
    public $count = 0;

    public function AddMore()
    {
        $countable = $this->count++;
        if ($countable < 5) {
            $this->addMore[] = count($this->addMore) + 1;
        }
    }

    public function render()
    {
        return view('livewire.section');
    }
}

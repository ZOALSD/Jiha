<?php

namespace App\Http\Livewire;

use App\Models\Card;
use Livewire\Component;

class ShowInvoices extends Component
{
    
    public $count;
    public function render()
    {
        $this->count = Card::where('seen',1)->count();
        return view('livewire.show-invoices');
    }

    public function mount(){


    }
}

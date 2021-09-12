<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductListing extends Component
{
    public $gender='';
    public function render()
    {
        $data['contents']=Product::with(['brand', 'media'])
            ->whereGender($this->gender)
            ->inRandomOrder()
            ->paginate(15);
        return view('livewire.product-listing',['data' => $data]);
    }
}

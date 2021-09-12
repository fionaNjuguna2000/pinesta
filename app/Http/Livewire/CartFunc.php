<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CartFunc extends Component
{
    public function render()
    {
        $data['contents']= Cart::with(['product','product.media'])
            ->whereUserId(Auth::id())
            ->whereStatus(config('settings.status.active'))
            ->get();

        $additions= Cart::whereUserId(Auth::id())
            ->whereStatus(config('settings.status.active'))
            ->select(DB::raw('(quantity * amount) as total'))
            ->get();
       $data['totals']=$additions->sum('total');

        return view('livewire.cart-func',['data'=>$data]);
    }
}

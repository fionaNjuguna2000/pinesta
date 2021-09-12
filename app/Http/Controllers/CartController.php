<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function removeIndex(Cart $cart)
    {
        $cart->delete();
        toastSuccess('Item Removed');
        return back();
    }

    public function addCart(Request $request){
        $cart = new Cart();
        $cart->user_id=Auth::id();
        $cart->product_id=$request->get('product_id');
        $cart->quantity=$request->get('quantity');
        $cart->amount=$request->get('amount');
        $cart->size=$request->get('size');
        $cart->save();
        toastSuccess('Product added successfully');
        return back();
    }

    public function checkout()
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

        $data['user']=User::whereid(Auth::id())
            ->with('info')
            ->first();
        return view('web.cart',['data'=>$data]);
    }
}

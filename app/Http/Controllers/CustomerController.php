<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function addOrder()
    {
        $id=Auth::id();
        $items=Cart::whereUserId($id)
            ->whereStatus(config('settings.status.active'))
            ->get();

        $ord='ORD-'.Str::random(8).'-'.date('Y');

        foreach ($items as $item){
            Order::create([
                'order' => $ord,
                'user_id'=>$id,
                'amount'=>($item->amount * $item->quantity),
                'cart_id' => $item->id,
                'order_status' => 'processing',
            ]);

            $item->update(['status' =>config('settings.status.inactive')]);
        }


        return redirect()->route('customer.index');

    }


    public function index(){

        $data['title']="Order";
         $data['orders']=Order::with('cart')->whereUserId(Auth::id())
        ->whereOrderStatus('processing')
       ->select(
           'order',
           DB::raw('SUM(amount) as qt'))
            ->groupBy('order')
        ->get();

        return view('backend.customer.index',['data'=>$data]);


    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']="Sales";
        $data['products']=Product::with(['media','brand'])
        ->whereStatus(config('settings.status.active'))
            ->paginate(10);

        return  view('backend.sales.index',['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $product=Product::find($request->get('prod'));
        if($request->get('quantity')>$product->quantity){
            toastError('your quantity cant be processed');
            return back();
        }

        $sale=new Sale();
        $sale->user_id=$request->get('user_id');
        $sale->product_id=$request->get('prod');
        $sale->employee_id=Auth::id();
        $sale->sale=config('settings.sales.direct_sale');
        $sale->quantity=$request->get('quantity');
        $sale->amount=$request->get('amount');
        $sale->save();

        $product->update([
            'quantity' =>($request->get('quantity')-$product->quantity)
        ]);

        toastSuccess('Sale created successfully');
        return redirect()->route('sales.sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

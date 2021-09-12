<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class AdminController extends Controller
{


    /**
     * @return Application|Factory|View
     */
    public function products()
    {
        $data['title']="Products";
        $data['products']= Product::with(['brand', 'media'])
            ->orderByDesc('id')
            ->paginate(20);

        return view('backend.admin.products.index',['data'=>$data]);
    }

    /**
     * @return Application|Factory|View
     */
    public function createProducts()
    {
        $data['title']="Add Products";
        $data['brands']=Brand::select(['id','name'])
            ->get();
        $data['products']= Product::with(['brand', 'media'])
            ->orderByDesc('id')
            ->paginate(20);

        return view('backend.admin.products.create',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function storeProducts(Request $request)
    {
        $product=new Product();
        $product->name=$request->get('name');
        $product->title=$request->get('title');
        $product->sku=Str::random(8);
        $product->brand_id=$request->get('brand_id');
        $product->colorway=$request->get('colorway');
        $product->gender=$request->get('gender');
        $product->status=$request->get('status');
        $product->retail_price=$request->get('retail_price');
        $product->size=$request->get('size');
        $product->shoe=$request->get('shoe');
        $product->quantity=$request->get('quantity');
        $product->save();

        if ($request->has('imageUrl')){
            $product->addMedia($request->file('imageUrl'))
                ->addCustomHeaders([
                    'ACL' => 'public-read'
                ])->toMediaCollection('imageUrl');
        }

        if ($request->has('smallImageUrl')){
            $product->addMedia($request->file('smallImageUrl'))
                ->addCustomHeaders([
                    'ACL' => 'public-read'
                ])->toMediaCollection('smallImageUrl');
        }


        if ($request->has('thumbUrl')){
            $product->addMedia($request->file('thumbUrl'))
                ->addCustomHeaders([
                    'ACL' => 'public-read'
                ])->toMediaCollection('thumbUrl');
        }

        toastSuccess('Item created successfully');
        return redirect()->route('admin.products');

    }

    public function showProduct(Product $product)
    {
        $data['title']=$product->name;
        $data['product']=$product;
        return view('backend.admin.products.show',['data'=>$data]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|Factory|View|Response
     */
    public function user(Request $request)
    {
        $data['title']="Users";
        $data['users']=User::with(['info'])
            ->paginate(20);
        return \view('backend.admin.users.index',['data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        toastError('User deleted successfully');
        return back();
    }

    public function createUser()
    {
        $data['title']="Add Users";
        return view('backend.admin.users.create',['data' => $data]);

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeUser(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->role=$request->get('role');
        $user->save();
        toastSuccess('User Stored successfully');
        return redirect()->route('admin.user');

    }

    public function sales(){
        $data['title'] = 'Sales';
        $data['online_sales']=Sale::with(['user','product','product.media'])
            ->whereSale(config('settings.sales.online'))
            ->get();
        $data['direct_sales']=Sale::with(['employee','product','product.media'])
            ->whereSale(config('settings.sales.direct_sale'))
            ->get();


        return view('backend.admin.sale.index',['data'=>$data]);
    }




}

<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class WebController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {

        $data['brands'] = Product::with('brand')
            ->whereHas('media')
            ->select('brand_id', DB::raw('count(*) as total'))
            ->groupBy('brand_id')
            ->get();

        $data['comments'] = Comment::with(['user'])
          ->whereStatus(config('settings.status.active'))
            ->inRandomOrder()
            ->get()->take(3);

        $data['products'] = Product::with(['brand', 'media'])
            ->whereHas('media')
            ->inRandomOrder()
            ->get();

        $data['topSales'] = Product::with(['brand', 'media'])
            ->whereHas('media')
            ->inRandomOrder()
            ->get();


        return view('web.index', ['data' => $data]);
    }

    /**
     * @param Product $product
     * @return Application|Factory|View
     */
    public function details(Product $product)
    {
        $data['product'] = $product->load(['comments.user']);
        $data['extras'] = Product::with(['brand', 'media'])
            ->whereGender($product->gender)
            ->inRandomOrder()
            ->get();
        return view('web.product-detail', ['data' => $data]);
    }

    /**
     * @return Application|Factory|View
     */
    public function cart()
    {
        $data['title'] = "Title";
        return view('web.cart', ['data' => $data]);
    }

    public function listing($gender){
        $data['title'] = "Listing";
        $data['gender'] = strtolower($gender);

        return view('web.listing',['data' => $data]);
    }

}

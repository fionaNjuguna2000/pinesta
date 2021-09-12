<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class crawlShoes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:shoes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'crawl shoe items from rapid api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $brands = Http::withHeaders([
            'x-rapidapi-host' => 'v1-sneakers.p.rapidapi.com',
            'x-rapidapi-key' => 'f0758f37f6msha0c434efe26f053p104b50jsna968e7928809'
        ])->get('https://v1-sneakers.p.rapidapi.com/v1/brands');
        foreach ($brands['results'] as $key => $value) {
            $name = Str::title($value);
            if (!Brand::whereName($name)->exists()) {
                Brand::create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                ]);
            }
        }


        $products = Http::withHeaders([
            'x-rapidapi-host' => 'v1-sneakers.p.rapidapi.com',
            'x-rapidapi-key' => 'f0758f37f6msha0c434efe26f053p104b50jsna968e7928809'
        ])->get('https://v1-sneakers.p.rapidapi.com/v1/sneakers', [
            'limit' => 30
        ]);

        foreach ($products['results'] as $item) {
            if (!Product::whereCrawlId($item['id'])->exists()) {
                $product = Product::create([
                    'crawl_id' => $item['id'],
                    'name' => $item['name'],
                    'title' => $item['title'],
                    'sku' => $item['styleId'],
                    'gender' => $item['gender'],
                    'retail_price' => $item['retailPrice'],
                    'release_date' => $item['releaseDate'],
                    'shoe' => $item['shoe'],
//                    'created_by' =>1,
                    'quantity' => rand(1,50),
                    'brand_id' => Brand::whereName($item['brand'])->first()->id,
                    'colorway' => $item['colorway'],
                ]);


                foreach ($item['media'] as $key=>$media) {
                    if (!is_null($media)) {
                        $product->addMediaFromUrl($media)
                            ->addCustomHeaders([
                                'ACL' => 'public-read'
                            ])->toMediaCollection($key);
                    } else if (!is_null($media)) {
                        $product->addMediaFromUrl($media)
                            ->addCustomHeaders([
                                'ACL' => 'public-read'
                            ])->toMediaCollection($key);
                    } else if (!is_null($media)){
                        $product->addMediaFromUrl($media)
                            ->addCustomHeaders([
                                'ACL' => 'public-read'
                            ])->toMediaCollection($key);
                    }

                }
            }


            $this->warn('crawl successful');
        }

    }
}

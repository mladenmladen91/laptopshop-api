<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Specification;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Function for importing products from Data';

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
        for ($j = 1; $j <= 16; $j++) {
            $endpoint = "https://search.gigatron.rs/v1/catalog/get/prenosni-racunari/laptop-racunari";
            $client = new \GuzzleHttp\Client();
            $page = $j;

            $response = $client->request('GET', $endpoint, ['query' => [
                'strana' => $page
            ]]);

            $content = json_decode($response->getBody(), true);
            $products = $content["hits"]["hits"];
            for ($i = 0; $i < sizeof($products); $i++) {
                $product = $products[$i]["_source"]["search_result_data"];
                $name = $product["name"];
                $brand = $product["brand"];
                $brand_image = $product["brand_image"];
                $price = $product["prices"]["price"]["value"];
                $price_old = $product["prices"]["old"]["value"];
                $saving = $product["prices"]["saving"]["value"];
                $small_image = $product["small_image"];
                $image = $product["image"];
                $big_image = $product["big_image"];
                $gift_url = $product["gift_url"];
                $stock = $product["stock"];
                $statistic_rating = $product["statistic_rating"];
                $statistic_votes = $product["statistic_votes"];
                $shock = $product["shock"];
                $top = $product["top"];
                $description = $products[$i]["_source"]["search_data"]["full_text_specification"];
                $product = Product::firstOrCreate([
                    'name' => $name,
                    'brand' => $brand,
                    'brand_image' => $brand_image,
                    'price' => $price,
                    'price_old' => $price_old,
                    'saving' => $saving,
                    'small_image' => $small_image,
                    'image' => $image,
                    'big_image' => $big_image,
                    'gift_url' => $gift_url,
                    'stock' => $stock,
                    'rating' => $statistic_rating,
                    'votes' => $statistic_votes,
                    'shock' => $shock,
                    'top' => $top,
                    'description' => $description,
                    'category_id' => 1,
                ]);
                $specifications = $products[$i]["_source"]["search_result_data"]["specification_summary"];
                foreach ($specifications as $specification) {
                    Specification::firstOrCreate([
                        "name" => $specification["name"],
                        "value" => $specification["value"],
                        "product_id" => $product->id
                    ]);
                }
            }
        }
    }
}

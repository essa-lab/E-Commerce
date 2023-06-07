<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImportProducts extends Command
{
    protected $signature = 'import:products';

    protected $description = 'Import products from external API';

    public function handle()
    {
        $response = Http::get('https://fakestoreapi.com/products/');

        if ($response->ok()) {
            $products = $response->json();

            foreach ($products as $productData) {


                // Fetch the category value from the API response
                $category = $productData['category'];
                $count = $productData['rating']['count'];
                $rate = $productData['rating']['rate'];

                // Find or create the category in the 'categories' table
                $categoryModel = Category::firstOrCreate(['title' => $category]);

                // Create the product in the 'products' table
                $product = new Product();
                $product->title = $productData['title'];
                $product->price = $productData['price'];
                $product->description=$productData['description'];



                // Set other product attributes

                // Associate the product with the category
                $product->category()->associate($categoryModel);

                // Fetch the image path from the API response
                $imageUrl = $productData['image'];
                $imageName = basename($imageUrl);
                $imagePath = 'products/' . $imageName;

                // Download the image and save it locally
                $imageData = file_get_contents($imageUrl);
                $image = Image::make($imageData);
                Storage::disk('public')->put($imagePath, $image->encode());

                // Set the image path in your product data for later storage in the database
                $productData['image'] = $imagePath;
                $product->image = $imagePath;
                // Save the product
                $product->save();

                $product->rating()->create([
                    'count' => $count,
                    'rate' => $rate,
                ]);

            }

            $this->info('Products imported successfully.');
        } else {
            $this->error('Failed to fetch products from API.');
        }
    }
}

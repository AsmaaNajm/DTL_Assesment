<?php

namespace App\Observers;

use App\Mail\CreateProductMail;
use App\Models\Product;
use App\Models\ProductHistory;
use App\Traits\HandleResponse;
use Illuminate\Support\Facades\Mail;

class ProductObserver
{
    use HandleResponse;
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $details = [
            "to" => $product->user->email,
            "title" => "Create Product",
            "body" => "Congratulations...The product is created successfully"
        ];
        Mail::to($details['to'])->send(new CreateProductMail($details));
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $updatedFields = collect($product->getDirty())->filter(function ($value, $key) {
            return !in_array($key, ['created_at', 'updated_at']);
        });

        $updatedFields->map(function ($value, $field) use ($product) {
            return [
                'product_id' => $product->id,
                'user_id' => $product->user->id,
                'prev_value' => $product->getOriginal($field),
                'new_value' => $product->$field,
            ];
        })->each(function ($record) {
            ProductHistory::create($record);
        });
    }
}

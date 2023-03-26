<?php

namespace App\Http\Controllers;

use App\Constants\Response;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\GetProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductHistory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::filter()->get();
        return $this->successResponse('Successful', ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $productResult = Product::firstOrCreate($request->validated());
        if ($productResult)
            return $this->successResponse('Successful', new ProductResource($productResult), Response::CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $product = Product::findOrFail($id);
        return $this->successResponse('Successful',  new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        Product::findOrFail($id)->update($request->validated());
        return $this->successResponse('Successful updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return $this->successResponse('Successful');
    }

    public function getProductHistoryList($id)
    {
        $productHistoryList = ProductHistory::where('product_id', $id)->get();
        return $this->successResponse($productHistoryList);
    }
    public function getHistory()
    {
        $productHistoryList = ProductHistory::all();
        return $this->successResponse($productHistoryList);
    }
}

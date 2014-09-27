<?php namespace SiteApi;

use Aska\Site\Models\Product;
use Aska\Site\Permissions\ProductPermission;
use BaseController;
use Input, Response;

class ProductController extends \BaseController {

    /**
     * @param Product $products
     * @param ProductPermission $productPermission
     */
    public function __construct(Product $products, ProductPermission $productPermission)
    {
        $this->products = $products;
        $this->productPermission = $productPermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->products->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(! $this->productPermission->canCreate()) {

            $this->forbidden("You can't create product");
        }

        $this->validateOrFail($data = Input::all(), $this->products->rules());

        return $this->products->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        return $product->load('images');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Product $product
     * @return Response
     */
    public function update(Product $product)
    {
        if(! $this->productPermission->canUpdate($product)) {

            $this->forbidden("You can't update this product");
        }

        $this->validateOrFail($data = Input::all(), $product->rules());

        $product->update(Input::all());

        return $product;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        if(! $this->productPermission->canDelete($product)) {

            $this->forbidden("You can't delete this product");
        }

        $product->delete();

        return Response::make(['message' => 'Product deleted successfully']);
    }


}

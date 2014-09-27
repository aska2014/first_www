<?php

use Aska\Site\Models\Product;
use Aska\Site\Models\ProductCategory;

class ProductsController extends BaseController {

    /**
     * @param ProductCategory $productCategories
     * @param Product $products
     */
    public function __construct(ProductCategory $productCategories, Product $products)
    {
        $this->productCategories = $productCategories;
        $this->products = $products;
    }

    /**
     * Display all products along with a filter by category
     */
    public function index()
    {
        $this->setPage('products');

        return View::make('products.index')
            ->with('productCategories', $this->productCategories->all())
            ->with('products', $this->products->all());
    }

    /**
     * @param $slug
     */
    public function category($slug)
    {
        return $this->index()->with('selectedCategory', $this->productCategories->bySlug($slug)->first());
    }

    /**
     * @param $slug
     */
    public function show($slug)
    {
        return View::make('product.index')
            ->with('product', $this->products->bySlug($slug)->first());
    }

} 
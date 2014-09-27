<?php namespace SiteApi;

use Aska\Site\Models\ProductCategory;
use Aska\Site\Permissions\ProductCategoryPermission;
use BaseController;
use Input, Response;

class ProductCategoryController extends \BaseController {

    /**
     * @param ProductCategory $productCategories
     * @param ProductCategoryPermission $categoryPermission
     */
    public function __construct(ProductCategory $productCategories, ProductCategoryPermission $categoryPermission)
    {
        $this->productCategories = $productCategories;
        $this->categoryPermission = $categoryPermission;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return $this->productCategories->all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if(! $this->categoryPermission->canCreate()) {

            $this->forbidden("You can't create product categories");
        }

        $this->validateOrFail($data = Input::all(), $this->productCategories->rules());

        return $this->productCategories->create($data);
	}


    /**
     * Display the specified resource.
     *
     * @param ProductCategory $productCategory
     * @return Response
     */
	public function show(ProductCategory $productCategory)
	{
        return $productCategory->load('image');
	}

    /**
     * Update the specified resource in storage.
     *
     * @param ProductCategory $productCategory
     * @return Response
     */
	public function update(ProductCategory $productCategory)
	{
        if(! $this->categoryPermission->canUpdate($productCategory)) {

            $this->forbidden("You can't update this category");
        }

        $this->validateOrFail($data = Input::all(), $productCategory->rules());

        $productCategory->update(Input::all());

        return $productCategory;
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param ProductCategory $productCategory
     * @return Response
     */
	public function destroy(ProductCategory $productCategory)
	{
        if(! $this->categoryPermission->canDelete($productCategory)) {

            $this->forbidden("You can't delete this category");
        }

        $productCategory->delete();

        return Response::make(['message' => 'Category deleted successfully']);
	}


}

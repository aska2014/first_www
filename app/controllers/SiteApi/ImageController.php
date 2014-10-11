<?php namespace SiteApi;

use Aska\ImageHandlers\NewsImage;
use Aska\ImageHandlers\PageSectionImage;
use Aska\ImageHandlers\ProductCategoryImage;
use Aska\ImageHandlers\ProductImage;
use Aska\ImageHandlers\ServiceCategoryImage;
use Aska\ImageHandlers\ServiceImage;
use Aska\ImageHandlers\SiteProjectImage;
use Aska\ImageHandlers\SliderItemImage;
use Aska\Media\Models\Image;
use Aska\Site\Models\News;
use Aska\Site\Models\PageSection;
use Aska\Site\Models\Product;
use Aska\Site\Models\ProductCategory;
use Aska\Site\Models\Project;
use Aska\Site\Models\Service;
use Aska\Site\Models\ServiceCategory;
use Aska\Site\Models\SliderItem;
use Aska\Site\Permissions\ImagePermission;
use Input;

class ImageController extends \BaseController {

    /**
     * @param ProductCategoryImage $productCategoryImage
     * @param ProductImage $productImage
     * @param ServiceCategoryImage $serviceCategoryImage
     * @param ServiceImage $serviceImage
     * @param SliderItemImage $sliderItemImage
     * @param ImagePermission $imagePermission
     * @param \Aska\Media\Models\Image $images
     * @param SiteProjectImage $projectImage
     * @param \Aska\ImageHandlers\PageSectionImage $pageSectionImage
     */
    public function __construct(ProductCategoryImage $productCategoryImage, ProductImage $productImage,
                                ServiceCategoryImage $serviceCategoryImage, ServiceImage $serviceImage,
                                SliderItemImage $sliderItemImage, ImagePermission $imagePermission,
                                Image $images, SiteProjectImage $projectImage, PageSectionImage $pageSectionImage, NewsImage $newsImage)
    {

        $this->productCategoryImage = $productCategoryImage;
        $this->productImage = $productImage;
        $this->serviceCategoryImage = $serviceCategoryImage;
        $this->serviceImage = $serviceImage;
        $this->sliderItemImage = $sliderItemImage;
        $this->imagePermission = $imagePermission;
        $this->images = $images;
        $this->projectImage = $projectImage;
        $this->pageSectionImage = $pageSectionImage;
        $this->newsImage = $newsImage;
    }

    /**
     * Upload products images
     * @param Product $product
     * @return array
     */
    public function product(Product $product)
    {
        if(! $this->imagePermission->canCreate()) {

            $this->forbidden("You can't create images");
        }

        return $this->productImage->addGalleryImage(Input::file('file'), $product);
    }

    /**
     * @param ProductCategory $productCategory
     * @return array
     */
    public function productCategory(ProductCategory $productCategory)
    {
        if(! $this->imagePermission->canCreate()) {

            $this->forbidden("You can't create images");
        }

        return $this->productCategoryImage->setMainImage(Input::file('file'), $productCategory);
    }

    /**
     * @param Service $service
     * @return array
     */
    public function service(Service $service)
    {
        if(! $this->imagePermission->canCreate()) {

            $this->forbidden("You can't create images");
        }

        return $this->serviceImage->addGalleryImage(Input::file('file'), $service);
    }

    /**
     * @param ServiceCategory $serviceCategory
     * @return array
     */
    public function serviceCategory(ServiceCategory $serviceCategory)
    {
        if(! $this->imagePermission->canCreate()) {

            $this->forbidden("You can't create images");
        }

        return $this->serviceCategoryImage->setMainImage(Input::file('file'), $serviceCategory);
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function project(Project $project)
    {
        if(! $this->imagePermission->canCreate()) {

            $this->forbidden("You can't create images");
        }

        return $this->projectImage->addGalleryImage(Input::file('file'), $project);
    }

    /**
     * @param \Aska\Site\Models\News $news
     * @return mixed
     */
    public function news(News $news)
    {
        if(! $this->imagePermission->canCreate()) {

            $this->forbidden("You can't create images");
        }

        return $this->newsImage->addGalleryImage(Input::file('file'), $news);
    }

    /**
     * @param SliderItem $sliderItem
     * @return array
     */
    public function sliderItem(SliderItem $sliderItem)
    {
        if(! $this->imagePermission->canCreate()) {

            $this->forbidden("You can't create images");
        }

        return $this->sliderItemImage->setMainImage(Input::file('file'), $sliderItem);
    }

    /**
     * @param PageSection $pageSection
     * @return array
     */
    public function pageSection(PageSection $pageSection)
    {
        if(! $this->imagePermission->canCreate()) {

            $this->forbidden("You can't create images");
        }

        return $this->pageSectionImage->setMainImage(Input::file('file'), $pageSection);
    }

    /**
     * Delete image
     */
    public function destroy(Image $image)
    {
        if(! $this->imagePermission->canDelete($image)) {

            $this->forbidden("You can't delete this image");
        }

        $image->delete();

        return ['message' => 'Image deleted successfully'];
    }


    /**
     * @param $ids
     * @return array
     */
    public function destroyAll($ids)
    {
        foreach(explode("," , $ids) as $id)
        {
            if(! $image = $this->images->find($id)) continue;

            $this->destroy($image);
        }

        return ['message' => 'All images deleted successfully'];
    }
}
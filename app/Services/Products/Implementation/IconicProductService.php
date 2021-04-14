<?php
namespace App\Services\Products\Implementation;

use App\Services\Products\Interfaces\IProductService;

class IconicProductService implements IProductService
{
    /**
     * Fetch all products
     * @return array
     */
    public function fetchProducts(): array
    {

    }

    /**
     * Get preview videos (if any) for the product
     * @param string $productSku
     * @return array
     */
    public function getPreviewVideos(string $productSku): array
    {

    }

    /**
     * Decorate the products with preview videos (if any)
     * @param array $products
     * @return array
     */
    public function decorateProducts(array $products): array
    {

    }
}

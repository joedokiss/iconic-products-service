<?php
namespace App\Services\Products\Implementation;

use App\Services\HttpService;
use App\Services\Products\Interfaces\IProductService;

class IconicProductService implements IProductService
{
    const BASE_URL = 'https://eve.theiconic.com.au/';

    private $httpClient;

    public function __construct()
    {
        $this->httpClient = app()->make(HttpService::class, ['baseUrl' => self::BASE_URL]);
    }

    /**
     * Fetch all products
     * @return array
     */
    public function fetchProducts(): array
    {
        $jsonProducts = $this->httpClient->getData('GET', 'catalog/products', ['query' => [
            'gender' => 'female',
            'page' => 1,
            'page_size' => 30,
            'sort' => 'popularity',
        ]]);

        return isset($jsonProducts['_embedded']['product'])
            ? $jsonProducts['_embedded']['product']
            : [];
    }

    /**
     * Get preview videos (if any) for the product
     * @param string $productSku
     * @return array
     */
    public function getPreviewVideos(string $productSku): array
    {
        $videos = $this->httpClient->getData('GET', "catalog/products/{$productSku}/videos");

        return isset($videos['_embedded']['videos_url'])
            ? $videos['_embedded']['videos_url']
            : [];
    }

    /**
     * Decorate the products with preview videos (if any)
     * @param array $products
     * @return array
     */
    public function decorateProducts(array $products): array
    {
        $productsCollection = [];

        foreach ($products as $product)
        {
            // No videos
            if ((int)$product['video_count'] === 0)
            {
                // Add products without videos on bottom
                array_push($productsCollection, $product);
                continue;
            }

            $videos = $this->getPreviewVideos($product['sku']);

            if (!empty($videos))
            {
                $decoratedProduct = array_merge($product, ['videos_previews' => $videos]);

                // Add products having videos on the top
                array_unshift($productsCollection, $decoratedProduct);
            }
        }

        return $productsCollection;
    }
}

<?php
namespace App\Services\Products\Interfaces;

interface IProductService
{
    public function fetchProducts();

    public function getPreviewVideos(string $productSku);

    public function decorateProducts(array $products);
}

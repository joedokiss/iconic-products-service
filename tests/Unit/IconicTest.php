<?php

namespace Tests\Unit;

use App\Services\Products\Implementation\IconicProductService;
use Tests\TestCase;

class IconicTest extends TestCase
{
    public function test_decorate_products_having_videos()
    {
        $product = [
            0 => [
                'video_count' => 1,
                'sku' => 'PE745AA11LMQ',
                'name' => 'Steady Run Leggings',
            ]
        ];
        $productVideo = [
            0 => [
                'url' => 'https://vod-progressive.akamaized.net/exp=1618402104~acl=%2Fvimeo-prod-skyfire-std-us%2F01%2F1036%2F21%2F530184014%2F2497272071.mp4~hmac=5144760de753813881705f36b16763a2c715ca59c9ae688c04dbb8f50d0d7c8b/vimeo-prod-skyfire-std-us/01/1036/21/530184014/2497272071.mp4',
            ],
        ];
        $productWithVideo = [
            0 => [
                'video_count' => 1,
                'sku' => 'PE745AA11LMQ',
                'name' => 'Steady Run Leggings',
                'videos_previews' => [
                    [
                        'url' => 'https://vod-progressive.akamaized.net/exp=1618402104~acl=%2Fvimeo-prod-skyfire-std-us%2F01%2F1036%2F21%2F530184014%2F2497272071.mp4~hmac=5144760de753813881705f36b16763a2c715ca59c9ae688c04dbb8f50d0d7c8b/vimeo-prod-skyfire-std-us/01/1036/21/530184014/2497272071.mp4',
                    ]
                ]
            ]
        ];

        $productServiceMock = $this->createPartialMock(IconicProductService::class, ['getPreviewVideos']);

        $productServiceMock->method('getPreviewVideos')
            ->willReturn($productVideo);

        $this->assertEquals($productWithVideo, $productServiceMock->decorateProducts($product));
    }

    public function test_decorate_products_expects_get_videos_once()
    {
        $product = [
            0 => [
                'video_count' => 1,
                'sku' => 'PE745AA11LMQ',
                'name' => 'Steady Run Leggings',
            ],
            1 => [
                'video_count' => 0,
                'sku' => 'NI126SA50NLX',
                'name' => 'Steady Run Leggings',
            ]
        ];

        $productServiceMock = $this->createPartialMock(IconicProductService::class, ['getPreviewVideos']);
        $productServiceMock->expects($this->exactly(1))
            ->method('getPreviewVideos')
            ->with('PE745AA11LMQ');

        $productServiceMock->decorateProducts($product);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class IconicFeatureTest extends TestCase
{
    public function test_output_json_file()
    {
        Artisan::call('command:iconic');

        Storage::disk('local')->assertExists('out.json');
    }
}

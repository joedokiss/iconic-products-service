<?php
namespace App\Utils;

use Illuminate\Support\Facades\Storage;

class Outputer
{
    /**
     * Output the data to a JSON file
     * @param array $data
     */
    public static function toJsonFile(array $data)
    {
        Storage::disk('local')->put('out.json', json_encode($data));
    }
}

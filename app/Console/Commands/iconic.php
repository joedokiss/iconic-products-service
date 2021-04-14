<?php

namespace App\Console\Commands;

use App\Services\Products\Interfaces\IProductService;
use App\Utils\Outputer;
use http\Exception;
use Illuminate\Console\Command;

class iconic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:iconic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Iconic products decoration service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param IProductService $iconicProductService
     * @return int
     */
    public function handle(IProductService $iconicProductService)
    {
        try
        {
            $products = $iconicProductService->fetchProducts();

            $decoratedProducts = $iconicProductService->decorateProducts($products);

            Outputer::toJsonFile($decoratedProducts);
        }
        catch (Exception $e)
        {
            // Log the error $e->getMessages();
            echo 'Something wrong!';
            return false;
        }

        return true;
    }
}

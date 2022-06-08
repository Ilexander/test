<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        DB::connection('top_follow')
            ->table('services')
            ->orderBy('id')
            ->each(function ($service) {

                Service::query()
                    ->insert([
                        'id'    => $service->id,
                        'user_id'   => $service->uid,
                        'category_id'   => $service->cate_id,
                        'name'  => $service->name,
                        'desc'  => $service->desc,
                        'price' => $service->price,
                        'original_price'    => $service->original_price,
                        'min'   => $service->min,
                        'max'   => $service->max,
                        'add_type'  => $service->add_type,
                        'type'  => $service->type,
                        'api_service_id'    => $service->api_service_id,
                        'api_provider_id'   => $service->api_provider_id,
                        'dripfeed'  => $service->dripfeed,
                        'status'    => $service->status,
                        'created_at' => $service->created,
                        'updated_at' => $service->changed,
                    ]);
            });
    }
}

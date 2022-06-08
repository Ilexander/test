<?php

namespace App\Console\Commands;

use App\Models\ApiProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportApiProviders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:api_providers';

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
            ->table('api_providers')
            ->orderBy('id')
            ->each(function ($api_provider) {

                ApiProvider::query()
                    ->insert([
                        'id'    => $api_provider->id,
                        'user_id'   => $api_provider->uid,
                        'name'  => $api_provider->name,
                        'url'   => $api_provider->url,
                        'key'   => $api_provider->key,
                        'type'  => $api_provider->type,
                        'balance'   => $api_provider->balance,
                        'currency_code' => $api_provider->currency_code ?? '',
                        'description'   => $api_provider->description,
                        'status'    => $api_provider->status,
                        'created_at' => $api_provider->created,
                        'updated_at' => $api_provider->changed,
                    ]);
            });
    }
}

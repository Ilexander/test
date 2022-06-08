<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users';

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
            ->table('general_users')
            ->where('id', '>', 263259)
            ->orderBy('id')
            ->each(function ($user) {
                User::query()
                    ->insert([
                        "id" => $user->id,
                        "email" => $user->email,
                        "password" => $user->password,
                        "email_verified_at" => date('Y-m-d H:i:s'),
                        "role_id" => User::ROLE_CLIENT,
                        "login_type" => null,
                        "first_name" => $user->first_name,
                        "last_name" => $user->last_name,
                        "timezone" => $user->timezone,
                        "more_information" =>  $user->more_information,
                        "desc" =>  $user->desc,
                        "balance" =>  $user->balance,
                        "custom_rate" => $user->custom_rate,
                        "api_key" =>  $user->api_key,
                        "spent" => $user->spent ?? 0,
                        "activation_key" =>  $user->activation_key,
                        "status" => $user->status,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s'),
                        "image_file" => "",
                    ]);
            });
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:categories';

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
            ->table('categories')
            ->orderBy('id')
            ->each(function ($category) {

                Category::query()
                    ->insert([
                        'id'    => $category->id,
                        'user_id'   => $category->uid,
                        'name'  => $category->name,
                        'description'   => $category->desc,
                        'image_url' => $category->image,
                        'sort'  => $category->sort,
                        'status'    => $category->status,
                    ]);
            });
    }
}

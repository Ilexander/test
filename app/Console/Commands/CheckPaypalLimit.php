<?php

namespace App\Console\Commands;

use App\Services\Payment\СustomPaypalService;
use Illuminate\Console\Command;

class CheckPaypalLimit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paypal:limit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check paypal transaction amount sum limit for day';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private СustomPaypalService $сustomPaypalService;

    public function __construct(СustomPaypalService $сustomPaypalService)
    {
        parent::__construct();

        $this->сustomPaypalService = $сustomPaypalService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->сustomPaypalService->getDailyLimit();
    }
}

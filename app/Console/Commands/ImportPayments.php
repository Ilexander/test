<?php

namespace App\Console\Commands;

use App\Models\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:payments';

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
        $res = DB::connection('top_follow')
            ->table('payments')
            ->orderBy('id')
            ->where('id', '>', 144)
            ->each(function ($payment) {
                $params = json_decode($payment->params, true);

                $client_id = $params['option']['client_id']
                    ?? (
                            $params['option']['merchant_id']
                            ?? (
                                    $params['option']['public_key']
                                    ?? $params['option']['usd_wallet']
                            )
                    );

                Payment::query()
                    ->insert([
                        'id'                    => $payment->id,
                        'name'                  => $payment->name,
                        'image_url'             => '',
                        'type'                  => $payment->type,
                        'min'                   => $payment->min,
                        'max'                   => $payment->max,
                        'status'                => $payment->status,
                        'take_fee_from_user'    => $params['take_fee_from_user'] ?? $params['option']['tnx_fee'],
                        'client_id'             => $client_id,
                        'secret_key'            => $params['option']['secret_key'] ?? $params['option']['alternate_pass'],
                        'limit'                 => $payment->max,
                        'created_at'            => date('Y-m-d H:i:s'),
                        'updated_at'            => date('Y-m-d H:i:s')
                    ]);
            });
    }
}

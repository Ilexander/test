<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:transactions';

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
            ->table('general_transaction_logs')
            ->where('id', '>', 97440)
            ->orderBy('id')
            ->each(function ($transaction) {

                /** @var Payment $payment */
                $payment = Payment::query()
                    ->where('type', $transaction->type)
                    ->first();

                $user = User::query()
                    ->where('id', $transaction->uid)
                    ->first();


                Transaction::query()
                    ->insert([
                        'id'                => $transaction->id,
                        'payer_email'       => $transaction->payer_email ?? '',
                        'payment_id'        => $payment->id ?? 1,
                        'transaction_id'    => $transaction->transaction_id,
                        'txn_fee'           => $transaction->txn_fee,
                        'amount'            => $transaction->amount,
                        'status'            => $transaction->status,
                        'system_hash'       => $transaction->ids,
                        'currency_id'       => 3,
                        'user_id'           => $user->id ?? 1,
                        'note'              => $transaction->note
                    ]);
            });
    }
}

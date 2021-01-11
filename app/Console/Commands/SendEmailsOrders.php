<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use function GuzzleHttp\Promise\all;

class SendEmailsOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendemailsorders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command SendEmailsOrders';

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
       $orders =  Order::whereDate('updated_at',  '<', Carbon::now()->subMonth(3)->toDate())->get();
        $count = $orders->count();
        foreach ($orders as $order) {
            if(\File::exists(public_path($order->file_path))){
                \File::delete(public_path($order->file_path));
            }
            $order->delete();
        }
        $this->info("Удалено {$count} записей.");
        return 0;
    }
}

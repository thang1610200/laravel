<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\SellTicket;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RefundTicketOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:refundorder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $sellticket = SellTicket::where('sold', '>', '0')->get();

        foreach ($sellticket as $data) {
            // Log::alert(array_sum(array_column($data->orderAll, 'quantity')));
            $sum = 0;
            foreach ($data->order as $order) {
                $sum += $order->quantity;
            }
            if ($sum !== $data->sold) {
                SellTicket::where('id', $data->id)->update([
                    'sold' => ($data->sold - ($data->sold - $sum))
                ]);
            }
        }

        $this->info("SUCCESS");
    }
}

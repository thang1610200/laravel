<?php

namespace Database\Seeders;

use App\Models\Pay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Pay::create( [
            'id'=>'9a940f4d-212a-49e8-8356-6057dbfd5688',
            'order_id'=>'9a940c4b-b823-45df-8943-712e3beebc72',
            'amount_from_buyer'=>1600000,
            'amount_to_seller'=>1200000,
            'amount_to_ht'=>400000,
            'created_at'=>'2023-11-10 02:03:45',
            'updated_at'=>'2023-11-10 02:03:45'
            ] );
            
            
                        
            Pay::create( [
            'id'=>'9a9bc295-9ea4-4392-9101-0507a599cce9',
            'order_id'=>'9a9bc203-d071-4d44-aaf3-3ccdb9e841ae',
            'amount_from_buyer'=>2800000,
            'amount_to_seller'=>2100000,
            'amount_to_ht'=>700000,
            'created_at'=>'2023-11-13 21:55:51',
            'updated_at'=>'2023-11-13 21:55:51'
            ] );
    }
}

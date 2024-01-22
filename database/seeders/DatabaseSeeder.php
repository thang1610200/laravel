<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pay;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(CommissionSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PaySeeder::class);
        $this->call(ResetPasswordSeeder::class);
        $this->call(SellTicketSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(WalletModelSeeder::class);
        $this->call(WithdrawSeeder::class);
        $this->call(UserSeeder::class);
    }
}

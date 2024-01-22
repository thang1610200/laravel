<?php

namespace Database\Seeders;

use App\Models\Commission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Commission::create( [
            'id'=>'9a857855-58ce-4502-aaf2-e5753a11308f',
            'name'=>'25%',
            'cost'=>25,
            'created_at'=>'2023-11-02 20:00:01',
            'updated_at'=>'2023-11-02 20:00:01'
            ] );
    }
}

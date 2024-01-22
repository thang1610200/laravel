<?php

namespace Database\Seeders;

use App\Models\SellTicket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Sellticket::create( [
            'id'=>'9a857864-1ec5-4a99-96e0-c30ea0996a60',
            'slug'=>'space-run',
            'seller_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'ticket_id'=>'9a85784c-a84e-4e25-9fbe-70b98617ac78',
            'commission_id'=>'9a857855-58ce-4502-aaf2-e5753a11308f',
            'price'=>400000,
            'quantity'=>4,
            'sold'=>4,
            'isSell'=>1,
            'isBrowse'=>1,
            'deleted_at'=>NULL,
            'created_at'=>'2023-11-02 20:00:11',
            'updated_at'=>'2023-11-10 02:03:14'
            ] );
            
            
                        
            Sellticket::create( [
            'id'=>'9a9bb1f7-9db9-4a2c-b1d3-b1f592db37f2',
            'slug'=>'klang',
            'seller_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'ticket_id'=>'9a8f8124-f94a-42ee-b49a-9ffcfcb26f2a',
            'commission_id'=>'9a857855-58ce-4502-aaf2-e5753a11308f',
            'price'=>700000,
            'quantity'=>8,
            'sold'=>4,
            'isSell'=>1,
            'isBrowse'=>1,
            'deleted_at'=>NULL,
            'created_at'=>'2023-11-13 21:09:24',
            'updated_at'=>'2023-11-14 01:56:00'
            ] );
            
            
                        
            Sellticket::create( [
            'id'=>'9a9bb204-1fea-45be-b197-717dd635823e',
            'slug'=>'ha-long',
            'seller_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'ticket_id'=>'9a859e35-1779-4e24-9db5-2aa6cbedc8f2',
            'commission_id'=>'9a857855-58ce-4502-aaf2-e5753a11308f',
            'price'=>700000,
            'quantity'=>10,
            'sold'=>0,
            'isSell'=>1,
            'isBrowse'=>1,
            'deleted_at'=>NULL,
            'created_at'=>'2023-11-13 21:09:32',
            'updated_at'=>'2023-11-14 01:56:00'
            ] );
            
            
                        
            Sellticket::create( [
            'id'=>'9a9bb211-aea3-4047-a384-78f90c778c7e',
            'slug'=>'dna',
            'seller_id'=>'9a85794e-79bb-41f6-a33d-782c74c997a4',
            'ticket_id'=>'9a858b99-0796-4a6c-ad10-38fee8a7756c',
            'commission_id'=>'9a857855-58ce-4502-aaf2-e5753a11308f',
            'price'=>150000,
            'quantity'=>7,
            'sold'=>0,
            'isSell'=>1,
            'isBrowse'=>1,
            'deleted_at'=>NULL,
            'created_at'=>'2023-11-13 21:09:41',
            'updated_at'=>'2023-11-14 21:23:33'
            ] );
            
            
                        
            Sellticket::create( [
            'id'=>'9a9bb21e-be6d-4277-b74a-7828925ba24f',
            'slug'=>'thanh-giong',
            'seller_id'=>'9a85794e-79bb-41f6-a33d-782c74c997a4',
            'ticket_id'=>'9a8579dc-27e4-4848-ac1c-81f77848b800',
            'commission_id'=>'9a857855-58ce-4502-aaf2-e5753a11308f',
            'price'=>250000,
            'quantity'=>5,
            'sold'=>0,
            'isSell'=>1,
            'isBrowse'=>1,
            'deleted_at'=>NULL,
            'created_at'=>'2023-11-13 21:09:49',
            'updated_at'=>'2023-11-14 02:44:00'
            ] );
            
            
                        
            Sellticket::create( [
            'id'=>'9a9be555-2783-422e-ae9a-ff739176e5ba',
            'slug'=>'move-for-hope',
            'seller_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'ticket_id'=>'9a9be52f-be06-4ddb-aa06-4cbf1e56cedb',
            'commission_id'=>'9a857855-58ce-4502-aaf2-e5753a11308f',
            'price'=>150000,
            'quantity'=>4,
            'sold'=>0,
            'isSell'=>1,
            'isBrowse'=>1,
            'deleted_at'=>NULL,
            'created_at'=>'2023-11-13 23:33:01',
            'updated_at'=>'2023-11-13 23:33:01'
            ] );
            
            
                        
            Sellticket::create( [
            'id'=>'9a9be6a1-a358-4ab4-a68a-417378dec62f',
            'slug'=>'smiles',
            'seller_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'ticket_id'=>'9a9be692-0b91-42b4-b848-86ba3af1ec67',
            'commission_id'=>'9a857855-58ce-4502-aaf2-e5753a11308f',
            'price'=>120000,
            'quantity'=>7,
            'sold'=>0,
            'isSell'=>1,
            'isBrowse'=>1,
            'deleted_at'=>NULL,
            'created_at'=>'2023-11-13 23:36:39',
            'updated_at'=>'2023-11-13 23:36:39'
            ] );
            
            
                        
            Sellticket::create( [
            'id'=>'9a9beeb4-f479-4a70-8d0f-e9e00c5d7544',
            'slug'=>'ultra-trail',
            'seller_id'=>'9a940235-7170-4dc2-8e44-0cef4446c2ff',
            'ticket_id'=>'9a9bee9e-26ff-43f1-8253-05769c4ec234',
            'commission_id'=>'9a857855-58ce-4502-aaf2-e5753a11308f',
            'price'=>70000,
            'quantity'=>4,
            'sold'=>0,
            'isSell'=>1,
            'isBrowse'=>1,
            'deleted_at'=>NULL,
            'created_at'=>'2023-11-13 23:59:14',
            'updated_at'=>'2023-11-13 23:59:14'
            ] );
    }
}

<?php

namespace Database\Seeders;

use App\Models\Withdraw;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Withdraw::create( [
            'id'=>'9aafb3a2-0cc1-4fe0-94b5-3d84f351a75d',
            'token'=>'1700794236',
            'user_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'cccd'=>'075202006689',
            'phone'=>'0385903024',
            'stk'=>'2222222',
            'bank'=>'VCB',
            'cccd_front'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1700794233/e35lqqapbntzsvphbxqd.jpg',
            'cccd_behind'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1700794236/xkti5jcrhp7soo1wjzry.jpg',
            'total'=>1000000,
            'status'=>'Cancel',
            'created_at'=>'2023-11-23 19:50:36',
            'updated_at'=>'2023-11-24 02:40:41'
            ] );
            
            
                        
            Withdraw::create( [
            'id'=>'9ab045ff-c197-4a8d-aaae-601ead6e863e',
            'token'=>'1700818793',
            'user_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'cccd'=>'075202006689',
            'phone'=>'122222',
            'stk'=>'123',
            'bank'=>'sdsd',
            'cccd_front'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1700818789/juwsnssdib0bwpfbarjw.jpg',
            'cccd_behind'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1700818792/s8v2nsebjbknjrfazucr.jpg',
            'total'=>1000000,
            'status'=>'Cancel',
            'created_at'=>'2023-11-24 02:39:53',
            'updated_at'=>'2023-11-24 02:40:34'
            ] );
            
            
                        
            Withdraw::create( [
            'id'=>'9ab0479c-c83c-468c-bdbc-691956393e51',
            'token'=>'1700819063',
            'user_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'cccd'=>'075202006689',
            'phone'=>'101011',
            'stk'=>'344',
            'bank'=>'re',
            'cccd_front'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1700819060/on823v43metav7tufn1i.jpg',
            'cccd_behind'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1700819063/l78tqkjh36rrvtgdn02x.jpg',
            'total'=>1000000,
            'status'=>'Cancel',
            'created_at'=>'2023-11-24 02:44:23',
            'updated_at'=>'2023-11-24 02:45:05'
            ] );
    }
}

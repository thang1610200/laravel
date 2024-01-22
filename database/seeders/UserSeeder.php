<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create( [
            'id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'name'=>'Nguyễn Hữu Thắng',
            'email'=>'nguyenhuuthangc7@gmail.com',
            'link'=>'nguyenhuuthangc7',
            'email_verified_at'=>'2023-11-02 19:53:08',
            'password'=>'$2y$10$O7ixT57rO/tvTmkyt23Y1.ftL5Uqk.ZGRZSvb8bpVHIS0o60xGhtK',
            'verify_code'=>'Kh6VhK2OPAIslIr7ZXdI',
            'role'=>'user',
            'amount'=>2100000,
            'image'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNL_ZnOTpXSvhf1UaK7beHey2BX42U6solRA&usqp=CAU',
            'remember_token'=>'n16HhlZ3FD5WTlxOF3GZlpiO4dpS0VuEkpminrXyNUaNXW24ruPvZCCnt6Fv',
            'created_at'=>'2023-11-02 19:52:51',
            'updated_at'=>'2023-11-24 02:45:05'
            ] );
            
            
                        
            User::create( [
            'id'=>'9a85777d-6ce9-42d9-879b-274e28eda68e',
            'name'=>'Nguyễn Hữu Thắng',
            'email'=>'nguyenhuuthang9440@gmail.com',
            'link'=>'nguyenhuuthang9440',
            'email_verified_at'=>NULL,
            'password'=>'$2y$10$NhFuqBGjQaC0ncurTutGOedyPAzIJP4kME2zTPhQl3ulcQMV1fMUu',
            'verify_code'=>NULL,
            'role'=>'admin',
            'amount'=>0,
            'image'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNL_ZnOTpXSvhf1UaK7beHey2BX42U6solRA&usqp=CAU',
            'remember_token'=>'tG0xI9rf8k1EgdkEetno1RApnYiSl9dpYb7xNboDTe3JpZE7MY3hwpCeM1kM',
            'created_at'=>'2023-11-02 19:57:40',
            'updated_at'=>'2023-11-24 02:40:41'
            ] );
            
            
                        
            User::create( [
            'id'=>'9a85794e-79bb-41f6-a33d-782c74c997a4',
            'name'=>'Nguyễn Thắng',
            'email'=>'thang123@gmail.com',
            'link'=>'thang123',
            'email_verified_at'=>'2023-11-03 03:02:56',
            'password'=>'$2y$10$yGcyQx..gE/LlJCnk9TbKeY1AU0PTY1GOHoODRWFrawBYQnKB86sq',
            'verify_code'=>'uY2GHx6ePuw64nNy8BWR',
            'role'=>'user',
            'amount'=>0,
            'image'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNL_ZnOTpXSvhf1UaK7beHey2BX42U6solRA&usqp=CAU',
            'remember_token'=>'li5n5hcdgswronfIJVpqnJ4B0lQe6cGaACxIAbqAnFThJmu3Tg6vXRCX71By',
            'created_at'=>'2023-11-02 20:02:45',
            'updated_at'=>'2023-11-10 01:08:22'
            ] );
            
            
                        
            User::create( [
            'id'=>'9a940235-7170-4dc2-8e44-0cef4446c2ff',
            'name'=>'thangtestssss',
            'email'=>'thang@gmail.com',
            'link'=>'thang',
            'email_verified_at'=>'2023-11-10 08:27:16',
            'password'=>'$2y$10$l4MiZTcAShtXa.t51vutMe4JJfijy200bGtuNb/uzyvKQLYsD1NKm',
            'verify_code'=>'JGxVc5Dwdf51woKUgDVH',
            'role'=>'user',
            'amount'=>0,
            'image'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNL_ZnOTpXSvhf1UaK7beHey2BX42U6solRA&usqp=CAU',
            'remember_token'=>'bmNlClRYlA7dYasLU4BRyoTqV2YvXh9u8pOzUAMsB9q3FmswZKnr9xWjnRJb',
            'created_at'=>'2023-11-10 01:27:08',
            'updated_at'=>'2023-11-10 01:27:08'
            ] );
    }
}

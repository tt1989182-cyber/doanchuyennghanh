<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            'description' => "Cửa hàng trang sức đẹp, chất lượng cao, phục vụ khách hàng tận tâm.",
            'short_des'   => "Trang sức tinh xảo, thời trang, sang trọng.",
            'photo'       => "image.jpg",  // nếu muốn có mặc định, giữ hoặc đổi tên file
            'logo'        => "logo.jpg",   // logo mặc định
            'address'     => "20 Phường Hòa Khánh, Đà Nẵng, Việt Nam",
            'email'       => "aurashop@gmail.com",
            'phone'       => "079-553-2120",
        );
        DB::table('settings')->insert($data);
    }
}

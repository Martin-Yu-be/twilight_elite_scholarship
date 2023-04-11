<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('districts')->insert(
            [
                ['id' => '1', 'name' => '不分區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '2', 'name' => '基隆區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '3', 'name' => '桃園區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '4', 'name' => '新竹區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '5', 'name' => '苗栗區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '6', 'name' => '南投區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '7', 'name' => '彰化區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '8', 'name' => '嘉義區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '9', 'name' => '台南區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '10', 'name' => '高雄區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '11', 'name' => '屏東區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '12', 'name' => '台東區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '13', 'name' => '花蓮區', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '14', 'name' => '宜蘭區', 'created_at' => now(), 'updated_at' => now()],
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('schools')->insert(
            [
                ['id' => '1', 'district_id' => '1', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '2', 'district_id' => '2', 'name' => '基隆高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '3', 'district_id' => '2', 'name' => '基隆女中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '4', 'district_id' => '3', 'name' => '武陵高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '5', 'district_id' => '3', 'name' => '桃園高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '6', 'district_id' => '3', 'name' => '中大壢中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '7', 'district_id' => '3', 'name' => '內壢高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '8', 'district_id' => '3', 'name' => '陽明高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '9', 'district_id' => '4', 'name' => '竹北高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '10', 'district_id' => '4', 'name' => '新竹中學', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '11', 'district_id' => '4', 'name' => '新竹女中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '12', 'district_id' => '4', 'name' => '湖口高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '13', 'district_id' => '5', 'name' => '苗栗高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '14', 'district_id' => '5', 'name' => '竹南高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '15', 'district_id' => '6', 'name' => '中興高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '16', 'district_id' => '6', 'name' => '南投高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '17', 'district_id' => '7', 'name' => '彰化高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '18', 'district_id' => '7', 'name' => '彰化女中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '19', 'district_id' => '8', 'name' => '嘉義高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '20', 'district_id' => '8', 'name' => '嘉義女中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '21', 'district_id' => '9', 'name' => '台南一中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '22', 'district_id' => '9', 'name' => '台南女中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '23', 'district_id' => '10', 'name' => '高雄中學', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '24', 'district_id' => '10', 'name' => '高雄女中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '25', 'district_id' => '10', 'name' => '三民高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '26', 'district_id' => '11', 'name' => '屏東高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '27', 'district_id' => '11', 'name' => '屏東女中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '28', 'district_id' => '11', 'name' => '潮州高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '29', 'district_id' => '12', 'name' => '台東高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '30', 'district_id' => '12', 'name' => '台東女中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '31', 'district_id' => '13', 'name' => '花蓮高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '32', 'district_id' => '13', 'name' => '花蓮女中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '33', 'district_id' => '14', 'name' => '宜蘭女中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '34', 'district_id' => '14', 'name' => '蘭陽女高', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '35', 'district_id' => '14', 'name' => '羅東高中', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '36', 'district_id' => '2', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '37', 'district_id' => '3', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '38', 'district_id' => '4', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '39', 'district_id' => '5', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '40', 'district_id' => '6', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '41', 'district_id' => '7', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '42', 'district_id' => '8', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '43', 'district_id' => '9', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '44', 'district_id' => '10', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '45', 'district_id' => '11', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '46', 'district_id' => '12', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '47', 'district_id' => '13', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
                ['id' => '48', 'district_id' => '14', 'name' => '不分校', 'created_at' => now(), 'updated_at' => now()],
            ]
        );
    }
}

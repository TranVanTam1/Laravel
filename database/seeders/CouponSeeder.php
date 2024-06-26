<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Coupon::create([
            'code' => 'DISCOUNT10',
            'discount_percent' => 10,
            'valid_from' => Carbon::now()->subDays(1), // Ngày hôm qua
            'valid_to' => Carbon::now()->addDays(30),   // Ngày hôm nay + 30 ngày
        ]);
    }
}

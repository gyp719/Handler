<?php

namespace Database\Seeders;

use App\Models\Mobile;
use Illuminate\Database\Seeder;

class MobileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mobile::factory()->count(1000)->create();
    }
}

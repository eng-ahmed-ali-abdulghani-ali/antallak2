<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //

    $cities = [
      ['name' => 'Riyadh'],
      ['name' => 'Jeddah'],
      ['name' => 'Mecca'],
      ['name' => 'Medina'],
      ['name' => 'Dammam'],
      ['name' => 'Khobar'],
      ['name' => 'Dhahran'],
      ['name' => 'Tabuk'],
      ['name' => 'Buraidah'],
      ['name' => 'Hail'],
      ['name' => 'Abha'],
      ['name' => 'Khamis Mushait'],
      ['name' => 'Najran'],
      ['name' => 'Sakakah'],
      ['name' => 'Jizan'],
      ['name' => 'Al Baha'],
      ['name' => 'Arar'],
    ];

    DB::table('cities')->insert($cities);
  }
}

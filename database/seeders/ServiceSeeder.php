<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //
    $services = [
      [
        'name' => 'Ride'
      ],
      ['name' => 'Delivery'],
    ];
    DB::table(table: 'services')->insert($services);
  }
}

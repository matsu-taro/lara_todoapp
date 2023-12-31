<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('users')->insert([
      [
        'name' => 'matsu',
        'email' => 'eee.rip179@gmail.com',
        'password' =>  Hash::make('ripslyme3080'),
        'created_at' => '2023/12/22 12:00:00'
      ],
      [
        'name' => 'なかむら',
        'email' => 'a@a.com',
        'password' =>  Hash::make('ripslyme3080'),
        'created_at' => '2023/12/22 12:00:00'
      ],
      [
        'name' => 'まつだ',
        'email' => 'a1@a.com',
        'password' =>  Hash::make('ripslyme3080'),
        'created_at' => '2023/12/22 12:00:00'
      ],
      [
        'name' => 'やまだ',
        'email' => 'a2@a.com',
        'password' =>  Hash::make('ripslyme3080'),
        'created_at' => '2023/12/22 12:00:00'
      ],
      [
        'name' => 'たなか',
        'email' => 'a3@a.com',
        'password' =>  Hash::make('ripslyme3080'),
        'created_at' => '2023/12/22 12:00:00'
      ],
      [
        'name' => 'さとう',
        'email' => 'a4@a.com',
        'password' =>  Hash::make('ripslyme3080'),
        'created_at' => '2023/12/22 12:00:00'
      ],
    ]);

  }
}

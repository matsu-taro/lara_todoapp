<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('todos')->insert([
            [
                'user_id'=>1,
                'title' => 'タイトル1',
                'content' => 'サンプルテキスト',
                'owner_name' => '田中',
                'status' => 0,
            ],
            [
                'user_id'=>2,
                'title' => 'タイトル2',
                'content' => 'サンプルテキスト',
                'owner_name' => '佐藤',
                'status' => 0,
            ],
            [
                'user_id'=>3,
                'title' => 'タイトル3',
                'content' => 'サンプルテキスト',
                'owner_name' => '山田',
                'status' => 1,
            ],
            [
                'user_id'=>4,
                'title' => 'タイトル4',
                'content' => 'サンプルテキスト',
                'owner_name' => '中村',
                'status' => 1,
            ],
            [
                'user_id'=>5,
                'title' => 'タイトル5',
                'content' => 'サンプルテキスト',
                'owner_name' => '斎藤',
                'status' => 2,
            ],
            [
                'user_id'=>6,
                'title' => 'タイトル6',
                'content' => 'サンプルテキスト',
                'owner_name' => '杉田',
                'status' => 2,
            ],
        ]);
    }
}

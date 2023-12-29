<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\MOdels\User;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all(); 

        foreach ($users as $user) {
            DB::table('todos')->insert([
                [
                    'user_id' => $user->id,
                    'title' => 'タイトル'.$user->id,
                    'content' => 'サンプルテキスト'.$user->id,
                    'owner_name' => $user->name,
                    'status' => 0,
                ]
            ]);
        }
    }
}

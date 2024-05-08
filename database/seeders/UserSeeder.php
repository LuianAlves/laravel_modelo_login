<?php

namespace Database\Seeders;

use App\Enums\PanelTypeEnum;
use App\Enums\UserStatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'teste@teste.com',
            'password' => bcrypt('teste123'),
            'status' => UserStatusEnum::ATIVO,
            'panel' => PanelTypeEnum::ADMIN
        ]);

        \App\Models\User::factory(30)->create([]);
    }
}

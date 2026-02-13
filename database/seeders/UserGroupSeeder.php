<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserGroup;

class UserGroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            ['name' => 'Admin Setda'],
            ['name' => 'Administrator'],
            ['name' => 'Operator'],
        ];
        
        foreach ($groups as $group) {
            UserGroup::create($group);
        }
    }
}
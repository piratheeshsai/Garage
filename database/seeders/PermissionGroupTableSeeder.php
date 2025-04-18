<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionGroups =[
            [
                'name' => 'branch'

            ],
            [
                'name' => 'user',

            ]

            ];
        foreach ($permissionGroups as $key => $value) {

            $permissionGroup = new PermissionGroup();
            $permissionGroup->name = $value['name'];
            $permissionGroup->save();

            echo "--------Created Permission Group Name=> $permissionGroup->name-----"."\n";
        }
        echo '---------Create completed---------'."\n";
    }

}

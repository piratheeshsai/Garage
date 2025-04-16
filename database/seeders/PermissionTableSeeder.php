<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions =[


            [
                'name' => 'branch Create',
                'permission_group_id' => PermissionGroup::where('name','branch')->first()->id

            ]
            ];

            echo '----------------------------------------------------------------'."\n";
        echo '---------Creating Permission ---------'."\n";
        foreach ($permissions as $key => $value) {
            $permission = new Permission();
            $permission->name = $value['name'];
            $permission->permission_group_id = $value['permission_group_id'];
            $permission->save();

            echo "--------Created Permission  Name=> $permission->name-----"."\n";
        }
        echo '---------Create completed---------'."\n";
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesPermissions = [
            'admin' => [
                'create invoice',
                'update invoice',
                'delete invoice',
                'view invoices',
                'view invoice'
            ],
            'member' => [
                'view invoices',
                'view invoice',
                'pay invoice',
                'view payed history'
            ]
        ];


        foreach ($rolesPermissions as $role => $permissions) {
            /** @var Role $roleCreated */
            $roleCreated = Role::query()->create(['name' => $role]);

            foreach ($permissions as $permission) {
                /** @var Permission $permissionCreated */
                Permission::query()->updateOrCreate(['name' => $permission]);
            }

            $roleCreated->givePermissionTo($permissions);
        }
    }
}

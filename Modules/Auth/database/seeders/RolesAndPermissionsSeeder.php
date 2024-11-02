<?php

namespace Modules\Auth\Database\Seeders;



use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'manage users',
            'manage patient records',
            'manage doctors',
            'manage doctorShifts',
            'manage services',
            'manage ambulance',
            'manage departments and clinics'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // Create userRoles
        $superAdmin = Role::create(['name' => 'superAdmin']);
        $manager = Role::create(['name' => 'manager']);
        $admissionStaff = Role::create(['name' => 'admissionStaff']);
        $ambulanceStaff = Role::create(['name' => 'ambulanceStaff']);
        $HrStaff = Role::create(['name' => 'hrStaff']);


        // Assign permissions to userRoles
        $superAdmin->givePermissionTo(Permission::all()); // Admin has all permissions
        $manager->givePermissionTo([
            'manage patient records',
            'manage doctors',
            'manage doctorShifts',
            'manage services',
            'manage ambulance',
            'manage departments and clinics']);
        $admissionStaff->givePermissionTo([ 'manage patient records','manage services',]);
        $ambulanceStaff->givePermissionTo(['manage ambulance']);
        $HrStaff->givePermissionTo(['manage doctors', 'manage doctorShifts','manage departments and clinics']);
    }
}

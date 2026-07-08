<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'dashboard.view',
            'hotels.create', 'hotels.read', 'hotels.update', 'hotels.delete',
            'rooms.create', 'rooms.read', 'rooms.update', 'rooms.delete',
            'bookings.create', 'bookings.read', 'bookings.update', 'bookings.delete',
            'users.create', 'users.read', 'users.update', 'users.delete',
            'payments.read', 'payments.update',
            'promos.create', 'promos.read', 'promos.update', 'promos.delete',
            'coupons.create', 'coupons.read', 'coupons.update', 'coupons.delete',
            'reviews.read', 'reviews.update', 'reviews.delete',
            'articles.create', 'articles.read', 'articles.update', 'articles.delete',
            'banners.create', 'banners.read', 'banners.update', 'banners.delete',
            'settings.read', 'settings.update',
            'reports.read', 'reports.export',
            'roles.create', 'roles.read', 'roles.update', 'roles.delete',
            'permissions.read',
            'activity_logs.read',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'dashboard.view',
            'hotels.create', 'hotels.read', 'hotels.update', 'hotels.delete',
            'rooms.create', 'rooms.read', 'rooms.update', 'rooms.delete',
            'bookings.create', 'bookings.read', 'bookings.update', 'bookings.delete',
            'users.read', 'users.update',
            'payments.read', 'payments.update',
            'promos.create', 'promos.read', 'promos.update', 'promos.delete',
            'coupons.create', 'coupons.read', 'coupons.update', 'coupons.delete',
            'reviews.read', 'reviews.update',
            'articles.create', 'articles.read', 'articles.update', 'articles.delete',
            'banners.create', 'banners.read', 'banners.update', 'banners.delete',
            'settings.read', 'settings.update',
            'reports.read', 'reports.export',
            'activity_logs.read',
        ]);

        $manager = Role::create(['name' => 'manager']);
        $manager->givePermissionTo([
            'dashboard.view',
            'hotels.read', 'hotels.update',
            'rooms.read', 'rooms.update',
            'bookings.read', 'bookings.update',
            'payments.read',
            'reviews.read',
            'reports.read',
        ]);

        $customer = Role::create(['name' => 'customer']);
        $customer->givePermissionTo([
            'bookings.create', 'bookings.read',
        ]);
    }
}
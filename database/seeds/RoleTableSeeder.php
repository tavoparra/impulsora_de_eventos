<?php

use Illuminate\Database\Seeder;
use Kodeine\Acl\Models\Eloquent\Role;
use App\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $roles = [];

        $roles[] = Role::create([
            'name' => 'Administrar usuarios',
            'slug' => 'users.administrator',
            'description' => 'Permiso para administrar usuarios'
        ]);

        $roles[] = Role::create([
            'name' => 'Administrar clientes',
            'slug' => 'clients.administrator',
            'description' => 'Permiso para administrar clients'
        ]);

        $roles[] = Role::create([
            'name' => 'Administrar categorías',
            'slug' => 'categories.administrator',
            'description' => 'Permiso para administrar categorías'
        ]);

        $roles[] = Role::create([
            'name' => 'Administrar productos',
            'slug' => 'products.administrator',
            'description' => 'Permiso para administrar productos'
        ]);

        $roles[] = Role::create([
            'name' => 'Administrar reservaciones',
            'slug' => 'reservations.administrator',
            'description' => 'Permiso para administrar reservaciones'
        ]);

        $roles[] = Role::create([
            'name' => 'Acceder reportes',
            'slug' => 'reports.access',
            'description' => 'Permiso para acceder a los reportes'
        ]);

        $admin = User::where('username', 'administrador')->firstOrFail();
        $admin->syncRoles($roles);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{

    public function run()
    {
        //Crear Roles
        $rol_admin= Role::create(['name' => 'admin']);
        $rol_vendedor= Role::create(['name' => 'vendedor']);
        $rol_cliente= Role::create(['name' => 'cliente']);
        
        //Crear permisos
        Permission::create(['name' => 'lista_usuarios']);
        Permission::create(['name' => 'carrito']);
        Permission::create(['name' => 'lista_productos']);
        Permission::create(['name' => 'lista_proveedores']);
        //Asignar permisos a roles
        $rol_cliente->givePermissionTo('carrito');
        $rol_admin->givePermissionTo('lista_productos');
        $rol_admin->givePermissionTo('carrito');
        $rol_admin->givePermissionTo('lista_proveedores');
        $rol_admin->givePermissionTo('lista_usuarios');
       
        $rol_vendedor->givePermissionTo('lista_productos');
        $rol_vendedor->givePermissionTo('lista_proveedores');
    }
}

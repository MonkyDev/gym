<?php

use App\Suscripcion;
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
/*	Proveedor   \paquete\carpeta\Entidad*/

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resources = array(
            'index' => ['action' => 'Navegar en ', 'description' => 'Lista y navega todos los registros de '],

            'create'=> ['action' => 'Crear el registro de ', 'description' => 'Vista creación de un nuevo registro de '],

            'store'=> ['action' => 'Guardar el registro de ', 'description' => 'Guardado de un nuevo registro de '],

            'show'=> ['action' => 'Ver el registro de ', 'description' => 'Ver en detalle único cada registro de '],

            'edit'=> ['action' => 'Editar el registro de ', 'description' => 'Vista de edición de los datos de '],

            'update'=> ['action' => 'Actualizar el registro de ', 'description' => 'Guardado de la modificación del registro de '],

            'destroy'=> ['action' => 'Eliminar el registro de ', 'description' => 'Eliminar el registro de ']
        );
        
        $modules = array(
            'users'         => 'Usuarios',
            'roles'         => 'Roles',
            'clientes'      => 'Clientes',
            'mensualidades' => 'Mensualidades',
            'ingresos'      => 'Ingresos',
            'egresos'       => 'Egresos',
        );

        foreach ($modules as $module => $mod) {
            foreach ($resources as $resource => $value) {
                Permission::create ([
                    'name'          =>  $value['action'].$mod,
                    'slug'          =>  $module.'.'.$resource,
                    'description'   =>  $value['description'].$mod.' del sistema',
                ]);
            }
        }

        Role::create([
        	'name'		=> 'Administrador',
        	'slug'		=> 'admin',
        	'special'	=> 'all-access',
        ]);
        Role::create([
            'name'      => 'Testing',
            'slug'      => 'test',
        ]);

        /* OTROS PERMISOS DE ACCESO GENERAL*/
        \DB::table('users')->insert([
            'name' => 'ADMINISTRADOR', 
            'email' => 'GIX', 
            'password' => '$2y$10$0zfwvsIzkE6VYSBlS.qmv.arUJ3V4imknCHWye7FcojGfeLlFhmme' /*123123*/
        ]);
        \DB::table('users')->insert([
            'name' => 'PRUEBAS', 
            'email' => 'PRUEBA', 
            'password' => '$2y$10$yZrkw0HK5DOiTE7qv.5.F.bPW5Ga4wV22CCGcGw0LoDUvOUbiDn0m' /*111111*/
        ]);

        \DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1
        ]);

        Suscripcion::create([
            'fecha_incio' => '2018-11-01',
            'fecha_fin' => '2018-11-30',
            'no_pago' => '1',
            'alojamiento' => '3',
            'folio_contrato' => '1234567890',
            'nombre_paquete' => 'BASICO',
            'fecha_contrato' => '2018-11-01',
        ]);

    }

}

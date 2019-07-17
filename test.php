<?php 

$resources = array(
            'index' => ['action' => 'Navegar en el ', 'slug' => 'index', 'description' => 'Lista y navega todos los '],

            'create'=> ['action' => 'Crear el ', 'slug' => 'create', 'description' => 'Vista de creación un nuevo registro de un '],

            'store'=> ['action' => 'Guardar el ', 'slug' => 'store', 'description' => 'Guardado de un nuevo registro de un '],

            'show'=> ['action' => 'Ver el ', 'slug' => 'show', 'description' => 'Ver en detalle único cada '],

            'edit'=> ['action' => 'Editar el ', 'slug' => 'edit', 'description' => 'Vista de edición de los datos de un '],

            'update'=> ['action' => 'Actualizar el ', 'slug' => 'update', 'description' => 'Guardado de la modificación del registro '],

            'destroy'=> ['action' => 'Eliminar el ', 'slug' => 'destroy', 'description' => 'Eliminar el registro '],

            'finish' => ['action' => ' del sistema']
        );

        $module = array(
            [ 'name' => 'school', 'single'=>'Institucion', 'plural' => 'Instituciones']
        );

        foreach ($resources as $resource => $value) :
        	///echo $module.$mod['single'];
        	 $resource." ".$value['action']."<br>";
        endforeach;
         $modules[0]['name'];

          $resources = array(
            'index' => ['action' => 'Navegar en ', 'description' => 'Lista y navega todos los registros de la'],

            'create'=> ['action' => 'Crear el registro de ', 'description' => 'Vista de creación un nuevo registro de un '],

            'store'=> ['action' => 'Guardar el registro de ', 'description' => 'Guardado de un nuevo registro de un '],

            'show'=> ['action' => 'Ver el registro de ', 'description' => 'Ver en detalle único cada '],

            'edit'=> ['action' => 'Editar el registro de ', 'description' => 'Vista de edición de los datos de un '],

            'update'=> ['action' => 'Actualizar el registro de ', 'description' => 'Guardado de la modificación del registro de '],

            'destroy'=> ['action' => 'Eliminar el registro de ', 'description' => 'Eliminar el registro ']
        );

        $module = array(
            [ 'name' => 'school', 'single'=>'Institucion']
        );

        foreach ($resources as $resource => $value) {
	        $datas=([
	        	'name'			=>	$value['action'].$module[0]['single'],
	        	'slug'			=>	$module[0]['name'].'.'.$resource,
	        	'description'	=>	$value['description'].$module[0]['single'].' del sistema'
	        ]);
       
        }

        //////////////////////////////////////////////////////////////

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
            'school'        => 'Institucion',
            'roles'         => 'Rol',
            'users'         => 'Usuario',
        );

        foreach ($modules as $module => $mod) {
            foreach ($resources as $resource => $value) {
                $datas = ([
                    'name'          =>  $value['action'].$mod,
                    'slug'          =>  $module.'.'.$resource,
                    'description'   =>  $value['description'].$mod.' del sistema',
                ]);
            }
        }
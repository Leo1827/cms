<?php

// Key value From Json
function kvfj($json, $key){
    if($json == null):
        return null;
    else:
        $json = $json;
        $json = json_decode($json, true);
        if(array_key_exists($key, $json)):
            return $json[$key];
        else:
            return null;
        endif;
    endif;    
}

function getModulesArray(){
    $a = [
    	 '0' => 'Productos',
    	 '1' => 'Blog'

    ];
        	 return $a;
 }

 function getRoleUserArray($mode, $id){
 	$roles = ['0' => 'Usuario normal', '1' => 'Administrador'];
 	if(!is_null($mode)):
 		     return $roles;
 	else:
        	 return $roles[$id];
    endif;
 }
 function getUserStatusArray($mode, $id){
    $status = ['0' => 'Registrado', '1' => 'Verificado', '100' => 'Baneado'];
    if(!is_null($mode)):
 		     return $status;
 	else:
        	 return $status[$id];
    endif;

 }

 function user_permissions(){
    $p = [
        'dashboard' => [
            'icon' => '<i class="fas fa-home"></i>',
            'title' => 'Modulo Dashboard',
            'keys' => [
                'dashboard' => 'Puede ver el dashboard.',
                'dashboard_small_stats' => 'Puede ver las estadísticas rápidas.',
                'dashboard_sell_today' => 'Puede ver lo facturado hoy.',
            ]
        ],
        'products' => [
            'icon' => '<i class="fas fa-boxes"></i>',
            'title' => 'Modulo Producto',
            'keys' => [
                'products' => 'Puede ver el listado de productos.',
                'product_add' => 'Puede agregar nuevos productos.',
                'product_edit' => 'Puede editar productos.',
                'product_search' => 'Puede buscar productos.',
                'product_delete' => 'Puede eliminar productos.',
                'product_gallery_add' => 'Puede agregar imágenes a la galería.',
                'product_gallery_delete' => 'Puede eliminar imágenes de la galería.',
            ]
        ],
        'categories' => [
            'icon' => '<i class="fas fa-folder-open"></i>',
            'title' => 'Modulo Categoria',
            'keys' => [
                'categories' => 'Puede ver el listado de las categorias.',
                'category_add' => 'Puede agregar categorias.',
                'category_edit' => 'Puede editar las categorias.',
                'category_delete' => 'Puede eliminar las categorias.',
            ]
        ],
        'users' => [
            'icon' => '<i class="fas fa-user-friends"></i>',
            'title' => 'Modulo Usuarios',
            'keys' => [
                'user_list' => 'Puede ver el listado de usuarios.',
                'user_edit' => 'Puede editar usuarios.',
                'user_banned' => 'Puede banear usuarios.',
                'user_permissions' => 'Puede administrar permisos de usuarios.',
            ]
        ],
        'sliders' => [
            'icon' => '<i class="far fa-images"></i>',
            'title' => 'Modulo de Sliders',
            'keys' => [
                'sliders_list' => 'Puede ver la lista del sliders.',
                'slider_add' => 'Puede crear un Sliders.',
                'slider_edit' => 'Puede editar los Sliders.',
                'slider_delete' => 'Puede eliminar los Sliders.'
            ]
        ],
        'settings' => [
            'icon' => '<i class="fas fa-cogs"></i>',
            'title' => 'Modulo de Configuraciones',
            'keys' => [
            'settings' => 'Puede modificar la configuración.'
            ]
        ],
        'orders' => [
            'icon' => '<i class="fas fa-clipboard-list"></i>',
            'title' => 'Modulo de Ordenes',
            'keys' => [
                'orders_list' => 'Puede ver el listado de ordenes.'
            ]
        ]

    ];

    return $p;
 }

 function getUserYears(){
    $ya = date('Y');
    $ym = $ya - 18;
    $yo = $ym - 62;

    return [$ym,$yo];
 }

 function getMonths($mode, $key){
    $m = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    ];
    if($mode == "list"){
        return $m;
    }else{
        return $m[$key];
    }
 }


<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'controlador_principal/pagina_inici';
$route['translate_uri_dashes'] = FALSE;
$route['404_override'] = '';


// $route['news'] = 'news_controller/index/0';
// $route['news/page'] = 'news_controller/index/0';
// $route['news/page/(:any)'] = 'news_controller/index/$1';

// $route['news/create'] = 'news_controller/create';
// $route['news/(:any)'] = 'news_controller/view/$1';
// $route['news/delete/(:any)'] = 'news_controller/delete/$1';
// $route['news/edit/(:any)'] = 'news_controller/edit/$1';
// $route['news/edit'] = 'news_controller/edit';

$route['login'] = 'login_controller/login';
$route['register'] = 'login_controller/register';
$route['tancar_sessio'] = 'login_controller/tancar_sessio';

$route['categoria/(:any)'] = 'controlador_principal/categoria/$1';
$route['crear_recurs'] = 'controlador_principal/crear_recurs';
$route['recursos'] = 'controlador_principal/veure_recursos';
$route['recursos/editar/(:any)'] = 'controlador_principal/editar_recursos/$1';
$route['recursos/editar'] = 'controlador_principal/editar_recursos';
$route['recursos/borrar/(:any)'] = 'controlador_principal/borrar_recursos/$1';
$route['recursos/mostrar/(:any)'] = 'controlador_principal/recurs_veure/$1';


$route['administracio_tags'] = 'controlador_principal/admin_tags';
$route['administracio_tags/editar'] = 'controlador_principal/editar_tag_individual';
$route['administracio_tags/crear'] = 'controlador_principal/crear_tag_individual';
$route['administracio_tags/editar/(:any)'] = 'controlador_principal/editar_tag_individual/$1';
$route['administracio_tags/borrar/(:any)'] = 'controlador_principal/borrar_tag/$1';


$route['administracio_categories'] = 'controlador_principal/admin_categories';
$route['administracio_categories/editar'] = 'controlador_principal/editar_categoria_individual';
$route['administracio_categories/crear'] = 'controlador_principal/crear_categoria_individual';
$route['administracio_categories/editar/(:any)'] = 'controlador_principal/editar_categoria_individual/$1';
$route['administracio_categories/borrar/(:any)'] = 'controlador_principal/borrar_categoria/$1';


$route['buscador'] = 'controlador_buscador/buscar_titol_desc';
$route['pissarra'] = 'controlador_principal/pissarra';



$route['admin/usuaris'] = 'controlador_administrador/usuaris_administracio';
$route['perfil'] = 'controlador_administrador/editar_perfil';
$route['contrasenya'] = 'controlador_administrador/canviar_contrasenya';
$route['contrasenya_admin'] = 'controlador_administrador/canviar_contrasenya_admin';
$route['contrasenya_admin/(:any)'] = 'controlador_administrador/canviar_contrasenya_admin/$1';
$route['borrar_usuari/(:any)'] = 'controlador_administrador/borrar_usuari/$1';







$route['api'] = 'news_api/index';















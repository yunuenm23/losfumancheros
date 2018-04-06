<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
include_once '../config.php';

$baseUrl = '';
$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://'. $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);

$dotenv = new Dotenv\Dotenv(__DIR__.'/..');
$dotenv->load();

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$route = isset($_GET['route'])?$_GET['route']:'/';

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();


$router->controller('/', App\Controllers\IndexController::class);
$router->controller('/', App\Controllers\AlbumController::class);
$router->controller('/', App\Controllers\TiendaController::class);
$router->controller('/', App\Controllers\ConciertosController::class);
$router->controller('/', App\Controllers\NoticiaController::class);
$router->controller('/', App\Controllers\VideoController::class);
$router->controller('/', App\Controllers\VernoticiaController::class);

session_start();
$router->filter('auth', function(){
	if(!isset($_SESSION['userid'])){
		header('Location:' . BASE_URL . '');
		return false;
	}
});

$router->controller('/auth', App\Controllers\AuthController::class);

$router->group(['before' => 'auth'], function($router){
	$router->controller('/admin', App\Controllers\Admin\IndexController::class);
    $router->controller('/admin/head', App\Controllers\Admin\HeadController::class);
	$router->controller('/admin/users', App\Controllers\Admin\UserController::class);
    $router->controller('/admin/bio', App\Controllers\Admin\BioController::class);
    $router->controller('/admin/carousel', App\Controllers\Admin\CarouselController::class);
    $router->controller('/admin/album', App\Controllers\Admin\AlbumController::class);
    $router->controller('/admin/shows', App\Controllers\Admin\ConciertosController::class);
    $router->controller('/admin/noticias', App\Controllers\Admin\NoticiaController::class);
    $router->controller('/admin/videonuevo', App\Controllers\Admin\VideoController::class);
    $router->controller('/admin/adwords', App\Controllers\Admin\AdwordsController::class);
    $router->controller('/admin/partners', App\Controllers\Admin\PartnerController::class);
    $router->controller('/admin/newsletter', App\Controllers\Admin\NewsletterController::class);
    $router->controller('/admin/footer', App\Controllers\Admin\FooterController::class);
    $router->controller('/admin/mail', App\Controllers\Admin\MailController::class);
});

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);
echo $response;
<?php
declare(strict_types=1);
require 'vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
        'dbconf' => 'src/conf/conf.ini']
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

use \Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$app = new \Slim\App;

$app->get(
    '/',
    'mywishlist\controller\AffichageController:afficherAcceuil'
)->setName('acceuil');

$app->get(
    '/test',
    function ($rq, $rs, $args) {
        echo 'test';
    }
)->setName('test');

$app->get(
    '/listes',
    'mywishlist\controller\AffichageController:afficherListes'
)->setName('listeDesListes');

$app->get(
    '/liste/{noListe}',
    'mywishlist\controller\AffichageController:afficherUneListe'
)->setName('affUneListe');

$app->get(
    '/item/{id}',
    function ($rq, $rs, $args) {
        $c = new \mywishlist\controller\AffichageController($this);
        return $c->afficherUnItem($rq, $rs, $args);
    }
)->setName('affUnItem');

$app->run();


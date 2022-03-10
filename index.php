<?php
declare(strict_types=1);
require './vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use custombox\controller\ControllerMenu;

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

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);

$app->get('/',
    function ($rq, $rs, $args) {
        $c = new ControllerMenu($this);
        return $c->controllerAccueil($rq, $rs, $args);
    }
)->setName("accueil");

/*$app->get('/list',
    function ($rq, $rs, $args) {
        $c = new ControllerMenu($this);
        return $c->afficherListeCategorie($rq, $rs, $args);
    }
)->setName("liste_categorie");*/

$app->get('/listcat', ControllerMenu::class . ':afficherListeCategorie')->setName('liste_categorie');


$app->get('/commande', "custombox\controller\ControllerCommande:listerCommande")->setName("voirListes");

$app->post('/commande/creer', "custombox\controller\ControllerCommande:creerCommande");
$app->get('/commande/creer', "custombox\controller\ControllerCommande:affCrerCommande")->setName("creerCommande");
$app->post('/commande/choix', "custombox\controller\ControllerCommande:choixBoite");
$app->get('/commande/choix', "custombox\controller\ControllerCommande:affChoixBoite")->setName("choixBoite");





try {
    $app->run();
} catch (Throwable $e) {
}


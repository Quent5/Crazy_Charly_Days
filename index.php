<?php
declare(strict_types=1);
require './vendor/autoload.php';

use custombox\controller\ControllerCreerProduit;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use custombox\controller\ControllerMenu;
use custombox\controller\ControllerCompte;

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

$app->get('/form',
    function ($rq, $rs, $args) {
        $c = new ControllerCreerProduit($this);
        return $c->afficherForm($rq, $rs, $args);
    }
)->setName('creer_produit');

$app->post('/form',
    function ($rq, $rs, $args) {
        $c = new ControllerCreerProduit($this);
        return $c->afficherForm($rq, $rs, $args);
    }
)->setName('creer_produit_post');

$app->get('/listcat', ControllerMenu::class . ':afficherListeCategorie')->setName('liste_categorie');


$app->get('/commande', "custombox\controller\ControllerCommande:listerCommande")->setName("voirListes");

$app->post('/commande/creer', "custombox\controller\ControllerCommande:creerCommande");
$app->get('/commande/creer', "custombox\controller\ControllerCommande:affCrerCommande")->setName("creerCommande");
$app->post('/commande/choix', "custombox\controller\ControllerCommande:choixBoite");
$app->get('/commande/choix', "custombox\controller\ControllerCommande:affChoixBoite")->setName("choixBoite");

$app->get('/connexion', ControllerCompte::class . ':login')->setName('login');
$app->post('/connexion', ControllerCompte::class . ':login')->setName('loginForm');

// Inscription
$app->get('/inscription', ControllerCompte::class . ':register')->setName('register');
$app->post('/inscription', ControllerCompte::class . ':register')->setName('registerForm');

$app->get('/categorie/{id}', ControllerMenu::class . ':afficherUneCategorie')->setName('afficherUneCategorie');


try {
    $app->run();
} catch (Throwable $e) {
}

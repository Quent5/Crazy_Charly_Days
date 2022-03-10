<?php
declare(strict_types=1);

namespace custombox\controller;

use custombox\models\Produit;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;
use custombox\vues\VueCreerProduit;

class ControllerCreerProduit {

    private Container $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function afficherForm(Request $rq, Response $rs, $args):Response
    {
        $vue = new \custombox\vues\VueCreerProduit([],$this->container);
        $html = $vue->render(0);
        $rs->getBody()->write($html);
        if(isset($_POST['submit'])) {
            if($_POST['submit'] == 'Valider') {
                echo "test";
                $nom = htmlspecialchars($_POST['nom_p']);
                $desc = htmlspecialchars($_POST['desc_p']);
                /*$img = htmlspecialchars($_POST['img_p']);*/
                $categorie = htmlspecialchars($_POST['categ_p']);
                $poids = htmlspecialchars($_POST['poids_p']);
                $p = new Produit();
                $p->titre = $nom;
                $p->description=$desc;
                $p->categorie=$categorie;
                $p->poids = $poids;
                $p->save();
                $rs = $rs->withRedirect($this->container->router->pathFor('creer_produit'));
            }
        }
        return $rs;
    }
}
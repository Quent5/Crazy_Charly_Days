<?php
declare(strict_types=1);

namespace custombox\controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

class ControllerMenu {

    private Container $container;

    public function __construct(Container $container) {
		$this->container = $container;
	}

    public function controllerAccueil(Request $rq, Response $rs, $args):Response
    {
        $vue = new \custombox\vues\VueMenu([], $this->container) ;
        $html = $vue->render(0) ;
        $rs->getBody()->write($html);
        return $rs;
    }


    public function afficherListeCategorie(Request $rq, Response $rs, $args):Response
    {
        $listes = \custombox\models\Categorie::all();
        $vue = new \custombox\vues\VueMenu($listes->toArray(), $this->container) ;
        $html = $vue->render(1) ;
        $rs->getBody()->write($html);
        return $rs;
    }
}
<?php
declare(strict_types=1);

namespace custombox\models;

use custombox\vues\VueMenu;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

class ControllerMenu {

    private Container $container;

    public function __construct(Container $container) {
		$this->container = $container;
	}

    // 
    public function afficherListeProduit(Request $rq, Response $rs, $args): Response {
		$array = [];
		$vue = new VueMenu($array, $this->container);
		$html = $vue->render(1);
		$rs->getBody()->write($html);
		return $rs;
	}
}
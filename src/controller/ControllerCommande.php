<?php
declare(strict_types=1);
namespace custombox\controller;


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

use custombox\models\Produit;


class ControllerCommande{

    private Container $container;

    public function __construct(Container $container) {
		$this->container = $container;
	}


    public function affChoixBoite(Request $request, Response $response, $args): Response {
        
        $url_acceuil = $this->container->router->pathFor('accueil');
        if($args < 0.7)$response->getBody()->write("<p>La petite boite est plus adaptée</p>");
        if($args > 0.7 && $args <= 1.5 )$response->getBody()->write("<p>La boite moyenne est plus adaptée</p>");
        if($args > 1.5 && $args <= 3.2 )$response->getBody()->write("<p>La grande boite est plus adaptée</p>");
        
        $response->getBody()->write("<form action='' method='post'>
        <p>Taille de la boite  : <input type='text' name='boite' placeholder='1,2,3' /></p>
        <p>1 = petit(0,7kg) / 2 = moyenne(1,5kg) / 3 = grande(3,2kg)</p>
        <p><input type='submit' value='Confirmer'></p>
        </form>
        
        <button>
        <div><a href=$url_acceuil>Retour</a></div>
        </button>
        ");  

            return $response;
    }

    public function choixBoite(Request $request, Response $response, $args): Response {
        $json = $request->getParsedBody();

        if(!filter_var($json["boite"], FILTER_VALIDATE_INT)){
            $response->getBody()->write('<h1>Boîte invalide</h1>');
        } 
        $this->affCreerCommande($request, $response, $args);

        return $response;
    }


    public function affCrerCommande(Request $request, Response $response, $args): Response {
        $produit = Produit::all();
        $url_acceuil = $this->container->router->pathFor('accueil');

        $response->getBody()->write("<form action='' method='post'");

        foreach($produit as $p){
            $id = $p->id;
            $nom = $p->titre;
            $img = $p->img;
            $response->getBody()->write("<p><img src='$url_acceuil/images/produits/$img' width = '150' height='150' > <br>$nom :  
            <br>Nombre de produit <br> <input type='text' name=$id placeholder='1,2,3,...' /></p>");
            
        }

        $response->getBody()->write("<p><input type='submit' value='Confirmer la selection'></p>
        </form>
        <button>
        <div><a href=$url_acceuil>Retour</a></div>
        </button>
        ");  
        return $response;
    }


        
    public function creerCommande(Request $request, Response $response, $args): Response {
        $json = $request->getParsedBody();
        $total = 0;
        $produit = Produit::all();
        $url_acceuil = $this->container->router->pathFor('accueil');

        foreach($produit as $p){
            $id = $p->id;
            $nom = $p->titre;
            $img = $p->img;
            $poids = $p->poids;

            $data = $json[$id];
            if(filter_var($data, FILTER_VALIDATE_INT)){
                $data = $data*$poids;
                $total += $data;
            }
        }


        $response->getBody()->write("<p> Total : $total kg</p>");
        $this->affChoixBoite($request, $response, $total);
        return $response;

    }

}

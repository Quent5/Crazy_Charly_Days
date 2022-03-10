<?php

namespace custombox\vues;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Container;

class VueMenu
{
    public array $tab;
    public Container $container;
    public Request $rq;

    public function __construct(array $tab, Container $container,Request $rq)
    {
        $this->tab = $tab;
        $this->container = $container;
        $this->rq = $rq;
    }

    private function accueil() : string
    {
        $content = "<h1>Accueil</h1>";
        return $content;
    }

    private function afficherListeCategorie() : string
    {
        $content = "Liste des Catégories\n";
        foreach ($this->tab as $l) {
            $content .= "<a href=/CustomBox/categorie/$l[id]><article>$l[nom]<img src=\"images/categories/$l[id].png\"></article></a>\n";
            //$url_$l[nom]
        }
        return "<section>$content</section>";
    }

    private function afficherCategorie() : string
    {
        $k = $this->tab[0];
        $categorie = \custombox\models\Categorie::where('id', '=', "$k[categorie]")->first();
        $content = "Liste des produits de catégories : $categorie->nom";
        foreach ($this->tab as $l) {
            $url_acceuil = $this->container->router->pathFor('accueil');
            $content .= "<article>$l[id] ; $l[titre] ; $l[description]<img src=\"$url_acceuil/images/produits/$l[id].jpg\" width='150px' height='150px'></article>\n";
        }
        return "<section>$content</section>";
    }



    public function render($selecteur)
    {
        switch ($selecteur) {
            case 0: {
                $content = $this->accueil();
                break;
            }
            case 1: {
                $content = $this->afficherListeCategorie();
                break;
            }

            case 2: {
                $content = $this->afficherCategorie();
                break;
            }
        }

        $url_acceuil = $this->container->router->pathFor('accueil');
        $url_listecategorie = $this->container->router->pathFor('liste_categorie');
        $url_creer_produit = $this->container->router->pathFor('creer_produit');
		$url_register = $this->container->router->pathFor('register');
		$url_login = $this->container->router->pathFor('login');
        $url_creerCommande = $this->container->router->pathFor('creerCommande');
        
        //$url_categorie = $this->container->router->pathFor('afficherUneCategorie');

        $base = $this->rq->getUri()->getBasePath() ;
        $url = $base . '/style.css' ;
        $url_img = $base . '/images/logo/print-logo-blanc-petit.png';
        $url_img1 = $base . '/images/logo/paniers.png';
        $url_img2 = $base . '/images/logo/paniers.png';


        $html = <<<END
        <!DOCTYPE html>
        <html>
            <head>
                <link rel="stylesheet" href=$url />
                <div class="haut">
                    <img src=$url_img id="logo">
                    <h1 class = "text-center">CustomBox</h1>
                    <a href="" id="panier"><img src=$url_img1 id="panier_logo"></a>
                </div>
                                
            </head>
            <nav class="nav">
                <h1 class="titre-nav">Navigation</h1>
                <div class="lien"><a href=$url_acceuil>Accueil</a></div>
                <div class="lien"><a href=$url_listecategorie>Liste de Catégorie</a></div>
                <div class="lien"><a href=$url_creer_produit>Ajouter un produit</a></div>
                <div class="lien"><a href=$url_register>S'inscrire</a></div>
                <div class="lien"><a href=$url_login>Se connecter</a></div>
                <div class="lien"><a href=$url_creerCommande>Creer une commande</a></div>
                
            </nav>
            <body>
                <div class="content">
                $content
                </div>
            </body>
        </html>
        END;
        return $html;
    }
}
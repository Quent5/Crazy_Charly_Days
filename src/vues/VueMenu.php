<?php

namespace custombox\vues;
use Slim\Container;

class VueMenu
{
    public array $tab;
    public Container $container;

    public function __construct(array $tab, Container $container)
    {
        $this->tab = $tab;
        $this->container = $container;
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
            $content .= "<article>$l[nom]<img src=\"images/categories/$l[id].png\"></article>\n";
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
        }

        $url_acceuil = $this->container->router->pathFor('accueil');
        $url_listecategorie = $this->container->router->pathFor('liste_categorie');

        $html = <<<END
        <!DOCTYPE html>
        <html>
            <head>
                <link rel="stylesheet" href="style.css" />
                <div class="haut">
                    <img src="images/logo/print-logo-blanc-petit.png" id="logo">
                    <h1 class = "text-center">CustomBox</h1>
                </div>
                                
            </head>
            <nav class="nav">
                <h1 class="titre-nav">Navigation</h1>
                
            </nav>
            <body>
                <div class="content">
                $content
                </div>
                <nav>
                <br>
                <div><a href=$url_acceuil>Accueil</a></div>
               <div><a href=$url_listecategorie>Liste de Catégorie</a></div>
               </nav>
            </body>
        </html>
        END;
        return $html;
    }
}
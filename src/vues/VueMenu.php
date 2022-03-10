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
            $content .= "<article>$l[id] ; $l[nom]</article>\n";
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
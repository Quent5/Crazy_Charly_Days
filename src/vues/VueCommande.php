<?php

namespace custombox\vues;
use Slim\Container;

class VueCommande{
    public array $tab;
    public Container $container;

    public function __construct(array $tab, Container $container)
    {
        $this->tab = $tab;
        $this->container = $container;
    }


    public function render($selecteur)
    {
        switch ($selecteur) {
            case 0:
            {
                $content = $this->afficherListeCategorie();
                break;
            }
        }

        $url_acceuil = $this->container->router->pathFor('accueil');

        $html = <<<END

END;
        return $html;
    }
}
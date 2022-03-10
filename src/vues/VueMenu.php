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

    private function afficherListeCategorie() : string
    {
        $content = "\n";
        foreach ($this->tab as $l) {
            $content .= "<article>$l[id] ; $l[nom]</article>\n";
        }
        return "<section>$content</section>";
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
        <!DOCTYPE html>
        <html>
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
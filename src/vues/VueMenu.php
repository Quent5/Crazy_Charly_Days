<?php
namespace costumbox\vues;
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


    private function htmlAcceuil() : string
    {
        return $content ="<h1>Costumbox</h1>";
    }

    public function render($selecteur)
    {
        switch ($selecteur) {
            case 0:
            {
                $content = $this->htmlAcceuil();
                break;
            }
        }
    }
}
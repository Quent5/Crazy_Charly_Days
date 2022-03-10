<?php
namespace custombox\vues;
use Slim\Container;

class VueCreerProduit {

    public array $tab;
    public Container $container;

    public function __construct(array $tab, Container $container)
    {
        $this->tab = $tab;
        $this->container = $container;
    }

    public function afficherForm() : string
    {
        $content = "
            <a href='/Crazy_Charly_Days'>
                <img src='images/logo/print-logo-blanc-petit.png' id='logo'>
            </a>
            <div class='main-block'>
              <form action='' method='post'>
                <h1>Ajouter un produit :</h1>
                <div class='info'>
                  <p>Nom du produit</p>
                  <input id='nom_p' class='fname' type='text' name='nom_p' placeholder='' required>
                  <p>Description du produit</p>
                  <input id='desc_p' class='fname' type='text' name='desc_p' placeholder='' required>
                  <!--<p>Image du produit</p>
                  <input id='img_p' type='text' name='name' placeholder=''>-->
                  <p>Catégorie du produit</p>
                  <input id='categ_p' class='fname' type='text' name='categ_p' placeholder='' required>
                  <p>Poids du produit </p>
                  <input id='poids_p' type='text' name='poids_p' placeholder='' required>
                </div>
                <input class='bouton_chiant' name='submit' type='submit' value='Valider'/>
              </form>
            </div>";
        return $content;
    }
    public function render($selecteur)
    {
        switch ($selecteur) {
            case 0: {
                $content = $this->afficherForm();
                break;
            }
        }

        $html = <<<END
        <!DOCTYPE html>
        <html>
            <head>
            <title>Création d'un produit</title>
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
            <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet'>
            <link rel='stylesheet' href='style2.css'>
            </head>
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
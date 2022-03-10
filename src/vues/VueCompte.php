<?php

namespace custombox\vues;

use Slim\Container;

class VueCompte
{
    public array $tab;
    public Container $container;

    public function __construct(array $tab, Container $container)
    {
        $this->tab = $tab;
        $this->container = $container;
    }


    private function register(): string {
		return "
			<h2>Inscription</h2>
			<form action='' method='post'>
                <label for='nom'>Login</label>
                <input type='text' name='login' id='login' required>
				<label for='nom'>Nom</label>
				<input type='text' name='nom' id='nom' required>
				<label for='prenom'>Prénom</label>
				<input type='text' name='prenom' id='prenom' required>
				<label for='email'>Email</label>
				<input type='email' name='email' id='email' required>
				<label for='password'>Mot de passe</label>
				<input type='password' name='password' id='password' required>
				<label for='password_confirm'>Confirmation du mot de passe</label>
				<input type='password' name='password_confirm' id='password_confirm' required>
				<input type='submit' value='Inscription'>
			</form>
		";
	}

	private function login(): string {
		return "
			<h2>Connexion</h2>
			<form action='' method='post'>
				<label for='username'>Nom d'utilisateur</label>
				<input type='text' name='username' id='username' required>
				<label for='password'>Mot de passe</label>
				<input type='password' name='password' id='password' required>
				<input type='submit' value='Connexion'>
			</form>
		";
	}

    public function render($selector): string {
		$content = "";
		switch ($selector) {
			case 1:
			{
				$content = $this->register();
				break;
			}
			case 2:
			{
				$content = $this->login();
				break;
			}
		}
		$url_acceuil = $this->container->router->pathFor('accueil');
        $url_listecategorie = $this->container->router->pathFor('liste_categorie');
		$url_register = $this->container->router->pathFor('register');
		$url_login = $this->container->router->pathFor('login');

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
               <div><a href=$url_register>S inscire</a></div>
               <div><a href=$url_login>Se connecter</a></div>
               </nav>
            </body>
        </html>
        END;
        return $html;
    }
}
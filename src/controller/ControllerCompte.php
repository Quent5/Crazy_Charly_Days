<?php
declare(strict_types=1);

namespace custombox\controller;

use custombox\vues\VueCompte;
use PDO;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use custombox\models\Compte;
use Slim\Container;

class ControllerCompte {
	private Container $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function register(Request $rq, Response $rs, array $args): Response {
		$array = [];
		$vue = new VueCompte($array, $this->container);
		$html = $vue->render(1);
		$rs->getBody()->write($html);
		if (isset($_POST['submit'])) {
			// Si le bouton "S'inscrire" a été cliqué :
			if ($_POST['submit'] == 'Inscription') {
				$donnees = Compte::where('mail', $_POST['email'])->first();
				//$email = $donnees->mail;
				// Si l'email est pas déjà présent dans la base de données :
				if ($donnees != []) {
					echo "<p class='erreur'>Vous êtes déjà inscrit avec cette adresse mail.</p>";
				} else {
					if ($_POST['password'] != $_POST['password_confirm']) {
						echo('quatrieme if ');
						echo "<p class='erreur'>Les mots de passe ne correspondent pas.</p>";
					} else {
						$email = htmlspecialchars($_POST['email']);
						$prenom = htmlspecialchars($_POST['prenom']);
						$nom = htmlspecialchars($_POST['nom']);
						$login = htmlspecialchars($_POST['login']);
						// Création de l'utilisateur par le modèle :
						$u = new Compte();
						$u->mail = $email;
						$u->prenom = $prenom;
						$u->nom = $nom;
						$u->mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
						$u->nom_utilisateur = $login;
						$u->save();
						$_SESSION['id_compte'] = $u->id;
						$rs = $rs->withRedirect($this->container->router->pathFor('accueil'));
					}
				}
			}
		}
		return $rs;
	}

	
	public function login(Request $rq, Response $rs, array $args): Response {
		$vue = new VueCompte([], $this->container);
		$html = $vue->render(2);
		$rs->getBody()->write($html);
		if (isset($_POST['submit'])) {
			// Si le bouton Connexion a été cliqué :
			if ($_POST['submit'] == 'Connexion') {
				$email = htmlspecialchars($_POST['email']);
				$pass = htmlspecialchars($_POST['password']);
				$user = Compte::where('mail', '=', $_POST['email'])->first();
				// Si l'utilisateur existe :
				if ($user != []) {
					if (password_verify($pass, $user['mdp'])) {
						$_SESSION['id_compte'] = $user['id'];
						$rs = $rs->withRedirect($this->container->router->pathFor('accueil'));
					} else {
						echo "<p class='erreur'>Le mot de passe est incorrect.</p>";
					}
				} else {
					echo "<p class='erreur'>Aucun compte ne correspond à cet email.</p>";
				}
			}
		}
		return $rs;
	}

	
}
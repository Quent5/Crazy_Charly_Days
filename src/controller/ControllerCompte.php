<?php
declare(strict_types=1);

namespace custombox\controller;

use custombox\vues\MainView;
use PDO;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

class MainController {
	private Container $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function register(Request $rq, Response $rs, array $args): Response {
		$array = [];
		$vue = new MainView($array, $this->container);
		$html = $vue->render(1);
		$rs->getBody()->write($html);
		return $rs;
	}


	public function registerForm() {
	}

	public function login(Request $rq, Response $rs, array $args): Response {
		$array = [];
		$vue = new MainView($array, $this->container);
		$html = $vue->render(2);
		$rs->getBody()->write($html);
		return $rs;
	}

	public function loginForm() {
		$bdd = new PDO('mysql:host=localhost;dbname=bdd-connect;charset=utf8', 'root', '');
		if (isset($_POST['login'], $_POST['motDePasse'])) {
			$req = $bdd->prepare('select * FROM compte WHERE username = ? or email = ? AND password = ?');
			$req->execute([$_POST['login'], $_POST['motDePasse']]);
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			if (!empty($donnees)) {
				echo "connecté, redirection sur votre profil...";
				$_SESSION['username'] = $donnees['username'];
				$_SESSION['name'] = $donnees['name'];
				$_SESSION['surname'] = $donnees['surname'];
				// si resterConnecte est coché on crée un cookie avec les informations de connection
				if (isset($_POST['resterConnecte'])) {
					setcookie('username', $donnees['username'], time() + 365 * 24 * 3600, null, null, false, true);
					setcookie('password', $donnees['password'], time() + 365 * 24 * 3600, null, null, false, true);
				} else {
					if (isset($_COOKIE['username'], $_COOKIE['password'])) {
						unset($_COOKIE['username'], $_COOKIE['password']);
					}
				}
				header('location: profil.php', true, 301);
			} else {
				echo '<p>Identifiants incorrects</p>';
			}
		} else {
			echo '<p>Tous les champs sont obligatoires !</p>';
		}
	}
}
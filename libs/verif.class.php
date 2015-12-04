
<?php
class connect{
	
	private $pdo;	
	private $db_base;	
	private $db_host;	
	private $db_user;	
	
	public function __construct($db_base,$db_host="localhost",$db_user="root"){

		$this->db_base = $db_base;
		$this->db_host = $db_host;
		$this->db_user = $db_user;		
	}

	public function getPDO(){

		if($this->pdo === null){
		$pdo = new PDO('mysql:host=localhost;dbname=mff', 'root');		
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$this->pdo = $pdo;
		}
		return $this->pdo;
	}

}

class verif{

	public $id;
	public $name;
	public $login;
	public $email;
	public $password;
	public $photo;
	public $birthday;
	public $last_connexion;
	public $inscription;

	public function __construct($idUser,$pdo){

		if($idUser != 0){

			$req = $pdo->prepare("SELECT * FROM users WHERE id = ?");
			$req->execute([$idUser]);
			$user = $req->fetch(PDO::FETCH_OBJ);

			$this->id = $user->id;
			$this->login = $user->login;
			$this->email = $user->email;
			$this->password = $user->password;
			$this->photo = $user->photo;
			$this->birthday = $user->birthday;
			$this->last_connexion = $user->last_connexion;
			$this->name = $user->name;
			$this->inscription = $user->inscription;
		}
	}

	public function logVerif($email,$psw,$pdo){

		$return = array();
		
		if($email == null || $psw == null){
			
			$return[0] = 2;					
			$return[1] = "Remplir tous les champs pour vous authentifier ! ";					
		}
		else{
		
			$hash = hash('md5',$psw);

			$req = $pdo->prepare("SELECT * FROM users WHERE email = ?");
			$req->execute([$email]);
			$user = $req->fetch(PDO::FETCH_OBJ);

			if(!empty($user)){
				
				$psw_verif = $user->password;
				$email_verif = $user->email;
				$log = $user->login;
				$id = $user->id;

				if($psw_verif == $hash && $email_verif == $email){

					$_SESSION['id'] = $id;
					$_SESSION['auth'] = $log;
					$_SESSION['mail'] = $email;
					$return[0] = 1;
					$return[1] = "Vous êtes bien authentifié ! ";					
				}
				else{
					
					$return[0] = 2;
					$return[1] = "Le couple Login/MDP ne correspont pas dans notre base de données ! ";					
				}
			}else{

				$return[0] = 2;
				$return[1] = "Le couple Login/MDP ne correspont pas dans notre base de données ! ";				
			}

		}

		return $return;
	}


	public function createVerif($pdo,$donnees){
		
		$return = array();
		$result = isIsset($donnees);
		//debug($result,1);
		if($result == "true")
		{
			debug("je passe par true info");
			$login = $_POST['login'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$birthday = $_POST['birthday'];
			$psw = $_POST['password'];
			$psw2 = $_POST['secondpassword'];
			$photo = $_POST['photo'];

			$req_log = $pdo->prepare('SELECT * FROM users WHERE login = ?');
			$req_mail = $pdo->prepare('SELECT * FROM users WHERE email = ?');

			$req_log->execute([$login]);
			$result_log = $req_log->fetch(PDO::FETCH_OBJ);

			$req_mail->execute([$email]);
			$result_mail = $req_mail->fetch(PDO::FETCH_OBJ);

			if(!empty($result_log))
			{
				debug("je passe par login existe déja");
				$return[0] = 2;
				$return[1] = "Ce login existe déjà. Veuillez en choisir un autre ! ";
			}
			else
			{
				if(!empty($result_mail))
				{
					debug("je passe par email existe déja");
					$return[0] = 2;
					$return[1] = "Cette adresse mail correspond déjà à un compte sur notre site ! ";			
				}
				else
				{
					if($psw != $psw2)
					{
						debug("je passe par pas de correspondance");
						$return[0] = 2;
						$return[1] = "Les mots de passes ne correspondent pas ! ";
					}
					else
					{
						debug("je passe par req et mail");
						$hash = hash('md5', $psw);
						$token = str_random(60);
						$created_ts = time();

						$req_insert = $pdo->prepare('INSERT INTO users (id,name,login,password,email,photo,presentation,inscription,birthday,last_connexion,token,created_ts) VALUES ("",?,?,?,?,?,"",NOW(),?,NOW(),?,?)');
						$req_insert->execute([$name,$login,$hash,$email,$photo,$birthday,$token,$created_ts]);

						$id = $pdo->lastInsertId();

						$lien = '<a href="http://localhost/formation/motherFF/libs/verif-token.php?to='.$token.'&i='.$id.'">http://www.mff.com/verif/u675CXIV9YOLHbYIjhgc8O7UNM</a>';
						$lien_img = "http://images.all-free-download.com/images/graphiclarge/diamond_93729.jpg";
						
						$msg = "<img src='".$lien_img."' style='width:100px;height:100px'/> <h2>POST IT ! </h2>";
						$msg .= "<h4>MFF Corp.</h4><br/><br/>";
						$msg .= "Pour pouvoir confirmer l'activation de votre compte sur le forum MFF pour le compte de <span style='font-weight:bold;'>".strtoupper($login)."</span>. Veuillez cliquer sur le lien suivant qui vous redirigera vers notre site<br/><br/>".$lien;
						$msg .= "<br/><br/>Attention ce message s'auto-détruira dans 5.. 4.. 3.. 2.. 1.. bon dans 1 heure en fait !!!!! ";
						
						require_once 'mail.php';
						
						smtpmailer('mff.wf3@gmail.com', 'oday972@gmail.com', 'Admin', 'Vérification de la création de compte MFF', $msg);
						/*if (true !== $result){
							// erreur -- traiter l'erreur
							echo $result;
							die();
						}*/
						$return[0] = 3;
						$return[1] = "Votre compte est en instance de création! Un email vous à été envoyer afin de confirmer votre inscription ! ";	
					}
				}		
			}
		}
		else
		{
			debug("je passe par remplir");
			$return[0] = 2;
			$return[1] = "Remplir tous les champs pour vous inscrire ! ";
			// die(); //????
		}
	
	//die();
	return $return;
	}

}
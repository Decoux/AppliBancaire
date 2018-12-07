<?php
session_start();
// On enregistre notre autoload.
function chargerClasse($classname)
{
    if (file_exists('../models/' . $classname . '.php')) {
        require '../models/' . $classname . '.php';
    } else {
        require '../entities/' . $classname . '.php';
    }
}
spl_autoload_register('chargerClasse');

/**
 * Connection database
 */
$db = Database::DB();

$userManager = new UserManager($db);
if (isset($_POST['email'])){
    if(!empty($_POST['email'])){
        if($userManager->getUserByEmail($_POST['email'])== TRUE){
        
            if(!empty($_POST['pass'])){
                $hash_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $user = new User([
                    'email' => $_POST['email'],
                    'pass'=>$hash_pass
                ]);
                $data_user = $userManager->getObjectUserByEmail($user);
                    if(password_verify($_POST['pass'], $data_user->getPass())==TRUE){
                        $_SESSION['id'] = $data_user->getId();
                        $_SESSION['name'] = $data_user->getName();
                        
                    }else{
                        echo 'Le mot de passe est incorrecte';
                    }
                }else{
                    echo 'Veuillez renseigner votre mot de passe';
                }
            }else{
                echo 'Veuillez vous inscrire';
            }
        }else{
        echo 'Veuillez renseigner votre adresse email';
    }
}
if (isset($_POST['connexion_auto'])) {
    setcookie('email', $_POST['email'], time() + 365 * 24 * 3600, null, null, false, true);
    setcookie('pass', password_hash($_POST['pass'], PASSWORD_DEFAULT), time() + 365 * 24 * 3600, null, null, false, true);
}

if(isset($_SESSION['id'])){
    header('Location: getAccount.php');
}

if(isset($_POST['deconnexion'])){
    // Suppression des variables de session et de la session
    $_SESSION = array();
    session_destroy();

    // Suppression des cookies de connexion automatique

    setcookie('email', '');
    setcookie('pass', '');
    header('Location: index.php');
}
include "../views/indexView.php";
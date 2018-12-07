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

if(isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['name'])){

    if(!empty($_POST['email']) && !empty($_POST['name'])){
        
        if(!empty($_POST['pass'])){
            $hash_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

            if (preg_match("#^[a-z0-9-._]+@[a-z0-9-._]{2,}\.[a-z]{2,4}$#", $_POST['email'] )){
                $user = new User([
                    'name' => addslashes(strip_tags($_POST['name'])),
                    'email' => addslashes(strip_tags($_POST['email'])),
                    'pass' => addslashes(strip_tags($hash_pass))
                ]);

                if($userManager->getUserByEmail($email)==FALSE){
                    $userManager->addUser($user);
                    header('Location: index.php');
                    
                }else{
                    echo 'Cette adresse email est déja utilisé';
                }
                
            }else{
                echo 'tot';
            }

        }else {
            echo 'Veuillez renseigner un mot de passe !';
        }
    }else{
        echo 'Veuillez renseigner votre adresse email !';
    }

}
include "../views/registrationView.php";

// $dd = $userManager->getUserByEmail($user);

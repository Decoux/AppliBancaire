<?php
session_start();
// On enregistre notre autoload.
function chargerClasse($classname)
{
    if(file_exists('../models/'. $classname.'.php'))
    {
        require '../models/'. $classname.'.php';
    }
    else 
    {
        require '../entities/' . $classname . '.php';
    }
}
spl_autoload_register('chargerClasse');

/**
 * Connection database
 */
$db = Database::DB();

$manager = new AccountManager($db);
/**
 * Create array for dynamique display select
 */
$types = ["PEL", "Compte courant", "Livret A", "Compte joint"];

/**
 * if $_POST['new'] is defined we create object
 */
if(isset($_POST['new'])){
    $account = new Account([
        "name" => $_POST['name'],
        "balance" => 80
    ]);
    $manager->addAccount($account);
}

/**
 * Add Founds on account
 */
if(isset($_POST['payment'])){
    $getAccountById = $manager->getAccountById($_POST['id']);
    $addFounds = $manager->creditFounds($getAccountById, $_POST['balance']);
    
}

/**
 * delete founds on account
 */
if (isset($_POST['debit'])) {
    $getAccountById = $manager->getAccountById($_POST['id']);
    $addFounds = $manager->deptFounds($getAccountById, $_POST['balance']);
}

/**
 * tranfer founds on account
 */
if(isset($_POST['transfer'])){
    /**
     * delete founds after transfer
     */
    $getAccountByIdDeleteFounds = $manager->getAccountById($_POST['idDebit']);
    $manager->transferDeptFounds($getAccountByIdDeleteFounds, $_POST['balance']);

    /**
     * credit founds after transfer
     */
    $getAccountByIdAddFounds = $manager->getAccountById($_POST['idPayment']);
    $manager->tranferCreditFounds($getAccountByIdAddFounds, $_POST['balance']);
    
}

if(isset($_POST['delete'])){
    /**
     * Delete account from db
     */
    $getAccountFromDelete = $manager->getAccountById($_POST['id']);
    $manager->deleteAccount($getAccountFromDelete);
}

/**
 * display all accounts from database
 */
$getAccounts = $manager->getAccountsByIdUser();


include "../views/getAccountView.php";

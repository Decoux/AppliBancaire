<?php

include('includes/header.php');

?>

    <header class="flex">
		<p class="margin-right">Bienvenue sur l'application Comptes Bancaires</p>
        <?php if (isset($_SESSION['id'])) { ?>
		<form action="index.php" method="post">
			<input type="submit" value="Deconnexion" class="btn btn-danger">
		</form> 
	<?php 
} ?>
    </header>
<div class="container">
    <form class="col-md-5 border border-dark rounded p-5 mt-5 mx-auto d-flex flex-column" action="index.php" method="post">
        <label for="">Email : </label>    
        <input name="email" class="form-control" type="text">
        <label for="">Mot de passe : </label>
        <input name="pass" class="form-control" type="password">
        <button type="submit" class="text-white btn bg-fa8072 mt-5">Se connecter</button>
        <div class="input-group mb-3 mt-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                <input name="connexion_auto" type="checkbox" aria-label="Checkbox for following text input">
            
                </div>
            </div>
            <input value="Connexion automatique" type="text" class="text-center form-control" aria-label="Text input with checkbox">
        </div>
    </form>
    <a class="d-flex justify-content-center" href="registration.php">
        <input name="registration" class="col-md-4 text-white btn bg-fa8072 mt-5" type="submit" value="S'inscrire">
    </a>
</div>
<?php

include('includes/footer.php');

?>
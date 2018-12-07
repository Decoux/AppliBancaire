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
    <form class="col-md-5 border border-dark rounded p-5 mt-5 mx-auto d-flex flex-column" action="registration.php" method="post">
        <label for="">Nom : </label>
        <input name="name" class="form-control" type="text">    
        <label for="">Email : </label>
        <input class="form-control" type="text" name="email">
        <label for="">Mot de passe : </label>
        <input class="form-control" type="password" name="pass">
        <button type="submit" class="text-white btn bg-fa8072 mt-5">S'inscrire</button>
    </form>
    
</div>
<?php

include('includes/footer.php');

?>
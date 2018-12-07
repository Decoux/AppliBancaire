<?php

include('includes/header.php');

?>
<header class="flex">
	<p class="margin-right">Bienvenue sur l'application Comptes Bancaires <?php echo $_SESSION['name'] ?></p>
	<?php if(isset($_SESSION['id'])){ ?>
		<form action="index.php" method="post">
			<input name="deconnexion" type="submit" value="Deconnexion" class="btn btn-danger">
		</form> 
	<?php } ?>
</header>
<div class="container">

	

	<h1>Mon application bancaire</h1>

	<form class="newAccount" action="../controllers/getAccount.php" method="post">
		<label>Sélectionner un type de compte</label>
		<select class="" name="name" required>
			<option value="" disabled>Choisissez le type de compte à ouvrir</option>
			<?php for($i=0; $i < count($types); $i++){ ?>
				<option value="<?php echo $types[$i]; ?>"><?php echo $types[$i]; ?></option>
			<?php } ?>
		</select>
		<input type="submit" name="new" value="Ouvrir un nouveau compte">
	</form>

	<hr>

	<div class="main-content flex">

	<!-- Pour chaque compte enregistré en base de données, il faudra générer le code ci-dessous -->

	<?php if($getAccounts){
			
			foreach($getAccounts as $key => $account){ ?>

		<div class="card-container">
			
			<div class="card">
				<?php if ($account->getBalance() < 0) { ?><p class="error-message"><?php echo 'Vous etes en debit'; ?></p><?php } ?>
				<h3><strong><?php echo $account->getName(); ?></strong></h3>
				<div class="card-content">


					<p>Somme disponible : <?php echo $account->getBalance(); ?> €</p>

					<!-- Formulaire pour dépot/retrait -->
					<h4>Dépot / Retrait</h4>
					<form action="getAccount.php" method="post">
						<input type="hidden" name="id" value=" <?php echo $account->getId(); ?>"  required>
						<label>Entrer une somme à débiter/créditer</label>
						<input type="number" name="balance" placeholder="Ex: 250" required>
						<input type="submit" name="payment" value="Créditer">
						<input type="submit" name="debit" value="Débiter">
					</form>


					<!-- Formulaire pour virement -->
			 		<form action="getAccount.php" method="post">

						<h4>Transfert</h4>
						<label>Entrer une somme à transférer</label>
						<input type="number" name="balance" placeholder="Ex: 300"  required>
						<input type="hidden" name="idDebit" value="<?php echo $account->getId(); ?>" required>
						<label for="">Sélectionner un compte pour le virement</label>
						<select name="idPayment" required>
							<option value="" disabled>Choisir un compte</option>
							<?php foreach ($getAccounts as $key => $accountName) { ?>
								<option value="<?php echo $accountName->getId(); ?>"><?php echo $accountName->getName(); ?></option>
							<?php } 
							?>
						</select>
						<input type="submit" name="transfer" value="Transférer l'argent">
					</form>

					<!-- Formulaire pour suppression -->
			 		<form class="delete" action="getAccount.php" method="post">
				 		<input type="hidden" name="id" value="<?php echo $account->getId(); ?>"  required>
				 		<input type="submit" name="delete" value="Supprimer le compte">
			 		</form>

				</div>
			</div>
		</div>

	<?php }
} ?>

	</div>

</div>

<?php

include('includes/footer.php');

 ?>

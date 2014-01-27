					</div>
					<nav class="span4">

						<h2>Menu</h2>

						<ul>
							<li><a href="index.php">Accueil</a></li>
							<?php
								if (utilisateur_connecte()) {
							?>
							<li><a href="controleur.php?action=ecrire_article">Rédiger un article</a></li>
							<li><a href="deconnexion.php">Se déconnecter</a></li>
							<?php
								}else{
							?>
							<li><a href="connexion.php">Connexion</a></li>							
							<?php
								}
							?>
						</ul>

						<h2>Recherche</h2>
						<form role="form" action="controleur.php" method="GET">
							<input type="hidden" id="action" name="action" value="recherche">
							<div class="form-group">
								<input type="text" class="form-control" id="texte" name="texte">
							</div>
							<input type="submit" class="btn btn-primary" id="rechercher" name="rechercher" value="rechercher">
						</form>

					</nav>

				</div>
		
			</div>

			<footer>
				<p>&copy; HELAL Nour</p>
			</footer>

		</div>

	</body>
</html>
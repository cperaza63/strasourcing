<?php
$userName = '';
$show = '';
if(!empty($_SESSION['userid']) && $_SESSION['userid']) {
	$userName =  $_SESSION['username'];		
} else {
	$show = 'hidden';
}
?>	
<br>
<span><a href="index.php">Portada</span>
<div id="loggedPanel" class="<?php echo $show; ?>">
	Iniciar Sesión <span id="loggedUser" class="logged-user"><?php echo $userName; ?></span>
	<a href="action.php?action=logout">Salir</a>
</div>
<br><br><br>
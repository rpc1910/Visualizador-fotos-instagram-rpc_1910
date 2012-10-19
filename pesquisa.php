<?php 
##########################################################
##														##
##		Desenvolvido por Rodrigo Passos					##
##		http://www.rodrigop.com.br						##
##		contato@rodrigop.com.br							##
##														##
##		Sinta-se livre para alterar o que quiser :)		##
##														##
##########################################################

$title = "Busca por $_REQUEST[user]";
include("topo.php"); ?>

<section class="resultadoBusca">
	<h2>Busca por: <?php echo $_REQUEST["user"]; ?></h2>
	<?php echo $Instagram->searchUser($_REQUEST["user"]); ?>
</section>
<?php include("rodape.php"); ?>
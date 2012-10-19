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
$title = $_REQUEST["usuario"];
include("topo.php"); ?>
<?php echo $Instagram->User($_REQUEST["usuario"]); ?>
<?php include("rodape.php"); ?>
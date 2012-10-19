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

require_once("class.php");
if($_REQUEST["url"]) {
	$Instagram = new Instagram();
	if($_REQUEST["action"] == "1") {
		echo $Instagram->loadMore($_REQUEST["url"]);
	}
	else if($_REQUEST["action"] == "2") {
		echo $Instagram->getUrlMore($_REQUEST["url"]);
	}
}
?>
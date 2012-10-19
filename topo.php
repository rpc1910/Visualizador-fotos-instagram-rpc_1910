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
	$Instagram = new Instagram();
	$title = ($title) ? "$title | View Photos - By @rpc_1910" : "View Photos - By @rpc_1910";
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<meta name="description" content="Visualize todas as suas fotos do Instagram em um único lugar - Desenvolvido por Rodrigo Passos" />
    <meta name="keywords" content="Visualize, todas, suas, fotos, Instagram, único, lugar, rodrigo, passos, desenvolvedor, @rpc_1910" />
	<link href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="/instagram/css/estilos.css" media="all"/>
	<script type="text/javascript" src="/instagram/funcoes.js"></script>
	<!--[if IE]>
	<script type="text/javascript" src="/instagram/html5.js"></script>
	<![endif]-->
</head>
<body>
	<header id="topo">
		<a href="/instagram/" class="logo" title="View Photos - by @rpc_1910">View Photos Instagram - By @rpc_1910</a>
		<section class="searchTop">
			<form action="/instagram/search/" method="get">
				<input type="text" placeholder="Digite o nome de usuário" name="user" id="user" />
				<!--<input type="submit" value="Buscar" class="botaoBuscar"/>-->
			</form>
		</section>
		<br clear="all" />
	</header>
	<section id="principal">
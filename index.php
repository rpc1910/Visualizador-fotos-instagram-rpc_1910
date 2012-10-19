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

include("topo.php"); ?>
<section class="search">
	<h2>Seja bem vindo</h2>
	<p>Esta aplicação foi desenvolvida para o estudo da API do <a href="http://instagram.com/" rel="nofollow" title="Instagram" target="_blank">Instagram</a>.</p>
	<p>Pesquise o nome de usuário abaixo para visualizar as fotos</p>
	<form action="/instagram/search/" method="get" class="formularioPrincipal">
		<input type="text" placeholder="Digite o nome de usuário" name="user" id="buscaPrincipal" />
		<input type="submit" value="Pesquisar" class="botaoPesquisarPrincipal" />
	</form>
	<br clear="all" />
</section>
<?php include("rodape.php"); ?>
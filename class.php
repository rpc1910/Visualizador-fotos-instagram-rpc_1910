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

/*
Classe para manipulação da API do Instagram
*/
Class Instagram {
	private $ClientID = "INSIRA O CLIENT ID AQUI";
	private $Token = "INSIRA O TOKEN DE ACESSO AQUI";
	
	public function __construct() {
	}
	
	//Recupera dados da API via JSON
	public function Curl($url) {
		$session = curl_init($url);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($session);
        curl_close($session);
		
		$data = json_decode($json);
		return $data;
	}
	
	//Recupera ID do usuário
	public function getUserID($user) {
		$url = "https://api.instagram.com/v1/users/search?q=$user&count=1&access_token=".$this->Token;
		
		//Recupera dados da API via CURL - Resposta em formato JSON
		$data = $this->Curl($url);
		
		foreach($data->data AS $usuario) {
			$id = $usuario->id;
			break;
		}
		return $id;
	}
	
	//Realiza a busca dos usuários
	public function searchUser($name) {
		if($name) {
			$name = urlencode($name);
			$url = "https://api.instagram.com/v1/users/search?q=$name&access_token=".$this->Token;
		
			//Recupera dados da API via CURL - Resposta em formato JSON
			$data = $this->Curl($url);
			
			if($data) {
				$saida = "<ul class=\"listaUsuarios\">";
				foreach($data->data AS $user) {
					$conteudoBusca .= "<li>";
					$conteudoBusca .= '<div class="fotoUsuario"><a href="/instagram/user/'.$user->username.'" title="'.$user->full_name.'"><img src="'.$user->profile_picture.'" alt="'.$user->full_name.'" border="0" /></a></div>';
					$conteudoBusca .= '<div class="infoUser"><div class="fullName"><h3>'.$user->full_name.' <span>('.$user->username.')</span></h3></div>';
					$conteudoBusca .= ($user->bio) ? '<div class="bio"><p>'.$user->bio.'</p></div>' : NULL;
					$conteudoBusca .= ($user->website) ? '<div class="link"><strong>Site: </strong><a href="'.$user->website.'" target="_blank" rel="nofollow">'.$user->website.'</a></div>': NULL;
					$conteudoBusca .= '</div><div class="linkVisualizar"><a href="/instagram/user/'.$user->username.'" title="Visualizar fotos do perfil">Visualizar fotos do perfil</a></div>';
					$conteudoBusca .= '<br clear="all"/></li>';
				}
				$saida .= ($conteudoBusca) ? $conteudoBusca: '<p style="padding: 20px 10px;">Nenhum resultado foi encontrado :(</p>';
				$saida .= "</ul>";
			}
			else {
				$saida .= '<p style="padding: 20px 10px;">Nenhum resultado foi encontrado :(</p>';
			}
		}
		else {
			$saida .= "<p style=\"padding: 20px 10px; \">Nenhum resultado foi encontrado :(</p>";
		}
		$saida .= '<br clear="all" /><p style="padding: 0 10px;">Faça a pesquisa novamente</p><form action="/instagram/search/" method="get" class="formularioPrincipal">
			<input type="text" placeholder="Digite o nome de usuário" name="user" id="buscaPrincipal" />
			<input type="submit" value="Pesquisar" class="botaoPesquisarPrincipal" />
		</form><br clear="all" />';
		return $saida;
	}
	
	//Monta cabeçalho do usuário com informações do perfil
	public function headerUser($id) {
		$url = "https://api.instagram.com/v1/users/$id/?access_token=".$this->Token;
		
		//Recupera dados da API via CURL - Resposta em formato JSON
		$data = $this->Curl($url);
		
		$saida .= '<div class="infoUsuario">
			<div class="fotoUsuario"><img src="'.$data->data->profile_picture.'" alt="'.$data->data->full_name.'" border="0" /></div>
			<div class="conteudoInfo">
				<div class="username"><h1>'.$data->data->full_name.' <span>('.$data->data->username.')</span></h1></div>';
		$saida .= ($data->data->bio) ? '<div class="bio"><p>'.$data->data->bio.'</p></div>' : NULL;
		$saida .= ($data->data->website) ? '<div class="website"><strong>Site: </strong><a href="'.$data->data->website.'" rel="nofollow" target="_blank">'.$data->data->website.'</a></div>': NULL;
		$saida .= '</div>
			<div class="stats">
				<ul>
					<li class="numberPhotos"><strong>Fotos: </strong>'.$data->data->counts->media.'</li>
					<li class="segue"><strong>Seguindo: </strong>'.$data->data->counts->follows.'</li>
					<li class="sequidores"><strong>Seguidores: </strong>'.$data->data->counts->followed_by.'</li>
				</ul>
			</div>
			<br clear="all" />
		</div>';
		return $saida;
	}
	
	//Cria lista com as fotos do usuário
	public function getPhotos($id) {
		$url = "https://api.instagram.com/v1/users/$id/media/recent/?access_token=".$this->Token;

		//Recupera dados da API via CURL - Resposta em formato JSON
		$data = $this->Curl($url);
		
		if($data)
			foreach($data->data AS $photos) {
				$conteudoFotos .= '<li>
					<div class="fotoMiniatura"><a href="'.$photos->link.'" target="_blank" title="'.$photos->caption->text.'" rel="nofollow"><img src="'.$photos->images->low_resolution->url.'" alt="'.$photos->caption->text.'" border="0" width="290" /></a></div>';
				$conteudoFotos .= ($photos->caption->text) ? '<div class="descPhoto">'.substr($photos->caption->text, 0, 200).'</div>' : NULL;
				$conteudoFotos .= '<div class="statsPhoto">
					<ul>
						<li>'.$photos->comments->count.' comentários</li>
						<li>'.$photos->likes->count.' likes</li>
					</ul>
				</div>
				<br clear="all" />
				<div class="viewPhoto"><a href="'.$photos->link.'" target="_blank" title="Visualizar Foto" rel="nofollow">Visualizar Foto</a></div>';
				$conteudoFotos .= '</li>';
			}
		
			$saida .= ($conteudoFotos) ? "<ul class=\"listaFotos\">$conteudoFotos</ul>" : "<p>Nenhuma foto foi encontrada para este usuário :(</p>";
			$saida .= ($conteudoFotos AND $data->pagination->next_url) ? '<br clear="all"/><div class="loadMore" id="box_1"><a href="javascript:void(0)" onclick="loadMore(\''.base64_encode($data->pagination->next_url).'\')">Carregar mais fotos</a></div>': NULL;
		}
		else {
			$saida .= "<p>Nenhuma foto foi encontrada :(</p>";
		}
		return $saida;
	}
	
	//Monta página do usuário
	public function User($user) {
		$id = $this->getUserID($user);
		$saida .= '<section class="conteudoUsuario">';
		if($id) {
			$saida .= $this->headerUser($id);
			$saida .= "<h2>Fotos recentes</h2>";
			$saida .= $this->getPhotos($id);
		}
		else {
			$saida .= "<p>Conteúdo não encontrado! :(</p>";
		}
		$saida .= '<hr/><br clear="all" /><p>Pesquise o nome de usuário abaixo para visualizar as fotos</p>
		<form action="/instagram/search/" method="get" class="formularioPrincipal">
			<input type="text" placeholder="Digite o nome de usuário" name="user" id="buscaPrincipal" />
			<input type="submit" value="Pesquisar" class="botaoPesquisarPrincipal" />
		</form>';
		$saida .= "<br clear=\"all\" /></section>";
		return $saida;
	}
	
	//Carrega mais imagens na lista tendo como parâmetro a URL
	public function loadMore($url) {
		$url = base64_decode($url);

		//Recupera dados da API via CURL - Resposta em formato JSON
		$data = $this->Curl($url);
		
		foreach($data->data AS $photos) {
			$conteudoFotos .= '<li>
				<div class="fotoMiniatura"><a href="'.$photos->link.'" target="_blank" title="'.$photos->caption->text.'" rel="nofollow"><img src="'.$photos->images->low_resolution->url.'" alt="'.$photos->caption->text.'" border="0" width="290" /></a></div>';
			$conteudoFotos .= ($photos->caption->text) ? '<div class="descPhoto">'.substr($photos->caption->text, 0, 200).'</div>' : NULL;
			$conteudoFotos .= '<div class="statsPhoto">
				<ul>
					<li>'.$photos->comments->count.' comentários</li>
					<li>'.$photos->likes->count.' likes</li>
				</ul>
			</div>
			<br clear="all" />
			<div class="viewPhoto"><a href="'.$photos->link.'" target="_blank" title="Visualizar Foto" rel="nofollow">Visualizar Foto</a></div>';
			$conteudoFotos .= '</li>';
		}
		
		return $conteudoFotos;
	}
	
	//Método para gerar URL com o Link para carregar mais fotos na página
	public function getUrlMore($url) {
		$url = base64_decode($url);

		//Recupera dados da API via CURL - Resposta em formato JSON
		$data = $this->Curl($url);
		
		$saida .= ($data->pagination->next_url) ? '<a href="javascript:void(0)" onclick="loadMore(\''.base64_encode($data->pagination->next_url).'\')">Carregar mais fotos</a>': "<p>Não foram encontradas mais fotos!</p>";
		return $saida;
	}
	
	//Caso queira inserir anúncios, basta inserir o código neste método
	public function anuncios() {
		return('');
	}
}
?>
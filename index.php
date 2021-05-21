<!-- CONSUMINDO API DO GITHUB VIA CURL -->
<?php
$url = "https://api.github.com/users"; 
$ch = curl_init($url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
//CASO HAJAM PROBLEMAS EM API'S COM RESTRIÇÕES HTTPS, UTILIZAR ESTE COMANDO
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
$users = json_decode(curl_exec($ch));
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../images/fav_icon.png" type="image/x-icon">
    <title>Usuários</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- Bulma Version 0.7.2-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <section class="hero is-info is-small">
      <div class="hero-body">
        <div class="container has-text-centered">
          <p class="title">
            Web App PHP - GitHub API
          </p>
          <p class="subtitle">
            Consumindo API do GitHub para buscar usuários e seus repositórios existentes
          </p>
        </div>
      </div>
    </section>
    <div class="box cta">
      <p class="has-text-centered">
        <!-- ESPAÇO PARA BUSCA DE USUÁRIO GITHUB -->
        <div>
          <label for="nome">Pesquisar por usuários...</label>
          <input type="text" id="nome" />
        </div>
        <div class="button">
          <button type="submit">Buscar</button>
        </div>
      </p>
    </div>
    <section class="container">
      <!-- FUNÇÃO PHP PARA VERIFICAR EXISTÊNCIA DE USUÁRIOS-->
      <?php
      if(count($users->users)) {
      $i = 0;
      foreach($users->users as $users) {
      $i++;
      ?>
      <?php if($i % 3 == 1) { ?>
      <div class="columns features">
      <?php } ?>
        <div class="column is-4">
          <div class="card">
            <div class="card-image has-text-centered">
              <figure class="image is-128x128">
                <!-- INSERINDO IMAGEM DO USUÁRIO GITHUB -->
                <img src="<?=$users->avatar_url?>" alt="<?=$users->avatar_url?>" class="" data-target="modal-image2">              
              </figure>
            </div>
            <div class="card-content has-text-centered">
              <div class="content">
                <!-- EXIBINDO NOME DO USUÁRIO -->
                <h4><?=$users->login?></h4>
                <p>
                  <ul>
                  <!-- FUNÇÃO PHP = BUSCANDO ATRIBUTOS DO USUÁRIO VIA API-->
                  <?php
                  if(count($users->repos_url)) {
                    echo "Repositórios existentes: ";
                  } else {
                    echo "Não possui repositórios existentes ainda ";
                  }
                ?>
                </ul>
                </p>
              </div>
            </div>
          </div>
        </div>
      <?php if($i % 3 == 0) { ?>
      </div>
      <?php } } } else { ?>
        <strong>Nenhum usuário existente na API!</strong>
      <?php } ?>
    </section>
  </body>
</html>
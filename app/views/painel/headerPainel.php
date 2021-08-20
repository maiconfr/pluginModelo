<html>
<head>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <!--Let browser know website is optimized for mobile-->
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="<?php echo URLBASE; ?>public/css/materialize.min.css">
   <link href="<?php echo URLBASE; ?>public/css/painelcustom.css" rel="stylesheet">
</head>

<body>

  <header>
    <!-- Dropdown Structure -->

    <nav class="top-nav">
      <div class="container">
        <ul id="navPrincipal" class="sidenav sidenav-fixed fundoCorPrincipal ">

          <li><div class="user-view">
     <div class="background"></div>
       <a>
       <img class="responsive-img" src="<?php echo URLBASE; ?>public/img/logo-branca.png">
        </a>
        <a href="#name"><span class="white-text name"><?php echo $this->nomeUsuario ?></span></a>
        <a href="#email"><span class="white-text email"><?php echo $this->emailUsuario ?></span></a>

   </div></li>


            <li><div class="divider"></div></li>
            <?php foreach ($this->arrayMenus as $key => $value) {
              ?>
              <li><a href="<?php echo $value["link"] ?>" class="letraAzulFraco"><i class="material-icons letraAzulFraco"><?php echo $value["icone"] ?></i><?php echo $value["titulo"] ?></a></li>
              <?php
            } ?>
            <li><div class="divider"></div></li>
            <li><a href="<?php echo URLBASE; ?>painel/configuracoes" class="letraAzulFraco"><i class="material-icons letraAzulFraco">settings</i>Configurações</a></li>
            <li><a href="<?php echo URLBASE; ?>login/logout" class="letraAzulFraco"><i class="material-icons letraAzulFraco">logout</i>Sair</a></li>



            <li>
              <p></p>
            </li>

          </ul>
          <a href="#" data-target="navPrincipal" class="sidenav-trigger "><i class="material-icons letraAzulPrincipal">menu</i></a>
        </div>
        <div class="nav-wrapper fundoCorTopo" >
          <ul class="right hide-on-med-and-down " >
            <li><a href="configuracoes" class="black-text">Configurações</a></li>
            <li><a href="collapsible.html" class="black-text">Sair</a></li>
            </ul>
        </div>
      </nav>

    </header>

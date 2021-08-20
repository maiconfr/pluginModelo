<main>
  <div id="loadingBarra" class="progress" style="display: none;">
    <div class="indeterminate"></div>
  </div>

  <div id="painelConfigsEmpresas" class="containerCustom">
    <div class="row">
      <div class="col s12 m8">
        <div class="containerCustom z-depth-2">
          <h3>Informações</h3>
          <form id="formConfigsEmrpesa" class="" action="" method="post">
            <div class="row">
              <div class="input-field col s6">
                <input id="razaoSocial" type="text" class="validate" name="razaoSocial" value="<?php echo $this->getConfig("razaoSocial"); ?>">
                <label for="razaoSocial">Razão Social</label>
              </div>
              <div class="input-field col s6">
                <input id="nomeFantasia" type="text" class="validate" name="nomeFantasia" value="<?php echo $this->getConfig("nomeFantasia"); ?>">
                <label for="nomeFantasia">Nome Fantasia</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <input id="emailDeContato" type="email" class="validate" name="emailDeContato" value="<?php echo $this->getConfig("emailDeContato"); ?>">
                <label for="emailDeContato">Email de contato</label>
              </div>
              <div class="input-field col s6">
                <input id="telefone" type="number" class="validate" name="telefone" value="<?php echo $this->getConfig("telefone"); ?>">
                <label for="telefone">Telefone</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <input id="cnpj" type="number" class="validate" name="cnpj" value="<?php echo $this->getConfig("cnpj"); ?>">
                <label for="cnpj">CNPJ</label>
              </div>
              <div class="input-field col s6">
                <input id="cep" type="number" class="validate" name="cep" value="<?php echo $this->getConfig("cep"); ?>">
                <label for="cep">CEP</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <input id="cidade" type="text" class="validate" name="cidade" value="<?php echo $this->getConfig("cidade"); ?>">
                <label for="cidade">Cidade</label>
              </div>
              <div class="input-field col s6">
                <input id="bairro" type="text" class="validate" name="bairro" value="<?php echo $this->getConfig("bairro"); ?>">
                <label for="bairro">Bairro</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s9">
                <input id="endereco" type="text" class="validate" name="endereco" value="<?php echo $this->getConfig("endereco"); ?>">
                <label for="endereco">Endereço</label>
              </div>
              <div class="input-field col s3">
                <input id="numero" type="number" class="validate" name="numero" value="<?php echo $this->getConfig("numero"); ?>">
                <label for="numero">Número</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="uf" type="text" class="validate" name="uf" value="<?php echo $this->getConfig("uf"); ?>">
                <label for="uf">Estado/UF</label>
              </div>
            </div>
            <button id="botaoConfigsEmpresa" type="submit" name="button" class="btn">Salvar</button>
          </form>
        </div>
      </div>

      <div class="col s12 m4">
        <div class="containerCustom z-depth-2 row">
          <h3>Alterar senha</h3>
          <form id="formSenha" class="col s12" action="" method="post">
            <div class="row">
              <div class="input-field col s12">
                <input id="senhaAtual" type="password" class="validate" name="senhaAtual" value="" required>
                <label for="senhaAtual">Senha atual</label>
              </div>
              <div class="input-field col s12">
                <input id="novaSenha" type="password" class="validate" name="novaSenha" value="" required>
                <label for="novaSenha">Nova senha</label>
              </div>
              <div class="input-field col s12">
                <input id="confirmarSenha" type="password" class="validate" name="confirmarSenha" value="" required>
                <label for="confirmarSenha">Confirmar senha</label>
              </div>
            </div>
            <button id="botaoSenha" type="submit" name="button" class="btn">Salvar</button>
            <div class="row">

            </div>
            <?php $this->exibeErro(); ?>
            <div id="erroNovaSenha" class="center red-text erroLogin" hidden>
              <p class="">Confirmação de senha incorreto</p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="loadingCoracao center" hidden>
    <img src="<?php echo URLBASE; ?>public/img/logo-coracao.png" class="pulse">
  </div>

</main>

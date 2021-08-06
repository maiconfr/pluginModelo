
    <div class="container">
        <div class="row z-depth-4 formLogin">
          <form id="formLogin" class="" action="" method="post">
            <div class="input-field col s12">
              <input id="usuario" placeholder="" type="text" name="usuario" value="">
              <label for="usuario">Email</label>
            </div>

            <div class="input-field col s12">
            <input id="senha" placeholder="" type="password" name="senha" value="">
            <label for="senha">Senha</label>
            </div>
            <div class="row center">
              <div class="col s6">
                <button type="submit" class="btn" name="button">Login</button>
              </div>
              <input id="idGoogle" type="hidden" name="idGoogle" value="">
              <input id="foto" type="hidden" name="foto" value="">
              <input id="email" type="hidden" name="email" value="">
              <div class="col s6">
              <div class="g-signin2" data-onsuccess="onSignIn"></div>
              </div>
            </div>
            <?php $this->exibeErro() ?>
          </form>
        </div>
    </div>

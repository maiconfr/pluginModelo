<main>

<div class="container">
  <div class="row">
    <ul class="collection with-header">
        <li class="collection-header center"><h4>Estes são os numeros da fila de whats, certifique-se que eles estão no formato DDD+Numero (xx)xxxxx-xxxx</h4>

          <p>Você deve apontar seus atendimentos para: <a href="">filainteligente.com.br/w/indoor/outro</a></p>
            <ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">insert_comment</i>Mensagem Personalizada para o Whats</div>
      <div class="collapsible-body">
        <div class="row left">
          <p>
            <b>Variaves disponiveis:</b><br>
            {{atendente}} - Troca pelo nome do atendente correspondente;
          </p>
        </div>
        <div class="row">
        <form method="post">
      <div class="input-field col s10">
        <input value="<?php /*echo $whatsappQueueIT->getMensagemWhats()*/ ?>" id="memsagemWhats" name="memsagemWhats" type="text" class="validate">
        <label class="active" for="memsagemWhats">Digite a memsagem de boas vindas</label>
      </div>
      <div class="col s2">
        <button type="submit" class="btn flow-text" style="width:100%;"><i class="material-icons white-text">save</i></button>
      </div>
      </form>
    </div>
    </div>
    </li>
  </ul>


        </li>
        <?php
        foreach (array() as $key => $value) {
          ?>
          <form id='formIT-<?php echo $value->id; ?>' method="post"><input  type="hidden" name="deletar" value="<?php echo $value->id; ?>"></form>
          <li class="collection-item">
            <div>
              <?php echo $value->nomeAtendente." - ".$value->numWhats?><a href="#!" onclick="document.getElementById('formIT-<?php echo $value->id; ?>').submit()" class="secondary-content"><i class="material-icons red-text">close</i></a>
              <?php echo ($whatsappQueueIT->whatsAtual == $value->numWhats)? '<span class="new badge fundoCorPrincipal" data-badge-caption="Link Atual"></span>':"" ?>
            </div>
          </li>
          <?php
        }
         ?>
      </ul>
  </div>
  <div class="row">
    <form method="post">
    <div class="input-field col s6">
      <input value="" id="nomeAtendente" name="nomeAtendente" type="text" class="validate">
      <label class="active" for="nomeAtendente">Nome Atendente</label>
    </div>
    <div class="input-field col s6">
      <input value="" id="novoWhatsFila" name="novoWhatsFila" type="number" class="validate">
      <label class="active" for="novoWhatsFila">Novo Numero</label>
    </div>
    <div class="col s12">
      <button type="submit" class="btn flow-text" style="width:100%;"><i class="material-icons white-text">add</i></button>
    </div>
    </form>
  </div>

</div>

</main>

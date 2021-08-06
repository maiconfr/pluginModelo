M.AutoInit();

function notificaIndoor(logCompleto){
  var corporativo;
  if ($("#empresa_form").length >0) corporativo = true;
  else corporativo = false;

  var nome = $("#nome_form").val();
  var documento = $("#cpf_form").val();
  var dataDoAgendamento = $(".horarioSelecionado").parent().attr("datadisponivel");
  var horarioDoAgendamento = $(".horarioSelecionado").attr("horario");
  var idDoMedico = $(".horarioSelecionado").parent().attr("medico");
  var especialidade = $(".horarioSelecionado").parent().attr("nomeespecialidade");
  var tel = $("#whats_form").val();

  db("Valor corporativo = "+corporativo);

  var mensagem = "";
  if(corporativo){
    mensagem = mensagem+"Agendamento corporativo\n";
  }else{
    mensagem = mensagem+"Agendamento pessoal\n";
  }
  mensagem = mensagem+"Nome : "+nome+"\n"+
  "Documento: "+documento+"\n"+
  "dataDoAgendamento: "+dataDoAgendamento+"\n"+
  "horarioDoAgendamento: "+horarioDoAgendamento+"\n"+
  "idDoMedico: "+idDoMedico+"\n"+
  "especialidade: "+especialidade+"\n"+
  "telefone: "+tel+"\n"+
  "-----------------------\n"+
  logCompleto;

  $.post( URLBASE+"api/notificaIndoor", {mensagem: mensagem});
}

var debug = true;
var logCompleto  = "";
function db(log,tipo=0){
  if(debug){
    switch (tipo) {
      case 1:
        console.warn(log);
        logCompleto += "⚠️ "+log+"\n";
        break;
      case 2:
        console.error(log);
        logCompleto += "❌ "+log+"\n";
        notificaIndoor(logCompleto);
        break;
      default:
        console.log(log);
        logCompleto += "✅ "+log+"\n";
        break;

    }
  }
}

function trataCatch(erro){
  db("Erro no js",1);
  db(erro,2);
  setTimeout(
    function()
    {
      document.location.reload(true);
    }, 1000);
}

atribuiCookies()
function atribuiCookies(){
  if ($("#empresa_form").length >0){
    var formPj = Cookies.get("formPj");
    if(Cookies.get("formPj") !== undefined){
      var formPj = $.parseJSON(Cookies.get("formPj"));

      $("#whats_form").val(formPj.telefone);
      $("#email_form").val(formPj.email);
      $("#empresa_form").val(formPj.empresa);
      $("#cnpj_form").val(formPj.cnpj);
      $("#"+formPj.clinica).addClass("clinicaAtivo");
      $("#email_form").addClass("valid");
    }
  }else{
    var formPf = Cookies.get("formPf");
    if(Cookies.get("formPf") !== undefined){
      var formPf = $.parseJSON(Cookies.get("formPf"));

      $("#nome_form").val(formPf.nome);
      $("#sobrenome_form").val(formPf.sobrenome);
      $("#whats_form").val(formPf.telefone);
      $("#email_form").val(formPf.email);
      $("#email_form").addClass("valid");
      $("#cpf_form").val(formPf.cpf);
      $("#"+formPf.clinica).addClass("clinicaAtivo");
      $("#email_form").addClass("valid");
    }
  }
}

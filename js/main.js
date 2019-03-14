$(document).ready(function () {

  /* --------- ASIDE MENU ----------- */

  $("#menu").click(function () {
    if ($(this).parent().find("li").hasClass("open")) {
      $(this).parent().find("li").removeClass("open");
    } else {
      $(this).parent().find("li").addClass("open");
    }
  })

  /* --------- LIMITE INPUT ----------- */

  function maxLength(element, limit){
    if (element.val().length >= limit) { 
      element.val(element.val().substr(0, limit));
    }
  }

  $("#nip_paciente").keydown(function(){
    maxLength($(this), 8);
  })

  $("#nip_paciente").keyup(function(){
    maxLength($(this), 8);
  })

  $("#nip_titular").keydown(function(){
    maxLength($(this), 8);
  })

  $("#nip_titular").keyup(function(){
    maxLength($(this), 8);
  })

  $("#cpf_titular").keydown(function(){
    maxLength($(this), 11);
  })

  $("#cpf_titular").keyup(function(){
    maxLength($(this), 11);
  })  

  /* --------- CONDICIONAIS ----------- */

  json_condicionais = {}

  $.getJSON("js/condicionais.json", function (data) {
    json_condicionais = data;
  });

  function condicionais(id, valor, nondestructive = false, justRefresh) {
    array = json_condicionais[id][valor];
    if (!nondestructive) {
      $(".condicional").addClass("none").attr("required", false);
    } else {
      $("*[data-condicional=" + justRefresh + "]").addClass("none").attr("required", false);
    }

    if (array) {
      array.map(item => {
        $("*[data-condicional=" + item + "]").removeClass("none").attr("required", true);
      })
    }
  }

  function addProcedimento(id) {
    var num = parseInt(id.replace('procedimento_', '')),
      next_num = num++;

    if ($("#" + id).val()) {
      console.log(next_num);
      $("*[data-condicional=procedimento_" + num + "]").removeClass("none");
      console.log($("*[data-condicional=procedimento_" + num + "]"));
    } else {
      console.log("branco");

      for (i = num; i <= 20; i++) {
        console.log("*[data-condicional=procedimento_" + i + "]");
        $("*[data-condicional=procedimento_" + i + "]").addClass("none").attr("required", false);
      }
    }
  }

  //Reset de todos os inputs condicionais
  $(".condicional").addClass("none").attr("required", false);

  $("#situacao_adm").change(function () {
    condicionais($(this).attr("id"), $(this).val())
  })

  $("*[name=atleta]").change(function () {
    condicionais($(this).attr("id"), $(this).val(), true, "modalidade")
  })

  $("*[name=comparecimento]").change(function () {
    condicionais($(this).attr("id"), $(this).val(), true, "procedimento_1")
  })

  $("#modalidade").change(function () {
    condicionais($(this).attr("id"), $(this).val(), true, "outra_modalidade")
  })

  $(".procedimento").change(function () {
    addProcedimento($(this).attr("id"))
  })

  /* --------- LINKS ----------- */

  $(".link").click(function () {
    window.location.href = $(this).attr("data-link");
  });

  /* --------- ADICIONAR FISIOTERAPEUTA ---------- */

  $("#adicionar_fisioterapeuta").click(function (e) {
    e.preventDefault();
    nome = $(this).parent().find("input").val();

    $.ajax({
      url: "php/resources/fisioterapeutas.php",
      method: "POST",
      data: { nome: nome },
      beforeSend: function (xhr) {
        aviso({
          mensagem: "<div class='spinner'><i class='fas fa-spinner'></i></div> Carregando...",
          class: "yellow"
        });
      }
    }).done(function (data) {
      console.log(data);

      aviso(data);
      $("#table_fisioterapeuta").append("<tr data-id=\"" + data.id + "\"><td class=\"nome\">" + nome + "</td><td><button class=\"options-bt del static\" data-del=\"" + data.id + "\" data-confirm=\"" + nome + "\"><i class=\"fas fa-trash-alt\"></i></button></td></tr>");
    });
  })

  /* --------- EXCLUIR FISIOTERAPEUTA ---------- */

  $('#table_fisioterapeuta').on("click", ".del", function () {

    id = $(this).attr("data-del");
    confirm_str = $(this).attr("data-confirm");

    if (window.confirm("Deseja realmente excluir " + confirm_str + "?")) {

      $.ajax({
        url: "php/resources/fisioterapeutas.php",
        method: "DELETE",
        data: { id: id },
        beforeSend: function (xhr) {
          aviso({
            mensagem: "<div class='spinner'><i class='fas fa-spinner'></i></div> Carregando...",
            class: "yellow"
          });
        }
      }).done(function (data) {
        aviso(data);
        $("tr[data-id=" + id + "]").hide();
      });

    }

  });

  /* --------- EXCLUIR PACIENTE ---------- */

  $('#table_pacientes').on("click", ".del", function () {

    id = $(this).attr("data-del");
    confirm_str = $(this).attr("data-confirm");

    if (window.confirm("Deseja realmente excluir " + confirm_str + "?")) {

      $.ajax({
        url: "php/resources/pacientes.php",
        method: "DELETE",
        data: { id: id },
        beforeSend: function (xhr) {
          aviso({
            mensagem: "<div class='spinner'><i class='fas fa-spinner'></i></div> Carregando...",
            class: "yellow"
          });
        }
      }).done(function (data) {
        aviso(data);
        $("tr[data-id=" + id + "]").hide();
      });

    }

  });

  /* --------- ADICIONAR REGISTRO ---------- */

  $("#adicionar_registro").click(function (e) {
    if (document.getElementById("form_registro").checkValidity()) {
      e.preventDefault();
      console.log($("#form_registro").serialize());

      $.ajax({
        url: "php/resources/registros.php",
        method: "POST",
        data: $("#form_registro").serialize(),
        beforeSend: function (xhr) {
          aviso({
            mensagem: "<div class='spinner'><i class='fas fa-spinner'></i></div> Carregando...",
            class: "yellow"
          });
        }
      }).done(function (data) {
        console.log(data);
        if (data.fisioterapeuta) {
          googleSheetAPI(data);
        }
        aviso(data);
      });
    }
  })

  /* --------- HINTS ---------- */

  array_hint = [];

  $("#nome_paciente").keyup(function (e) {
    var hintBox = "nome_paciente_hint";

    $.ajax({
      url: "php/resources/pacientes.php",
      method: "GET",
      data: { "nome": $(this).val() },
    }).done(function (data) {
      $("#" + hintBox + " ul").html("");
      if (data.length) {
        $("#" + hintBox).show();
        data.forEach(function (element, index, array) {
          // console.log(element);

          $("#" + hintBox + " ul").append("<li data-value=\"" + index + "\">" + element.nome + "</li>");
        })
      } else {
        $("#" + hintBox).hide();
        $("#" + hintBox + " ul").html("");
      }

      array_hint = data;

    });
  });

  $("input").focus(function () {
    if (!$(this).hasClass("hint-input")) {
      closehint($(this).attr("id"), $(this).val());
    }
  })

  $(".hint").on("click", "li", function () {
    var input_id = $(this).parent().parent().attr("data-input-hint"),
      value = $(this).text().trim();
    closehint(input_id, value);
    index = $(this).attr("data-value");
    console.log(array_hint[index]);
    fillInputs(array_hint[index]);
  })

  function closehint(id, value) {
    $("#" + id).val(value);
    $(".hint").hide();
  }

  //style
  $(".hint").each(function (index) {
    id = $(this).attr("data-input-hint");
    width = $("#" + id).outerWidth();
    $(this).css({
      width: width + "px"
    })
  });

  function fillInputs(data) {
    array = Object.entries(data);
    array.forEach(function (el) {
      if (el[0] != "id") {
        $("#" + el[0]).focus().val(el[1]).blur().change();
      }
      $("input[name=origem][value=" + data.origem + "]").prop('checked', true);
      $("input[name=corpoquadro][value=" + data.corpoquadro + "]").prop('checked', true);
      $("input[name=atleta][value=" + data.atleta + "]").prop('checked', true);
    })
  }

  /* --------- GOOGLE API SEND ---------- */

  function pad(num, size) {
    var s = num + "";
    while (s.length < size) s = "0" + s;
    return s;
  }

  function googleSheetAPI(array) {
  console.log(array);
  
    num_procedimentos = 0;
    for (let idx = 1; idx <= 20; idx++) { //campos de procedimentos
      array["procedimento_"+idx] != "" ? num_procedimentos++ : null;
    }

    final_array = [];
    final_array.push("=Row()-1");
    // array.map((el, i) => {
    //   switch (i) {
    //     case 6:
    //     case 7: //campo de nip
    //       el = pad(el, 8);
    //       break;
    //     case 8: //campo de cpf
    //       el = pad(el, 11)
    //       break;
    //     case 33: //campo de procedimentos
    //       el = num_procedimentos
    //       break;
    //     default:
    //       el = el
    //   }
    //   final_array.push(el);
    // })
    array["data"] ? final_array.push(array["data"]) : final_array.push("");
    array["fisioterapeuta"] ? final_array.push(array["fisioterapeuta"]) : final_array.push("");
    array["nome_paciente"] ? final_array.push(array["nome_paciente"]) : final_array.push("");
    array["tipoatendimento"] ? final_array.push(array["tipoatendimento"]) : final_array.push("");
    array["situacao_adm"] ? final_array.push(array["situacao_adm"]) : final_array.push("");
    array["nip_paciente"] ? final_array.push(array["nip_paciente"]) : final_array.push("");
    array["nip_titular"] ? final_array.push(array["nip_titular"]) : final_array.push("");
    array["cpf_titular"] ? final_array.push(array["cpf_titular"]) : final_array.push("");
    array["origem"] ? final_array.push(array["origem"]) : final_array.push("");
    array["corpoquadro"] ? final_array.push(array["corpoquadro"]) : final_array.push("");
    array["posto_graduacao"] ? final_array.push(array["posto_graduacao"]) : final_array.push("");
    array["atleta"] ? final_array.push(array["atleta"]) : final_array.push("");
    array["modalidade"] ? final_array.push(array["modalidade"]) : final_array.push("");
    array["outra_modalidade"] ? final_array.push(array["outra_modalidade"]) : final_array.push("");
    array["comparecimento"] ? final_array.push(array["comparecimento"]) : final_array.push("");

    for (let idx = 1; idx <= 20; idx++) { //campos de procedimentos
      array["procedimento_"+idx] ? final_array.push(array["procedimento_"+idx]) : final_array.push("");
    }

    final_array.push(num_procedimentos);


    makeApiCall(final_array)
    // console.log(final_array);

  }

})

/* --------- GOOGLE API ---------- */


// Client ID and API key from the Developer Console
var CLIENT_ID = '449836031683-4q3r4oqgvsv6327elf5qjkdcos6ji6p9.apps.googleusercontent.com';
var API_KEY = 'AIzaSyA13xSg0pTDZHH8zCN2GwVW4WoaIXnyedU';

// Array of API discovery doc URLs for APIs used by the quickstart
var DISCOVERY_DOCS = ["https://sheets.googleapis.com/$discovery/rest?version=v4"];

// Authorization scopes required by the API; multiple scopes can be
// included, separated by spaces.
var SCOPES = "https://www.googleapis.com/auth/spreadsheets";

/**
 *  On load, called to load the auth2 library and API client library.
 */
function handleClientLoad() {
  gapi.load('client:auth2', initClient);
}

/**
 *  Initializes the API client library and sets up sign-in state
 *  listeners.
 */
function initClient() {
  gapi.client.init({
    apiKey: API_KEY,
    clientId: CLIENT_ID,
    discoveryDocs: DISCOVERY_DOCS,
    scope: SCOPES
  }).then(function () {
    // Listen for sign-in state changes.
    // gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

    // Handle the initial sign-in state.
    // updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
  }, function (error) {
    console.log(error);
  });
}

/**
 *  Sign out the user upon button click.
 */
// function handleSignoutClick(event) {
//   gapi.auth2.getAuthInstance().signOut();
// }

/**
 * Print the names and majors of students in a sample spreadsheet:
 * https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
 */
function makeApiCall(array) {
  gapi.auth2.getAuthInstance().signIn();

  var params = {
    // The ID of the spreadsheet to update.
    spreadsheetId: '1gqpz5ZVYmGivhkVmRnzMfkjQ8bkVENGbxdKIBm2jET8',  // TODO: Update placeholder value.

    // The A1 notation of a range to search for a logical table of data.
    // Values will be appended after the last row of the table.
    range: 'Sheet1',  // TODO: Update placeholder value.

    // How the input data should be interpreted.
    valueInputOption: 'USER_ENTERED',  // TODO: Update placeholder value.

    // How the input data should be inserted.
    insertDataOption: 'INSERT_ROWS',  // TODO: Update placeholder value.
  };

  var valueRangeBody = {
    values: [
      array
    ]
  };

  var request = gapi.client.sheets.spreadsheets.values.append(params, valueRangeBody);
  request.then(function (response) {
    // TODO: Change code below to process the `response` object:
    console.log(response.result);
    aviso({
      mensagem: "Inserido na planilha",
      class: "green"
    });
    // document.getElementById("form_registro").reset();
    // document.setTimeout(() => location.reload(), 500)
  }, function (reason) {
    console.error('error: ' + reason.result.error.message);
  });
}

/* --------- AVISO ---------- */

function aviso(props, long = false) {

  time = long ? 50000 : 5000;

  if (typeof (timeaviso) !== 'undefined') {
    clearTimeout(timeaviso);
  }

  props = typeof (props) == "object" ? props : JSON.parse(props);
  color = props.class || "grey";
  mensagem = props.mensagem || "Aviso";

  $("#aviso").removeClass("red green yellow grey");
  $("#aviso").addClass(color).find("div").html(mensagem);

  $("#aviso").css("display", "inline-table");
  timeaviso = setTimeout(function () { $("#aviso").hide(); }, time);
}

$("#aviso .close").click(function () {
  $("#aviso").hide()
})
$(document).ready(function () {
  /* --------- ASIDE MENU ----------- */

  $("#menu").click(function () {
    if ($(this).parent().find("li").hasClass("open")) {
      $(this).parent().find("li").removeClass("open");
    } else {
      $(this).parent().find("li").addClass("open");
    }
  });

  /* --------- LIMITE INPUT ----------- */

  function maxLength(element, limit) {
    if (element.val().length >= limit) {
      element.val(element.val().substr(0, limit));
    }
  }

  $("#nip_paciente").keydown(function () {
    maxLength($(this), 8);
  });

  $("#nip_paciente").keyup(function () {
    maxLength($(this), 8);
  });

  $("#nip_titular").keydown(function () {
    maxLength($(this), 8);
  });

  $("#nip_titular").keyup(function () {
    maxLength($(this), 8);
  });

  $("#cpf_titular").keydown(function () {
    maxLength($(this), 11);
  });

  $("#cpf_titular").keyup(function () {
    maxLength($(this), 11);
  });

  /* --------- CONDICIONAIS ----------- */

  json_condicionais = {};

  $.getJSON("static/js/condicionais.json", function (data) {
    json_condicionais = data;
  });

  /**
   *
   * @param {string} id
   * @param {string} valor
   * @param {boolean} nondestructive
   * @param {string} justRefresh
   */
  function condicionais(id, valor, nondestructive = false, justRefresh) {
    array = json_condicionais[id][valor];
    if (!nondestructive) {
      $(".condicional").addClass("none").attr("required", false);
    } else {
      $("*[data-condicional=" + justRefresh + "]")
        .addClass("none")
        .attr("required", false);
    }

    if (array) {
      array.map((item) => {
        $("*[data-condicional=" + item + "]")
          .removeClass("none")
          .attr("required", true);
      });
    }
  }

  function addProcedimento(id) {
    var num = parseInt(id.replace("procedimento_", "")),
      next_num = num++;

    if ($("#" + id).val()) {
      console.log(next_num);
      $("*[data-condicional=procedimento_" + num + "]").removeClass("none");
      console.log($("*[data-condicional=procedimento_" + num + "]"));
    } else {
      console.log("branco");

      for (i = num; i <= 20; i++) {
        console.log("*[data-condicional=procedimento_" + i + "]");
        $("*[data-condicional=procedimento_" + i + "]")
          .addClass("none")
          .attr("required", false);
      }
    }
  }

  resetForm();

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
          mensagem:
            "<div class='spinner'><i class='fas fa-spinner'></i></div> Carregando...",
          class: "yellow",
        });
      },
    }).done(function (data) {
      console.log(data);

      aviso(data);
      $("#table_fisioterapeuta").append(
        '<tr data-id="' +
          data.id +
          '"><td class="nome">' +
          nome +
          '</td><td><button class="options-bt del static" data-del="' +
          data.id +
          '" data-confirm="' +
          nome +
          '"><i class="fas fa-trash-alt"></i></button></td></tr>'
      );
    });
  });

  /* --------- EXCLUIR FISIOTERAPEUTA ---------- */

  $("#table_fisioterapeuta").on("click", ".del", function () {
    id = $(this).attr("data-del");
    confirm_str = $(this).attr("data-confirm");

    if (window.confirm("Deseja realmente excluir " + confirm_str + "?")) {
      $.ajax({
        url: "php/resources/fisioterapeutas.php",
        method: "DELETE",
        data: { id: id },
        beforeSend: function (xhr) {
          aviso({
            mensagem:
              "<div class='spinner'><i class='fas fa-spinner'></i></div> Carregando...",
            class: "yellow",
          });
        },
      }).done(function (data) {
        aviso(data);
        $("tr[data-id=" + id + "]").hide();
      });
    }
  });

  /* --------- EXCLUIR PACIENTE ---------- */

  $("#table_pacientes").on("click", ".del", function () {
    id = $(this).attr("data-del");
    confirm_str = $(this).attr("data-confirm");

    if (window.confirm("Deseja realmente excluir " + confirm_str + "?")) {
      $.ajax({
        url: `/api/v1/paciente/${id}`,
        method: "DELETE",
        beforeSend: function (xhr) {
          aviso({
            mensagem:
              "<div class='spinner'><i class='fas fa-spinner'></i></div> Carregando...",
            class: "yellow",
          });
        },
      }).done(function (data) {
        aviso(data.msg);
        $("tr[data-id=" + id + "]").hide();
      });
    }
  });

  /* --------- ADICIONAR REGISTRO ---------- */

  $("#adicionar_registro").click(function (e) {
    if (document.getElementById("form_registro").checkValidity()) {
      // Se ocorreu a validação mínima de campos
      e.preventDefault();
      console.log($("#form_registro").serialize());

      $.ajax({
        url: "/api/v1/registro",
        method: "POST",
        data: $("#form_registro").serialize(),
        beforeSend: function (xhr) {
          aviso({
            mensagem:
              "<div class='spinner'><i class='fas fa-spinner'></i></div> Carregando...",
            class: "yellow",
          });
        },
      }).done(function (data) {
        aviso(data);
        resetForm();
      });
    }
  });

  /* --------- HINTS ---------- */

  array_hint = [];

  $("#nome_paciente").keyup(function (e) {
    var hintBox = "nome_paciente_hint";

    $.ajax({
      url: "/api/v1/paciente",
      method: "GET",
      data: { q: $(this).val() },
    }).done(function (data) {
      $("#" + hintBox + " ul").html("");
      if (data.length) {
        // Caso tenha conteúdo do retorno escreve nas dicas
        $("#" + hintBox).show();
        data.forEach(function (element, index, array) {
          $("#" + hintBox + " ul").append(
            '<li data-value="' + index + '">' + element.Nome + "</li>"
          );
        });
      } else {
        // Caso não haja apaga blocos
        $("#" + hintBox).hide();
        $("#" + hintBox + " ul").html("");
      }

      // Dados provisórios que contém as informações capturadas do banco
      array_hint = data;
    });
  });

  $("input").focus(function () {
    if (!$(this).hasClass("hint-input")) {
      closehint($(this).attr("id"), $(this).val());
    }
  });

  $(".hint").on("click", "li", function () {
    var input_id = $(this).parent().parent().attr("data-input-hint"),
      value = $(this).text().trim();
    closehint(input_id, value);
    index = $(this).attr("data-value");
    console.log(array_hint[index]);
    fillInputs(array_hint[index]);
  });

  function closehint(id, value) {
    $("#" + id).val(value);
    $(".hint").hide();
  }

  //style
  $(".hint").each(function (index) {
    id = $(this).attr("data-input-hint");
    width = $("#" + id).outerWidth();
    $(this).css({
      width: width + "px",
    });
  });

  function fillInputs(data) {
    array = Object.entries(data);
    array.forEach(function (el) {
      function changeSelectInput(id, value) {
        $(`#${id}`).focus().val(value).blur().change();
      }

      $("input[name=origem][value=" + data.Origem + "]").prop("checked", true);

      if (data.CorpoQuadro) {
        $("input[name=corpoquadro][value=" + data.CorpoQuadro + "]").prop(
          "checked",
          true
        );
      }

      if (typeof data.Atleta == "boolean") {
        $(`input[name=atleta][value=${+ data.Atleta}]`).prop("checked", true).change()
        changeSelectInput("modalidade", data.Modalidade);
        if(data.Modalidade == "Outra"){
          changeSelectInput("outra_modalidade", data.OutraModalidade);
        }
      }

      if (data.PostoGraduacao) {
        changeSelectInput("posto_graduacao", data.PostoGraduacao);
      }

      if (data.NipPaciente) {
        changeSelectInput("nip_paciente", data.NipPaciente);
      }

      if (data.NipTitular) {
        changeSelectInput("nip_titular", data.NipTitular);
      }

      if (data.CpfTitular) {
        changeSelectInput("cpf_titular", data.CpfTitular);
      }
    });
  }

  /* --------- ENVIAR TABELA ---------- */

  function resetForm() {
    console.log("----- Reset Form -----");

    $("#form_registro").trigger("reset");

    // Reset de todos os inputs condicionais
    $(".condicional").addClass("none").attr("required", false);

    $("#situacao_adm").change(function () {
      condicionais($(this).attr("id"), $(this).val());
    });

    $("*[name=atleta]").change(function () {
      condicionais($(this).attr("id"), $(this).val(), true, "modalidade");
    });

    $("*[name=comparecimento]").change(function () {
      condicionais($(this).attr("id"), $(this).val(), true, "procedimento_1");
      condicionais($(this).attr("id"), $(this).val(), true, "tipo_falta");
    });

    $("#modalidade").change(function () {
      condicionais($(this).attr("id"), $(this).val(), true, "outra_modalidade");
    });

    $(".procedimento").change(function () {
      addProcedimento($(this).attr("id"));
    });
  }

  function pad(num, size) {
    var s = num + "";
    while (s.length < size) s = "0" + s;
    return s;
  }

  /* --------- ENVIO DE FORMULÁRIO DE LOGIN ----------- */

  $("#form_login").submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
      type: "POST",
      url: url,
      data: form.serialize(),
      success: function (data) {
        window.location.replace("/");
      },
      error: function (data) {
        window.location.replace(data.getResponseHeader("Location"));
      },
    });
  });
});

/* --------- AVISO ---------- */

function aviso(props, long = false) {
  time = long ? 50000 : 5000;

  if (typeof timeaviso !== "undefined") {
    clearTimeout(timeaviso);
  }

  props = typeof props == "object" ? props : JSON.parse(props);
  color = props.class || "grey";
  mensagem = props.mensagem || "Aguarde um momento.";

  $("#aviso").removeClass("red green yellow grey");
  $("#aviso").addClass(color).find("div").html(mensagem);

  $("#aviso").css("display", "inline-table");
  timeaviso = setTimeout(function () {
    $("#aviso").hide();
  }, time);
}

$("#aviso .close").click(function () {
  $("#aviso").hide();
});

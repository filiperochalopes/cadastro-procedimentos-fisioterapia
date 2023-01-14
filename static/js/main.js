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
      url: "/api/v1/fisioterapeuta",
      method: "POST",
      data: { nome },
      beforeSend: function (xhr) {
        aviso('loading');
      },
    }).done(function (data) {
      aviso(data);
      $("#table_fisioterapeutas").append(
        `<tr data-id="${data.id}"><td class="nome">${nome}</td><td><button class="options-bt del static" data-del="${data.id}" data-confirm="${nome}"><i class="fas fa-trash-alt"></i></button></td></tr>`
      );
    });
  });

  /* --------- EXCLUIR FISIOTERAPEUTA ---------- */

  $("#table_fisioterapeutas").on("click", ".del", function () {
    id = $(this).attr("data-del");

    if (window.confirm(`Deseja desabilitar ${$(this).attr("data-confirm")}?`)) {
      $.ajax({
        url: `/api/v1/fisioterapeuta/${id}`,
        method: "DELETE",
        beforeSend: () => aviso('loading'),
      }).done(function (data) {
        aviso(data);
        $(`tr[data-id=${id}]`).hide();
      });
    }
  });

  /* --------- EDITAR/RENOVAR FISIOTERAPEUTA ---------- */

  $("#table_fisioterapeutas_desabilitados").on("click", ".renew", function () {
    id = $(this).attr("data-renew");

    if (window.confirm(`Deseja habilitar ${$(this).attr("data-confirm")}?`)) {
      $.ajax({
        url: `/api/v1/fisioterapeuta/${id}`,
        method: "PUT",
        beforeSend: () => aviso('loading'),
      }).done(function (data) {
        aviso(data);
        $(`tr[data-id=${id}]`).hide();
      });
    }
  });

  /* --------- EXCLUIR PACIENTE ---------- */

  $("#table_pacientes").on("click", ".del", function () {
    id = $(this).attr("data-del");
    confirm_str = $(this).attr("data-confirm");

    if (window.confirm("Deseja realmente desabilitar " + confirm_str + "?")) {
      $.ajax({
        url: `/api/v1/paciente/${id}`,
        method: "DELETE",
        beforeSend: () => aviso('loading'),
      }).done(function (data) {
        aviso(data);
        $(`tr[data-id=${id}]`).hide();
      });
    }
  });

  /* --------- EDITAR/RENOVAR PACIENTE ---------- */

  $("#table_pacientes_desabilitados").on("click", ".renew", function () {
    id = $(this).attr("data-renew");
    confirm_str = $(this).attr("data-confirm");

    if (window.confirm("Deseja habilitar " + confirm_str + "?")) {
      $.ajax({
        url: `/api/v1/paciente/${id}`,
        method: "PUT",
        dataTType: "json",
        data: { Desabilitado: false },
        beforeSend: () => aviso('loading'),
      }).done(function (data) {
        aviso(data);
        $(`tr[data-id=${id}]`).hide();
      });
    }
  });

  /* --------- ADICIONAR REGISTRO ---------- */

  $("#adicionar_registro").click(async function (e) {
    if (document.getElementById("form_registro").checkValidity()) {
      // Se ocorreu a validação mínima de campos
      e.preventDefault();
      console.log($("#form_registro").serialize());

      try {
        aviso('loading')
        const response = await axios.post('/api/v1/registro', $("#form_registro").serialize());
        aviso(response.data)
        resetForm()
      } catch (errors) {
        console.error(errors);
        aviso(errors.response.data)
      }
    }
  });

  /* --------- INCONSISTÊNCIAS ---------- */

  // TODO Avaliar uma forma de reduzir a repetição dos blocos

  /* --------- 1. MILITARES SEM GRADUAÇÃO ---------- */

  $("#lista_inconsistencias_militar").on("click", "button", async function () {
    try {
      aviso('loading')
      const response = await axios.put(`/api/v1/paciente/${($(this).data('id')).split('-')[1]}`, {
        PostoGraduacao: $(`#${$(this).data('id')}`).val()
      });
      aviso(response.data)
    } catch (errors) {
      console.error(errors);
    }
  });

  /* --------- 2. ATLETAS SEM MODALIDADE ---------- */

  $("#lista_inconsistencias_atleta").on("click", "button", async function () {
    try {
      aviso('loading')
      const response = await axios.put(`/api/v1/paciente/${($(this).data('id')).split('-')[1]}`, {
        Modalidade: $(`#${$(this).data('id')}`).val()
      });
      aviso(response.data)
    } catch (errors) {
      console.error(errors);
    }
  });

  /* --------- 3. REGISTRO SEM TURNO ---------- */

  $("#lista_inconsistencias_turno").on("click", "button", async function () {
    try {
      aviso('loading')
      const response = await axios.put(`/api/v1/registro/${($(this).data('id')).split('-')[1]}`, {
        Turno: $(`#${$(this).data('id')}`).val()
      });
      aviso(response.data)
    } catch (errors) {
      console.error(errors);
    }
  });

  /* --------- 4. FALTAS SEM JUSTIFICATIVAS ---------- */

  $("#lista_inconsistencias_falta").on("click", "button", async function () {
    try {
      aviso('loading')
      const response = await axios.put(`/api/v1/registro/${($(this).data('id')).split('-')[1]}`, {
        TipoFalta: $(`#${$(this).data('id')}`).val()
      });
      aviso(response.data)
    } catch (errors) {
      console.error(errors);
    }
  });

  /* --------- 5. COMPARECIMENTO SEM PROCEDIMENTO ---------- */

  $("#lista_inconsistencias_procedimento").on("click", "button", async function () {
    try {
      aviso('loading')
      const response = await axios.put(`/api/v1/registro/${($(this).data('id')).split('-')[1]}`, {
        Procedimentos: [
          $(`#${$(this).data('id')}`).val()
        ]
      });
      aviso(response.data)
    } catch (errors) {
      console.error(errors);
    }
  });

  /* --------- 6. ATENDIMENTOS DUPLICADOS ---------- */

  $("#lista_inconsistencias_duplicidade").on("click", "button", async function () {
    try {
      aviso('loading')
      const response = await axios.delete(`/api/v1/registro/${($(this).data('id')).split('-')[1]}`);
      aviso(response.data)
    } catch (errors) {
      console.error(errors);
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

      if (data.SituacaoAdmistrativa) {
        changeSelectInput("situacao_adm", data.SituacaoAdmistrativa);
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

  $("body").on("click", "#aviso .close", function () {
    $("#aviso").hide();
  });
});

/* --------- AVISO ---------- */

function aviso(props, long = false) {
  time = long ? 50000 : 5000;

  if (typeof timeaviso !== "undefined") {
    clearTimeout(timeaviso);
  }

  if(props == 'loading'){
    mensagem = "<div class='spinner'><i class='fas fa-spinner'></i></div> Carregando..."
    color = 'yellow';
  }else{
    props = typeof props == "object" ? props : JSON.parse(props);
    color = props.class || "grey";
    mensagem = props.mensagem || "Aguarde um momento.";
  }


  $("#aviso").removeClass("red green yellow grey");
  $("#aviso").addClass(color).find("div").html(mensagem);

  $("#aviso").css("display", "inline-table");
  timeaviso = setTimeout(function () {
    $("#aviso").hide();
  }, time);
}

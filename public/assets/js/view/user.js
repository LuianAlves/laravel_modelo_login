import {deleteBtn, editBtn} from "../common/button.js";
import {openModalCreate} from "../common/modal.js";
import {alert, alertEmpty, alertError, removeErrorModal} from "../common/alert.js";

$(() => {
    var modalId = "#modalUser";
    var formId = "#formUser";
    var tableId = "#tableUser";

    // Carregar tabela com todos os dados
    function carregarUsers() {
        $.ajax({
            type: "GET",
            url: route,
            success: function (response) {
                $(tableId + " tbody").empty();

                if (Array.isArray(response.data)) {
                    response.data.forEach(function (data) {

                        var newRow = $('<tr class="text-center" data-id="' + data.id + '">' +
                            '<td><div class="d-flex px-2 py-1"><div><img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"></div><div class="d-flex flex-column justify-content-center"><h6 class="mb-0 text-sm">' + data.name + '</h6><p class="text-xs text-secondary mb-0">' + data.email + '</p></div></div></td>' +
                            '<td><p class="text-xs font-weight-bold mb-0">Painel</p><p class="text-xs text-secondary mb-0">' + data.panel + '</p></td>' +
                            '<td class="align-middle text-center text-sm"><span class="badge badge-sm bg-gradient-success">' + data.status + '</span></td>' +
                            '<td class="align-middle text-center"><span class="text-secondary text-xs font-weight-bold">' + data.created_at + '</span></td>' +
                            '</tr>');

                        $(tableId + " tbody").append(newRow);
                    });
                } else {
                    console.error("A propriedade 'data' não é um array na resposta da API:", response);
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    carregarUsers();

    // Abrir o modal de cadastro
    $(document).on("click", ".createbtn", function () {
        openModalCreate("user_id", "", "orçamento", formId, modalId);
    });

    // Abrir o modal de edição
    $(tableId).on("click", ".editbtn", function () {
        alertEmpty();

        var $row = $(this).closest("tr");
        var dataId = $row.data("id");

        abrirModalEdicao(dataId);
    });

    function abrirModalEdicao(dataId) {
        $.ajax({
            type: "GET",
            url: route + "/" + dataId,
            success: function (response) {
                var data = response.data;

                $(formId)[0].reset();

                $("input[name='user_id']").val(data.id);

                $("input[name='name']").val(data.name);
                $("input[name='email']").val(data.email);


                $(modalId + " .modal-title").text("Editar orçamento");
                $(modalId + " button[type='submit']").text("Atualizar");

                $(modalId).modal("show");
            }, error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // Formulário PUT/POST
    $(document).on("submit", formId, function (e) {
        e.preventDefault();

        var formData = $(this).serialize();
        var dataId = $("input[name='user_id']").val();

        if (dataId) {
            $.ajax({
                type: "PUT",
                url: route + "/" + dataId,
                data: formData,
                success: function (response) {
                    carregarUsers();

                    alert("alert-primary", response.message);

                    $(modalId).modal("hide");
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        alertError(xhr.responseJSON.errors)
                    } else {
                        alert("alert-danger", "Ocorreu um erro na operação!");
                    }
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: route,
                data: formData,
                success: function (response) {
                    carregarUsers()

                    alert("alert-success", response.message);

                    $(modalId).modal("hide");
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        alertError(xhr.responseJSON.errors)
                    } else {
                        alert("alert-danger", "Ocorreu um erro na operação!");
                    }
                }
            });
        }
    });

    // Remover do Banco de Dados
    $(tableId).on("click", ".deletebtn", function () {
        var dataId = $(this).closest("tr").data("id");
        var token = $('meta[name="csrf-token"]').attr('content');
        var $this = $(this);

        $('#confirmationModal').modal('show');

        $('#confirmDelete').on('click', function () {
            $('#confirmationModal').modal('hide');

            $.ajax({
                type: "DELETE",
                url: route + "/" + dataId,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function (response) {
                    $this.closest("tr").remove();
                    alert("alert-warning", response.message);
                    carregarUsers();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        alertError(xhr.responseJSON.errors);
                    } else {
                        alert("alert-danger", "Ocorreu um erro na operação!");
                    }
                }
            });
        });
    });

    // Limpando alert de error do modal
    $(modalId).on("hidden.bs.modal", function () {
        removeErrorModal(modalId)
    });
});

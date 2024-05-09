import {deleteBtn, editBtn, viewBtn} from "../common/button.js";
import {openModalCreate} from "../common/modal.js";
import {alert, alertEmpty, alertError, removeErrorModal} from "../common/alert.js";

$(() => {
    var modalId = "#modalUser";
    var formId = "#formUser";
    var tableId = "#tableUser";

    function carregarUsers() {
        $.ajax({
            type: "GET",
            url: route,
            success: function (response) {
                $(tableId + " tbody").empty();

                if (Array.isArray(response.data)) {
                    response.data.forEach(function (data) {

                        var newRow = $('<tr data-id="' + data.id + '">' +
                            '<td><div class="d-flex px-2 py-1"><div><img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"></div><div class="d-flex flex-column justify-content-center"><h6 class="mb-0 text-sm">' + data.name + '</h6><p class="text-xs text-secondary mb-0">' + data.email + '</p></div></div></td>' +
                            '<td class="text-center"><p class="text-xs font-weight-bold mb-0">Painel</p><p class="text-xs text-secondary text-uppercase mb-0">' + data.panel + '</p></td>' +
                            '<td class="text-center align-middle text-sm"><span class="badge badge-sm bg-gradient-' + (data.status == 'ativo' ? 'success' : 'dark') + '">' + data.status + '</span></td>' +
                            '<td class="text-center align-middle"><span class="text-secondary text-xs font-weight-bold">' + data.humansDate + '</span></td>' +
                            '<td class="text-center"><div class="dropdown dropdown-table"><a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" id="tableBtn"><i class="fa-solid fa-ellipsis-vertical fs-5"></i></a><ul class="dropdown-menu" aria-labelledby="tableBtn">' + viewBtn() + editBtn() + deleteBtn() + '</ul></div></td>' +
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

    // Modal Create
    $(document).on("click", ".createbtn", function () {
        openModalCreate("user_id", "", "de usuário", formId, modalId);
    });

    // Modal View
    $(tableId).on("click", ".viewbtn", function () {
        alertEmpty();

        var $row = $(this).closest("tr");
        var dataId = $row.data("id");

        abrirModalVisualizacao(dataId);
    });

    function abrirModalVisualizacao(dataId) {
        $.ajax({
            type: "GET",
            url: route + "/" + dataId,
            success: function (response) {
                var data = response.data;

                $(formId)[0].reset();

                $("input[name='user_id']").val(data.id);

                $("input[name='name']").val(data.name);

                var panelValue = data.panel.toLowerCase() === "admin";
                var statusValue = data.status.toLowerCase() === "ativo";

                if (panelValue) {
                    $("input[name='panel']").prop('checked', data.panel);
                }

                if (statusValue) {
                    $("input[name='status']").prop('checked', data.status);
                }

                $(formId + " input").prop('disabled', true);

                $(modalId + " .modal-title").text("Detalhes do usuário");
                $(modalId + " button[type='submit']").hide();

                $(modalId).modal("show");
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // Modal Edit
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

                $("input[name='password']").val('');
                $("input[name='password_confirmation']").val('');

                var panelValue = data.panel.toLowerCase() === "admin";
                var statusValue = data.status.toLowerCase() === "ativo";

                if (panelValue) {
                    $("input[name='panel']").prop('checked', data.panel);
                }

                if (statusValue) {
                    $("input[name='status']").prop('checked', data.status);
                }

                $(modalId + " .modal-title").text("Editar usuário");
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

                    alert("alert-info", response.message);

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
                    alert("alert-danger", response.message);
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

    $(modalId).on("hidden.bs.modal", function () {
        removeErrorModal(modalId)
    });
});

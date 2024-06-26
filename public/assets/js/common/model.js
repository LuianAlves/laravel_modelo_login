import {openModalCreate} from "../common/modal.js";
import {alert, alertEmpty, alertError, removeErrorModal} from "../common/alert.js";

export function generateCRUD(options) {
    const {
        route,
        inputId,
        modalId,
        formId,
        tableId,
        createbtn,
        viewbtn,
        editbtn,
        deletebtn,
        createTitle,
        viewTitle,
        editTitle,
        rowTable,
        inputsM
    } = options;

    /* Start: Table */
    function loadTable() {
        $.ajax({
            type: "GET",
            url: route,
            success: function (response) {
                $(tableId + " tbody").empty();

                if (Array.isArray(response.data)) {
                    response.data.forEach(function (data) {
                        const newRow = rowTable(data);

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

    /* Start: Modal create */
    function storeModal() {
        openModalCreate(inputId, "", createTitle, formId, modalId);
    }

    /* Start: Modal view */
    function viewModal() {
        alertEmpty();

        var $row = $(this).closest("tr");
        var dataId = $row.data("id");

        openModalView(dataId);
    }

    function openModalView(dataId) {
        $.ajax({
            type: "GET",
            url: route + "/" + dataId,
            success: function (response) {
                var data = response.data;

                $(formId)[0].reset();

                $("input[name=inputId]").val(data.id);

                const viewModal = inputsM(data);
                $(formId).append(viewModal);

                $(formId + " input").prop('disabled', true);

                $(modalId + " .modal-title").text(viewTitle);
                $(modalId + " button[type='submit']").hide();

                $(modalId).modal("show");
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    /* Start: Modal edit */
    function editModal() {
        alertEmpty();

        var $row = $(this).closest("tr");
        var dataId = $row.data("id");

        openModalEdit(dataId);
    }

    function openModalEdit(dataId) {
        $.ajax({
            type: "GET",
            url: route + "/" + dataId,
            success: function (response) {
                var data = response.data;

                $(formId)[0].reset();
                $(formId + " input").prop('disabled', false);

                const inputModal = inputsM(data);
                $(formId).append(inputModal);

                $(modalId + " .modal-title").text(editTitle);
                $(modalId + " button[type='submit']").text("Atualizar");

                $(modalId).modal("show");
            }, error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    /* Start: Submit Form */
    function submitForm(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        var dataId = $("input[name='" + inputId + "']").val();

        if (dataId) {
            $.ajax({
                type: "PUT",
                url: route + "/" + dataId,
                data: formData,
                success: function (response) {
                    loadTable();

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
                    loadTable()

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
    }

    /* Start: Delete */
    function deleteData() {
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
                    loadTable();
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
    }

    $(document).ready(function () {
        loadTable();

        $(document).on("click", createbtn, storeModal);
        $(tableId).on("click", viewbtn, viewModal);
        $(tableId).on("click", editbtn, editModal);
        $(document).on("submit", formId, submitForm);
        $(tableId).on("click", deletebtn, deleteData);
    });

    $(modalId).on("hidden.bs.modal", function () {
        removeErrorModal(modalId)
    });
}

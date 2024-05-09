import {deleteBtn, editBtn, viewBtn} from "../common/button.js";
import {generateCRUD} from "../common/model.js";

const options = {
    route: route,
    inputId: "user_id",
    modalId: "#modalUser",
    formId: "#formUser",
    tableId: "#tableUser",
    createbtn: ".createbtn",
    viewbtn: ".viewbtn",
    editbtn: ".editbtn",
    deletebtn: ".deletebtn",
    createTitle: "de usuário",
    viewTitle: "Visualizar usuário",
    editTitle: "Editar usuário",
    rowTable: function (data) {
        return $('<tr data-id="' + data.id + '">' +
            '<td><div class="d-flex px-2 py-1"><div><img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"></div><div class="d-flex flex-column justify-content-center"><h6 class="mb-0 text-sm">' + data.name + '</h6><p class="text-xs text-secondary mb-0">' + data.email + '</p></div></div></td>' +
            '<td class="text-center"><p class="text-xs font-weight-bold mb-0">Painel</p><p class="text-xs text-secondary text-uppercase mb-0">' + data.panel + '</p></td>' +
            '<td class="text-center align-middle text-sm"><span class="badge badge-sm bg-gradient-' + (data.status == 'ativo' ? 'success' : 'dark') + '">' + data.status + '</span></td>' +
            '<td class="text-center align-middle"><span class="text-secondary text-xs font-weight-bold">' + data.humansDate + '</span></td>' +
            '<td class="text-center"><div class="dropdown dropdown-table"><a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" id="tableBtn"><i class="fa-solid fa-ellipsis-vertical fs-5"></i></a><ul class="dropdown-menu" aria-labelledby="tableBtn">' + viewBtn() + editBtn() + deleteBtn() + '</ul></div></td>' +
            '</tr>');
    },
    inputsM: function (data) {
        $("input[name='user_id']").val(data.id);
        $("input[name='name']").val(data.name);
        $("input[name='password']").val('');
        $("input[name='password_confirmation']").val('');

        const panelValue = data.panel.toLowerCase() === "admin";
        const statusValue = data.status.toLowerCase() === "ativo";

        if (panelValue) $("input[name='panel']").prop('checked', data.panel);
        if (statusValue) $("input[name='status']").prop('checked', data.status);

        return null;
    }
};

generateCRUD(options);


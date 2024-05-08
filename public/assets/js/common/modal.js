import {alertEmpty} from "./alert.js";

export function openModalCreate(input, value = null, text, formId, modalId) {
    alertEmpty();

    $(formId)[0].reset();

    $("input[name=" + input + "]").val(value);

    $(modalId + " .modal-title").text("Cadastrar " + text);
    $(modalId + " button[type='submit']").text("Salvar Registro");

    $(modalId).modal("show");
}

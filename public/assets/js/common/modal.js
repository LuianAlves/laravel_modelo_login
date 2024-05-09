import {alertEmpty} from "./alert.js";

export function openModalCreate(input, value = null, text, formId, modalId) {
    alertEmpty();

    $(formId)[0].reset();

    $(formId + " input").prop('disabled', false);

    $("input[name=" + input + "]").val(value);

    $(modalId + " .modal-title").text("Cadastro " + text);
    $(modalId + " button[type='submit']").text("Cadastrar");

    $(modalId).modal("show");
}

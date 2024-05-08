<x-modal modalId="modalUser" formId="formUser" :input="$input">
    <div class="row">
        <x-input col="12 col-sm-6 mb-3 mb-sm-0" set="" id="name" name="name" type="text" label="Nome do cliente" placeholder="Nome do cliente .."></x-input>
    </div>
    <div class="row">
        <x-input col="12 col-sm-6 my-0 my-sm-3" set="" id="password" name="password" type="password" label="Senha de acesso" placeholder="Senha de acesso .."></x-input>
        <x-input col="12 col-sm-6 my-0 my-sm-3" set="" id="password_confirmation" name="password_confirmation" type="password" label="Confirmar senha" placeholder="Confirmar senha .."></x-input>
    </div>
    <div class="row mx-1">
        <x-check-input col="6" id="panel" name="panel" type="checkbox" label="É administrador?" check=""></x-check-input>
        <x-check-input col="5 ms-2" id="status" name="status" type="checkbox" label="Usuário ativo?" check=""></x-check-input>
    </div>
</x-modal>

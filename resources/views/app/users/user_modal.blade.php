<x-modal modalId="modalUser" formId="formUser" :input="$input">
    <div class="row">
        <x-input col="12 col-sm-6 mb-3 mb-sm-0" set="" id="name" name="name" type="text" label="Nome do cliente" placeholder="Nome do cliente .."></x-input>
        <x-input col="12 col-sm-6 mb-3 mb-sm-0" set="" id="email" name="email" type="email" label="E-mail do cliente" placeholder="E-mail do cliente .."></x-input>
    </div>
    <div class="row">
        <x-input col="12 col-sm-6 my-0 my-sm-3" set="" id="password" name="password" type="password" label="Senha de acesso" placeholder="Nome do cliente .."></x-input>
        <x-input col="12 col-sm-6 my-0 my-sm-3" set="" id="password_confirmation" name="password_confirmation" type="password" label="Senha de acesso" placeholder="Nome do cliente .."></x-input>
    </div>
</x-modal>

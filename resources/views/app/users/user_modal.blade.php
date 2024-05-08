<x-modal modalId="modalUser" formId="formUser" :input="{{$input}}">
    <div class="row">
        <x-input col="12 col-sm-6 mb-3 mb-sm-0" set="" id="name" name="name" type="text" label="Nome do cliente" placeholder="Nome do cliente .." icon="fa-solid fa-user"></x-input>
        <x-input col="12 col-sm-6 mb-3 mb-sm-0" set="" id="email" name="email" type="email" label="E-mail do cliente" placeholder="E-mail do cliente .." icon="fa-regular fa-envelope"></x-input>
    </div>
</x-modal>

<!-- Modal -->
<div id="{{$modalId}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form class="modal-content" id="{{ $formId }}">
            @csrf

            @if ($input)
                <input type="hidden" name="{{ $input['name'] }}" value=""/>
                @isset($input['name2'])
                    <input type="hidden" name="{{ $input['name2'] }}" value=""/>
                @endisset
            @endif

            <div class="modal-body p-0">
                <x-alert id="alert-error"/>

                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary text-gradient modal-title text-center"></h3>
                    </div>
                    <div class="card-body pb-3">
                        {{ $slot }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-sm bg-gradient-primary"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

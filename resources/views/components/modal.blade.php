{{--<div id="{{$modalId}}" class="modal fade" data-bs-backdrop="static" tabindex="-1">--}}
{{--    <div class="modal-dialog modal-dialog-centered">--}}
{{--        <form class="modal-content" id="{{ $formId }}">--}}
{{--            @csrf--}}

{{--            @if ($inputHidden)--}}
{{--                <input type="hidden" name="{{ $inputHidden['name'] }}" value=""/>--}}
{{--                @isset($inputHidden['name2'])--}}
{{--                    <input type="hidden" name="{{ $inputHidden['name2'] }}" value=""/>--}}
{{--                @endisset--}}
{{--            @endif--}}

{{--            <div class="modal-body">--}}
{{--                <div class="row modal-bg">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title"></h5>--}}
{{--                    </div>--}}

{{--                    <x-alert id="alert-error"/>--}}

{{--                    {{ $slot }}--}}

{{--                    <div class="row my-3 pt-3">--}}
{{--                        <div class="modal-btn d-flex justify-content-between">--}}
{{--                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-dismiss="modal">Fechar--}}
{{--                            </button>--}}
{{--                            <button type="submit" class="btn btn-sm btn-danger"></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}

{{--    <button type="button" class="btn bg-gradient-info btn-block" data-bs-toggle="modal" data-bs-target="#exampleModalSignUp">--}}
{{--        SignUp Modal--}}
{{--    </button>--}}

<!-- Modal -->
<div id="{{$modalId}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <form class="modal-content" id="{{ $formId }}">
            @csrf

            @if ($inputHidden)
                <input type="hidden" name="{{ $inputHidden['name'] }}" value=""/>
                @isset($inputHidden['name2'])
                    <input type="hidden" name="{{ $inputHidden['name2'] }}" value=""/>
                @endisset
            @endif

            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary text-gradient modal-title tetx-center">/h3>
                    </div>
                    <div class="card-body pb-3">
                        <x-alert id="alert-error"/>
                        {{ $slot }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn bg-gradient-primary"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

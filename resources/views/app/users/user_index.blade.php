<x-app-layout>
    @section('content-dashboard')
        <div class="row">
            <div class="col-12">
                <div class="card card-table">
                    <x-alert id="alert-response"/>

                    <x-card-header title="{{currentUrl()}}"></x-card-header>

                    <x-table tableId="tableUser">
                        <x-slot name="slot">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Usuário
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Permissão
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Cadatrado em
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Ações
                                </th>
                            </tr>
                        </x-slot>
                    </x-table>

{{--                    <x-table-paginate></x-table-paginate>--}}
                </div>
            </div>
        </div>

        <script>
            var route = "{{ route('usuario.index') }}"

            document.addEventListener('DOMContentLoaded', function () {
                var tableContainer = document.querySelector('.card-table');

                new PerfectScrollbar(tableContainer);
            });
        </script>

        <script type="module" src="{{ asset('assets/js/view/user.js') }}"></script>
        @include('app.users.user_modal')
    @endsection
</x-app-layout>

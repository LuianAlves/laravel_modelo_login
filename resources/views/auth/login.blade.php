<x-guest-layout>
    @section('content-guest')
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                <div class="card card-plain mt-8">
                    <div class="card-header pb-0 text-left bg-transparent">
                        <h3 class="font-weight-bolder text-info text-gradient">Bem vindo!</h3>
                        <p class="mb-0">Realize login com seu e-mail e senha</p>
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <label>E-mail</label>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="E-mail" id="email" name="email"
                                       :value="old('email')" required autofocus autocomplete="username">
                            </div>
                            <label>Senha</label>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Senha" id="password"
                                       name="password" required autocomplete="current-password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Acessar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                    <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                         style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                </div>
            </div>
        </div>
    @endsection
</x-guest-layout>

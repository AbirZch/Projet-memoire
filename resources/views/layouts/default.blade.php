<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Default Title')</title>
    @include('includes.head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/app.scss'])
    @stack('head')
</head>

<body>
  @if (session('success'))
  <div class="alert alert-success center">
      {{ session('success') }}
  </div>
@endif
    @include('includes.header')

    <main>
        @yield('content')
    </main>

    @if (count($errors) > 0)

        {{--     <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:1000;">
            <div class="toast-header">
              <strong class="mr-auto">Error</strong>
              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="toast-body">
            {{$error}}
            </div>
          </div> --}}

        <div class="d-flex  justify-content-center align-items-center w-100" style="position: fixed;">
            <div class="toast show " role="alert" id="liveToast" data-bs-autohide="true" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Erreur</strong>
                    <small class="text-body-secondary">Votre email ou mot de passe est incorrecte .Veuillez les vérifier</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                @foreach ($errors->all() as $error)
                    <div class="toast-body">
                        {{ $error }}
                    </div>
                @endforeach

            </div>

        </div>
 {{--        <script>
            const toastLive = document.getElementById('liveToast')
            console.log(Toast)
            const toastBootstrap = Toast.getOrCreateInstance(toastLive)
            toastBootstrap.show()
        </script> --}}
    @endif

</body>

</html>

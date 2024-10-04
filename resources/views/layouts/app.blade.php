<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS from CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="../assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top " style="background-color: rgba(58, 58, 58, 0.8);height:70px" color-on-scroll="300">
            <div class="container">
                <div class="navbar-translate">
                    <a class="navbar-brand" href="/" rel="tooltip" title="Coded by Creative Tim" data-placement="bottom">
                        <img src="../assets/img/teacher_logo.png" alt="..." style="height: 50px; width: auto;"><span style="color: white;font-size:20px"> Edu</span><span style="color: red">Plan</span>
                    </a>
                    <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
                        <!-- Check if the user is not logged in -->
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="btn nav-link" style="border-radius: 50px;background-color:#0056b3;color:white;font-weight:bold">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="btn nav-link" style="border-radius: 50px;background-color:#0056b3;color:white;font-weight:bold">Inscrivez-vous</a>
                        </li>
                        @endguest
        
                        @auth
                        <li class="dropdown nav-item">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                               <span style="font-size: 15px"> Mon compte </span>
                            </a>
                            <div class="dropdown-menu" style="font-size: 15px">
                                <a class="dropdown-item" href="#">Table de bord</a>
                                <a class="dropdown-item" href="#">Classe</a>
                                <a class="dropdown-item" href="#">Nom de la classe</a>
                                <a class="dropdown-item" href="#">Niveau de la classe</a>
                                <a class="dropdown-item" href="#">Jours de travail</a>
                                <a class="dropdown-item" href="#">Heures de début</a>
                                <a class="dropdown-item" href="#">Heures de fin</a>
                                <a class="dropdown-item" href="#">Planification</a>
                                <a class="dropdown-item" href="#">Fiche pédagogique</a>
                                <a class="dropdown-item" href="#">Fiche de séance</a>
                                <a class="dropdown-item" href="#">Examen</a>
                                <a class="dropdown-item" href="#">Évaluation</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-content" style="padding: 80px;">
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
</body>
</html>

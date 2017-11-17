<html>

<head>
    <meta charset="utf-8">
    <meta charset="iso-8859-1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta @yield( 'redirect')>

    <link type="text/css" rel="stylesheet" href="/css/app.css" />
    <link type="text/css" rel="stylesheet" href="/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="/css/PrincipalStyle.css" />
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">


    </style>

    <title>HT Clube - @yield('title')</title>
    <script type="text/javascript">
        function MenuCadastro() {
            location.href = "/cadastro";
        }

        function RedirectToFormAluno() {
            location.href = "/cadastro/Aluno";
        }

        function RedirectToFormLivro() {
            location.href = "/cadastro/Livro";
        }

        function RedirectToListAluno() {
            location.href = "/lista/Aluno";
        }

        function RedirectToListLivro() {
            location.href = "/lista/Livro";
        }

        function MenuLista() {
            location.href = "/lista/menu";
        }

        function MainMenu() {
            location.href = "/home";
        }

        function Devolucao() {
            location.href = "/Devolucao";
        }

        function Historico() {
            location.href = "/Historico";
        }

        function StatusAluno() {
            location.href = "/lista/status/aluno";
        }

        function Reserva() {
            location.href = "/Reserva";
        }

        function LogoutMethod() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }

        function MenuAdmin() {
            var lateral = document.querySelector('#lateral');
            if (lateral.classList.contains('menu-active')) {
                lateral.classList.remove('menu-active');
            } else {
                lateral.classList.add('menu-active');
            }
        }

    </script>
</head>

<body>

    <div class="nabr navbar-default">
        <div class="collapse navbar-collapse topo" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <div class="poscentralized">
                <div class="absolute positioned" style="cursor:pointer;" onclick="MainMenu()">
                    <ul class="nav navbar-nav">
                        <h3>HT Clube</h3>
                    </ul>
                </div>
            </div>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                
                @else
                <li>
                    @yield('back')
                </li>
                @if(Auth::user()->is_admin == 1)

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Painel de configurações <span class="caret"></span>
                                </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="/Admin/painel">
                                            Lista de usuários
                                        </a>
                        </li>
                        <li>
                            <a href="/Admin/painel">
                                            Registrar usuário
                                        </a>
                        </li>
                        <li>
                            <a href="/Admin/painel/bloqueio">
                                            Definir tempo de bloqueio
                                        </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>






    @yield('content')
    <footer class="footer">
        <div align="center" id="footer">
            <a href="/RedirectToHT"><img src="/hacktown-marca.png" alt="Logo" class="logo" /></a>
        </div>
    </footer>
</body>

</html>

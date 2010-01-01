<html>

<head>
    <meta charset="utf-8">
    <meta charset="iso-8859-1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta @yield('redirect')>
    
    <link type="text/css" rel="stylesheet" href="/css/app.css" />
    <link type="text/css" rel="stylesheet" href="/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="/css/PrincipalStyle.css" />
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css">
    

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <style type="text/css">
@font-face {
    font-family: roboto;
    src: url('{{ public_path('/fonts/Roboto-Thin.ttf') }}');
}
</style>
          
    <title>CDL - @yield('title')</title>
    <script type="text/javascript">
        function MenuCadastro() {
            location.href = "/cadastro";
        }
        function RedirectToFormAluno(){
            location.href = "/cadastro/Aluno";
        }
        function RedirectToFormLivro(){
            location.href="/cadastro/Livro";
        }
        function LogoutMethod(){
            event.preventDefault();
                document.getElementById('logout-form').submit();
        }

    </script>
</head>

<body>
    
  <div class="nabr navbar-default">
  <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
        <div class="poscentralized">
            <div class="absolute positioned">
                    <ul class="nav navbar-nav">
                        <h3>Clube de Leitura</h3>
                    </ul>
            </div>
      </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Registrar-se</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
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
    <footer class="footer navbar">
        <div align="center" id="footer">
            <img src="hacktown-marca.png" alt="Logo"/>
        </div>
    </footer>
</body>

</html>

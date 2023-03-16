<!doctype html>
<html lang="fr">
    <head>
        {!! Html::style('assets/css/bootstrap.css') !!}
        {!! Html::style('assets/css/bootstrap-theme.css') !!}
        {!! Html::style('assets/css/gsb.css') !!}
    </head>
    <body class="body">
        <div class="container">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar+ bvn"></span>
                        </button>
                        <a class="navbar-brand" href="">GSB Frais</a>
                    </div>

                    @if(\Illuminate\Support\Facades\Session::get('id') == 0)
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/getLogin') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se connecter</a></li>
                        </ul>
                    </div>
                    @endif
                    @if(\Illuminate\Support\Facades\Session::get('id') > 0)
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/getListeFrais') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Lister</a></li>
                            <li><a href="{{ url('/ajouterFrais') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Ajouter</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/getLogout') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se déconnecter</a></li>
                        </ul>
                    </div>
                    @endif

                </div><!--/.container-fluid -->
            </nav>
        </div>
        <div class="container">
            @yield('content')
        </div>
        {!! Html::script('assets/js/bootstrap.js')  !!}
        {!! Html::script('assets/js/ui-bootstrap-tpls.0.11.js')  !!}
        {!! Html::script('assets/js/ui-bootstrap-tpls.js')  !!}
    </body>
</html>

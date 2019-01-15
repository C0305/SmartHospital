<html>
<head>
    <title>Smart Hospital - Incio de Sesion</title>
    <link rel="stylesheet" type="text/css" href="/css/log-in.css">
    <meta name="theme-color" content="#333333"></head>
<meta name="msapplication-TileColor" content="#da532c">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="apple-touch-icon" sizes="57x57" href="images/icons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/icons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/icons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/icons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/icons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/icons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/icons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/icons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/icons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="images/icons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/icons/favicon-16x16.png">
</head>
<body class="login-page login-3">
<div id="app" class="site-wrapper">
    <div class="login-box">
        <div class="box-wrapper">
            <div class="logo-main">
                <a href="/"><img src="/svg/logo.svg"  alt="Smart Hospital Log - In  Logo"></a>
            </div>
            <form method="POST" action="/login">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input id="email" type="email"  name="email" class="form-control form-control-danger" placeholder="Correo Electronico" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password"  class="form-control form-control-danger" placeholder="Contraseña" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="other-actions row">
                        <div class="col-6">
                            <div class="checkbox">
                                <label class="c-input c-checkbox">
                                    <input
                                            type="checkbox"
                                            name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                    <span class="c-indicator"></span>
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('password.request') }}" class="forgot-link">¿Contraseña Olvidada?</a>
                        </div>
                    </div>
                </div>
                <button class="btn btn-theme btn-full">Iniciar sesión</button>
            </form>
            <div class="page-copyright">
                <p><a href="https://www.smarthospital.tech" target="_blank">Smart Hospital</a></p>
                <p>The future in smart health</p>
            </div>
        </div>
    </div>
    <div class="content-box">
    </div>
</div>
</body>
</html>
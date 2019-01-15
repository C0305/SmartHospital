<html>
    <head>
        <title>
            Smart Hospital - Log In
        </title>
        <link rel="stylesheet" type="text/css" href="/css/log-in.css">
    </head>
    <body>
        <div class="grid">
            <div class="sidebar">
                <div class="">
                    <div class="sidebar__container">
                        <div class="sidebar__container__brand">
                            <a href="/">
                                <img src="/svg/logo.svg"  alt="Smart Hospital Log - In  Logo">
                            </a>
                        </div>
                        <div class="sidebar__container__form">
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
                                        <div class="checkbox other-actions-left">
                                            <label class="c-input">
                                                <input
                                                        type="checkbox"
                                                        name="remember"
                                                        {{ old('remember') ? 'checked' : '' }}>
                                                <span class="c-indicator"></span>
                                                Remember Me
                                            </label>
                                        </div>
                                        {{--<div class="text-right other-actions-rigth">
                                            <a href="{{ route('password.request') }}" class="forgot-link">¿Contraseña Olvidada?</a>
                                        </div>--}}
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
                </div>
            </div>
            <div class="cover">
                <img src="images/background.jpg">
            </div>
        </div>
    </body>
</html>
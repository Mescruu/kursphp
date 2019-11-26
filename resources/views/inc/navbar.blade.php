<nav class="navbar navbar-expand-md navbar-dark bg-darkblue fixed-top">

    <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}"><img src="/storage/logo.png" width="30" height="30" class="d-inline-block mr-1 align-bottom ml-0" alt="{{ config('app.name', 'kurs php') }}"> kurs PHP</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu"
                        aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
                    <!--        aria-controls="mainmenu" - pokazuje połączenie pomiedzy togglerem a rozwijanym collapse oraz czy jest rozwinięte "aria-collapse"
                        przy czym na początek jest ustawione jako false, jest to zrobione by czytniki wiedziały co się dzieje-->
                    <!--         gdy rozwiniete zamiast false jest true. Dla aria-label  pokazuje co to jest. np dla osob niewidomych by wiedziały co to jest.-->
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse w-100" id="mainmenu">

                    <!--            mr-auto margines automatyczny-->
                    <div class="d-flex flex-row  flex-wrap align-items-center navbar-nav mr-auto float-left">

                    @if (!Auth::guest())
                        <!--                    jezeli jest "active" dodatkowo w klasie, wtedy pokazuje, na której stronie jesteśmy-->
                            <li class="nav-item d-flex align-items-start">
                                @if(Auth::user()->typ==\App\User::$admin)
                                    <a class="nav-link" href="/panel">Panel administracyjny</a>
                                @endif
                                @if(Auth::user()->typ==\App\User::$user)
                                        <a class="nav-link" href="/profil">Profil</a>
                                @endif
                            </li>
                            <!--                    submenu-->
                            <li class="nav-item dropdown">
                                <!--                        dropdown-toggle pokazuje, żę jest to rozwijalne i nadaje strzałkę, data-toggle mówi o tym, że może się to rzeczywiście rozwijać, natomiast rola jako przycisk umożliwia to mechanicznie-->
                                <!--                      aria-expended mówi o tym, czy jest to rozwinięte czy też nie-->
                                <a class="nav-link dropdown-toggle m-auto" data-toggle="dropdown" role="button" aria-expanded="false" id="submenu" href="#">Tematy</a>

                                <!--                        pojemnik na podmenu-->
                                <!--                        aria-labelledby przez co jest rozwijalne,  aria-haspopup, pokazuje czy jest to submenu, które się dodatkowo rozwija-->
                                <div class="dropdown-menu" aria-labelledby="#submenu" aria-haspopup="true">
                                    <a class="dropdown-item" href="/tematy">Lista tematów</a>
                                    <!--                            jest to separator pomiedzy odnosnikami-->
                                    <div class="dropdown-divider"></div>


                                        @if(count($listaTematow)>=1)
                                            @foreach($listaTematow as $temat)
                                                <a class="dropdown-item" href="/tematy/{{$temat->id}}">{{$temat->nazwa}}</a>
                                            @endforeach
                                        @endif
                                    

                                </div>
                            </li>
                        @endif

                    <!--       na końcu znajduje się-->
                    @if (Auth::guest())

                        @if(request()->segment(count(request()->segments()))!='login')

                            <form class="form-inline d-flex ml-auto" method="POST" class="w-100" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <input id="email" type="email" class="form-control" name="email" placeholder="email" value="{{ old('email') }}" required autofocus>
                                <input id="password" type="password" placeholder="haslo" class="form-control" name="password" required>

                                <div class="form-control login-checkbox">
                                    <input  type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }} checked> Zapamiętaj
                                </div>

                                <button type="submit"class="btn btn-info float-right btn-login btn-log">
                                    Zaloguj 
                                </button>
                            </form>

                        @endif
                    @else

                        <div class="d-flex ml-auto btn-logout">
                        <a class="btn btn-info btn-log " href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Wyloguj
                        </a>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>


                    @endif

                    </div>

                </div>
                @if (Auth::guest())
                    <div class="userName">
                        {{--                Nie jesteś zalogowany - zaloguj się!--}}
                    </div>
                @else
                    <div class="userName">
                        Zalogowany:  {{ Auth::user()->imie }} {{ Auth::user()->nazwisko}}
                    </div>
                @endif
    </div>
</nav>

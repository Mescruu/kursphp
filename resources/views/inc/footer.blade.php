<!-- Footer Links -->
<footer class="
   @if(Request::path() !== '/')
        fixed-bottom
@endif

">

    <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row pt-4">

        <!-- Grid column -->
        <div class="col-md-2 mt-md-0 mt-3">

            <img src="/storage/logo.png">
        </div>
        <!-- Grid column -->

        <div class="col-md-3 offset-4 mb-md-0 mb-3">
            @if (!Auth::guest())
                @if(count($listaTematow)>=1)
                    <h5>Tematy</h5>

                    <ul class="list-unstyled">
                        @foreach($listaTematow as $temat)

                            <li>
                                <a href="/tematy/{{$temat->id}}">{{$temat->nazwa}}</a>

                            </li>
                        @endforeach

                    </ul>
                @endif
            @endif
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 mb-md-0 mb-3">

            <!-- Links -->
            @if (Auth::guest())

                <h5>Linki</h5>
                <ul class="list-unstyled">

                    <li>
                        <a  href="{{route('login')}}"/> zaloguj się
                        </a>
                    </li>
                    <li>
                        <a class="forgetLink w-100 text-right mt-2" href="{{ route('password.request') }}">
                            Zapomniałeś hasła?
                        </a>
                    </li>
                </ul>

             @else

                <h5 >Linki</h5>

                <ul class="list-unstyled">

                    @if(Auth::user()->typ==\App\User::$admin)
                        <li>
                            <a href="/panel">Panel administracyjny</a>
                        </li>
                    @endif
                    @if(Auth::user()->typ==\App\User::$user)
                        <li>
                            <a  href="/profil">Profil</a>
                        </li>
                    @endif

                    <li>
                        <a  href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                            wyloguj się
                        </a>
                    </li>
                </ul>

             @endif


        </div>

    </div>
    <!-- Copyright -->
    <div class="footer-copyright text-right py-3">© 2019-2020</div>
    <!-- Copyright -->
</div>
</footer>

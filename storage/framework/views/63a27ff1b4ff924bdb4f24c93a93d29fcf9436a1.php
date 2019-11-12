<nav class="navbar navbar-expand-md navbar-dark bg-darkblue fixed-top">

    <div class="container">

                <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><img src="/storage/logo.png" width="30" height="30" class="d-inline-block mr-1 align-bottom ml-0" alt="<?php echo e(config('app.name', 'kurs php')); ?>"> kurs PHP</a>

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

                    <?php if(!Auth::guest()): ?>
                        <!--                    jezeli jest "active" dodatkowo w klasie, wtedy pokazuje, na której stronie jesteśmy-->
                            <li class="nav-item d-flex align-items-start">
                                <a class="nav-link" href="/profile">Profil</a>
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


                                    <?php if(session()->has('listaTematow')): ?>
                                        <?php if(count( session('listaTematow') )>=1): ?>
                                            <?php $__currentLoopData = session('listaTematow'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a class="dropdown-item" href="/tematy/<?php echo e($temat->id); ?>"><?php echo e($temat->nazwa); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>
                            </li>
                            <li class="nav-item d-flex align-items-start">
                                <a class="nav-link" href="/services">Panel Administracyjny</a>
                            </li>
                        <?php endif; ?>

                    <!--       na końcu znajduje się-->
                    <?php if(Auth::guest()): ?>

                        <?php if(request()->segment(count(request()->segments()))!='login'): ?>

                            <form class="form-inline d-flex ml-auto" method="POST" class="w-100" action="<?php echo e(route('login')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input id="email" type="email" class="form-control" name="email" placeholder="email" value="<?php echo e(old('email')); ?>" required autofocus>
                                <input id="password" type="password" placeholder="haslo" class="form-control" name="password" required>

                                <div class="form-control login-checkbox">
                                    <input  type="checkbox"  name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> checked> Zapamiętaj
                                </div>

                                <button type="submit"class="btn btn-info float-right btn-login btn-log">
                                    Zaloguj
                                </button>
                            </form>

                        <?php endif; ?>
                    <?php else: ?>

                        <div class="d-flex ml-auto btn-logout">
                        <a class="btn btn-info btn-log " href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Wyloguj
                        </a>
                        </div>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>


                    <?php endif; ?>

                    </div>

                </div>
                <?php if(Auth::guest()): ?>
                    <div class="userName">
                        
                    </div>
                <?php else: ?>
                    <div class="userName">
                        Zalogowany:  <?php echo e(Auth::user()->imie); ?> <?php echo e(Auth::user()->nazwisko); ?>

                    </div>
                <?php endif; ?>
    </div>
</nav>

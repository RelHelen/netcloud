<!-- регистрация -->


<div class="d-flex align-items-center h-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <h4>Форма регистрации</h4>
                        <form class="form" id="check" method="POST" action="<?= PATH ?>user/singup">

                            <div class=" mb-4">
                                <input type="text" id="login" name="login" class="form-control form-control-lg" placeholder="Введите логин" value="<?= isset($_SESSION['form_data']['login']) ? hsc($_SESSION['form_data']['login']) : ''; ?>" />
                                <!-- <label class="form-label" for="login">Введите логин</label> -->
                            </div>
                            <!-- <div class="mb-4">
                                  <input type="text" id="sname" name="sname" class="form-control form-control-lg" placeholder="Введите имя" /> 
                               <label class="form-label" for="sname">Введите имя</label>  
                    </div> -->

                            <div class="mb-4">
                                <input type="email" id="mail" name="mail" class="form-control form-control-lg" placeholder="Введите почту" value="<?= isset($_SESSION['form_data']['mail']) ? hsc($_SESSION['form_data']['mail']) : ''; ?>" />
                                <!--  <label class="form-label" for="mail">Введите почту</label> -->
                            </div>

                            <div class="mb-4">
                                <input type="password" id="pass" name="pass" class="form-control form-control-lg" placeholder="Введите пароль" value="" />
                                <!-- <label class="form-label" for="pass">Password</label> -->
                            </div>

                            <!--  <div class="form-outline mb-4">
                  <input type="password" id="pass2" name="mail" class="form-control form-control-lg" />
                  <label class="form-label" for="pass2">Repeat your password</label>
                </div> -->



                            <div class="mb-4 ">
                                <button type="submit" id="check-btn" class="btn btn-success  ">
                                    Регистрация</button>
                            </div>

                            <div class="text-center text-muted ">
                                Уже есть аккаунт? <a href="<?= PATH ?>user/login" class=" ">
                                    Войти</a>
                            </div>

                        </form>
                        <!-- данные сессии показываем только один раз  -->
                        <?php
                        if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- вход -->
 <div class="d-flex align-items-center h-100">
     <div class="container h-100">
         <div class="row d-flex justify-content-center align-items-center h-100">
             <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                 <div class="card" style="border-radius: 15px;">
                     <div class="card-body p-5">
                         <h4>Вход в личный кабинет</h4>
                         <form class="form" id="check" method="POST" action="<?= PATH ?>/user/login">

                             <div class=" mb-4">
                                 <label class="form-label" for="login">Введите логин</label>
                                 <input type="text" id="login" name="login" class="form-control " placeholder="Введите логин" />
                             </div>


                             <div class=" mb-4">
                                 <label class="form-label" for="pass">Введите пароль</label>
                                 <input type="password" id="pass" name="pass" class="form-control " placeholder="Введите пароль" />

                             </div>



                             <div class=" mb-4 ">
                                 <button type="submit" id="check-btn" class="btn btn-success  ">
                                     Войти</button>
                             </div>
                             <div class="text-center text-muted ">
                                 Нет аккаунта? <a href="<?= PATH ?>/user/singup" class=" ">
                                     Регистрация</a>
                             </div>



                         </form>
                         <p><a href="#"><i class="fas fa-caret-square-down"></i>
                                 <!-- fas fa-chevron-circle-up -->
                                 Возможности сервиса</a></p>
                         <p><a href="#"><i class="fas fa-chevron-circle-down"></i> Как получить доступ к сервису</a></p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
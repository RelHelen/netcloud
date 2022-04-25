 <!-- вход -->
 <div class="d-flex align-items-center h-100">
     <div class="container h-100">
         <div class="row d-flex justify-content-center align-items-center h-100">
             <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                 <div class="card" style="border-radius: 15px;">
                     <div class="card-body p-5">
                         <h4>Вход в личный кабинет</h4>
                         <form class="form" id="check" method="POST" action="<?= PATH ?>user/login">

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



                         </form>
                         <p><a href="#">Возможности сервиса</a></p>
                         <p><a href="#">Как получить доступ к сервису</a></p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
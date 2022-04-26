<!-- <code><?= __FILE__ ?></code> -->

<div class="login-box">
  <div class="login-logo">
    <!-- <b>Admin</b> -->
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Войти в панель администратора</p>
      <?php
      if (isset($_SESSION['error'])) :   ?>
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Ошибка</h3>
          </div>
          <div class="card-body">
            <?= $_SESSION['error'];
            unset($_SESSION['error']); ?>
          </div>
          <!-- /.card-body -->

        </div> <br>
      <?php endif;      ?>


      <form action="<?= ADMIN ?>/user/login" method="post">
        <div class="input-group mb-3">
          <input type="text" name="login" class="form-control" placeholder="Логин">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="pass" class="form-control" placeholder="Пароль">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Запомнить
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">Забыл пароль</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
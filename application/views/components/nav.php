<div id="nav">
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="/">BeeJee</a>
    <?php if(!$_SESSION['auth']):?>
      <button class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="modal" data-target="#loginModal">Войти</button>
      <?php else:?>
          <form class="form-inline">
      <a href="/cabinet/" class="mr-3">
          <svg width="31" height="37" viewBox="0 0 31 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="15.5" cy="9.14103" r="9.14103" fill="#C4C4C4"/>
              <path d="M16.2949 21.0717C1.58974 20.6742 0 36.1743 0 36.1743H31C31 36.1743 31 21.4692 16.2949 21.0717Z" fill="#C4C4C4"/>
          </svg>

      </a>
      <button class="btn btn-outline-success my-2 my-sm-0" type="button" @click="logout">Выйти</button>
      </form>
  <?php endif;?>
  </nav>

  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Вход в Личный кабинет</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <form method="post" id="form-signin" @submit="login_form($event)">
              <div class="alert alert-danger" v-show="error_div" role="alert" style="display:none">
              {{error_div}}
              </div>
                      <?php if(!empty($data['error'])) :?>
                          <p><?php echo $data['error']; ?></p>
                      <?php endif; ?>
                  <div class="form-group">
                      <label for="login">Имя пользователя</label>
                      <input type="text" class="form-control" id="login" name="login" v-model="login">
                  </div>
                  <div class="form-group">
                      <label for="password">Пароль</label>
                      <input type="password" class="form-control" id="password" name="password" v-model="password">
                  </div>
					        <div class="text-center">
                    <button type="submit" class="btn btn-outline-success">Войти</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" @click='close_modal'>Закрыть</button>
                  </div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <form class="col s4 offset-s4 blue-grey" id="loginForm" action="<?$_SERVER['PHP_SELF']?>" method="POST">
    <div class="row">

      <!-- Username -->
      <div class="input-field col s12">
        <i class="material-icons prefix">account_circle</i>
        <input id="icon_prefix" type="text" name="utente" class="validate">
        <label for="icon_prefix">Username</label>
      </div>

      <!-- Password -->
      <div class="input-field col s12">
        <i class="material-icons prefix">vpn_key</i>
        <input id="icon_telephone" type="password" name="password" class="validate">
        <label for="icon_telephone">Password</label>
      </div>
      
    </div>
    <a name="loginButton" class="waves-effect waves-light btn-large" onclick="$('#loginForm').submit();">Login</a>
  </form>
</div>
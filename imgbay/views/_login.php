<form action="<?= $base_url ?>/" method="post" class="login">
<fieldset><legend>Login</legend>
  <dl>
	<dt><label for="login[username]">Username</label></dt>
	<dd><input type="text" id="login[username]" name="username" value="" /></dd>

	<dt><label for="login[password]">Password</label></dt>
	<dd><input type="password" id="login[password]" name="password" value="" /></dd>
  </dl>
  <input type="hidden" name="action" value="login" />
</fieldset>
<div class="buttons">
  <button type="submit">login</button>
</div>
</form>


<form action="<?= $base_url ?>/" method="post" class="register">
<fieldset><legend>Register</legend>
  <dl>
	<dt><label for="register[username]">Username</label></dt>
	<dd><input type="text" id="register[username]" name="username" value="" /></dd>

	<dt><label for="register[email]">E-mail</label</dt>
	<dd><input type="text" id="register[email]" name="email" value ="" /></dd>

	<dt><label for="register[password]">Password</label</dt>
	<dd><input type="password" id="register[password]" name="password" value ="" /></dd>

	<dt><label for="register[password_confirmation]">Password Confirmation</label</dt>
	<dd><input type="password" id="register[password_confirmation]" name="password_confirmation" value ="" /></dd>
  </dl>
  <input type="hidden" name="action" value="register" />
</fieldset>
<div class="buttons">
  <button type="submit">register</button>
</div>
</form>

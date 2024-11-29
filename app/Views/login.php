<?php
  if($alert = session('alert')) { 
?>
<div class="alert alert-warning mt-3"><?= $alert?></div>

<?php }?>

<h1>Login</h1>
<form action="<?= site_url('/loginOk') ?>" method="POST">
  <div class="form-floating mb-3">
    <input type="text" class="form-control" id="userid" name="userid" require>
    <label for="userid">아이디</label>
  </div>
  <div class="form-floating mb-3">
    <input type="password" class="form-control" name="passwd" id="password" placeholder="Password" require>
    <label for="password">비밀번호</label>
  </div>
  <button class="btn btn-primary">로그인</button>
</form>

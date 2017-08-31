<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/bootstrap-clearmin.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/roboto.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/font-awesome.min.css">
    <title>Авторизация :: УчительскийКомплект</title>
    <style></style>
  </head>
  <body class="cm-login">

    <div class="text-center" style="padding:90px 0 30px 0;background:#fff;border-bottom:1px solid #ddd">
      <img src="<?=base_url();?>graphics/img/big_logo.png">
    </div>
       <? if(!empty($error)) echo $error; ?>
    <div class="col-sm-6 col-md-4 col-lg-3" style="margin:40px auto; float:none;">
      <form method="post">
      <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
	<div class="col-xs-12">
          <div class="form-group">
	  <!--  <div class="input-group">
	      <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
	      <input type="text" name="ticket_users" class="form-control" placeholder="Пользователь">
	    </div>-->
	    
	    <div class="input-group">
	      <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
	      <input type="text" name="surname_users" class="form-control" placeholder="Фамилия"><input type="text" name="realname_users" class="form-control" placeholder="Имя">
	    </div>
	    
          </div>
          <div class="form-group">
	    <div class="input-group">
	      <div class="input-group-addon"><i class="fa fa-fw fa-lock"></i></div>
	      <input type="password" name="ticket_paska" class="form-control" placeholder="Пароль">
	    </div>
          </div>
        </div>
	<div class="col-xs-6">
          <div class="checkbox"><label><input type="checkbox"> Запомнить меня</label></div>
	</div><div class="col-xs-6">
          <button type="submit" class="btn btn-block btn-primary">Войти</button>
        </div>
      </form>
    </div>
  </body>
</html>


        <div id="global">
            <div class="container-fluid">
             <? if(!empty($error)) echo $error; ?>
             <div class="row cm-fix-height">
                	<div class="col-sm-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">Фото</div>
                            <div class="panel-body">
                            	<form class="form" method="post" enctype="multipart/form-data">
                                <img src="<?=base_url();?>graphics/photo/male.png" class="img-responsive img-circle">
                               <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                               <imput type="hidden" name="referrer" value="<? echo getenv("HTTP_REFERER"); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Данные</div>
                            <div class="panel-body">
                                
  									<div class="form-group">
    									<input type="text" class="form-control" name="surname" id="exampleInputEmail3" value="<?=$user['users_surname'];?>" disabled>
  									</div>
  									<div class="form-group">
    									<input type="text" class="form-control" name="realname" id="exampleInputPassword3" value="<?=$user['users_name'];?>" disabled>
  									</div>
  									<div class="form-group">
    									<input type="text" class="form-control" name="middlename" id="exampleInputPassword3" value="<?=$user['users_middle'];?>" disabled>
  									</div>
									<div class="form-group">
										<label for="text">Телефон:</label>
    									<input type="text" class="form-control" name="telephone" id="exampleInputPassword3" value="<?=$user['users_phone'];?>">
  									</div>
  									<div class="form-group">
										<label for="text">E-Mail:</label>
    									<input type="text" class="form-control" name="email" id="exampleInputPassword3" value="<?=$user['users_email'];?>">
  									</div>
                            </div>
                        </div>
                    </div>
             
              
              <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Изменение пароля</div>
                            <div class="panel-body">
                                
  									<div class="form-group">
  									<label for="text">Старый пароль:</label>
    									<input type="password" class="form-control" name="old" id="exampleInputEmail3" >
  									</div>
  									<div class="form-group">
  									<label for="text">Новый пароль:</label>
    									<input type="password" class="form-control" name="new" id="exampleInputPassword3" >
  									</div>
  									<div class="form-group">
  									<label for="text">Повторить новый пароль:</label>
    									<input type="password" class="form-control" name="retur" id="exampleInputPassword3" >
  									</div>
  									<div class="alert alert-warning alert-dismissible fade in shadowed" role="alert">
                    					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    					<i class="fa fa-fw '.$icon.'"></i>При смене пароля, вы будете выведены из системы. 
                						</div>
                            </div>
                        </div>
                    </div>
              </div>
                          
              
                <br>
              <input name="Submit" type=submit class="btn btn-primary" value="Сохранить данные"> 
  								</form>
              
  
        </div>
            

        <div id="global">
            <div class="container-fluid">
            <? if(!empty($error)) echo $error; ?>
                <div class="row cm-fix-height">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Сотрудники</div>
                    <div class="panel-body">
                      
                      	<table class="table table-hover">
                      	<tr><th>Ф.И.</th><th>Логин</th><th>Статус</th><th>Пользователь</th><th>Telegram</th><th>Дата активности</th><th></th></tr>
                      	<? foreach($users as $us) {  ?>
                      		<tr><td><?=$us['users_name'];?> <?=$us['users_surname'];?></td><td><?=$us['users_login'];?></td><td><?=$us['user_stat']?></td><td><?=$us['users_hide']?></td><td><?=$us['telegram_reg'];?></td><td><span class="label label-info"><?=$us['data_to_active'];?></span></td><td>
							<?=$us['reset_password'];?>
							</td></tr>
                      	<?  } ?>
                      	</table>
                      	
                    </div>
                </div>
            </div>
            
            
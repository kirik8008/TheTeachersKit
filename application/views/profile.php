    <!-- Отображение и скрытие по onmouseover/onmouseout функции удаления истории -->

    <script type="text/javascript"> 
           function View_delete_icon(id)
				{
					var el=document.getElementById(id);
					el.style.display="block";
				}
			function hide_delete_icon(id)
				{
					var el=document.getElementById(id);
					el.style.display="none";
				}
        </script>
        
        
        <div id="global">
            <div class="container-fluid">
             <? if(!empty($error)) echo $error; ?>
           <div class="row cm-fix-height">
                	<div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?=$user['users_surname'];?> <?=$user['users_name'];?> <?=$user['users_middle'];?> </div>
                            <div class="panel-body">
                            	<form class="form" method="post" enctype="multipart/form-data">
                                <center><img src="<?=base_url();?>graphics/photo/male.png" class="img-responsive img-circle">
                                <h6><i class="fa fa-repeat"></i> <?=$user['users_dateactive'];?></h6></center>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-sm-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">Данные <a href="<?=base_url();?>user/edit" class="btn btn-info btn-xs pull-right">Edit</a></div>
                            <div class="panel-body">
                                
  									<div class="group">
    									<label for="text">Телефон</label> 
    									<p><?=$user['users_phone'];?></p>
  									</div>
  									<div class="group">
    									<label for="text">E-Mail</label> 
    									<p><?=$user['users_email'];?></p>
  									</div>
  									<div class="group">
    									<label for="text">Авторизация Telegram</label> 
    									<p>-</p>
  									</div>
  									<div class="group">
    									<label for="text">Авторизация Viber</label> 
    									<p>-</p>
  									</div>
  									
                            </div>
                        </div>
                    </div>
              </div>
              
              
                      
                 
                 <div class="row cm-fix-height">
             	 	<div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Ваши последние действия</div>
                            <div class="panel-body">
                                
  									<table class="table table-hover">
  									<tr><th>Дата события</th><th>Договор</th><th>Наименование</th><th>ИНВ.Номер</th><th>Примечание</th><th WIDTH=30 px></th></tr>
  									<? $x=1; foreach($history as $item) { ?>
  									<tr onmouseover="View_delete_icon('del_<?=$x;?>')" onmouseout="hide_delete_icon('del_<?=$x;?>')"><td><?=$item['date'];?></td><td><?=$item['contract'];?></td><td><?=$item['device_name'];?></td><td><?=$item['device_inv'];?></td><td><?=$item['note'];?></td><td><a href="#>"><i id="del_<?=$x;?>" style="display: none;" class="fa fa-trash-o" aria-hidden="true"></i></a></td></tr>
  									<? $x++; } ?>
  									</table>
                            </div>
                        </div>
                    </div>
                 </div> 
                 
                 
        <!-- Окно для изменения даты заключения -->  
        
                 <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">
                                Изменение даты заключения договора
                                <a class="anchorjs-link" href="#myModalLabel"><span class="anchorjs-icon"></span></a>
                            </h4>
                        </div>
                        <div class="modal-body">
                        	<div class="alert alert-info">После сохранения, договор будет от новой даты.</div>
                        	<center><form name="myForm">
                        	<input type="hidden" name="teacher_id" value="<?=$id;?>">
                        	<input type="date" name="date" min="<?=date("Y-m-d",time()-60*60*24*1270); ?>" max="<?=date("Y-m-d",time()+60*60*24*3); ?>"/></center><hr>
                        	<p>Информация о смене даты заключения договора, отобразится в истории.</p>
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                            <input type="submit" class="btn btn-primary" value="Сохранить новую дату"> 
                            </form>
                        </div>
                    </div>
                </div>
        <!-- /Окно для изменения даты заключения -->
              
  
        </div>
            

        <div id="global">
            <div class="container-fluid">
             <? if(!empty($error)) echo $error; ?>
           <div class="row cm-fix-height">
                	<div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?=$surname;?> <?=$realname;?> <?=$middlename;?> </div>
                            <div class="panel-body">
                            	<form class="form" method="post" enctype="multipart/form-data">
                                <center><img src="<?=$photo;?>" class="img-responsive img-circle">
                                <h6><i class="fa fa-repeat"></i> <?=$update_profile;?></h6></center>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Персональные данные <a href="<?=base_url();?>teacher/edit/<?=$id;?>" class="btn btn-info btn-xs pull-right">Edit</a></div>
                            <div class="panel-body">
                                
  									<div class="group">
    									<label for="text">Фактический адрес</label> 
    									<p><?=$realaddress;?></p>
  									</div>
  									<div class="group">
    									<label for="text">Телефон</label> 
    									<p><?=$telephone;?></p>
  									</div>
  									<div class="group">
    									<label for="text">Skype</label> 
    									<p><?=$skype;?></p>
  									</div>
  									<hr>
  									<div class="group">
    									<label for="text">Паспортные данные</label> 
    									<p><b>Серия, номер:</b> <?=$passport_number;?></p>
    									<p><b>Выдан:</b> <?=$passport_issued;?></p>
    									<p><b>Прописка:</b> <?=$passport_address;?></p>
  									</div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Данные</div>
                            <div class="panel-body">
                                
  									<div class="group">
    									<label for="text">Работа</label> 
    									<p><?=$work;?></p>
  									</div>
  									<div class="group">
    									<label for="text">Состояние</label> 
    									<p><?=$job;?></p>
  									</div>
  									<div class="group">
    									<label for="text">Предмет</label> 
    									<p><?=$teacher;?></p>
  									</div>							
  									<div class="group">
    									<label for="text">Договор</label> 
    									<p><?=$kit;?>
  									</div>
  									
                            </div>
                        </div>
                    </div>
              </div>
              
              
              
              	<div class="row cm-fix-height <?=$visible_contract;?>">
             	 	<div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Оборудование</div>
                            <div class="panel-body">
                                
  									<? if(!empty($kit_contract)) echo $kit_contract;?>
  									
                            </div>
                        </div>
                    </div>
                 </div> 
                      
                 
                 <div class="row cm-fix-height">
             	 	<div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">История изменений (последние 20 действий)</div>
                            <div class="panel-body">
                                
  									<table class="table table-hover">
  									<tr><th>Дата события</th><th>Договор</th><th>Наименование</th><th>ИНВ.Номер</th><th>Примечание</th></tr>
  									<? foreach($history as $item) { ?>
  									<tr><td><?=$item['date'];?></td><td><?=$item['contract'];?></td><td><?=$item['device_name'];?></td><td><?=$item['device_inv'];?></td><td><?=$item['note'];?></td></tr>
  									<? } ?>
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
                        	<input type="date" name="date" min="<?=date("Y-m-d",time()-60*60*24*30); ?>" max="<?=date("Y-m-d",time()+60*60*24*3); ?>"/></center><hr>
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
            
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
        
        
        <div class="modal" id="take">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Изъятие комплекта</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Вы собираетесь изъять комплект оборудования по договору <b> <?=$contract;?> от <?=$contract_date;?></b> Не забыли ли вы распечатать акт-изъятия?! </p>
        </div>
        <div class="modal-footer">
          <a href="<?=base_url();?>teacher/view/<?=$coding_cancellation;?>/cancellation" class="btn btn-primary">Изъять</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        </div>
      </div>
    </div>
  </div>
        
        
        <div id="global">
            <div class="container-fluid">
             <? if(!empty($error)) echo $error; ?>
           <div class="row cm-fix-height">
                	<div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?=$surname;?> <?=$realname;?> <?=$middlename;?> </div>
                            <div class="panel-body">
                            	<form class="form" method="post" enctype="multipart/form-data">
                                <center><img src="<?=$photo;?>" width="500" height="500" class="img-responsive img-circle">
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
    									<p><?=$phone;?></p>
  									</div>
  									<div class="group">
    									<label for="text">Skype</label> 
    									<p><?=$skype_btn;?></p>
    									<? if(!empty($skype_icon)) echo $skype_icon; ?>
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
  									<tr><th>Дата события</th><th>Договор</th><th>Наименование</th><th>ИНВ.Номер</th><th>Примечание</th><th WIDTH=30 px></th></tr>
  									<? $x=1; foreach($history as $item) { ?>
  									<tr onmouseover="View_delete_icon('del_<?=$x;?>')" onmouseout="hide_delete_icon('del_<?=$x;?>')"><td><?=$item['date'];?></td><td><?=$item['contract'];?></td><td><?=$item['device_name'];?></td><td><?=$item['device_inv'];?></td><td><?=$item['note'];?></td><td><a href="<?=base_url();?>/teacher/view/<?=$id;?>/remove_one_story/<?=$item['id'];?>"><i id="del_<?=$x;?>" style="display: none;" class="fa fa-trash-o" aria-hidden="true"></i></a></td></tr>
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
                        	<div class="alert alert-info">В браузере Safari наблюдается проблема с отображением окна выбора даты, так что дата вводится с клавиатуры! Формат даты дд.мм.гггг (Пример: 01.12.2017).</div>
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
            
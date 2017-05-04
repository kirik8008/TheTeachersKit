
        <div id="global">
            <div class="container-fluid">
             <? if(!empty($error)) echo $error; ?>
           <div class="row cm-fix-height">
                	<div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?=$surname;?> <?=$realname;?> <?=$middlename;?></div>
                            <div class="panel-body">
                            	<form class="form" method="post" enctype="multipart/form-data">
                                <img src="<?=$photo;?>" class="img-responsive img-circle">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Персональные данные</div>
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
    									<p><?=$contract;?></p>
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
                                
  									тест
  									
                            </div>
                        </div>
                    </div>
                 </div> 
                      
                 
                 <div class="row cm-fix-height">
             	 	<div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">История изменений</div>
                            <div class="panel-body">
                                
  									<table class="table table-hover">
  									<tr><th>Дата события</th><th>Договор</th><th>Наименование</th><th>ИНВ.Номер</th><th>Примечание</th></tr>
  									<tr><td>31.05.2016</td><td>-</td><td>-</td><td>-</td><td>Учитель прекратил работу</td></tr>
  									<tr><td>30.05.2016</td><td>У-100-00</td><td>-</td><td>-</td><td>Комплект У-100-00 изъят!</td></tr>
  									<tr><td>26.05.2016</td><td>У-100-00</td><td>-</td><td>-</td><td>Создан акт изъятия</td></tr>
  									<tr><td>21.12.2015</td><td>У-100-00</td><td>Рабочее место педагогического работника</td><td>201212510124213</td><td>Выдан взамен 201212510124000</td></tr>
  									<tr><td>21.12.2015</td><td>У-100-00</td><td>Рабочее место педагогического работника</td><td>201212510124000</td><td>Замена на 201212510124213</td></tr>
  									<tr><td>03.09.2015</td><td>У-100-00</td><td>-</td><td>-</td><td>Выдан комплект У-100-00</td></tr>
  									<tr><td>02.09.2015</td><td>-</td><td>-</td><td>-</td><td>Принят как Совместитель</td></tr>
  									<tr><td>02.09.2015</td><td>-</td><td>-</td><td>-</td><td>Пользователь создан</td></tr>
  									</table>
  									
                            </div>
                        </div>
                    </div>
                 </div> 
              
  
        </div>
            
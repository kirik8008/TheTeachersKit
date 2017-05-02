
        <div id="global">
            <div class="container-fluid">
             <? if(!empty($error)) echo $error; ?>
             <div class="row cm-fix-height">
                	<div class="col-sm-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">Фото</div>
                            <div class="panel-body">
                            	<form class="form" method="post" enctype="multipart/form-data">
                                <img src="<?=base_url();?>graphics/photo/nofoto.png" class="img-responsive img-circle">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-9">
                        <div class="panel panel-default">
                            <div class="panel-heading">ФИО и Номер телефона</div>
                            <div class="panel-body">
                                
  									<div class="form-group">
    									<input type="text" class="form-control" name="surname" id="exampleInputEmail3" placeholder="Фамилия">
  									</div>
  									<div class="form-group">
    									<input type="text" class="form-control" name="realname" id="exampleInputPassword3" placeholder="Имя">
  									</div>
  									<div class="form-group">
    									<input type="text" class="form-control" name="middlename" id="exampleInputPassword3" placeholder="Отчество">
  									</div>
									<div class="form-group">
										<label for="text">Телефон:</label>
    									<input type="text" class="form-control" name="telephone" id="exampleInputPassword3" placeholder="+7 000 000-00-00">
  									</div>
  									<!--<div class="form-group">
  										<label for="text">Фото</label>
  										<input type="file" name="userfile" size="10" />
  									</div> -->
  									<!--<div class="form-group">
    									<label for="inputDate">Дата рождения:</label>
   										<input type="date" class="form-control">
  									</div> -->
  									
                            </div>
                        </div>
                    </div>
              </div>
                          
              
              <div class="row cm-fix-height">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Персональные данные</div>
                            <div class="panel-body">
                            	<div class="form-group">
                            			<label for="text">Адрес фактического проживания (адрес нахождения оборудования):</label>
    									<textarea class="form-control" name="realaddress" rows="3"></textarea>
  								</div>
                                <div class="form-group">
    									<label for="text">Пол:</label>
   										 <select name="person" class="form-control">
   										 	<option value="2">Выбрать</option>
        									<option value="0">Женский</option>
        									<option value="1">Мужской</option>
      									</select>
  								</div>
  								
  								<div class="form-group">
    									<label for="text">Предмет:</label>
   										 <select name="teacher" class="form-control">
        									<option value="0">Выбрать</option>
        									<option value="Учитель Математики">Учитель Математики (Геометрия, алгебра)</option>
        									<option value="Учитель Русского языка и Литературы">Учитель Русского языка и Литературы</option>
        									<option value="Учитель Истории и(или) Общества">Учитель Истории и(или) Общества</option>
        									<option value="Учитель Информатики">Учитель Информатики</option>
        									<option value="Учитель Иностранных языков">Учитель Иностранных языков</option>
        									<option value="Учитель Физики">Учитель Физики</option>
        									<option value="Учитель Химии">Учитель Химии</option>
        									<option value="Учитель Биологии">Учитель Биологии</option>
        									<option value="Учитель Музыки и(или) МХК">Учитель Музыки и(или) Мировой художественной культуры</option>
        									<option value="Учитель Технологии">Учитель Технологии</option>
        									<option value="Учитель Географии">Учитель Географии</option>
        									<option value="Психолог">Психолог</option>
        									<option value="Логопед">Логопед</option>
        									<option value="Другое">Другое</option>
      									</select>
  								</div>
  								
  								<div class="form-group">
    									<label for="text">Преподователь:</label>
   										 <select name="work" class="form-control">
   										 	<option value="2">Выбрать</option>
        									<option value="1">Совместитель</option>
        									<option value="0">Постоянный</option>
      									</select>
  								</div>
  								
  								<div class="form-group">
    									<label for="text">Состояние:</label>
   										 <select name="job" class="form-control">
   										 	<option value="2">Выбрать</option>
        									<option value="1">Работает</option>
        									<option value="0">Не работает</option>
      									</select>
  								</div>
  								
  								<div class="form-group">
    									<label for="text">Фото:</label>
   										<input type="file" name="userfile" size="10" />
  								</div>
  								
  								
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Паспортные данные</div>
                            <div class="panel-body">
                            <label>Данные паспорта нужны для заполнения договора в автоматическом режиме, в противном случае в договор нужно будет вписать ручкой. </label>
                                	<div class="form-group">
    									<label for="text">Серия:</label>
   										<input type="text" class="form-control" name="passport_serial" id="exampleInputPassword3" placeholder="Вида: 1234">
  									</div>
  									<div class="form-group">
    									<label for="text">Номер:</label>
   										<input type="text" class="form-control" name="passport_number" id="exampleInputPassword3" placeholder="Вида: 123456">
  									</div>
  									<div class="form-group">
                            			<label for="text">Выдан:</label>
    									<textarea class="form-control" name="passport_issued" rows="3"></textarea>
  									</div>
  									<div class="form-group">
                            			<label for="text">Прописка:</label>
    									<textarea class="form-control" name="passport_address" rows="3"></textarea>
  									</div>
  							<h6>Паспортные данные хранятся в базе в закодированном виде!</h6>
                             </div>
                        </div>
                    </div>
                </div>  
              <input name="Submit" type=submit class="btn btn-primary" value="Отправить данные"> 
  								</form>
              
  
        </div>
            
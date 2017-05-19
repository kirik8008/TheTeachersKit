
        <div id="global">
            <div class="container-fluid">
             <? if(!empty($error)) echo $error; ?>
             <div class="row cm-fix-height">
                	<div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Информация об оборудовании</div>
                            <div class="panel-body">
                            <form class="form" method="post" enctype="multipart/form-data">
                            	<div class="form-group">
    									<input type="text" class="form-control" name="name"  maxlength="400" placeholder="Точное название оборудования">
  								</div>
  								<div class="form-group">
    									<input type="text" class="form-control" name="price" placeholder="Цена">
  								</div>
  								<div class="form-group">
  								<label for="text">Поставка:</label>
    									<input type="text" class="form-control" name="purchasing" placeholder="Год поставки">
  										<p class="help-block">Генерация номера договора. Заполнять данное поле не обязательно, ЕСЛИ оборудование не находится в первой категории.</p>
  								</div>
  								<div class="form-group">
    									<label for="text">Категория:</label>
   										 <select name="category" class="form-control">
        									<option value="0">Выбрать</option>
        									<? foreach($category as $item): ?>
        									<option value="<?=$item['id'];?>">(<?=$item['location'];?>) <?=$item['name'];?></option>	
        									<? endforeach; ?>
      									</select>
  								</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Колличество и другие данные</div>
                            <div class="panel-body">
                                	<div class="form-group">
    									<label><input type="radio" name="optionsRadios" value="1" checked>
    									Записать введенные ИНВ.номера
    									</label>
  									</div>
  									<div class="form-group">
    									<input type="text" class="form-control " name="inv_start" placeholder="Начальный ИНВ.номер">
  									</div>
  									<div class="form-group">
    									<input type="text" class="form-control" name="inv_finish" placeholder="Конечный ИНВ.номер">
  									</div>
  									<hr>
									<div class="form-group">
										<label><input type="radio" name="optionsRadios" value="0">
    									Записать только то колличество оборудования которое указали вы ниже в строке.
    									</label>
  									</div>
  									<div class="form-group">
    									<input type="text" class="form-control " name="inv_count" placeholder="Колличество оборудования">
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
                          
              
                
              <input name="Submit" type=submit class="btn btn-primary" value="Добавить оборудование"> 
  								</form>
              
  
        </div>
            
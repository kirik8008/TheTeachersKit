
        <div id="global">
            <div class="container-fluid">
                <? if(!empty($error)) echo $error; ?>
                 <div class="row cm-fix-height">
                	<div class="col-sm-7">
                        <div class="panel panel-default">
                            <div class="panel-heading">Новая категория</div>
                            <div class="panel-body">
                               <form class="form" method="post">
                               <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
  									<div class="form-group">
  									<label for="text">Названии категории оборудования:</label>
    									<input type="text" class="form-control" name="name" placeholder="Колонки">
  									</div>
  									<div class="form-group">
  									<label for="text">Положение категории, порядковый номер:</label>
    									<input type="text" class="form-control" name="id" placeholder="3">
  									</div>
  									<h5>В случае, если категория с таким же порядковым номером есть, существующий порядковый номер изменится и опустится вниз. 
  									<blockquote>
  									<b>Например:</b><br> Вы создаете новую категорию "Принтер" с порядковым номером 3, но в базе под номером 3 уже есть "Сканер". 
  									В этом случае "Принтер" будет под номером 3, а "Сканер" уже под номером 4 и соответственно все ниже этого оборудования изменят значение на 1 </h5>
  									</blockquote>
  									<input name="Submit" type=submit class="btn btn-primary" value="Отправить данные">  
  								</form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">Положение в договоре</div>
                            <div class="panel-body">
                            	<h6>Положение в договоре вида, Ноутбук, Сканер, Колонки, Принтер, Сетевой фильтр и т. п.</h6>
                                <img src="<?=base_url();?>graphics/img/gif/category_new.gif" class="img-responsive">	
                            </div>
                        </div>
                    </div>
              </div>
            </div>
            
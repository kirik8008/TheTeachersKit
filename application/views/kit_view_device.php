
        <div id="global">
            <div class="container-fluid">
            <? if(!empty($error)) echo $error; ?>
                <div class="row cm-fix-height">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Оборудование по договору <?=$contract;?></div>
                    <div class="panel-body">
                      <p><a href="<?=base_url();?>kit/all" class="btn btn-default btn-sm">Назад</a></p>
                      	<table class="table">
                      	<tr><th>#</th><th WIDTH="40%">Наименование</th><th>Инвентарный номер</th><th>Заводской номер</th><th>Сумма</th><th></th></tr>
                      	<? $x=0; $price=0; foreach($kit as $device) { $x++;  ?>
                      		<tr><td><?=$x;?></td><td><?=$device['name'];?></td><td><?=$device['inv'];?></td><td><?=$device['ser'];?></td><td><?=$device['price'];?> руб.</td></tr>
                      	<? $price+=$device['price']; } ?>
                      		<tr><td colspan=4>ИТОГО</td><td colspan=2><?=$price;?> руб.</td></tr>
                      	</table>
                      	
                    </div>
                </div>
            </div>
            
         
            
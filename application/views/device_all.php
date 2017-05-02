
        <div id="global">
            <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">Всё оборудование</div>
                    	<div class="panel-body" id="demo-buttons">
                        	<table class="table table-hover">
                        		<tr><th>Название</th><th>Инв.номер</th><th>Серийный.номер</th><th>Цена</th><th>Состояние</th><th>Нахождение</th><th>Договор №</th></tr>
                        		<? if ($result_count==0) {?>
                        		<tr><td COLSPAN=7><center>В базе нет категорий!</center></td></tr>
                        		
                        		<? } else {?>
                        		<? foreach($device as $item): ?>
                        		<tr><td><?=$item['name'];?></td><td><?=$item['inv'];?></td><td><?=$item['ser'];?></td><td><?=$item['price'];?></td><td><?=$item['work'];?></td><td><?=$item['location'];?></td><td><?=$item['contract'];?></td></tr>
                        		<? endforeach; 
                        		?>
                        		<? } ?>
                        	</table>
                        	<? echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
           
            
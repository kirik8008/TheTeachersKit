
        <div id="global">
            <div class="container-fluid">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Все комплекты</div>
                    	<div class="panel-body" id="demo-buttons">
                        	<table class="table table-hover">
                        		<tr><th WIDTH=10%>Договор</th><th>Владелец</th><th>Расположение</th><th>Кол. оборудования</th><th>Общая стоимость</th><th>Функции</th></tr>
                        		<? if ($result_count==0) {?>
                        		<tr><td COLSPAN=7><center>В базе нет комплектов!</center></td></tr>
                        		
                        		<? } else {?>
                        		<? foreach($kit as $item): ?>
                        		<tr><td><?=$item['contract'];?></td><td><?=$item['education_id'];?></td><td><?=$item['location'];?></td><td><?=$item['count'];?></td><td><?=$item['price'];?> руб.</td><td><? if(!empty($item['function'])) echo $item['function'];?></td></tr>
                        		<? endforeach; ?>
                        		<? } ?>
                        	</table>
                        	<? echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            
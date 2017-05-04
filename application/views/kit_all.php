
        <div id="global">
            <div class="container-fluid">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Все комплекты</div>
                    	<div class="panel-body" id="demo-buttons">
                        	<table class="table table-hover">
                        		<tr><th>Договор</th><th>Владелец</th><th>Расположение</th><th>Кол. оборудования</th><th>Общая стоимость</th><th></th></tr>
                        		<? if ($result_count==0) {?>
                        		<tr><td COLSPAN=7><center>В базе нет комплектов!</center></td></tr>
                        		
                        		<? } else {?>
                        		<? foreach($kit as $item): ?>
                        		<tr><td><?=$item['contract'];?></td><td><?=$item['education_id'];?></td><td><?=$item['location'];?></td><td><?=$item['count'];?></td><td><?=$item['price'];?></td><td></td><td></td></tr>
                        		<? endforeach; ?>
                        		<? } ?>
                        	</table>
                        </div>
                    </div>
                </div>
            </div>
            
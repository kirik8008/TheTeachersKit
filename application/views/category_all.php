
        <div id="global">
            <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">Категории оборудования</div>
                    	<div class="panel-body" id="demo-buttons">
                        	<table class="table table-hover">
                        		<tr><th>Название категории</th><th>Положение в договоре</th><th></th></tr>
                        		<? if ($result_count==0) {?>
                        		<tr><td COLSPAN=3><center>В базе нет категорий!</center></td></tr>
                        		
                        		<? } else {?>
                        		<? foreach($category as $item): ?>
                        		<tr><td><?=$item['name'];?></td><td><?=$item['location'];?></td><td><a href="all/delete/<?=$item['id'];?>">Удалить</a></td></tr>
                        		<? endforeach; ?>
                        		<? } ?>
                        	</table>
                        </div>
                    </div>
                </div>
            </div>
            
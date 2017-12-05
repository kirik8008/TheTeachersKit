
        <div id="global">
            <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">Всё оборудование</div>
                    	<div class="panel-body" id="demo-buttons">
                    		<? if(!empty($error)) echo $error; ?>
                        	<table class="table table-hover">
                        		<tr><th>Название</th><th>Нач.инв.номер</th><th>Последний.инв.номер</th><th>Цена за ед.</th><th>Количество</th></tr>
                        		<? if ($result_count==0) {?>
                        		<tr><td COLSPAN=7><center>В базе нет категорий!</center></td></tr>
                        		
                        		<? } else {?>
                        		<? foreach($device as $item): ?>
                        		<tr><td><a href="<?=base_url();?>device/view_device/<?=$item['low_key'];?>"><?=$item['name'];?></a></td><td><?=$item['inv_start'];?></td><td><?=$item['inv_end'];?></td><td><?=$item['price'];?></td><td><?=$item['count_device'];?></td></tr>
                        		<? endforeach; 
                        		?>
                        		<? } ?>
                        	</table>
                        	<? echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
           
            
<div id="global">
            <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">Оборудование</div>
                    	<div class="panel-body" id="demo-buttons">
                    	<? if(!empty($error)) echo $error; ?>
                    	<p><a href="<?=base_url();?>device/all" class="btn btn-default btn-sm">Назад</a>
                    	<? if ($result_count!=0) $text=$device[0]['name']; else $text='';?>
                    	<a href="<?=base_url();?>device/clean_device/<?=$types;?>" class="btn btn-default btn-sm pull-right" onClick="return window.confirm('Внимание, вы собираетесь удалить оборудование <<<?=$text;?>>> безвозвратно! Вы точно решили удалять данное оборудование ?');">Удалить оборудование</a></p>
                        	<table class="table table-hover">
                        		<tr><th>Название</th><th>Инв.номер</th><th>Серийный.номер</th><th>Цена</th><th>Состояние</th><th>Нахождение</th><th>Договор №</th></tr>
                        		<? if ($result_count==0) {?>
                        		<tr><td COLSPAN=7><center>Указана неверная категория, либо оборудования в указанной категории нет!</center></td></tr>
                        		
                        		<? } else {?>
                        		<? foreach($device as $item): ?>
                        		<tr><td><?=$item['name'];?></td><td><?=$item['inv'];?></td><td><?=$item['ser'];?></td><td><?=$item['price'];?></td><td><? if($item['work']==1) echo '<span class="label label-success">Рабочее</span>'; else echo '<span class="label label-danger">Сломано</span>'; ?></td><td><?=$item['location'];?></td><td><? if($item['contract']!='0') echo '<a href="'.base_url().'teacher/view/'.$item['education_id'].'" class="tooltip-test" data-toggle="tooltip" data-placement="top" title="Показать преподователя с данным договором">'.$item['contract'].'</a>'; else echo '-';?></td></tr>
                        		<? endforeach; 
                        		?>
                        		<? } ?>
                        	</table>
                        	<? echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
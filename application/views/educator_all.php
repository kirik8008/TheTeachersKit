
        <div id="global">
            <div class="container-fluid">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Все преподователи</div>
                    	<div class="panel-body" id="demo-buttons">
                        	<table class="table table-hover">
                        		<tr><th></th><th>ФИО</th><th>Предмет</th><th>Работа</th><th>Состояние</th><th>Договор</th><th></th></tr>
                        		<? if ($result_count==0) {?>
                        		<tr><td COLSPAN=7><center>В базе нет учителей!</center></td></tr>
                        		
                        		<? } else {?>
                        		<? foreach($teacher as $item): ?>
                        		<tr><td><img src="<?=$item['photo'];?>" width="32" height="32" class="img-circle"></td><td><?=$item['surname'];?> <?=$item['realname'];?> <?=$item['middlename'];?></td><td><img class="tooltip-test" data-toggle="tooltip" data-placement="top" title="<?=$item['teacher'];?>" src="<?=base_url();?>graphics/object/<?=$item['teacher_icon'];?>.png" width="30" height="30" ></td><td><img src="<?=$item['work'];?>" height="24" width="24"></td><td><?=$item['job'];?></td><td><? if($item['contract']!='0') echo $item['contract'].' (от '.$item['contract_date'].')'; else echo 'Договора нет';?></td><td><a href="<?=base_url();?>teacher/view/<?=$item['id'];?>" class="tooltip-test" data-toggle="tooltip" data-placement="top" title="Показать данные <?=$item['surname'];?> <?=$item['realname'];?>"><img src="<?=base_url();?>graphics/img/sf/user-id.svg" height="24" width="24"></a></td></tr>
                        		<? endforeach; ?>
                        		<? } ?>
                        	</table>
                        	<? echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            
            
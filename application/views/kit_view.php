
        <div id="global">
            <div class="container-fluid">
            <? if(!empty($error)) echo $error; ?>
                <div class="row cm-fix-height">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Оборудование находящийся у преподователя <a href="<?=base_url();?>teacher/view/<?=$teacher['id'];?>"><?=$teacher['surname']?> <?=$teacher['realname']?> <?=$teacher['middlename']?></a></div>
                    <div class="panel-body">
                      
                      	<table class="table">
                      	<tr><th>#</th><th WIDTH="40%">Наименование</th><th>Инвентарный номер</th><th>Заводской номер</th><th>Сумма</th><th></th></tr>
                      	<? $x=0; $price=0; foreach($teacher_kit as $device) { $x++;  ?>
                      		<tr><td><?=$x;?></td><td><?=$device['name'];?></td><td><?=$device['inv'];?></td><td><?=$device['ser'];?></td><td><?=$device['price'];?> руб.</td><td>
							<a href="<?=base_url();?>kit/view/<?=$teacher['coding_contract'];?>/<?=$teacher['coding_id'];?>/REPAIR_<?=$device['id_device'];?>" class="tooltip-test pull-right btn-xs btn btn-default" data-toggle="tooltip" data-placement="top" title="Оборудование на ремонт"><img src="<?=base_url();?>graphics/img/sf/trashcan-full.svg" height="24" width="24"></a>
                      		<a href="<?=base_url();?>kit/view/<?=$teacher['coding_contract'];?>/<?=$teacher['coding_id'];?>/CONFISCATE_<?=$device['id_device'];?>" class="tooltip-test pull-right btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Изъять на склад"><img src="<?=base_url();?>graphics/img/sf/safe.svg" height="24" width="24"></a> 
                      		</td></tr>
                      	<? $price+=$device['price']; } ?>
                      		<tr><td colspan=4>ИТОГО</td><td colspan=2><?=$price;?> руб.</td></tr>
                      	</table>
                      	
                    </div>
                </div>
            </div>
            
         <? if (count($storage)!=0) {?> 
            <div class="row cm-fix-height">
                <div class="panel panel-default">
                    <div class="panel-heading">Оборудование находящийся на складе</div>
                    <div class="panel-body">
                      <p>В данной таблице указано оборудование, которое указано в договоре, но находится на складе. Возможно оно ожидает ремонта.</p>
                      	<table class="table">
                      	<tr><th>Акт</th><th>Наименование</th><th>Инвентарный номер</th><th>Заводской номер</th><th>Сумма</th><th></th></tr>
                      	<? $x=0; $price=0; foreach($storage as $device_storage) { $x++;  ?>
                      		<tr><td><? if($device_storage['work']!=1) { ?>
                      		<a href="<?=base_url();?>device/act_faulty/<?=$device_storage['id'];?>/<?=$teacher['coding_id'];?>" target="_blank"><img src="<?=base_url();?>graphics/img/sf/window-layout.svg" class="tooltip-test pull-right" data-toggle="tooltip" data-placement="top" title="Посмотреть акт неисправного оборудования" height="24" width="24"></a>
                      		<? } ?>
                      		</td><td> <? if($device_storage['work']!=1) echo '<span class="label label-danger">Ремонт</span>'; ?> <?=$device_storage['name'];?></td><td><?=$device_storage['inv'];?></td><td><?=$device['ser'];?></td><td><?=$device_storage['price'];?> руб.</td>
                      		<td>
                      		<? if($device_storage['work']!=1) { ?>
                      		<a href="<?=base_url();?>kit/view/<?=$teacher['coding_contract'];?>/<?=$teacher['coding_id'];?>/REFURBISHED_<?=$device_storage['id'];?>" class="tooltip-test pull-right btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Выдать обратно ОТРЕМОНТИРОВАННОЕ"><img src="<?=base_url();?>graphics/img/sf/thumb-up.svg" height="24" width="24"></a>
                      		<? } else {?>
                      		<a href="<?=base_url();?>kit/view/<?=$teacher['coding_contract'];?>/<?=$teacher['coding_id'];?>/PASS_<?=$device_storage['id'];?>" class="tooltip-test pull-right btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Передать преподователю оборудование"><img src="<?=base_url();?>graphics/img/sf/box-out.svg" height="24" width="24"></a>
                      		<? }?>
                      		</td>
                      		</tr>
                      	<? $price+=$device_storage['price']; } ?>
                      		<tr><td colspan=4>ИТОГО</td><td><?=$price;?> руб.</td></tr>
                      	</table>
                      	
                    </div>
                </div>
            </div> <? } ?>
            
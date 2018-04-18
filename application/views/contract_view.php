
        <div id="global">
            <div class="container-fluid cm-container-white">
                  <h2 style="margin-top:0;">Краткая информация по договорам</h2> 
             <table class="table table-hover" WIDTH="">
             <tr><td><a href="<?=base_url();?>contract/permanent/">Постоянные преподователи с оборудованием</a></td><td><span class="badge"><?=$pte;?></span> человек</td></tr>
             <tr><td><a href="<?=base_url();?>contract/temporary/">Временные преподователи с оборудованием</a></td><td><span class="badge"><?=$tte; ?></span> человек</td></tr>
             <tr><td>
             	<? if(!empty($tec_info)) {
             		?>
             		<div class="panel-group" id="accordion">
             		<div>
    					<div>
								<a data-toggle="collapse" data-parent="#accordion" href="#TTE">
          						Показать договора подлежащие перезаключению или изъятию оборудования
        						</a>
    					</div>
    					<div id="TTE" class="panel-collapse collapse">
      						<div class="panel-body">
      							<table class="table table-hover">
             					<? foreach($tec_info as $tc): ?>
             					<tr><td><small><?=$tc['surname'];?> <?=$tc['realname'];?> <?=$tc['middlename'];?> <? if(!empty($tc['telephone'])) echo '(т.'.$tc['telephone'].')'; ?></small></td><td><span class="label label-danger">Истек срок действия договора</span> <small>№ <?=$tc['contract'];?> (от <?=$tc['contract_date'];?>).</small>
             					<td><a href="<?=base_url();?>teacher/view/<?=$tc['id'];?>" class="tooltip-test" data-toggle="tooltip" data-placement="top" title="Показать данные"><img src="<?=base_url();?>graphics/img/sf/user-id.svg" height="24" width="24"></a></td>
             					</td></tr> <? endforeach; ?></table>
        			     	</div>
    					</div>
 					</div>
					</div>
             		<?
             	 } else echo 'Договора подлежащие перезаключению или изъятию оборудования '; ?>
             	</td><td><span class="badge"><?=$tec;?></span> человек</td></tr>

               </table>
               </div>
            <div class="container-fluid">
            	<div class="panel panel-default">
                    <div class="panel-heading">Преподаватели с заключенными договорами<sup><small>*</small></sup> </div>
                    	<div class="panel-body" id="demo-buttons">
                        	<table class="table table-hover">
                        		<tr><th></th><th>Преподаватель</th><th>Договор</th><th></th></tr>
                        		<? if (empty($contract)) {?>
                        		<tr><td COLSPAN=7><center>В базе нет учителей!</center></td></tr>
                        		
                        		<? } else {?>
                        		<? foreach($contract as $item): ?>
                        		<? if($item['work_source']==0) echo '<tr>'; else echo '<tr class="info">'; ?><td><img src="<?=$item['photo'];?>" width="32" height="32" class="img-circle"></td><td><?=$item['surname'];?> <?=$item['realname'];?> <?=$item['middlename'];?></td><td><? if($item['contract']!='0') echo '<b>'.$item['contract'].'</b> (от '.$item['contract_date']; else echo 'Договора нет';?> <? if($item['work_source']=='1') echo 'сроком до 31 мая.)'; else echo 'бессрочный)';?></td><td><a href="<?=base_url();?>teacher/view/<?=$item['id'];?>" class="tooltip-test" data-toggle="tooltip" data-placement="top" title="Показать данные <?=$item['surname'];?> <?=$item['realname'];?>"><img src="<?=base_url();?>graphics/img/sf/user-id.svg" height="24" width="24"></a></td></tr>
                        		<? endforeach; ?>
                        		<? } ?>
                        	</table>
                        	<? echo $this->pagination->create_links(); ?>
                        	 <br><sup><small>*</small></sup> - Договора собранные скриптом на момент выдачи оборудования преподователю через T.T.K (The Teacher's Kit)

                        </div>
                        </div>
               
                
                 
            </div>
            
            
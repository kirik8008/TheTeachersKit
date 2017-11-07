
        <div id="global">
            <div class="container-fluid">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Резервное копирование</div>
                    	<div class="panel-body" id="demo-buttons">
                    	<div><a class="btn btn-default" href="<?=base_url()?>administrator/backup/create">Сделать бекап</a>
                    	<a class="btn btn-default" href="<?=base_url()?>administrator/backup/create/save">Сделать бекап и сохранить на компьютере</a></div>
                    	<div class="alert alert-info">Резервное копирование рекомендуется делать всегда, когда есть изменения в базе данных. В случае сбоя в работе MySQL созданные бекапы (резервные копии) помогут быстро восстановить данные!</div>
                        	<table class="table table-hover">
                        		<tr><th>Файл бекапа</th><th>Дата создания</th></tr>
                        		<? if ($count_backup==0) {?>
                        		<tr><td COLSPAN=7><center>Файлов бекапа нет на сервере</center></td></tr>
                        		
                        		<? } else {?>
                        		<? foreach($backup as $item): ?>
                        		<tr><td><?=$item['name'];?></td><td><?=$item['date'];?></td></tr>
                        		<? endforeach; ?>
                        		<? } ?>
                        	</table>
                        	<sup><small>*</small></sup> Создание backup ограничено 10 файлами. В случае создании нового (больше 10), удаляются более старые версии backup.
                        </div>
                    </div>
                </div>
    
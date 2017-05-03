
        <div id="global">
            <div class="container-fluid">
                <div class="row cm-fix-height">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Сборка комплекта</div>
                    <div class="panel-body">
                        
                       <script src="<?=base_url();?>graphics/js/lib/jquery-2.1.3.min.js"></script>
                        <script type="text/javascript">
	(function () {"use strict";
jQuery(function () {
		<? foreach($category as $item): ?>
		$( '#<?=$item['low_key']; ?>' ).change(function () {
			$( '#sel<?=$item['low_key']; ?>' ).find( 'option:not(:first)' )	// Ищем все теги option, не являющиеся тегом по умолчанию
				.remove()
				.end()		// Возвращаемся к исходному объекту
				.prop( 'disabled',true );		// Делаем поля неактивными
			var type_id = $( this ).val();
			if (type_id == 0) { return; }
			$.ajax({
				type: "POST",	// Тип запроса
				url: "http://10.0.0.227/teacher/kit/jpost/",	// Путь к сценарию, обработающему запрос
				dataType: "json",	// Тип данных, в которых сервер должен прислать ответ
				data: "query=getKinds&type_id=" + type_id,	// Строка POST-запроса
				error: function () {	// Обработчик, который будет запущен в случае неудачного запроса
					alert( "При выполнении запроса произошла ошибка :(" );	// Сообщение о неудачном запросе
				},
				success: function ( data ) { // Обработчик, который будет запущен после успешного запроса
					for ( var i = 0; i < data.length; i++ ) {
						$( '#sel<?=$item['low_key']; ?>' ).append( '<option value="' + data[i].kind_id + '">' + data[i].kind + '</option>' );
					}
					$( '#sel<?=$item['low_key']; ?>' ).prop( 'disabled', false );	// Включаем поле
				}
			});
		});
		<? endforeach; ?>
	}); 
})();
	</script>


	<!-- Форма для динамических списков -->
	<form action="" method="post" id="dynamic_selects">
	<table class="table">
	<tr><th>Наименование</th><th>Инвентарный номер</th><th>Заводской номер</th><th>Стоимость</th></tr>
		<!-- Создаем заголовок для списка выбора типов транспорта -->
		<!-- Поле формы помещаем в контейнер с классом row -->
		<? foreach($category as $item): ?>
			<tr>
			<td><select class="form-control" id="<?=$item['low_key'];?>">
				<!-- В список сразу внесем значение по умолчанию, а также
					несколько значений видов транспорта. Предположим, что они
					нам известны заранее, и хранятся, допустим, в базе данных -->
				<option value="0">Выберите <?=$item['name'];?></option>
				<? foreach($device[$item['id']] as $dev): ?>
				<option value="<?=$dev['id'];?>"><?=$dev['name'];?> (<?=$dev['price'];?> руб.)</option>
				<? endforeach; ?>
			</select></td><td>
				<select class="form-control" id="sel<?=$item['low_key'];?>" disabled>
				<option value="0">Выберите из списка</option>
				</select></td><td><input type="text" class="form-control" placeholder="Серийный номер"></td><td><input type="text" class="form-control" id="summa<?=$item['low_key'];?>" value="0"></td></tr>
		
		
        	
        <? endforeach; ?>
		</table>
	</form>

                        
                        
                        
                        
                    </div>
                </div>
            </div>
            
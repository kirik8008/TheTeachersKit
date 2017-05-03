
                            
                            
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
				url: "http://10.0.0.227/teacher/device/test/",	// Путь к сценарию, обработающему запрос
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
		<!-- Создаем заголовок для списка выбора типов транспорта -->
		<!-- Поле формы помещаем в контейнер с классом row -->
		<? foreach($category as $item): ?>
		<div class="row">
			<!-- Создаем поле со списком -->
			<select id="<?=$item['low_key'];?>">
				<!-- В список сразу внесем значение по умолчанию, а также
					несколько значений видов транспорта. Предположим, что они
					нам известны заранее, и хранятся, допустим, в базе данных -->
				<option value="0">Выберите <?=$item['name'];?></option>
				<? foreach($device[$item['id']] as $dev): ?>
				<option value="<?=$dev['id'];?>"><?=$dev['name'];?> (<?=$dev['price'];?> руб.)</option>
				<? endforeach; ?>
			</select>
				<select id="sel<?=$item['low_key'];?>" disabled>
				<option value="0">Выберите из списка</option>
				<option value="1">www</option>
				<option value="2">sss</option>
				</select>
		</div>
		
		
        	
        <? endforeach; ?>
		
	</form>

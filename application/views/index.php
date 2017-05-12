
        <div id="global">
            <div class="container-fluid cm-container-white">
                <h2 style="margin-top:0;">The Teacher's Kit</h2> 
                  <div class="alert alert-danger"><center>На стадии разработки!</center></div>
                <p>УчительскийКомплект - CMS для контроля выдачи оборудования учителям. </p>
               <div class="alert alert-info"><center>Исходный код находится на <a href="https://github.com/kirik8008/TheTeachersKit" target="_blank">GitHub</a></center>
               <hr>
               <center><b>Установка</b></center>
               <ul>
              <li>В корневой папке проекта лежит файл бэкап таблиц проекта TheTeachersKit.sql его загружаем в mysql.</li>
              <li>Рядом лежит users.sql его тоже загружаем в mysql.</li>
              <li>Далее редактируем файл  ../application/config/<b>database.php</b> прописываем свои настройки в $db['default'] таблицу куда был загружен первый бэкап. </li>
              <li>В $db['users'] прописываем таблицу для авторизации, от бэкапа users.sql</li>
              <li>Редактируем <b>.htaccess</b> изменив вторую строку (RewriteBase /teacher/) под себя (т.е указать категорию в которой лежит CMS)</li>
              <li>Открываем файл ../application/config/<b>config.php</b> ищем 26 строку ($config['base_url']) меняем на свои значения. </li>
              <li>Открываем CMS вы должны попасть на страницу авторизации в поле логин вводим <b>Admin</b> пароль: <b>demo</b></li>
  				</ul>
               </div>
                </div>
            <div class="container-fluid">
               
                </div>
            </div>
            
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
       	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url();?>graphics/favicon.ico" />
      	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/bootstrap-clearmin.min.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/roboto.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/material-design.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/small-n-flat.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/c3.min.css">
        <title>УчительскийКомплекст</title>

    <script type="text/javascript">
            function AjaxFormRequest(result_id,form_id,url) {
                jQuery.ajax({
                    url:     url, //Адрес подгружаемой страницы
                    type:     "POST", //Тип запроса
                    dataType: "html", //Тип данных
                    data: jQuery("#"+form_id).serialize(),
                    success: function(response) { //Если все нормально
                    document.getElementById(result_id).innerHTML = response;
                },
                error: function(response) { //Если ошибка
                document.getElementById(result_id).innerHTML = "Ошибка при отправке формы";
                }
             });
        }

   </script>

    </head>
    <body class="cm-no-transition cm-1-navbar">
        <div id="cm-menu">
            <nav class="cm-navbar cm-navbar-primary">
                <div class="cm-flex"><a href="<?=base_url();?>" class="cm-logo"></a></div>
                <div class="btn btn-primary md-menu-white" data-toggle="cm-menu"></div>
            </nav>
            <div id="cm-menu-content">
                <div id="cm-menu-items-wrapper">
                    <div id="cm-menu-scroller">
                        <ul class="cm-menu-items">
                            <li class="active"><a href="<?=base_url();?>" class="sf-house">Главная</a></li>
                            <li class="cm-submenu">
                                <a class="sf-profile-group">Учителя <span class="caret"></span></a>
                                <ul>
                                    <li><a href="<?=base_url();?>teacher/news">Добавить нового</a></li>
                                    <li><a href="<?=base_url();?>teacher/all">Отобразить всех</a></li>
                                </ul>
                            </li>
                            <li><a href="<?=base_url();?>contract/view" class="sf-folder">Договоры</a></li>

                            <li class="cm-submenu">
                                <a class="sf-device-computer">Оборудование <span class="caret"></span></a>
                                <ul>
                                    <li><a href="<?=base_url();?>device/news">Добавить оборудование</a></li>
                                    <li><a href="<?=base_url();?>device/all">Показать все оборудование</a></li>
                                    <li><a href="<?=base_url();?>category/news">Добавить категорию</a></li>
                                    <li><a href="<?=base_url();?>category/all">Все категории</a></li>
                                </ul>
                            </li>

                             <li class="cm-submenu">
                                <a class="sf-layers">Комплекты <span class="caret"></span></a>
                                <ul>
                                    <li><a href="<?=base_url();?>kit/all">Показать комплекты</a></li>
                                    <li><a href="<?=base_url();?>kit/news">Собрать комплект</a></li>
                                </ul>
                            </li>

                            <? if($user['user_stat']==2 OR $user['user_stat']==3) {?>

                            	<li class="cm-submenu">
                                <a class="sf-cogs">Управление <span class="caret"></span></a>
                                <ul>
                                    <li><a href="<?=base_url();?>administrator/staff">Сотрудники</a></li>
                                    <li><a href="<?=base_url();?>administrator/backup">Резервное копирование</a></li>
                                </ul>
                            </li>

                            <? } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <header id="cm-header">
            <nav class="cm-navbar cm-navbar-primary">
                <div class="btn btn-primary md-menu-white hidden-md hidden-lg" data-toggle="cm-menu"></div>
                <div class="cm-flex">
                    <h1>Учительский Комплект</h1>
                    <form id="cm-search" action="" onkeyup="AjaxFormRequest('global', 'cm-search', '<?=base_url();?>info/test')" method="post">
                        <input type="search" name="search" id="search_teacher_info" autocomplete="off" placeholder="Поиск...">
                    </form>
                </div>
                <div class="pull-right">
                    <div id="cm-search-btn" class="btn btn-primary md-search-white" data-toggle="cm-search"></div>
                </div>
                <div class="dropdown pull-right">
                    <button class="btn btn-primary md-notifications-white" data-toggle="dropdown"> <span class="label label-danger">0</span> </button>
                    <div class="popover cm-popover bottom">
                        <div class="arrow"></div>
                        <div class="popover-content">
                            <div class="list-group">


                                <a href="#" class="list-group-item">
                                    <h4 class="list-group-item-heading">
                                        <i class="fa fa-fw fa-envelope"></i> The Ticher's KIT
                                    </h4>
                                    <p class="list-group-item-text">Уведомления недоступны.</p>
                                </a>

                            </div>
                            <div style="padding:10px"><a class="btn btn-success btn-block" href="<?=base_url();?>message">Показать все сообщения</a></div>
                        </div>
                    </div>
                </div>
                <div class="dropdown pull-right">
                    <button class="btn btn-primary md-account-circle-white" data-toggle="dropdown"></button>
                    <ul class="dropdown-menu">
                        <li class="disabled text-center">
                            <a style="cursor:default;"><strong><?=$user['users_surname'];?> <?=$user['users_name'];?></strong></a>
                        </li>
                        <li class="divider"></li>

                        <li>
                            <a href="<?=base_url();?>user/profile"><i class="fa fa-fw fa-user"></i> Профиль</a>
                        </li>
                        <!--
                        <li>
                            <a href="#"><i class="fa fa-fw fa-cog"></i> Настройки</a>
                        </li>
                        -->
                        <li>
                            <a href="<?=base_url();?>user/logout"><i class="fa fa-fw fa-sign-out"></i> Выход</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

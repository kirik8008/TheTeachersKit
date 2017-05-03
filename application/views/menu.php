<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/bootstrap-clearmin.min.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/roboto.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/material-design.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/small-n-flat.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>graphics/css/font-awesome.min.css">
        <title>УчительскийКомплекст</title>
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
                                <a class="sf-window-layout">Учителя <span class="caret"></span></a>
                                <ul>
                                    <li><a href="<?=base_url();?>teacher/news">Добавить нового</a></li>
                                    <li><a href="<?=base_url();?>teacher/all">Отобразить всех</a></li>
                                </ul>
                            </li>
                            <li class="cm-submenu">
                                <a class="sf-cat">Оборудование <span class="caret"></span></a>
                                <ul>
                                    <li><a href="<?=base_url();?>device/news">Добавить оборудование</a></li>
                                    <li><a href="<?=base_url();?>device/all">Показать все оборудование</a></li>
                                    <li><a href="<?=base_url();?>category/news">Добавить категорию</a></li>
                                    <li><a href="<?=base_url();?>category/all">Все категории</a></li>
                                </ul>
                            </li>
                             <li class="cm-submenu">
                                <a class="sf-cat">Комплекты <span class="caret"></span></a>
                                <ul>
                                    <li><a href="<?=base_url();?>kit/all">Показать комплекты</a></li>
                                    <li><a href="<?=base_url();?>kit/news">Собрать комплект</a></li>
                                </ul>
                            </li>
                            <li><a href="login.html" class="sf-lock-open">Login page</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <header id="cm-header">
            <nav class="cm-navbar cm-navbar-primary">
                <div class="btn btn-primary md-menu-white hidden-md hidden-lg" data-toggle="cm-menu"></div>
                <div class="cm-flex">
                    <h1>Home</h1> 
                    <form id="cm-search" action="index.html" method="get">
                        <input type="search" name="q" autocomplete="off" placeholder="Search...">
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
                                    <h4 class="list-group-item-heading text-overflow">
                                        <i class="fa fa-fw fa-envelope"></i> Nunc volutpat aliquet magna.
                                    </h4>
                                    <p class="list-group-item-text text-overflow">Pellentesque tincidunt mollis scelerisque. Praesent vel blandit quam.</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <h4 class="list-group-item-heading">
                                        <i class="fa fa-fw fa-envelope"></i> Aliquam orci lectus
                                    </h4>
                                    <p class="list-group-item-text">Donec quis arcu non risus sagittis</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <h4 class="list-group-item-heading">
                                        <i class="fa fa-fw fa-warning"></i> Holy guacamole !
                                    </h4>
                                    <p class="list-group-item-text">Best check yo self, you're not looking too good.</p>
                                </a>
                            </div>
                            <div style="padding:10px"><a class="btn btn-success btn-block" href="#">Show me more...</a></div>
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
                            <a href="#"><i class="fa fa-fw fa-user"></i> Профиль</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-cog"></i> Настройки</a>
                        </li>
                        <li>
                            <a href="<?=base_url();?>user/logout"><i class="fa fa-fw fa-sign-out"></i> Выход</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `users` (
  `users_id` int(11) UNSIGNED NOT NULL,
  `users_login` varchar(30) NOT NULL,
  `users_password` varchar(32) NOT NULL,
  `users_hash` varchar(32) NOT NULL,
  `users_name` text NOT NULL,
  `users_surname` text NOT NULL,
  `users_middle` text NOT NULL,
  `user_stat` int(2) NOT NULL,
  `users_history` int(2) NOT NULL,
  `users_hide` int(2) NOT NULL,
  `users_new` int(2) NOT NULL,
  `style_menu` int(2) NOT NULL,
  `style_font` int(2) NOT NULL DEFAULT '9',
  `telegram_reg` int(2) NOT NULL DEFAULT '0',
  `users_page` int(2) NOT NULL,
  `users_dateactive` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `users` (`users_id`, `users_login`, `users_password`, `users_hash`, `users_name`, `users_surname`, `users_middle`, `user_stat`, `users_history`, `users_hide`, `users_new`, `style_menu`, `style_font`, `telegram_reg`, `users_page`, `users_dateactive`) VALUES
(1, 'Admin', '6c5ac7b4d3bd3311f033f971196cfa75', '', 'Иван', 'Иванов', 'Иванович', 2, 1, 0, 1, 0, 9, 1, 1, '2017-05-12 16:40:30');

ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

ALTER TABLE `users`
  MODIFY `users_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

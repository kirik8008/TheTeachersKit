SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `device_all` (
  `id` int(6) NOT NULL,
  `contract` varchar(100) NOT NULL,
  `category` int(4) NOT NULL,
  `types` int(6) NOT NULL,
  `name` varchar(200) NOT NULL,
  `inv` varchar(50) NOT NULL,
  `ser` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `work` tinyint(1) NOT NULL,
  `education_id` int(4) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `device_category` (
  `id` int(4) NOT NULL,
  `name` varchar(200) NOT NULL,
  `location` int(2) NOT NULL,
  `display` tinyint(1) NOT NULL,
  `low_key` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `device_types` (
  `id` int(4) NOT NULL,
  `category` int(4) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `count_device` int(4) NOT NULL,
  `inv_view` tinyint(1) NOT NULL,
  `inv_start` varchar(50) NOT NULL,
  `inv_end` varchar(50) NOT NULL,
  `low_key` varchar(10) NOT NULL,
  `purchasing` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `educator` (
  `id` int(4) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `realname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `person` int(1) NOT NULL,
  `teacher` varchar(100) NOT NULL,
  `birthdate` datetime NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `skype` varchar(30) NOT NULL,
  `passport_address` varchar(400) NOT NULL,
  `passport_number` varchar(200) NOT NULL,
  `passport_issued` varchar(400) NOT NULL,
  `realaddress` varchar(200) NOT NULL,
  `work` tinyint(1) NOT NULL,
  `job` tinyint(1) NOT NULL,
  `contract` varchar(100) NOT NULL,
  `contract_date` date NOT NULL,
  `photo` varchar(100) NOT NULL,
  `photo_skype` int(1) NOT NULL DEFAULT '0',
  `low_key` varchar(10) NOT NULL,
  `update_profile` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `history` (
  `id` int(6) NOT NULL,
  `date` datetime NOT NULL,
  `author` int(4) NOT NULL,
  `contract` varchar(100) NOT NULL,
  `device_name` varchar(200) NOT NULL,
  `device_inv` varchar(50) NOT NULL,
  `device_ser` varchar(50) NOT NULL,
  `teacher` int(4) NOT NULL,
  `teacher_name` varchar(200) NOT NULL,
  `operation` int(3) NOT NULL,
  `note` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `device_all`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `device_category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `device_types`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `educator`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `device_all`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `device_category`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

ALTER TABLE `device_types`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `educator`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `history`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;


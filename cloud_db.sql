-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 05 2022 г., 16:29
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cloud_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id_users` int(11) NOT NULL,
  `admin_can_create_customer` tinyint(1) NOT NULL,
  `admin_can_edit_customer` tinyint(1) NOT NULL,
  `admin_can_create_device` tinyint(1) NOT NULL,
  `admin_can_edit_device` tinyint(1) NOT NULL,
  `admin_can_create_dev_type` tinyint(1) NOT NULL,
  `admin_can_edit_dev_type` tinyint(1) NOT NULL,
  `admin_can_create_payment` tinyint(1) NOT NULL,
  `admin_can_edit_payment` tinyint(1) NOT NULL,
  `admin_can_create_admin` tinyint(1) NOT NULL,
  `admin_can_edit_admin` tinyint(1) NOT NULL,
  `admin_mail` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `admin_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `connection_dev`
--

CREATE TABLE `connection_dev` (
  `id` int(11) NOT NULL,
  `con_id_dev` int(11) NOT NULL,
  `con_date` datetime NOT NULL,
  `con_result` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `connection_dev`
--

INSERT INTO `connection_dev` (`id`, `con_id_dev`, `con_date`, `con_result`) VALUES
(1, 1, '2006-03-22 22:27:00', 0),
(2, 1, '2006-03-22 22:27:05', 0),
(3, 1, '2006-03-22 22:27:10', 0),
(4, 1, '2006-03-22 22:27:15', 2),
(5, 1, '2006-03-22 22:27:20', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `contr_id_cust` int(11) NOT NULL,
  `contr_nomer` varchar(255) NOT NULL,
  `contr_date_st` datetime NOT NULL,
  `contr_date_exp` datetime NOT NULL,
  `contr_adres_set` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contracts`
--

INSERT INTO `contracts` (`id`, `contr_id_cust`, `contr_nomer`, `contr_date_st`, `contr_date_exp`, `contr_adres_set`) VALUES
(1, 1, '00001', '2001-01-00 00:00:00', '2001-01-02 00:00:00', 'Пржевальского 33а'),
(2, 1, '00002', '2001-01-10 00:00:00', '2001-01-22 00:00:00', 'Платова 2Б');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `cust_id_users` int(11) NOT NULL,
  `cust_balanse` bigint(20) NOT NULL,
  `cust_name_org` varchar(255) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `cust_inn_org` bigint(20) NOT NULL,
  `cust_phone` varchar(255) NOT NULL,
  `cust_flag_phone` tinyint(1) NOT NULL,
  `cust_mail` varchar(255) NOT NULL,
  `cust_flag_mail` tinyint(1) NOT NULL,
  `cust_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `cust_id_users`, `cust_balanse`, `cust_name_org`, `cust_name`, `cust_inn_org`, `cust_phone`, `cust_flag_phone`, `cust_mail`, `cust_flag_mail`, `cust_comment`) VALUES
(1, 2, 100000, 'OOO roga and kopiata', 'Беляков Сергей Юрьевич', 61640611230, '+79185552224455', 0, '0dlkfgjdlfk@dlkjf.com', 0, 'you are all ass holes');

-- --------------------------------------------------------

--
-- Структура таблицы `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `dev_id_cust` int(11) NOT NULL,
  `dev_id_contr` int(11) NOT NULL,
  `dev_id_type` int(11) NOT NULL,
  `dev_sernumber` int(11) NOT NULL,
  `dev_mac` varchar(255) NOT NULL,
  `dev_place` varchar(255) NOT NULL,
  `dev_cost` int(11) NOT NULL,
  `dev_date_st` datetime NOT NULL,
  `dev_period_hour` int(11) NOT NULL,
  `dev_date_exp` datetime NOT NULL,
  `dev_flag_block` tinyint(1) NOT NULL,
  `dev_p1_price` int(11) NOT NULL,
  `dev_p2_price` int(11) NOT NULL,
  `dev_p3_price` int(11) NOT NULL,
  `dev_p3_flag` tinyint(1) NOT NULL,
  `dev_p4_price` int(11) NOT NULL,
  `dev_p1_inhibit` tinyint(1) NOT NULL,
  `dev_o1_price` int(11) NOT NULL,
  `dev_o2_price` int(11) NOT NULL,
  `dev_o3_price` int(11) NOT NULL,
  `dev_n_pulses_to_o1` int(11) NOT NULL,
  `dev_n_pulses_to_o2` int(11) NOT NULL,
  `dev_n_pulses_to_o3` int(11) NOT NULL,
  `dev_raw_type` int(11) NOT NULL,
  `dev_raw_file_name` varchar(255) NOT NULL,
  `dev_raw_file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `devices`
--

INSERT INTO `devices` (`id`, `dev_id_cust`, `dev_id_contr`, `dev_id_type`, `dev_sernumber`, `dev_mac`, `dev_place`, `dev_cost`, `dev_date_st`, `dev_period_hour`, `dev_date_exp`, `dev_flag_block`, `dev_p1_price`, `dev_p2_price`, `dev_p3_price`, `dev_p3_flag`, `dev_p4_price`, `dev_p1_inhibit`, `dev_o1_price`, `dev_o2_price`, `dev_o3_price`, `dev_n_pulses_to_o1`, `dev_n_pulses_to_o2`, `dev_n_pulses_to_o3`, `dev_raw_type`, `dev_raw_file_name`, `dev_raw_file_path`) VALUES
(1, 1, 1, 1, 1, 'ff-de-ff-aa-00', 'пост №1', 1000000, '2005-03-22 00:00:00', 744, '2009-03-22 00:00:00', 0, 10, 20, 30, 0, 50, 0, 10, 50, 0, 0, 0, 0, 0, '-----', '----'),
(2, 1, 1, 1, 2, 'ff-de-ff-aa-01', '2', 15000, '2022-05-05 00:00:00', 458, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(3, 1, 2, 3, 3, 'ff-de-ff-aa-03', '3', 17000, '2022-05-05 00:00:00', 582, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(4, 1, 2, 3, 3, 'ff-de-ff-aa-03', '3', 17000, '2022-05-05 00:00:00', 582, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `logs_type_event` int(11) NOT NULL,
  `logs_entity_event` varchar(255) NOT NULL,
  `logs_date_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `page` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `title`, `header`, `parent_id`, `page`) VALUES
(1, 'contracts', 'Договора', 0, 'main'),
(2, 'devaces', 'Объекты', 0, 'main'),
(3, 'operation', 'Операции', 0, 'main'),
(4, 'personal', 'Личный кабинет', 0, 'main'),
(5, 'documets', 'Документы', 0, ''),
(6, 'doc1', 'Документ1', 5, ''),
(7, 'doc2', 'Документ 2', 5, ''),
(8, 'doc2', 'Документ 3', 5, '');

-- --------------------------------------------------------

--
-- Структура таблицы `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `op_name` varchar(255) NOT NULL,
  `op_day_mail` varchar(255) NOT NULL,
  `op_period_rent` int(11) NOT NULL,
  `op_cost_rent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `params`
--

CREATE TABLE `params` (
  `id` int(11) NOT NULL,
  `params_name` varchar(255) NOT NULL,
  `params_value` text NOT NULL,
  `autoload` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `params`
--

INSERT INTO `params` (`id`, `params_name`, `params_value`, `autoload`) VALUES
(1, 'title', 'Система оплаты ренты Сloud Rental', 1),
(2, 'name_site', 'Cloud Rental', 1),
(3, 'admin_email', 'relmich2@gmail.com', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `pay_action` int(11) NOT NULL,
  `pay_id_dev` int(11) NOT NULL,
  `pay_name_table` varchar(255) NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `pay_summ` int(11) NOT NULL,
  `pay_date` datetime NOT NULL,
  `pay_result` int(11) NOT NULL,
  `pay_comment` text NOT NULL,
  `pay_token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `roles_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `roles_name`) VALUES
(1, 'god'),
(2, 'admin'),
(3, 'customer');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `serv_id_cust` int(11) NOT NULL,
  `serv_id_admin` int(11) NOT NULL,
  `serv_id_contr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `type_dev`
--

CREATE TABLE `type_dev` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_comment` text NOT NULL,
  `type_flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type_dev`
--

INSERT INTO `type_dev` (`id`, `type_name`, `type_comment`, `type_flag`) VALUES
(1, 'qr_pay', 'версия 1_0', 0),
(2, 'qr_pay', 'версия 2_0', 0),
(3, 'fiscal', 'версия 1_0', 0),
(4, 'fiscal', 'версия 1_1', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `users_login` varchar(255) NOT NULL,
  `users_pass` varchar(255) NOT NULL,
  `users_mail` varchar(100) NOT NULL,
  `users_id_rol` int(2) NOT NULL,
  `users_data_reg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `users_login`, `users_pass`, `users_mail`, `users_id_rol`, `users_data_reg`) VALUES
(1, 'admin', '$2y$10$CFTneGhBTLZSZOVHh3psZOYvvLMH/T4P2PpG0pA9.RwvbqBuPNCGO', 'admin@admin.ru', 2, '2022-04-26 18:06:29'),
(2, 'user', '$2y$10$MoYeZ77BodC6hlO5/7UPs.qA9qIGymZM13zkNiyrNqvmWhx/if5mq', 'user@yandex.ru', 3, '2022-04-26 18:07:02'),
(3, 'qwer', '$2y$10$jUYXo37/IHGZj/OuqZ2izeWD1Vj7I/O5kSFVOcGI.NINea7MfKJwy', 'resdfhsh@yanfgsddex.ru', 3, '2022-04-26 18:16:33'),
(4, 'werqwer', '$2y$10$uPTkNBMOZL/.62Ht5DM49edo4t2kV26QzLHssUennV1XOUmWv9TXS', 'fas@ERQW.UY', 3, '2022-04-28 16:29:25');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ind-admin_id_users` (`admin_id_users`) USING BTREE;

--
-- Индексы таблицы `connection_dev`
--
ALTER TABLE `connection_dev`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ind-con_id_dev` (`con_id_dev`);

--
-- Индексы таблицы `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ind-contr_id_cust` (`contr_id_cust`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ind-cust_id_users` (`cust_id_users`);

--
-- Индексы таблицы `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ind-dev_id_cust` (`dev_id_cust`),
  ADD KEY `ind-dev_id_contr` (`dev_id_contr`),
  ADD KEY `ind-dev_id_type` (`dev_id_type`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Индексы таблицы `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Индексы таблицы `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ind-pay_id_dev` (`pay_id_dev`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ind-serv_id_cust` (`serv_id_cust`),
  ADD KEY `ind-serv_id_admin` (`serv_id_admin`),
  ADD KEY `ind-serv_id_contr` (`serv_id_contr`);

--
-- Индексы таблицы `type_dev`
--
ALTER TABLE `type_dev`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_login` (`users_login`),
  ADD UNIQUE KEY `users_mail` (`users_mail`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `connection_dev`
--
ALTER TABLE `connection_dev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `params`
--
ALTER TABLE `params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `type_dev`
--
ALTER TABLE `type_dev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `connection_dev`
--
ALTER TABLE `connection_dev`
  ADD CONSTRAINT `connection_dev_ibfk_1` FOREIGN KEY (`con_id_dev`) REFERENCES `devices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`contr_id_cust`) REFERENCES `customers` (`id`);

--
-- Ограничения внешнего ключа таблицы `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`cust_id_users`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`dev_id_type`) REFERENCES `type_dev` (`id`),
  ADD CONSTRAINT `devices_ibfk_2` FOREIGN KEY (`dev_id_contr`) REFERENCES `contracts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

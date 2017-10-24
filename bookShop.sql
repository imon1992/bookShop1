-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 24 2017 г., 14:10
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `bookShop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `name`, `surname`) VALUES
(1, 'Stephen', 'King'),
(3, 'Dmitriy', 'Gluhovskiy'),
(4, 'Bob', 'Brown'),
(7, 'Andrew', 'Butorin'),
(8, 'Lina', 'Kostenko');

-- --------------------------------------------------------

--
-- Структура таблицы `bag`
--

CREATE TABLE `bag` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `description` text,
  `discount` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `name`, `price`, `description`, `discount`) VALUES
(1, 'Metro 2033', 255, 'Metro 2033 desc', 0),
(2, 'Doctor Sleep', 200, 'Doctor Sleep desc', 2),
(3, 'War of Gods', 450, 'War of Gods desc', 5),
(4, 'Siege of Paradise', 250, 'Siege of Paradise desc', 5),
(5, 'Lina Kostenko Autobiography', 100, 'Lina Kostenko life and art ', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `bookAuthor`
--

CREATE TABLE `bookAuthor` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bookAuthor`
--

INSERT INTO `bookAuthor` (`id`, `book_id`, `author_id`) VALUES
(1, 1, 3),
(2, 1, 1),
(3, 2, 1),
(4, 3, 4),
(5, 4, 7),
(6, 5, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `bookGenre`
--

CREATE TABLE `bookGenre` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bookGenre`
--

INSERT INTO `bookGenre` (`id`, `book_id`, `genre_id`) VALUES
(1, 1, 3),
(2, 1, 2),
(3, 2, 2),
(4, 3, 3),
(5, 4, 1),
(6, 5, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(15) DEFAULT NULL,
  `surname` varchar(15) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `hash` varchar(150) NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id`, `name`, `surname`, `phone`, `email`, `login`, `password`, `hash`, `discount`, `isActive`, `role`) VALUES
(1, 'Test', 'test', '0000000000', 'test@gmail.com', 'test', 'ec6a6536ca304edf844d1d248a4f08dc', 'ec167602fecdc012ed22f0164c7c450d', 0, 1, 'user'),
(2, 'admin', 'admin', '5555555555', 'admin@mksat.net', 'admin', 'ec6a6536ca304edf844d1d248a4f08dc', 'fdb1e6a50bb2b4b0034ae38a04d0ff31', 0, 1, 'admin'),
(3, 'Andrew', 'kolotii', '02589635741', 'imon@mksat.net', 'imonX', 'ec6a6536ca304edf844d1d248a4f08dc', '', 10, 1, 'user'),
(4, 'sade', 'asde', '1234567890', 'imon@mksat.net', 'asde', 'd8e3d85962958758d3a29dd1ecb0800a', '195dca0caeb34bcc67a2e8fb0539a3fe', 0, 1, 'user'),
(5, 'asdw', 'sdw', '1232123131', 'imon@mksat.net', 'asdw', 'ee2409ce5d882decc442b6b7fb8c353f', '', 0, 1, 'user'),
(6, 'zxzx', 'zxzx', '2313131312', 'imon@mksat.net', 'zxzx', '6e2495fafc65f40bb18712c198d93c87', '', 1, 1, 'user'),
(7, 'asdf', 'asdf', '122312312321', 'imon@mksat.net', 'asdf', '5259ee4a034fdeddd1b65be92debe731', '', 1, 1, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Fiction'),
(2, 'ScienceFiction'),
(3, 'Fantasy'),
(4, 'Autobiography');

-- --------------------------------------------------------

--
-- Структура таблицы `orderPart`
--

CREATE TABLE `orderPart` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `bookPrice` int(11) NOT NULL,
  `bookDiscount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderPart`
--

INSERT INTO `orderPart` (`id`, `book_id`, `order_id`, `user_id`, `count`, `bookPrice`, `bookDiscount`) VALUES
(1, 2, 1, 1, 2, 200, 2),
(2, 1, 1, 4, 2, 255, 0),
(3, 2, 1, 4, 3, 200, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id`, `name`) VALUES
(1, 'Pay Pal'),
(2, 'Webmoney'),
(3, 'Qiwi'),
(4, 'YandexMoney');

-- --------------------------------------------------------

--
-- Структура таблицы `statusOrder`
--

CREATE TABLE `statusOrder` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statusOrder`
--

INSERT INTO `statusOrder` (`id`, `name`) VALUES
(1, 'In Process'),
(2, 'In transit'),
(3, 'Done');

-- --------------------------------------------------------

--
-- Структура таблицы `userOrder`
--

CREATE TABLE `userOrder` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  `totalPrice` float(10,0) NOT NULL,
  `userDiscount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `userOrder`
--

INSERT INTO `userOrder` (`id`, `user_id`, `payment_id`, `status_id`, `createDate`, `totalPrice`, `userDiscount`) VALUES
(1, 1, 2, 3, '2017-10-23 12:51:48', 392, 0),
(2, 4, 3, 1, '2017-10-23 14:26:35', 1098, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bag`
--
ALTER TABLE `bag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bookAuthor`
--
ALTER TABLE `bookAuthor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BookAuthor_fk0` (`book_id`),
  ADD KEY `BookAuthor_fk1` (`author_id`);

--
-- Индексы таблицы `bookGenre`
--
ALTER TABLE `bookGenre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BookGenre_fk0` (`book_id`),
  ADD KEY `BookGenre_fk1` (`genre_id`);

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orderPart`
--
ALTER TABLE `orderPart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookId` (`book_id`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statusOrder`
--
ALTER TABLE `statusOrder`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `userOrder`
--
ALTER TABLE `userOrder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentStatus` (`payment_id`),
  ADD KEY `status` (`status_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `bag`
--
ALTER TABLE `bag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `bookAuthor`
--
ALTER TABLE `bookAuthor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `bookGenre`
--
ALTER TABLE `bookGenre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `orderPart`
--
ALTER TABLE `orderPart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `statusOrder`
--
ALTER TABLE `statusOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `userOrder`
--
ALTER TABLE `userOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bag`
--
ALTER TABLE `bag`
  ADD CONSTRAINT `book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Ограничения внешнего ключа таблицы `bookAuthor`
--
ALTER TABLE `bookAuthor`
  ADD CONSTRAINT `BookAuthor_fk0` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `BookAuthor_fk1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`);

--
-- Ограничения внешнего ключа таблицы `bookGenre`
--
ALTER TABLE `bookGenre`
  ADD CONSTRAINT `BookGenre_fk0` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `BookGenre_fk1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Ограничения внешнего ключа таблицы `orderPart`
--
ALTER TABLE `orderPart`
  ADD CONSTRAINT `bookId` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`);

--
-- Ограничения внешнего ключа таблицы `userOrder`
--
ALTER TABLE `userOrder`
  ADD CONSTRAINT `paymentStatus` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`),
  ADD CONSTRAINT `status` FOREIGN KEY (`status_id`) REFERENCES `statusOrder` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

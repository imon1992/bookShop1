-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 17 2017 г., 16:02
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bookShop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Author`
--

CREATE TABLE `Author` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Author`
--

INSERT INTO `Author` (`id`, `name`, `surname`) VALUES
(5, 'Bob', 'More'),
(6, 'Ben', 'Brown'),
(7, 'Stiw', 'Jobssss'),
(10, 'Bogdan', 'Stupka');

-- --------------------------------------------------------

--
-- Структура таблицы `Book`
--

CREATE TABLE `Book` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `description` text,
  `discount` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Book`
--

INSERT INTO `Book` (`id`, `name`, `price`, `description`, `discount`) VALUES
(1, 'War of Gods', 250, 'War of Gods desc', 4),
(2, 'metro 2033', 500, 'desc', 3),
(3, 'My Memuars', 465, 'My Memuars desc', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `BookAuthor`
--

CREATE TABLE `BookAuthor` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `BookAuthor`
--

INSERT INTO `BookAuthor` (`id`, `book_id`, `author_id`) VALUES
(2, 1, 10),
(3, 2, 10),
(7, 1, 5),
(8, 3, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `BookGenre`
--

CREATE TABLE `BookGenre` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `BookGenre`
--

INSERT INTO `BookGenre` (`id`, `book_id`, `genre_id`) VALUES
(2, 2, 2),
(3, 3, 2),
(5, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Client`
--

CREATE TABLE `Client` (
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
-- Дамп данных таблицы `Client`
--

INSERT INTO `Client` (`id`, `name`, `surname`, `phone`, `email`, `login`, `password`, `hash`, `discount`, `isActive`, `role`) VALUES
(1, NULL, NULL, NULL, NULL, '', '74be16979710d4c4e7c6', '', 0, 0, 'admin'),
(4, NULL, NULL, NULL, NULL, 'test', 'ec6a6536ca304edf844d1d248a4f08dc', '1ba249876eaa33de5a52c29ed739c934', 0, 0, 'admin'),
(6, 'Andrew', 'Kolotii', '0975998789', 'imon@mksat.net', 'imon', 'bb46977affa222b1237af74ec23c45a1', 'ae459b17c2534f5c9b35430b72ec498b', 0, 0, 'user'),
(7, 'imon', 'dsfsdfsd', '948468548546', 'imon@mksat.net', 'imonX', 'ec6a6536ca304edf844d1d248a4f08dc', 'ed9578cda9f4d436203336d63abe301a', 0, 1, 'user'),
(8, 'NormA', 'Norms', '354353453534', 'imon@mksat.net', 'norm', 'ec6a6536ca304edf844d1d248a4f08dc', 'c994123fb4a50bb4cc178fc0dc74abbb', 0, 0, 'user'),
(9, 'John', 'Smith', '5236854689', 'imon@mksat.net', 'testAsd', '2952e1846b4ea765dfd0fdfcb7e21097', '', 5, 0, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `FullInfoOrder`
--

CREATE TABLE `FullInfoOrder` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_price` double NOT NULL,
  `book_id` int(11) NOT NULL,
  `count` smallint(6) NOT NULL,
  `discount_book` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Genre`
--

CREATE TABLE `Genre` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Genre`
--

INSERT INTO `Genre` (`id`, `name`) VALUES
(1, 'shadowww'),
(2, 'triller'),
(3, 'Fantastika'),
(4, 'melodrama');

-- --------------------------------------------------------

--
-- Структура таблицы `HistoryBook`
--

CREATE TABLE `HistoryBook` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `authors` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Order`
--

CREATE TABLE `Order` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `skidka_client` float NOT NULL DEFAULT '0',
  `date_order_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Payment`
--

CREATE TABLE `Payment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `StatusOrder`
--

CREATE TABLE `StatusOrder` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Author`
--
ALTER TABLE `Author`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `BookAuthor`
--
ALTER TABLE `BookAuthor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BookAuthor_fk0` (`book_id`),
  ADD KEY `BookAuthor_fk1` (`author_id`);

--
-- Индексы таблицы `BookGenre`
--
ALTER TABLE `BookGenre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BookGenre_fk0` (`book_id`),
  ADD KEY `BookGenre_fk1` (`genre_id`);

--
-- Индексы таблицы `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `FullInfoOrder`
--
ALTER TABLE `FullInfoOrder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FullInfoOrder_fk0` (`order_id`),
  ADD KEY `FullInfoOrder_fk1` (`book_id`);

--
-- Индексы таблицы `Genre`
--
ALTER TABLE `Genre`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `HistoryBook`
--
ALTER TABLE `HistoryBook`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Order`
--
ALTER TABLE `Order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Order_fk0` (`client_id`),
  ADD KEY `Order_fk1` (`payment_id`),
  ADD KEY `Order_fk2` (`status_id`);

--
-- Индексы таблицы `Payment`
--
ALTER TABLE `Payment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `StatusOrder`
--
ALTER TABLE `StatusOrder`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Author`
--
ALTER TABLE `Author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `Book`
--
ALTER TABLE `Book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `BookAuthor`
--
ALTER TABLE `BookAuthor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `BookGenre`
--
ALTER TABLE `BookGenre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `Client`
--
ALTER TABLE `Client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `FullInfoOrder`
--
ALTER TABLE `FullInfoOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Genre`
--
ALTER TABLE `Genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `HistoryBook`
--
ALTER TABLE `HistoryBook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Order`
--
ALTER TABLE `Order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Payment`
--
ALTER TABLE `Payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `StatusOrder`
--
ALTER TABLE `StatusOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `BookAuthor`
--
ALTER TABLE `BookAuthor`
  ADD CONSTRAINT `BookAuthor_fk0` FOREIGN KEY (`book_id`) REFERENCES `Book` (`id`),
  ADD CONSTRAINT `BookAuthor_fk1` FOREIGN KEY (`author_id`) REFERENCES `Author` (`id`);

--
-- Ограничения внешнего ключа таблицы `BookGenre`
--
ALTER TABLE `BookGenre`
  ADD CONSTRAINT `BookGenre_fk0` FOREIGN KEY (`book_id`) REFERENCES `Book` (`id`),
  ADD CONSTRAINT `BookGenre_fk1` FOREIGN KEY (`genre_id`) REFERENCES `Genre` (`id`);

--
-- Ограничения внешнего ключа таблицы `FullInfoOrder`
--
ALTER TABLE `FullInfoOrder`
  ADD CONSTRAINT `FullInfoOrder_fk0` FOREIGN KEY (`order_id`) REFERENCES `Order` (`id`),
  ADD CONSTRAINT `FullInfoOrder_fk1` FOREIGN KEY (`book_id`) REFERENCES `Book` (`id`);

--
-- Ограничения внешнего ключа таблицы `Order`
--
ALTER TABLE `Order`
  ADD CONSTRAINT `Order_fk0` FOREIGN KEY (`client_id`) REFERENCES `Client` (`id`),
  ADD CONSTRAINT `Order_fk1` FOREIGN KEY (`payment_id`) REFERENCES `Payment` (`id`),
  ADD CONSTRAINT `Order_fk2` FOREIGN KEY (`status_id`) REFERENCES `StatusOrder` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

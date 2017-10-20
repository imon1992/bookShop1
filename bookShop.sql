-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 20 2017 г., 15:53
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
(5, 'authorryaaa', 'new'),
(6, 'Ben', 'Brown'),
(7, 'Stiw', 'Jobssss'),
(10, 'Bogdan', 'Stupka'),
(11, 'Lina', 'Kostenko');

-- --------------------------------------------------------

--
-- Структура таблицы `Bag`
--

CREATE TABLE `Bag` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(5, 1, 1),
(6, 1, 2);

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
(7, 'imon', 'dsfsdfsd', '948468548546', 'imon@mksat.net', 'imonX', 'ec6a6536ca304edf844d1d248a4f08dc', '740e6378ed10fde7904fdbccfeb6ac3c', 5, 1, 'user'),
(8, 'NormA', 'Norms', '354353453534', 'imon@mksat.net', 'norm', 'ec6a6536ca304edf844d1d248a4f08dc', 'c994123fb4a50bb4cc178fc0dc74abbb', 0, 0, 'user'),
(9, 'John', 'Smith', '5236854689', 'imon@mksat.net', 'testAsd', '2952e1846b4ea765dfd0fdfcb7e21097', '', 5, 0, 'user'),
(10, 'asde', 'asde', '3698745632', 'imon@mksat.net', 'asde', 'd8e3d85962958758d3a29dd1ecb0800a', '52e0b935edf78c3b342d25f7630aa5e8', 0, 1, 'user');

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
(1, 1, 1, 7, 1, 250, 4),
(2, 2, 1, 7, 1, 500, 3),
(3, 1, 2, 7, 3, 250, 4),
(4, 2, 2, 7, 1, 500, 3),
(5, 1, 3, 10, 4, 250, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `Payment`
--

CREATE TABLE `Payment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Payment`
--

INSERT INTO `Payment` (`id`, `name`) VALUES
(1, 'WebMoney'),
(2, 'Pay Pal');

-- --------------------------------------------------------

--
-- Структура таблицы `StatusOrder`
--

CREATE TABLE `StatusOrder` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `StatusOrder`
--

INSERT INTO `StatusOrder` (`id`, `name`) VALUES
(1, 'In Process'),
(2, 'Done'),
(3, 'In transit');

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
  `totalPrice` float NOT NULL,
  `userDiscount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `userOrder`
--

INSERT INTO `userOrder` (`id`, `user_id`, `payment_id`, `status_id`, `createDate`, `totalPrice`, `userDiscount`) VALUES
(1, 7, 1, 1, '2017-10-19 13:34:43', 689, 5),
(2, 7, 2, 2, '2017-10-20 12:19:23', 1144.75, 5),
(3, 10, 2, 1, '2017-10-20 14:19:36', 960, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Author`
--
ALTER TABLE `Author`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Bag`
--
ALTER TABLE `Bag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `client_id` (`client_id`);

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
-- Индексы таблицы `orderPart`
--
ALTER TABLE `orderPart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookId` (`book_id`);

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
-- AUTO_INCREMENT для таблицы `Author`
--
ALTER TABLE `Author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `Bag`
--
ALTER TABLE `Bag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `Client`
--
ALTER TABLE `Client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
-- AUTO_INCREMENT для таблицы `orderPart`
--
ALTER TABLE `orderPart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `Payment`
--
ALTER TABLE `Payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `StatusOrder`
--
ALTER TABLE `StatusOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `userOrder`
--
ALTER TABLE `userOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Bag`
--
ALTER TABLE `Bag`
  ADD CONSTRAINT `book_id` FOREIGN KEY (`book_id`) REFERENCES `Book` (`id`),
  ADD CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `Client` (`id`);

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
-- Ограничения внешнего ключа таблицы `orderPart`
--
ALTER TABLE `orderPart`
  ADD CONSTRAINT `bookId` FOREIGN KEY (`book_id`) REFERENCES `Book` (`id`);

--
-- Ограничения внешнего ключа таблицы `userOrder`
--
ALTER TABLE `userOrder`
  ADD CONSTRAINT `paymentStatus` FOREIGN KEY (`payment_id`) REFERENCES `Payment` (`id`),
  ADD CONSTRAINT `status` FOREIGN KEY (`status_id`) REFERENCES `StatusOrder` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

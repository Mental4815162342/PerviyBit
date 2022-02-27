-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 27 2022 г., 14:41
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testobj`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chapter`
--

CREATE TABLE `chapter` (
  `id_chapter` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_create` date NOT NULL,
  `date_update` date NOT NULL,
  `description` text,
  `parent_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `chapter`
--

INSERT INTO `chapter` (`id_chapter`, `name`, `date_create`, `date_update`, `description`, `parent_id`) VALUES
(1, 'Корневой раздел', '2022-02-24', '2022-02-24', 'Это корневой раздел', 0),
(2, 'Раздел с новостями', '2022-02-24', '2022-02-24', 'Это раздел с новостями', 1),
(3, 'Раздел со статьями', '2022-02-24', '2022-02-24', 'Это раздел со статьями', 1),
(4, 'Раздел с отзывами', '2022-02-24', '2022-02-24', 'Это раздел с отзывами', 1),
(5, 'Раздел с комментариями', '2022-02-24', '2022-02-24', 'Это раздел с комментариями', 1),
(6, 'Новости спорта', '2022-02-24', '2022-02-24', 'В этом разделе новости спорта', 2),
(7, 'Новости биатлона', '2022-02-24', '2022-02-26', 'В этом разделе новости биатлона', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `element`
--

CREATE TABLE `element` (
  `id_element` int NOT NULL,
  `id_chapter` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_create` date NOT NULL,
  `date_update` date NOT NULL,
  `type` int NOT NULL,
  `other` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `element`
--

INSERT INTO `element` (`id_element`, `id_chapter`, `name`, `date_create`, `date_update`, `type`, `other`) VALUES
(1, 7, 'Мы заняли второе место', '2022-02-24', '2022-02-27', 1, 'Теперь у нас на одну серебряную медаль больше!'),
(3, 7, 'Мы взяли золото', '2022-02-27', '2022-02-27', 1, 'Наши взяли золото! Мы - молодцы!'),
(4, 7, 'Атлет получил травму', '2022-02-27', '2022-02-27', 1, 'Наш атлет получил травму, пока учувствовал в соревнованиях по спринту.'),
(7, 7, 'Женщина подарила наши атлетам деньги', '2022-02-27', '2022-02-27', 1, 'Женщина, живущая на Марсе подарила нашим биатлонистам по 10000000 денег каждому!');

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE `type` (
  `id_type` int NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`id_type`, `name`) VALUES
(1, 'Новость'),
(2, 'Статья'),
(3, 'Отзыв'),
(4, 'Комментарий');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id_chapter`);

--
-- Индексы таблицы `element`
--
ALTER TABLE `element`
  ADD PRIMARY KEY (`id_element`),
  ADD KEY `id_element` (`id_element`),
  ADD KEY `id_chapter` (`id_chapter`),
  ADD KEY `type` (`type`);

--
-- Индексы таблицы `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`),
  ADD KEY `id_type` (`id_type`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id_chapter` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `element`
--
ALTER TABLE `element`
  MODIFY `id_element` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `element`
--
ALTER TABLE `element`
  ADD CONSTRAINT `element_ibfk_1` FOREIGN KEY (`id_chapter`) REFERENCES `chapter` (`id_chapter`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `element_ibfk_2` FOREIGN KEY (`type`) REFERENCES `type` (`id_type`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

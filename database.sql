-- phpMyAdmin SQL Dump
-- version 2.11.3
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 27 2017 г., 15:13
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

--
-- База данных: `database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `autobarachlo`
--

CREATE TABLE IF NOT EXISTS `autobarachlo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Дамп данных таблицы `autobarachlo`
--

INSERT INTO `autobarachlo` (`id`, `user`, `title`, `text`, `date`, `time`) VALUES
(69, 'Петюня(Аноним)', 'цуйцу', 'йцуйцуйц', '2017-11-27', '00:47:00'),
(70, 'ывфывф(Аноним)', 'ссыфс', 'ыфвыфвы', '2017-11-27', '01:00:00'),
(71, 'афыафыа(Аноним)', 'афыафы', 'аафыа', '2017-11-27', '01:08:00'),
(72, 'qwerty', 'bnvnvbnvbn', 'vvvbnvnv', '2017-11-27', '12:49:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `type` varchar(15) NOT NULL DEFAULT 'user',
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `type`, `password`) VALUES
(36, 'pawlooha', 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(37, 'gena', 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(38, 'werka', 'user', '81dc9bdb52d04dc20036dbd8313ed055'),
(39, 'qwerty', 'user', '81dc9bdb52d04dc20036dbd8313ed055');

-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 19 2014 г., 12:31
-- Версия сервера: 5.5.38
-- Версия PHP: 5.3.10-1ubuntu3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `service-links`
--

-- --------------------------------------------------------

--
-- Структура таблицы `abanner`
--

CREATE TABLE IF NOT EXISTS `abanner` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `sid` int(10) NOT NULL,
  `href` varchar(300) NOT NULL,
  `ban_href` varchar(300) NOT NULL,
  `status` int(1) NOT NULL,
  `lim` varchar(16) NOT NULL,
  `sz` int(1) NOT NULL,
  `price` float NOT NULL,
  `hold` float NOT NULL,
  `views` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `add`
--

CREATE TABLE IF NOT EXISTS `add` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `date` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `alink`
--

CREATE TABLE IF NOT EXISTS `alink` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `sid` int(10) NOT NULL,
  `href` varchar(300) NOT NULL,
  `text` varchar(300) NOT NULL,
  `status` int(1) NOT NULL,
  `date` varchar(16) NOT NULL,
  `price` float NOT NULL,
  `dopol` varchar(4) NOT NULL,
  `cvet` varchar(7) NOT NULL,
  `views` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Структура таблицы `avtoriz`
--

CREATE TABLE IF NOT EXISTS `avtoriz` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `date` varchar(16) NOT NULL,
  `schet` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `avtoriz`
--

INSERT INTO `avtoriz` (`id`, `ip`, `date`, `schet`) VALUES
(1, '92.85.169.173', '0', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `href` varchar(300) NOT NULL,
  `pos` float NOT NULL,
  `text` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `href` varchar(300) NOT NULL,
  `pos` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `money`
--

CREATE TABLE IF NOT EXISTS `money` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `date` varchar(16) NOT NULL,
  `summa` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` varchar(25) NOT NULL,
  `descr` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `outbalance`
--

CREATE TABLE IF NOT EXISTS `outbalance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `date` varchar(16) NOT NULL,
  `r` varchar(13) NOT NULL,
  `summa` float NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pars`
--

CREATE TABLE IF NOT EXISTS `pars` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `pr` int(10) NOT NULL,
  `cu` int(10) NOT NULL,
  `yahoo` text NOT NULL,
  `lipok` int(10) NOT NULL,
  `lipos` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `pars`
--

INSERT INTO `pars` (`id`, `uid`, `pr`, `cu`, `yahoo`, `lipok`, `lipos`) VALUES
(1, 1, 0, 0, '0', 185, 15),
(2, 2, 0, 0, '0', 52, 6),
(3, 8, 0, 0, '0', 939, 197),
(4, 10, 0, 0, '0', 1021, 194),
(5, 11, 0, 0, '0', 515, 107);

-- --------------------------------------------------------

--
-- Структура таблицы `statistic`
--

CREATE TABLE IF NOT EXISTS `statistic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `tip` int(1) NOT NULL,
  `date` varchar(16) NOT NULL,
  `summa` float NOT NULL,
  `balance` float NOT NULL,
  `coshel` varchar(14) NOT NULL,
  `url` varchar(300) NOT NULL,
  `dop` varchar(300) NOT NULL,
  `plosh` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `url` varchar(500) NOT NULL,
  `t` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `price` float NOT NULL,
  `linknum` int(10) NOT NULL,
  `defban` varchar(500) NOT NULL,
  `maxtext` int(10) NOT NULL,
  `w` int(10) NOT NULL,
  `d` int(10) NOT NULL,
  `schet` int(10) NOT NULL,
  `forma` int(1) NOT NULL,
  `name` varchar(500) NOT NULL,
  `update` varchar(2) NOT NULL,
  `dopol` varchar(4) NOT NULL,
  `lastdate` varchar(16) NOT NULL,
  `up` varchar(1) NOT NULL,
  `c1` int(1) NOT NULL,
  `c2` int(1) NOT NULL,
  `c3` int(1) NOT NULL,
  `c4` int(1) NOT NULL,
  `svoi` varchar(6) NOT NULL,
  `holdv` int(1) NOT NULL,
  `atext` varchar(201) NOT NULL,
  `slot` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `tables`
--

INSERT INTO `tables` (`id`, `uid`, `url`, `t`, `status`, `price`, `linknum`, `defban`, `maxtext`, `w`, `d`, `schet`, `forma`, `name`, `update`, `dopol`, `lastdate`, `up`, `c1`, `c2`, `c3`, `c4`, `svoi`, `holdv`, `atext`, `slot`) VALUES
(2, 1, 'http://opcat.ru/', 2, 2, 1, 0, 'http://opcat.ru/promo/dummy/468x60.jpg', 0, 468, 60, 0, 0, 'BannersNeo', '1', '', '0', '0', 0, 0, 0, 0, '0', 1, 'Сервис мгновенного размещения витрин ссылок и баннеров. Владельцы сайтов с легкостью смогут заработать, а рекламодатели в автоматическом режиме заказать рекламу.', 30),
(1, 1, 'http://opcat.ru', 1, 2, 2, 10, '', 40, 0, 0, 0, 1, 'BannersNeo', '1', '1', '0', '0', 1, 1, 1, 1, '0', 0, 'Сервис мгновенного размещения витрин ссылок и баннеров. Владельцы сайтов с легкостью смогут заработать, а рекламодатели в автоматическом режиме заказать рекламу.', 30);

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `text` varchar(500) NOT NULL,
  `atext` varchar(500) NOT NULL,
  `date` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `passw` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `group` int(1) NOT NULL,
  `balance` float NOT NULL,
  `rid` int(10) NOT NULL,
  `rbalance` float NOT NULL,
  `icq` int(15) NOT NULL,
  `wmr` varchar(13) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `lastdate` varchar(16) NOT NULL,
  `lastip` varchar(15) NOT NULL,
  `num` float NOT NULL,
  `regdate` varchar(16) NOT NULL,
  `tops` float NOT NULL,
  `hold` float NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `passw`, `email`, `group`, `balance`, `rid`, `rbalance`, `icq`, `wmr`, `ip`, `lastdate`, `lastip`, `num`, `regdate`, `tops`, `hold`, `hash`) VALUES
(1, 'Admin', 'ee082ebe4ffbeeec8e96d5a571ad6417', 'support@neoskript.ru', 2, 0, 1, 0, 0, '', '93.77.230.110', '18.08.2014 12:51', '93.77.230.110', 5, '11.08.2014 00:08', 0, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

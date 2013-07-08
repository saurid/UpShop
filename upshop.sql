-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 09 augusti 2011 kl 18:47
-- Serverversion: 5.1.53
-- PHP-version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `upshop`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Data i tabell `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `date`) VALUES
(1, 0, 'CD', '2011-04-16 12:34:39'),
(2, 0, 'DVD', '2011-04-16 12:34:49'),
(3, 0, 'BluRay', '2011-04-16 12:35:02');

-- --------------------------------------------------------

--
-- Struktur för tabell `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `price` float NOT NULL,
  `retailprice` float NOT NULL,
  `weight` float NOT NULL,
  `count` int(11) NOT NULL,
  `image` varchar(64) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `thumb` varchar(64) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `vat_id` smallint(6) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Data i tabell `item`
--

INSERT INTO `item` (`id`, `category_id`, `name`, `description`, `price`, `retailprice`, `weight`, `count`, `image`, `thumb`, `vat_id`, `date`) VALUES
(1, 1, 'Front Line Assembly: Improvised Electronic Device', 'Front Line Assembly (FLA) is a Canadian electro-industrial band formed by Bill Leeb in 1986 after leaving Skinny Puppy.\r\n\r\nInfluenced by early Industrial acts such as Cabaret Voltaire, Portion Control, D.A.F., Test Dept, SPK, and Severed Heads, FLA has developed its own unique sound while combining elements of electronic body music (EBM).\r\n\r\nThe band''s membership has rotated through several members over the years, including Rhys Fulber and Michael Balch who are both associated with several other successful artists.', 159, 159, 70, 5, '1_frontlineassembly.jpg', '1_thumb_frontlineassembly.jpg', 1, '2011-04-16 16:15:46'),
(2, 1, 'Front 242: Tyranny For You', 'Front 242 is a pioneering Belgian electronic music group that came into prominence during the 1980s. During their most active period (effectively ending in 1993 with the albums 06:21:03:11 Up Evil and 05:22:09:12 Off) they influenced many electro-industrial and electronic artists.', 99, 99, 70, 10, '2_front242.jpg', '2_thumb_front242.jpg', 1, '2011-04-16 16:34:54'),
(3, 1, 'Haujobb: Polarity', 'Haujobb is a German musical project whose output has ranged drastically within the electronic music spectrum, from electro-industrial to IDM and techno. They have become a staple crossover act, bringing several forms of electro into the mainstream industrial music world.', 129, 129, 70, 10, '3_haujobb.jpg', '3_thumb_haujobb.jpg', 1, '2011-04-16 16:39:30'),
(4, 3, 'John Carpenters the Thing', 'The Thing (aka John Carpenter''s The Thing) is a 1982 science fiction horror film directed by John Carpenter, written by Bill Lancaster, and starring Kurt Russell.\r\n\r\nThe film''s title refers to its primary antagonist: a parasitic extraterrestrial lifeform that assimilates other organisms and in turn imitates them. It infiltrates an Antarctic research station, taking the appearance of the researchers that it kills, and paranoia occurs within the group.\r\n\r\nOstensibly a remake of the classic 1951 Howard Hawks-Christian Nyby film The Thing from Another World, Carpenter''s film is a more faithful adaptation of the novella Who Goes There? by John W. Campbell, Jr. which inspired the 1951 film.\r\n\r\nCarpenter considers The Thing to be the first part of his Apocalypse Trilogy, followed by Prince of Darkness and In the Mouth of Madness. Although the films are unrelated, each feature a potentially apocalyptic scenario; should "The Thing" ever reach civilization, it would be only a matter of time before it consumes humanity and takes over the Earth.', 199, 199, 100, 5, '4_thethingbluray.jpg', '4_thumb_thethingbluray.jpg', 1, '2011-04-17 00:34:56'),
(5, 3, 'Evil dead', 'The Evil Dead is a 1981 horror film written and directed by Sam Raimi, starring Bruce Campbell, Ellen Sandweiss, and Betsy Baker.\r\n\r\nThe film is a story of five college students vacationing in an isolated cabin in a wooded area. Their vacation becomes gruesome when they find an audiotape that releases evil spirits.\r\n\r\nThe film was extremely controversial for its graphic terror, violence, and gore, being initially turned down by almost all U.S. film distributors until a European company finally bought it in the Cannes Film Festival marketplace. It was finally released into theaters on October 15, 1981.\r\n\r\nAlthough its budget was probably no more than $400,000, the film was a moderate success at the box office, grossing a total of $2,400,000 in the U.S. upon its initial release. Despite getting mixed reviews by critics at the time, it now has a dedicated cult following.', 199, 199, 100, 10, '5_evildeadbluray.jpg', '5_thumb_evildeadbluray.jpg', 1, '2011-04-17 00:39:45'),
(6, 1, 'Alice in Videoland: She''s a Machine', 'Alice in Videoland är ett electroclash/EBM band som tog det officiella steget in i musikvärlden den 18 maj 2002, de är kända för sin säregna och nyskapande stil. Själva kallar de sin musik för electropunk. Namnet är taget ifrån C64-spelet "Alice in videoland" (Audiogenic) från 1984.\r\n\r\n2003 släpptes den första singeln "Dance with me" som satte fart på bandets karriär. Bandet har vunnit priserna årets bästa nykomling 2005 och årets artist 2006 på SAMA-galan. Man har också gjort ett hundratal spelningar där Arvikafestivalen med en förtjust 5 000-hövdad publik varit den största.', 139, 139, 70, 10, '6_aliceinvideoland.jpg', '6_thumb_aliceinvideoland.jpg', 1, '2011-04-18 22:01:45');

-- --------------------------------------------------------

--
-- Struktur för tabell `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userrole_id` smallint(6) NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `contact` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `phone` varchar(32) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Data i tabell `user`
--

INSERT INTO `user` (`id`, `userrole_id`, `email`, `contact`, `phone`, `password`) VALUES
(1, 3, 'admin@admin.se', 'Admin\r\nAdminvägen 1\r\nAdminstad', '0123-456789', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur för tabell `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `id` smallint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Data i tabell `userrole`
--

INSERT INTO `userrole` (`id`, `name`) VALUES
(1, 'visitor'),
(2, 'retailer'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Struktur för tabell `vat`
--

CREATE TABLE IF NOT EXISTS `vat` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `vat` smallint(6) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Data i tabell `vat`
--

INSERT INTO `vat` (`id`, `vat`, `name`) VALUES
(1, 25, 'Normal'),
(2, 12, 'Livsmedel'),
(3, 6, 'Litteratur, tidsskrifter');

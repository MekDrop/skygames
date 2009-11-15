-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 13, 2008 at 08:30 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `skygames`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `adminmenus`
-- 

CREATE TABLE `adminmenus` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(64) character set latin1 default NULL,
  `link` varchar(255) character set latin1 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `adminmenus`
-- 

INSERT INTO `adminmenus` (`id`, `title`, `link`) VALUES 
(1, 'index', '/home/index'),
(2, 'groups', '/admin/groups/index'),
(3, 'users', '/admin/users/index'),
(4, 'permissions', '/admin/permissions/index'),
(5, 'adminmenus', '/admin/adminmenus/index'),
(6, 'events', '/admin/events/index'),
(7, 'teams', '/admin/teams/index'),
(8, 'menu', '/admin/menus/index'),
(9, 'matches', '/admin/matches/index '),
(10, 'results', '/admin/results/index '),
(11, 'news', '/admin/infos/index'),
(12, 'languages', '/admin/langs/index'),
(13, 'games', '/admin/games/index'),
(14, 'news categories', '/admin/infocats/index'),
(15, 'forum categories', '/admin/threadcats/index'),
(16, 'maps', '/admin/maps/index'),
(17, 'feeds', '/admin/feeds/index'),
(18, 'servers', '/admin/servers/index');

-- --------------------------------------------------------

-- 
-- Table structure for table `betts`
-- 

CREATE TABLE `betts` (
  `id` int(11) NOT NULL auto_increment,
  `match_id` int(11) default NULL,
  `team_id` int(11) default NULL,
  `sum` int(11) default NULL,
  `odds` float(9,3) default NULL,
  `user_id` int(11) default NULL,
  `created` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `betts`
-- 

INSERT INTO `betts` (`id`, `match_id`, `team_id`, `sum`, `odds`, `user_id`, `created`) VALUES 
(1, 6, 19, 123, NULL, 1, '2008-10-13'),
(2, 6, 18, 100, NULL, 1, '2008-10-13'),
(3, 6, 18, 100, NULL, 1, '2008-10-13'),
(4, 6, 18, 100, NULL, 1, '2008-10-13'),
(5, 5, 24, 50, NULL, 1, '2008-10-02'),
(6, 60, 27, 500, NULL, 1, '2008-09-15');

-- --------------------------------------------------------

-- 
-- Table structure for table `custcomments`
-- 

CREATE TABLE `custcomments` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `body` text collate utf8_unicode_ci,
  `created` datetime default NULL,
  `user_id` int(11) unsigned default NULL,
  `seqnumber` int(11) default NULL,
  `parent_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `custcomments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `events`
-- 

CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(45) collate utf8_unicode_ci default NULL,
  `game_id` int(10) unsigned NOT NULL,
  `eventtype_id` int(10) unsigned NOT NULL,
  `status` enum('signup','postsignup','active','closed','finished') collate utf8_unicode_ci default 'signup',
  `created` datetime default NULL,
  `teamcount` int(11) default NULL,
  `genmatches` tinyint(4) default NULL,
  `regdate` datetime default NULL,
  `startdate` datetime default NULL,
  `matchinterval` int(11) default NULL,
  `desc` text collate utf8_unicode_ci,
  `user_id` int(11) unsigned NOT NULL,
  `teamsize` int(11) default NULL,
  `org_id` int(11) default NULL,
  `enddate` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_Events_Games` (`game_id`),
  KEY `fk_Events_Event_types` (`eventtype_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0 AUTO_INCREMENT=31 ;

-- 
-- Dumping data for table `events`
-- 

INSERT INTO `events` (`id`, `name`, `game_id`, `eventtype_id`, `status`, `created`, `teamcount`, `genmatches`, `regdate`, `startdate`, `matchinterval`, `desc`, `user_id`, `teamsize`, `org_id`, `enddate`) VALUES 
(1, 'Warcraft premiere league', 1, 1, 'active', '2009-01-23 17:50:37', 16, 1, NULL, NULL, NULL, NULL, 1, 2, 1, NULL),
(2, 'Premiership of smth', 2, 1, 'closed', '2008-05-23 17:50:37', NULL, 1, NULL, NULL, NULL, NULL, 14, 5, 1, NULL),
(13, 'summer cup 2on2 I', 2, 1, 'signup', '2008-07-09 16:14:52', 8, 1, NULL, '0000-00-00 02:00:00', NULL, NULL, 1, 5, 1, NULL),
(19, 'rrr', 2, 1, 'finished', '2008-08-17 15:48:08', 8, 1, NULL, NULL, NULL, NULL, 14, 5, 1, NULL),
(21, 'quickcup', 2, 1, 'finished', '2008-08-19 17:27:47', 8, 1, NULL, '2008-08-21 21:27:00', NULL, NULL, 1, 5, 2, NULL),
(22, 'AIM MAP SS', 2, 1, 'closed', '2008-09-10 11:45:30', 8, 1, NULL, '2008-09-13 09:00:00', NULL, NULL, 19, 1, 1, NULL),
(23, 'Test', 2, 1, 'closed', '2008-09-12 17:39:20', 8, 1, NULL, '2008-11-12 17:38:00', NULL, NULL, 19, 1, 1, NULL),
(24, 'aaaaa', 2, 1, 'signup', '2008-09-15 18:06:24', 8, 1, NULL, '2008-09-15 18:06:00', NULL, NULL, 1, 1, 1, NULL),
(25, 'zzzz', 2, 1, 'signup', '2008-09-15 18:07:03', 8, 1, NULL, '2008-09-15 18:06:00', NULL, NULL, 1, 1, 1, NULL),
(26, 'eeee', 2, 1, 'signup', '2008-09-15 18:07:42', 8, 1, NULL, '2008-09-15 18:06:00', NULL, NULL, 1, 2, 1, NULL),
(27, 'test', 1, 1, 'active', '2008-09-21 15:03:38', 4, 1, NULL, '2008-09-15 18:06:00', NULL, NULL, 1, 5, 2, NULL),
(28, 'Slam Bang I', 3, 1, 'signup', '2008-09-29 23:42:19', 16, 1, NULL, NULL, NULL, NULL, 1, 2, 1, NULL),
(29, 'c', 3, 1, 'signup', '2008-12-09 23:46:20', 8, 1, NULL, '2008-12-09 23:35:00', NULL, NULL, 1, 1, 1, NULL),
(30, 'cooood', 3, 1, 'closed', '2008-12-09 23:50:46', 8, 1, NULL, '2008-12-09 23:50:00', NULL, NULL, 1, 1, 2, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `eventteams`
-- 

CREATE TABLE `eventteams` (
  `event_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `level` enum('S','A','K') collate utf8_unicode_ci NOT NULL default 'S',
  PRIMARY KEY  (`id`),
  KEY `fk_events_has_teams_events` (`event_id`),
  KEY `fk_events_has_teams_teams` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=143 ;

-- 
-- Dumping data for table `eventteams`
-- 

INSERT INTO `eventteams` (`event_id`, `team_id`, `id`, `level`) VALUES 
(1, 12, 87, 'A'),
(13, 23, 97, 'A'),
(19, 21, 111, 'A'),
(19, 22, 112, 'A'),
(19, 26, 115, 'A'),
(19, 27, 116, 'A'),
(19, 16, 119, 'A'),
(21, 28, 123, 'A'),
(21, 25, 124, 'A'),
(21, 30, 126, 'A'),
(26, 41, 127, 'S'),
(26, 58, 128, 'S'),
(13, 61, 130, 'A'),
(26, 62, 131, 'S'),
(27, 59, 135, 'A'),
(27, 19, 136, 'A'),
(27, 18, 137, 'A'),
(27, 24, 138, 'A'),
(28, 56, 139, 'S'),
(30, 64, 140, 'A'),
(30, 65, 141, 'S'),
(24, 66, 142, 'S');

-- --------------------------------------------------------

-- 
-- Table structure for table `eventtypes`
-- 

CREATE TABLE `eventtypes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(45) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `eventtypes`
-- 

INSERT INTO `eventtypes` (`id`, `name`) VALUES 
(1, 'cup');

-- --------------------------------------------------------

-- 
-- Table structure for table `feeds`
-- 

CREATE TABLE `feeds` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) collate utf8_unicode_ci default NULL,
  `url` varchar(255) collate utf8_unicode_ci default NULL,
  `show` tinyint(1) default NULL,
  `game_id` int(11) unsigned default NULL,
  `source` varchar(32) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `game_id` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `feeds`
-- 

INSERT INTO `feeds` (`id`, `name`, `url`, `show`, `game_id`, `source`) VALUES 
(1, 'sk_all', 'http://www.sk-gaming.com/rss/', 1, 0, 'SK Gaming'),
(2, 'sk_cod4', 'http://www.sk-gaming.com/rss/channel/cod4', 1, 3, 'SK Gaming'),
(3, 'sk_cs', 'http://www.sk-gaming.com/rss/channel/cs', 1, 1, 'SK Gaming'),
(4, 'cadred_all', 'http://www.cadred.org/Rss/Channel/1/', 1, 0, 'Cadred'),
(5, 'cadred_coverage', 'http://www.cadred.org/Rss/Channel/2/', 1, 0, 'Cadred'),
(6, 'gotfrag_all', 'http://www.gotfrag.com/portal/xact/xml/?f=stories&a=any', 1, 0, 'Gotfrag'),
(7, 'gotfrag_cs', 'http://www.gotfrag.com/portal/xact/xml/?f=stories&a=cs', 1, 1, 'Gotfrag'),
(8, 'gotfrag_css', 'http://www.gotfrag.com/portal/xact/xml/?f=stories&a=css', 1, 2, 'Gotfrag'),
(9, 'gotfrag_cod4', 'http://www.gotfrag.com/portal/xact/xml/?f=stories&a=cod', 1, 3, 'Gotfrag'),
(10, 'sk_wc3', 'http://www.sk-gaming.com/rss/channel/wc3', 1, 4, 'SK Gaming'),
(11, 'gotfrag_wc3', 'http://www.gotfrag.com/portal/xact/xml/?f=stories&a=war', 1, 4, 'Gotfrag'),
(12, 'cgs_all', 'http://feeds.feedburner.com/ChampionshipGamingSeriesNewsAndFeatures?format=xml', 0, 0, 'CGS'),
(13, 'cb_all', 'http://clanbase.ggl.com/rss.php', 0, 0, 'Clanbase');

-- --------------------------------------------------------

-- 
-- Table structure for table `games`
-- 

CREATE TABLE `games` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(45) collate utf8_unicode_ci default NULL,
  `icon` varchar(50) collate utf8_unicode_ci default NULL,
  `avatar` varchar(50) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `games`
-- 

INSERT INTO `games` (`id`, `name`, `icon`, `avatar`) VALUES 
(1, 'Counter-Strike', '/img/uploads/games/cs.jpg', '/img/uploads/games/cs_big.gif'),
(2, 'Counter-Strike: Source', '/img/uploads/games/css.gif', '/img/uploads/games/css_big_rough.gif'),
(3, 'Call of Duty 4', '/img/uploads/games/cod4.gif', '/img/uploads/games/cod4_big.gif'),
(4, 'Warcraft 3', '/img/uploads/games/war3.gif ', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `gamewords`
-- 

CREATE TABLE `gamewords` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `label` varchar(45) collate utf8_unicode_ci default NULL,
  `value` varchar(45) collate utf8_unicode_ci default NULL,
  `game_id` int(10) unsigned NOT NULL,
  `lang_id` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_gamedict_games` (`game_id`),
  KEY `fk_gamewords_langs` (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `gamewords`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `groups`
-- 

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `redirect` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `perm_type` enum('allow','deny') character set latin1 NOT NULL default 'allow',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `groups`
-- 

INSERT INTO `groups` (`id`, `name`, `level`, `redirect`, `perm_type`, `created`, `modified`) VALUES 
(1, 'webmasters', 300, '', 'allow', '0000-00-00 00:00:00', '2008-02-27 01:33:05'),
(2, 'editors', 200, '', 'allow', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'members', 100, '', 'allow', '0000-00-00 00:00:00', '2008-03-22 18:34:13'),
(4, 'organizations', 150, '', 'allow', '0000-00-00 00:00:00', '2008-12-13 13:30:57');

-- --------------------------------------------------------

-- 
-- Table structure for table `groups_permissions`
-- 

CREATE TABLE `groups_permissions` (
  `group_id` int(10) unsigned NOT NULL default '0',
  `permission_id` int(10) unsigned NOT NULL default '0',
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `groups_permissions`
-- 

INSERT INTO `groups_permissions` (`group_id`, `permission_id`) VALUES 
(1, 1),
(2, 2),
(3, 6),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(1, 18),
(2, 18),
(3, 18),
(1, 19),
(2, 19),
(3, 19),
(1, 20),
(2, 20),
(3, 20),
(1, 21),
(2, 21),
(3, 21),
(4, 22),
(4, 14),
(4, 16),
(4, 24),
(4, 23),
(4, 28),
(4, 27),
(4, 15),
(4, 25),
(4, 26),
(4, 11),
(4, 21),
(4, 12),
(4, 9),
(4, 10),
(4, 17),
(4, 18),
(4, 20),
(4, 19),
(4, 13);

-- --------------------------------------------------------

-- 
-- Table structure for table `grouptables`
-- 

CREATE TABLE `grouptables` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci default NULL,
  `event_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `grouptables`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `images`
-- 

CREATE TABLE `images` (
  `id` int(5) NOT NULL auto_increment,
  `caption` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `alttext` varchar(255) NOT NULL,
  `folder` int(3) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `images`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `image_folders`
-- 

CREATE TABLE `image_folders` (
  `id` int(3) NOT NULL auto_increment,
  `caption` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `image_folders`
-- 

INSERT INTO `image_folders` (`id`, `caption`) VALUES 
(10, 'Flags'),
(11, 'Banners'),
(12, 'Photo');

-- --------------------------------------------------------

-- 
-- Table structure for table `infocats`
-- 

CREATE TABLE `infocats` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci default NULL,
  `game_id` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `game_id` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `infocats`
-- 

INSERT INTO `infocats` (`id`, `name`, `game_id`) VALUES 
(1, 'Premiere cup', 1),
(2, 'general', 2),
(3, 'general', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `infocomments`
-- 

CREATE TABLE `infocomments` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `body` text collate utf8_unicode_ci,
  `created` datetime default NULL,
  `user_id` int(11) unsigned default NULL,
  `info_id` int(10) unsigned default NULL,
  `seqnumber` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `info_id` (`info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `infocomments`
-- 

INSERT INTO `infocomments` (`id`, `body`, `created`, `user_id`, `info_id`, `seqnumber`) VALUES 
(1, 'Stet partem vix ne, probo exerci iisque cum no. Aliquip vituperata ei vel. Ne per modo putant. In quo utroque epicurei sadipscing, summo sonet in ius.', '2008-03-30 13:53:38', 1, 3, NULL),
(2, 'Ei vero aeterno sed. Sit saperet deseruisse ut. Quando animal sadipscing eu per, omnium aeterno honestatis ut nam. Populo tritani sea ne, sale aeque et pro.', '2008-03-30 13:53:58', 1, 3, NULL),
(3, 'aaa', '2008-03-30 14:54:11', 1, 3, NULL),
(4, 'This is my new comment', '2008-03-30 14:54:26', 1, 3, NULL),
(5, 'I cant read this !', '2008-03-30 14:54:40', 1, 3, NULL),
(6, ' Mel augue deterruisset no, mutat nonumy propriae mel an, ei his movet ponderum. No quo natum minimum electram.', '2008-03-30 14:57:53', 1, 2, NULL),
(7, 'adasdasd', '2008-03-30 16:16:13', 1, 3, NULL),
(8, 'aaa', '2008-03-30 16:18:03', 15, 1, NULL),
(9, 'this is not so difficult !', '2008-03-30 16:18:22', 15, 1, NULL),
(10, 'I am commenting this', '2008-09-08 18:00:52', 1, 5, NULL),
(11, 'aaa', '2008-09-08 18:08:57', 1, 5, 1),
(12, 'zzz', '2008-09-08 18:09:11', 1, 5, 2),
(13, ' i write something here', '2008-09-09 00:15:53', 1, 1, 1),
(14, ':D just testing... :)', '2008-09-12 23:01:20', 25, 3, 1),
(15, 'eee', '2008-09-16 18:22:42', 14, 5, 3),
(16, 'eeee', '2008-10-11 01:17:59', 1, 3, 2),
(17, 'ypy\r\n', '2008-10-11 01:18:08', 1, 3, 3),
(18, 'yay hei !', '2008-10-11 01:25:09', 1, 3, 4);

-- --------------------------------------------------------

-- 
-- Table structure for table `infos`
-- 

CREATE TABLE `infos` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(50) collate utf8_unicode_ci default NULL,
  `desc` text collate utf8_unicode_ci,
  `body` text collate utf8_unicode_ci,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `user_id` int(11) unsigned default NULL,
  `infocat_id` int(11) unsigned NOT NULL,
  `lang_id` int(11) unsigned NOT NULL,
  `game_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `infocat_id` (`infocat_id`),
  KEY `lang_id` (`lang_id`),
  KEY `game_id` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `infos`
-- 

INSERT INTO `infos` (`id`, `title`, `desc`, `body`, `created`, `modified`, `user_id`, `infocat_id`, `lang_id`, `game_id`) VALUES 
(1, 'Neque porro quisquam est qui dolorem ipsum quia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nunc mi eros, posuere semper, blandit in, feugiat sit amet, nunc. Suspendisse potenti. Aliquam quam ante, pretium tempus, elementum et, pretium ac, neque. Suspendisse nec velit vel enim egestas fermentum. Nullam et pede nec lectus rutrum accumsan. Etiam leo. Etiam sed augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec gravida mi non ipsum. Donec arcu neque, pulvinar nec, egestas in, aliquet sit amet, eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed ligula tellus, tincidunt ut, iaculis a, tristique quis, risus. Suspendisse potenti. ', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nunc mi eros, posuere semper, blandit in, feugiat sit amet, nunc. Suspendisse potenti. Aliquam quam ante, pretium tempus, elementum et, pretium ac, neque. Suspendisse nec velit vel enim egestas fermentum. Nullam et pede nec lectus rutrum accumsan. Etiam leo. Etiam sed augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec gravida mi non ipsum. Donec arcu neque, pulvinar nec, egestas in, aliquet sit amet, eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed ligula tellus, tincidunt ut, iaculis a, tristique quis, risus. Suspendisse potenti.\r\n\r\nIn eget dui. Nam dictum. Proin vitae odio. Nullam id est. Phasellus ullamcorper nisl sed magna. Sed interdum arcu quis nunc. Aliquam pharetra sodales est. Ut purus nulla, pretium ac, volutpat sit amet, consequat sit amet, quam. Vestibulum imperdiet nulla cursus elit. Vivamus auctor odio vitae nisi. Ut dictum semper ante. Nulla pharetra lacus a nibh. Phasellus tincidunt. Curabitur eros felis, sodales non, varius eu, malesuada sed, turpis. Maecenas aliquet, justo eu ultricies pretium, nulla diam rutrum dui, in volutpat nunc felis eu arcu.\r\n\r\nIn hac habitasse platea dictumst. Duis blandit. Nunc urna. Donec sapien odio, egestas et, fringilla porta, aliquet nec, erat. Fusce ligula. Vestibulum rutrum, dolor sit amet lobortis pretium, felis est adipiscing dui, et iaculis purus libero ac libero. Aliquam luctus velit at odio. Aliquam vulputate ultrices ligula. Aliquam varius blandit sem. Curabitur iaculis, ipsum at commodo iaculis, mi tortor congue ligula, sit amet elementum risus leo a dui.\r\n\r\nCurabitur eget nibh eget erat ultrices rutrum. Cras lacus. In quis leo. Suspendisse lectus. Suspendisse dui. Duis et urna. Phasellus euismod ipsum vitae nunc. Nulla scelerisque. Suspendisse potenti. Proin sollicitudin interdum tortor. Phasellus tincidunt pede at pede. Duis blandit. Sed porta eleifend enim.\r\n\r\nMaecenas nec massa. Aliquam quis leo ut mauris sodales faucibus. Donec blandit augue sed ante. In consequat iaculis massa. In aliquet suscipit dolor. Curabitur tincidunt nunc nec orci. Sed commodo purus id mauris. Proin felis velit, ullamcorper ut, lacinia id, sodales suscipit, turpis. Curabitur eleifend posuere nunc. Donec velit sem, tempor placerat, facilisis in, sagittis id, neque. Aliquam in metus in neque rutrum porta. Integer non arcu. Maecenas neque. Phasellus ligula ligula, feugiat id, luctus a, egestas sit amet, mi. Vivamus fermentum suscipit quam.\r\n', '2008-03-29 19:21:20', '2008-03-29 19:21:20', 1, 1, 2, 1),
(2, 'There is no one who loves pain itself', 'Sed et neque. Praesent ultricies dui nec leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse vulputate sem. Nunc ultricies consequat dolor. Aenean tellus augue, rutrum sit amet, vehicula elementum, varius a, odio. Quisque ornare mi at ante. Curabitur varius. Curabitur gravida.', 'Lius vulputate legentis erat. Iriure cum habent eorum eua sequitur autem placerat litterarum et. Lius eu per consectetuer id ii. Exerci processus luptatum diam assum. In claritas eros delenit ex nostrud possim quam diam. Lectorum quod, te formas. Anteposuerit dolor adipiscing tempor typi me. Est non eorum clari at. Ad facit cum vero. Usus, duis eua euismod et blandit eu. Nulla eleifend, litterarum videntur id humanitatis consectetuer. Quinta mutationem futurum ii.', '2008-03-29 19:29:59', '2008-03-30 15:22:31', 1, 1, 2, 1),
(3, 'Autem nobis, notare assum sit sed nisl aliquam ins', '<p align="justify">Et commodo erat, wisi legere. Enim te, autem eum, aliquam, accumsan formas per. Parum vel anteposuerit ullamcorper erat iriure dignissim me. Est qui nobis legere eodem augue adipiscing. Laoreet seacula, eorum non feugiat at ad demonstraverunt futurum augue cum. Humanitatis praesent littera legentis litterarum illum mirum eros blandit laoreet. Eua, possim lius praesent et autem diam eu nibh id. Nostrud fiant, ii assum notare in. Ex vero te lectorum volutpat lorem me. Iriure dynamicus placerat lobortis lorem liber velit est non lectorum.</p>', '<p align="justify">&nbsp;&nbsp;&nbsp; <img src="/skygames/img/uploads/Image/pirates.gif" alt="" width="82" height="87" align="right" />Et commodo erat, wisi legere. Enim te, autem eum, aliquam, accumsan formas per. Parum vel anteposuerit ullamcorper erat iriure dignissim me. Est qui nobis legere eodem augue adipiscing. Laoreet seacula, eorum non feugiat at ad demonstraverunt futurum augue cum. Humanitatis praesent littera legentis litterarum illum mirum eros blandit laoreet. Eua, possim lius praesent et autem diam eu nibh id. Nostrud fiant, ii assum notare in. Ex vero te lectorum volutpat lorem me. Iriure dynamicus placerat lobortis lorem liber velit est non lectorum.</p>', '2008-03-29 20:00:14', '2008-03-30 13:41:54', 1, 1, 2, 1),
(5, 'Yellowstone fires of 1988', '&nbsp;&nbsp;&nbsp; The Yellowstone fires of 1988 together formed the largest wildfire in the recorded history of Yellowstone National Park, United States. Starting as many smaller individual fires, the flames spread quickly out of control with increasing winds and drought and combined into one large conflagration, which burned for several months. The fires almost destroyed two major visitor destinations and, on September 8, 1988, the entire park was closed to all non-emergency personnel for the first time in its history. Only the arrival of cool and moist weather in the late fall brought the fires to an end. A total of 793,880 acres (3,213 km2), or roughly 36 percent of the park was affected by the wildfires. Thousands of firefighters fought the fires, assisted by dozens of helicopters and fixed-wing aircraft which were used for water and fire retardant drops. At the peak of the effort, over 9,000 firefighters were assigned to the park. The Yellowstone fires of 1988 were unprecedented in the history of the National Park Service, and many questioned existing fire management policies. Media accounts of mismanagement were often sensational and inaccurate, sometimes wrongly reporting that most of the park was being destroyed. While there were temporary declines in air quality during the fires, no adverse long-term health effects have been recorded in the ecosystem.', 'The Yellowstone fires of 1988 together formed the largest wildfire in the recorded history of Yellowstone National Park, United States. Starting as many smaller individual fires, the flames spread quickly out of control with increasing winds and drought and combined into one large conflagration, which burned for several months. The fires almost destroyed two major visitor destinations and, on September 8, 1988, the entire park was closed to all non-emergency personnel for the first time in its history. Only the arrival of cool and moist weather in the late fall brought the fires to an end. A total of 793,880 acres (3,213 km2), or roughly 36 percent of the park was affected by the wildfires. Thousands of firefighters fought the fires, assisted by dozens of helicopters and fixed-wing aircraft which were used for water and fire retardant drops. At the peak of the effort, over 9,000 firefighters were assigned to the park. The Yellowstone fires of 1988 were unprecedented in the history of the National Park Service, and many questioned existing fire management policies. Media accounts of mismanagement were often sensational and inaccurate, sometimes wrongly reporting that most of the park was being destroyed. While there were temporary declines in air quality during the fires, no adverse long-term health effects have been recorded in the ecosystem.', '2008-08-24 16:40:41', '2008-09-08 17:22:33', 1, 1, 1, 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `langs`
-- 

CREATE TABLE `langs` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(45) collate utf8_unicode_ci default NULL,
  `code` char(3) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `langs`
-- 

INSERT INTO `langs` (`id`, `name`, `code`) VALUES 
(1, 'English', 'eng'),
(2, 'Lithuanian', 'lit'),
(3, 'Latvian', 'lva');

-- --------------------------------------------------------

-- 
-- Table structure for table `maps`
-- 

CREATE TABLE `maps` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(45) collate utf8_unicode_ci default NULL,
  `game_id` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `game_id` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

-- 
-- Dumping data for table `maps`
-- 

INSERT INTO `maps` (`id`, `title`, `game_id`) VALUES 
(1, 'de_season', 1),
(34, 'de_storage', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `matchcomments`
-- 

CREATE TABLE `matchcomments` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `body` text collate utf8_unicode_ci,
  `created` datetime default NULL,
  `user_id` int(11) unsigned default NULL,
  `match_id` int(10) unsigned default NULL,
  `seqnumber` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `match_id` (`match_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=5461 COMMENT='InnoDB free: 10240 kB; (`user_id`) REFER `skygames/users`(`i' AUTO_INCREMENT=20 ;

-- 
-- Dumping data for table `matchcomments`
-- 

INSERT INTO `matchcomments` (`id`, `body`, `created`, `user_id`, `match_id`, `seqnumber`) VALUES 
(1, 'aaaa', '2008-10-10 00:00:00', 1, 71, 1),
(2, 'nnnnn', '2008-08-25 00:00:00', 1, 71, 2),
(3, 'zzzz', '2008-10-01 00:00:00', 1, 71, 3),
(8, NULL, '2008-10-03 22:31:22', 1, NULL, NULL),
(9, NULL, '2008-10-03 22:32:47', 1, NULL, NULL),
(10, 'aaa', '2008-10-03 22:35:03', 1, 5, NULL),
(11, 'levas', '2008-10-03 22:37:26', 1, 5, NULL),
(12, 'aaaa', '2008-10-03 22:38:02', 1, 5, NULL),
(13, 'rrrrr', '2008-10-03 22:38:08', 1, 5, NULL),
(14, 'eee', '2008-10-03 22:38:19', 1, 5, NULL),
(15, 'trar', '2008-10-03 22:40:31', 1, 5, 1),
(16, 'aaaa\r\nzzzz', '2008-10-10 14:49:55', 1, 5, 2),
(17, 'adasd', '2008-10-10 23:41:49', 1, 5, 3),
(18, 'asdasd', '2008-10-10 23:41:55', 1, 5, 4),
(19, 'zzzz', '2008-10-11 01:14:03', 1, 5, 5);

-- --------------------------------------------------------

-- 
-- Table structure for table `matches`
-- 

CREATE TABLE `matches` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `team1_id` int(10) unsigned NOT NULL,
  `team2_id` int(10) unsigned NOT NULL,
  `event_id` int(10) unsigned default NULL,
  `tposition_x` int(11) default NULL,
  `tposition_y` int(11) default NULL,
  `playofftable_id` int(11) default NULL,
  `date` datetime default NULL,
  `modified` datetime default NULL,
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_Matches_Teams` (`team1_id`),
  KEY `fk_Matches_Teams1` (`team2_id`),
  KEY `fk_Matches_Events` (`event_id`),
  KEY `fk_matches_playofftables` (`playofftable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=1820 PACK_KEYS=0 COMMENT='InnoDB free: 10240 kB; (`event_id`) REFER `skygames/events`(' AUTO_INCREMENT=143 ;

-- 
-- Dumping data for table `matches`
-- 

INSERT INTO `matches` (`id`, `team1_id`, `team2_id`, `event_id`, `tposition_x`, `tposition_y`, `playofftable_id`, `date`, `modified`, `user_id`) VALUES 
(5, 12, 12, 1, 1, 3, 1, NULL, '2008-10-06 20:46:31', NULL),
(6, 19, 18, 1, 1, 4, 1, NULL, '2008-09-21 01:12:08', NULL),
(13, 16, 15, 1, 1, 1, 1, NULL, NULL, NULL),
(15, 12, 12, 1, 2, 2, 1, NULL, '2008-10-06 16:36:55', NULL),
(16, 20, 28, 1, 1, 5, 1, NULL, NULL, NULL),
(17, 27, 21, 1, 1, 6, 1, NULL, NULL, NULL),
(18, 25, 26, 1, 1, 7, 1, NULL, NULL, NULL),
(20, 24, 19, 1, 2, 1, 1, NULL, NULL, NULL),
(21, 16, 12, 1, 2, 2, 1, NULL, NULL, NULL),
(22, 28, 27, 1, 2, 3, 1, NULL, NULL, NULL),
(24, 23, 18, 1, -1, 1, 1, NULL, NULL, NULL),
(25, 15, 17, 1, -1, 2, 1, NULL, NULL, NULL),
(26, 20, 21, 1, -1, 3, 1, NULL, NULL, NULL),
(27, 25, 22, 1, -1, 4, 1, NULL, NULL, NULL),
(56, 19, 12, 1, 3, 1, 1, NULL, NULL, NULL),
(58, 18, 24, 1, -2, 1, 1, NULL, NULL, NULL),
(59, 15, 16, 1, -2, 2, 1, NULL, NULL, NULL),
(60, 21, 27, 1, -2, 3, 1, NULL, NULL, NULL),
(61, 22, 26, 1, -2, 4, 1, NULL, NULL, NULL),
(62, 18, 16, 1, -3, 1, 1, NULL, NULL, NULL),
(63, 27, 26, 1, -3, 2, 1, NULL, NULL, NULL),
(64, 12, 28, 1, 4, 1, 1, NULL, NULL, NULL),
(67, 16, 19, 1, -4, 1, 1, NULL, NULL, NULL),
(69, 19, 12, 1, -6, 1, 1, NULL, NULL, NULL),
(70, 12, 28, 1, 0, 0, 1, NULL, NULL, NULL),
(71, 18, 25, 13, 1, 1, 12, '2008-10-13 18:25:00', '2008-10-14 18:28:34', 1),
(72, 23, 61, 13, 1, 2, 12, '2008-03-05 18:54:00', '2008-10-05 21:14:48', NULL),
(73, 20, 16, 13, 1, 3, 12, NULL, NULL, NULL),
(74, 21, 15, 13, 1, 4, 12, NULL, NULL, NULL),
(79, 26, 27, 19, 1, 1, 18, NULL, NULL, 1),
(80, 18, 24, 19, 1, 2, 18, NULL, NULL, NULL),
(81, 21, 16, 19, 1, 3, 18, NULL, NULL, NULL),
(82, 22, 30, 19, 1, 4, 18, NULL, NULL, NULL),
(107, 28, 24, 21, 1, 1, 20, '2008-09-09 21:42:00', '2008-09-09 21:44:05', NULL),
(108, 19, 25, 21, 1, 2, 20, NULL, NULL, NULL),
(109, 30, 20, 21, 1, 3, 20, NULL, NULL, NULL),
(111, 28, 19, 21, 2, 1, 20, NULL, NULL, NULL),
(113, 28, 30, 21, 3, 1, 20, NULL, NULL, NULL),
(114, 26, 18, 19, 2, 1, 18, NULL, NULL, NULL),
(115, 21, 22, 19, 2, 2, 18, NULL, NULL, NULL),
(116, 27, 24, 19, -1, 2, 18, NULL, NULL, NULL),
(117, 16, 30, 19, -1, 1, 18, NULL, NULL, NULL),
(118, 26, 21, 19, 3, 1, 18, NULL, NULL, NULL),
(119, 27, 18, 19, -2, 1, 18, NULL, NULL, NULL),
(120, 16, 22, 19, -2, 2, 18, NULL, NULL, NULL),
(121, 27, 16, 19, -3, 1, 18, NULL, NULL, NULL),
(122, 27, 21, 19, -4, 1, 18, NULL, NULL, NULL),
(123, 27, 26, 19, 0, 0, 18, NULL, NULL, NULL),
(124, 26, 18, 19, 2, 1, 18, NULL, NULL, NULL),
(125, 21, 22, 19, 2, 2, 18, NULL, NULL, NULL),
(126, 27, 24, 19, -1, 2, 18, NULL, NULL, NULL),
(127, 16, 30, 19, -1, 1, 18, NULL, NULL, NULL),
(128, 27, 16, 19, -3, 1, 18, NULL, NULL, NULL),
(129, 27, 21, 19, -4, 1, 18, NULL, NULL, NULL),
(130, 27, 26, 19, 0, 0, 18, NULL, NULL, NULL),
(131, 26, 18, 19, 2, 1, 18, NULL, NULL, NULL),
(132, 21, 22, 19, 2, 2, 18, NULL, NULL, NULL),
(133, 27, 24, 19, -1, 2, 18, NULL, NULL, NULL),
(134, 16, 30, 19, -1, 1, 18, NULL, NULL, NULL),
(135, 16, 12, 1, 2, 1, 1, NULL, '2008-09-08 14:33:25', 31),
(141, 20, 21, 1, -1, 2, 1, NULL, '2008-09-08 14:33:25', NULL),
(142, 25, 22, 1, -1, 1, 1, NULL, '2008-09-08 14:33:25', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `matchparts`
-- 

CREATE TABLE `matchparts` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(45) collate utf8_unicode_ci default NULL,
  `game_id` int(10) unsigned default NULL,
  `constant` tinyint(1) default NULL,
  `final` tinyint(1) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_matchparts_games` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `matchparts`
-- 

INSERT INTO `matchparts` (`id`, `title`, `game_id`, `constant`, `final`) VALUES 
(1, 'Final score', 1, 1, 1),
(2, 'First half', 1, 0, 0),
(3, 'Second half', 1, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `memberships`
-- 

CREATE TABLE `memberships` (
  `user_id` int(11) unsigned default NULL,
  `team_id` int(11) unsigned default NULL,
  `id` int(11) NOT NULL auto_increment,
  `status` enum('invited','member') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `team_id` (`team_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

-- 
-- Dumping data for table `memberships`
-- 

INSERT INTO `memberships` (`user_id`, `team_id`, `id`, `status`) VALUES 
(NULL, 18, 13, 'invited'),
(NULL, 37, 23, 'invited'),
(13, 23, 32, 'member'),
(13, 17, 35, 'member'),
(13, 20, 37, 'member'),
(13, 38, 43, 'member'),
(13, 37, 44, 'member'),
(13, 39, 45, 'member'),
(27, 59, 50, 'invited'),
(13, 61, 51, 'invited'),
(27, 19, 52, 'invited'),
(27, 18, 53, 'invited'),
(27, 24, 54, 'invited'),
(28, 56, 55, 'invited'),
(1, 25, 56, 'member'),
(19, 25, 57, 'invited');

-- --------------------------------------------------------

-- 
-- Table structure for table `menus`
-- 

CREATE TABLE `menus` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(64) character set latin1 default NULL,
  `link` varchar(255) character set latin1 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `menus`
-- 

INSERT INTO `menus` (`id`, `title`, `link`) VALUES 
(3, 'users', '/users/index'),
(6, 'events', '/events/index'),
(7, 'teams', '/teams/index'),
(8, 'news', '/infos/index'),
(9, 'forums', '/threadcats/index'),
(10, 'stats', '/statistics/index'),
(11, 'e-scene', '/feeds/index ');

-- --------------------------------------------------------

-- 
-- Table structure for table `orgs`
-- 

CREATE TABLE `orgs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `show` bit(1) default NULL,
  `name` varchar(50) collate utf8_unicode_ci default NULL,
  `user_id` int(10) unsigned default NULL,
  `created` datetime default NULL,
  `website` varchar(40) collate utf8_unicode_ci default NULL,
  `irc` varchar(40) collate utf8_unicode_ci default NULL,
  `logo_url` varchar(40) collate utf8_unicode_ci default NULL,
  `country_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `orgs`
-- 

INSERT INTO `orgs` (`id`, `show`, `name`, `user_id`, `created`, `website`, `irc`, `logo_url`, `country_id`) VALUES 
(1, '', 'NGA', NULL, NULL, NULL, NULL, '/v2/img/uploads/logos/banner20.gif', NULL),
(2, '', 'skygames.cod4', 1, '2008-12-09 23:49:26', 'www.skygames.lt', '#skygames.cod4', '/v2/img/uploads/logos/banner24.gif', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `permissions`
-- 

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) character set latin1 NOT NULL default '',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `permissions`
-- 

INSERT INTO `permissions` (`id`, `name`, `created`, `modified`) VALUES 
(1, '*', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'news', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'menus/view', '0000-00-00 00:00:00', '2008-02-27 00:29:58'),
(7, 'menus', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'groups/edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'teams/add', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'teams/edit', '0000-00-00 00:00:00', '2008-03-22 18:45:45'),
(11, 'teamplayers/add', '0000-00-00 00:00:00', '2008-03-22 18:47:31'),
(12, 'teamplayers/edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'users/edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'events/sign', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'posts/add', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'infocomments/add', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'threads/add', '0000-00-00 00:00:00', '2008-09-09 00:41:49'),
(18, 'uniqueids/add', '0000-00-00 00:00:00', '2008-09-16 16:09:40'),
(19, 'uniqueids/edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'uniqueids/delete', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'teamplayers/delete', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'events/add', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'matches/edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'matches/add', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'results/add', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'results/edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'orgs/promote', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'orgs/edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `playofftables`
-- 

CREATE TABLE `playofftables` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(45) collate utf8_unicode_ci default NULL,
  `events_id` int(10) unsigned default NULL,
  `size` int(11) default NULL,
  `type` enum('S','D') collate utf8_unicode_ci NOT NULL,
  `theme` varchar(50) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_playofftables_events` (`events_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

-- 
-- Dumping data for table `playofftables`
-- 

INSERT INTO `playofftables` (`id`, `name`, `events_id`, `size`, `type`, `theme`) VALUES 
(1, 'Main', 1, 16, 'D', 'skygames16'),
(12, 'summer cup 2on2 I', 13, 8, 'D', 'cs16'),
(18, 'rrr', 19, 8, 'D', 'cs16'),
(20, 'quickcup', 21, 8, 'S', 'cs8'),
(21, 'AIM MAP SS', 22, 8, 'S', 'cs8'),
(22, 'Test', 23, 4, 'D', 'nga8'),
(23, 'test', 27, 8, 'D', 'cs16'),
(24, 'Slam Bang I', 28, 32, 'S', 'cs16'),
(25, 'c', 29, 8, 'S', 'skygames8'),
(26, 'cooood', 30, 8, 'D', 'cs16');

-- --------------------------------------------------------

-- 
-- Table structure for table `posts`
-- 

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(50) character set latin1 default NULL,
  `body` text character set latin1,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `user_id` int(11) unsigned default NULL,
  `thread_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `thread_id` (`thread_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- 
-- Dumping data for table `posts`
-- 

INSERT INTO `posts` (`id`, `title`, `body`, `created`, `modified`, `user_id`, `thread_id`) VALUES 
(1, '', 'Ador ceceo oz dio. Semi panjo dekumi ene el, tiam troa ist i. Ien be tiom subigi dupunkto. Ba plus memmortigo san, fi speco lanta futuro sur.', '2008-03-30 18:38:53', '2008-03-30 18:38:53', 1, 1),
(2, '', 'Urino ligfinaÄµo bo tro. An neÅ­trala kvintiliono ajn, er vir multo multiplikite antaÅ­tagmezo, igi iz stopi neoficiala. Mf jes nura kioma, du kasedo popolnomo un'', sepen postpostmorgaÅ­ si poa. Nen disde pantalono co, fora ekzemploj to dum. Vic mili triliono gv, tioma tripunkto unu oz, hu por tera nome neado.', '2008-03-30 18:39:29', '2008-03-30 18:39:29', 15, 1),
(3, NULL, 'nomo minca familiano, arki zepto imperativo ies bv. Ilion estro nk ind, des io tial rilata, un'' mf patro dupunkto tiudirekten. Ilia solstariva vi sis.', '2008-03-30 18:46:54', '2008-03-30 18:46:54', NULL, 1),
(4, NULL, 'nomo minca familiano, arki zepto imperativo ies bv. Ilion estro nk ind, des io tial rilata, un'' mf patro dupunkto tiudirekten. Ilia solstariva vi sis.', '2008-03-30 18:48:31', '2008-03-30 18:48:31', 1, 1),
(5, NULL, 'I wanna falk on my table', '2008-04-07 22:40:13', '2008-04-07 22:40:13', 1, 5),
(6, NULL, 'aaaa', '2008-08-27 12:44:52', '2008-08-27 12:44:52', 1, 5),
(7, NULL, 'zzzzz', '2008-08-27 12:47:35', '2008-08-27 12:47:35', 14, 6),
(8, NULL, 'shite !', '2008-09-09 00:24:19', '2008-09-09 00:24:19', 14, 6),
(9, NULL, 'ssss', '2008-09-09 00:36:34', '2008-09-09 00:36:34', 14, 3),
(10, NULL, 'zzz', '2008-09-09 15:00:37', '2008-09-09 15:00:37', 14, 6),
(11, NULL, 'ssstrange', '2008-09-09 21:37:14', '2008-09-09 21:37:14', 14, 6),
(12, NULL, 'asdasd', '2008-09-09 23:34:49', '2008-09-09 23:34:49', 1, 5),
(13, NULL, '???', '2008-09-10 11:02:31', '2008-09-10 11:02:31', 19, 4),
(14, NULL, 'ok', '2008-09-12 23:03:41', '2008-09-12 23:03:41', 25, 7),
(15, NULL, 'aasd\r\nasdad\r\n', '2008-10-10 14:53:55', '2008-10-10 14:53:55', 1, 8),
(16, NULL, 'asdasd\r\nasdasd\r\nasdasd', '2008-10-17 16:08:44', '2008-10-17 16:08:44', 1, 11),
(17, NULL, 'asdasd', '2008-10-17 16:09:15', '2008-10-17 16:09:15', 1, 11),
(18, NULL, 'asdasd<br />\r\nasdasd', '2008-10-17 16:10:27', '2008-10-17 16:10:27', 1, 11),
(19, NULL, 'aaa<br />\r\na<br />\r\na<br />\r\na', '2008-11-02 12:34:43', '2008-11-02 12:34:43', 1, 11);

-- --------------------------------------------------------

-- 
-- Table structure for table `resultdemos`
-- 

CREATE TABLE `resultdemos` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(45) collate utf8_unicode_ci default NULL,
  `desc` varchar(45) collate utf8_unicode_ci default NULL,
  `url` varchar(45) collate utf8_unicode_ci default NULL,
  `result_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_resultdemos_results` (`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `resultdemos`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `resultpictures`
-- 

CREATE TABLE `resultpictures` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(45) collate utf8_unicode_ci default NULL,
  `desc` text collate utf8_unicode_ci,
  `url` varchar(45) collate utf8_unicode_ci default NULL,
  `result_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_resultpictures_results` (`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `resultpictures`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `results`
-- 

CREATE TABLE `results` (
  `id` int(11) NOT NULL auto_increment,
  `team1_score` int(11) default NULL,
  `team2_score` int(11) default NULL,
  `matchpart_id` int(11) default NULL,
  `match_id` int(10) unsigned default NULL,
  `map_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_results_matchparts` (`matchpart_id`),
  KEY `fk_results_matches` (`match_id`),
  KEY `fk_results_maps` (`map_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=1489 COMMENT='InnoDB free: 10240 kB; (`map_id`) REFER `skygames/maps`(`id`' AUTO_INCREMENT=170 ;

-- 
-- Dumping data for table `results`
-- 

INSERT INTO `results` (`id`, `team1_score`, `team2_score`, `matchpart_id`, `match_id`, `map_id`) VALUES 
(0, 16, 0, 1, 80, 1),
(22, 0, 1, 1, 16, 1),
(23, 1, 0, 1, 17, 1),
(27, 0, 1, 1, 20, 1),
(29, 1, 0, 1, 22, 1),
(31, 0, 1, 1, 24, 1),
(32, 1, 0, 1, 25, 1),
(33, 0, 1, 1, 26, 1),
(35, 0, 1, 1, 18, 1),
(43, 0, 1, 1, 27, 1),
(45, 1, 0, 1, 58, 1),
(46, 0, 1, 1, 59, 1),
(47, 0, 1, 1, 60, 1),
(50, 0, 1, 1, 61, 1),
(51, 0, 1, 1, 62, 1),
(52, 0, 1, 1, 63, 1),
(55, 0, 1, 1, 56, 1),
(56, 0, 1, 1, 64, 1),
(58, 0, 1, 1, 67, 1),
(61, 0, 1, 1, 69, 1),
(84, 1, 0, 1, 81, 1),
(85, 1, 0, 1, 82, 1),
(97, 1, 0, 1, 107, 1),
(98, 1, 0, 1, 108, 1),
(99, 1, 0, 1, 109, 1),
(101, 1, 0, 1, 111, 1),
(103, 1, 0, 1, 113, 1),
(104, 1, 0, 1, 79, 1),
(105, 1, 0, 1, 114, 1),
(106, 1, 0, 1, 135, 1),
(107, 1, 0, 1, 116, 1),
(108, 1, 0, 1, 117, 1),
(109, 1, 0, 1, 118, 1),
(115, 1, 0, 1, 119, 1),
(116, 1, 0, 1, 120, 1),
(117, 1, 0, 1, 121, 1),
(118, 1, 0, 1, 122, 1),
(120, 1, 0, 1, 123, 1),
(121, 10, 1, 1, 124, 1),
(123, 66, 66, 1, 142, 1),
(124, 16, 4, 1, 71, 1),
(129, 1, 1, 1, 15, 1),
(130, 0, 1, 2, 15, 1),
(131, 1, 2, 1, 70, 1),
(132, 1, 0, 2, 70, 1),
(133, 1, 0, 2, 70, 1),
(134, 1, 0, 2, 70, 1),
(137, 0, 1, 2, 70, 1),
(138, 1, 0, 1, 141, 1),
(140, 1, 0, 1, 21, 1),
(158, 1, 0, 2, 61, 1),
(162, 1, 0, 1, 13, 1),
(163, 1, 0, 1, 6, 1),
(165, 0, 1, 2, 6, 1),
(169, 1, 0, 1, 5, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `servercomments`
-- 

CREATE TABLE `servercomments` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `body` text collate utf8_unicode_ci,
  `created` datetime default NULL,
  `user_id` int(11) unsigned default NULL,
  `server_id` int(11) NOT NULL,
  `seqnumber` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `server_id` (`server_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `servercomments`
-- 

INSERT INTO `servercomments` (`id`, `body`, `created`, `user_id`, `server_id`, `seqnumber`) VALUES 
(1, 'geras servas', '2008-10-10 23:16:56', 1, 2, 1),
(2, 'bb', '2008-10-10 23:19:24', 1, 2, 2),
(3, '', '2008-10-10 23:19:29', 1, 2, 3),
(4, '', '2008-10-10 23:19:35', 1, 2, 4),
(5, 'ze', '2008-10-11 01:14:30', 1, 2, 5),
(6, 'asdasd', '2008-10-11 01:14:46', 1, 2, 6),
(7, 'rerere', '2008-10-11 01:14:52', 1, 2, 7),
(8, 'qeqweqwe', '2008-10-11 01:14:58', 1, 2, 8),
(9, 'asdasdasd', '2008-10-11 01:15:04', 1, 2, 9),
(10, 'asdasdasd', '2008-10-11 01:23:03', 1, 2, 10),
(11, 'tingalin', '2008-10-11 01:23:11', 1, 2, 11);

-- --------------------------------------------------------

-- 
-- Table structure for table `servers`
-- 

CREATE TABLE `servers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) collate utf8_unicode_ci default NULL,
  `game_id` int(11) default NULL,
  `last_response` date default NULL,
  `created` date default NULL,
  `ip` varchar(15) collate utf8_unicode_ci default NULL,
  `port` int(11) default NULL,
  `cachetime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `servers`
-- 

INSERT INTO `servers` (`id`, `name`, `game_id`, `last_response`, `created`, `ip`, `port`, `cachetime`) VALUES 
(1, 'Gelbeklt', 2, '2008-09-23', '2008-09-23', '87.247.75.91', 27015, 60),
(2, 'GERAS CSS LT Mega 64 slot (66 tickrate, www.css.lt)', 2, '2008-09-23', '2008-09-23', '217.147.32.181', 27015, 0),
(3, 'BR:CSS LT 24 slot (100 tickrate)', 2, '2008-09-23', '2008-09-23', '193.46.83.127', 27019, 0),
(4, 'Zombie Hell [Rpg | !Respawn | Fast-DL]', 2, '2008-09-23', '2008-09-23', '66.115.176.32', 27015, 0),
(5, '#aimzone @ 27023', 2, '2008-09-23', '2008-09-23', '84.240.20.100', 27023, 0),
(6, '87.247.77.174', 3, '2008-09-23', '2008-09-23', '87.247.77.174', 28960, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `staffs`
-- 

CREATE TABLE `staffs` (
  `user_id` int(11) unsigned default NULL,
  `org_id` int(11) unsigned default NULL,
  `id` int(11) NOT NULL auto_increment,
  `status` enum('invited','member') collate utf8_unicode_ci NOT NULL,
  `position` enum('admin','headadmin') collate utf8_unicode_ci NOT NULL default 'admin',
  PRIMARY KEY  (`id`),
  KEY `org_id` (`org_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `staffs`
-- 

INSERT INTO `staffs` (`user_id`, `org_id`, `id`, `status`, `position`) VALUES 
(1, 1, 7, 'member', 'headadmin'),
(1, 2, 8, 'member', 'headadmin'),
(19, 2, 9, 'invited', 'admin'),
(19, 1, 10, 'invited', 'admin');

-- --------------------------------------------------------

-- 
-- Table structure for table `statistics`
-- 

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL auto_increment,
  `team_id` int(11) unsigned default NULL,
  `matches` int(11) default NULL,
  `maps` int(11) default NULL,
  `won` int(11) default NULL,
  `lost` int(11) default NULL,
  `frags` int(11) default NULL,
  `deaths` int(11) default NULL,
  `events` int(11) default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_statistics_teams` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `statistics`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `teamdetails`
-- 

CREATE TABLE `teamdetails` (
  `id` int(11) NOT NULL auto_increment,
  `website` varchar(40) collate utf8_unicode_ci default NULL,
  `irc` varchar(40) collate utf8_unicode_ci default NULL,
  `logo` varchar(20) collate utf8_unicode_ci default NULL,
  `country` int(11) default NULL,
  `team_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `teamdetails`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `teamplayers`
-- 

CREATE TABLE `teamplayers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(45) collate utf8_unicode_ci default NULL,
  `mail` varchar(45) collate utf8_unicode_ci default NULL,
  `skype` varchar(45) collate utf8_unicode_ci default NULL,
  `uniqueid` int(11) default NULL,
  `team_id` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_teamplayers_teams` (`team_id`),
  KEY `fk_t` (`uniqueid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

-- 
-- Dumping data for table `teamplayers`
-- 

INSERT INTO `teamplayers` (`id`, `name`, `mail`, `skype`, `uniqueid`, `team_id`) VALUES 
(2, 'jaCk', '', '', 123, 23),
(3, 'tommy', NULL, NULL, 6547, 23),
(5, 'sabaka', NULL, NULL, 321, 17),
(8, 'zzz', NULL, NULL, 0, 15),
(11, 'bronius', NULL, NULL, NULL, 59),
(12, 'eeee', NULL, NULL, NULL, 60),
(13, 'tttt', NULL, NULL, NULL, 60),
(14, 'zona', NULL, NULL, NULL, 61),
(15, 'Playboy', NULL, NULL, NULL, 61),
(17, 'root', NULL, NULL, NULL, 63),
(18, 'eeeee', NULL, NULL, NULL, 63),
(19, 'uuuuu', NULL, NULL, NULL, 15),
(20, 'uuuuzzzz', NULL, NULL, 123456, 15);

-- --------------------------------------------------------

-- 
-- Table structure for table `teams`
-- 

CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci default NULL,
  `user_id` int(10) unsigned default NULL,
  `tag` varchar(8) collate utf8_unicode_ci default NULL,
  `game_id` int(11) unsigned default NULL,
  `type` enum('mix','clan','solo') collate utf8_unicode_ci default NULL,
  `created` datetime default NULL,
  `website` varchar(40) collate utf8_unicode_ci default NULL,
  `irc` varchar(40) collate utf8_unicode_ci default NULL,
  `logo_url` varchar(40) collate utf8_unicode_ci default NULL,
  `country_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `game_id` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=1365 PACK_KEYS=0 COMMENT='InnoDB free: 10240 kB; (`game_id`) REFER `skygames/games`(`i' AUTO_INCREMENT=67 ;

-- 
-- Dumping data for table `teams`
-- 

INSERT INTO `teams` (`id`, `name`, `user_id`, `tag`, `game_id`, `type`, `created`, `website`, `irc`, `logo_url`, `country_id`) VALUES 
(12, 'Momento mori', 2, 'mmori', 1, 'clan', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(15, 'team 2easy', 1, '2easy', 1, 'mix', '2008-01-01 00:00:00', 'www', '', '/v2/img/uploads/logos/banner21.gif', NULL),
(16, 'New Generation Alliance', 1, 'nga', 1, 'mix', '2008-01-01 00:00:00', NULL, NULL, '/v2/img/uploads/logos/banner22.gif', NULL),
(17, 'Crazy team', 14, 'crazy', 1, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(18, 'specas', 1, 'specas', 1, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(19, 'rage', 1, 'r', 1, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(20, 'implode', 1, 'im', 1, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(21, 'stackers', 1, 'stc', 1, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(22, '4 gravity', 1, '4g', 1, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(23, 'shame', 1, 'shame', 1, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(24, 'Legion', 1, 'legion', 1, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(25, 'sk gaming', 1, 'sk', 1, 'clan', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(26, 'allsaints', 1, 'alls', NULL, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(27, 'rushers', 1, 'rushers', NULL, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(28, 'free iraq', 1, 'f.i.', NULL, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(30, 'mix123', 1, 'mix123', 1, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(37, 'mekdrop', 19, 'mekdrop', 2, 'solo', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(38, 'skygames', 19, 'sg', NULL, 'clan', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(39, 'vbc', 19, 'cbv', NULL, 'clan', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(40, 'infinity', 25, 'inF.', NULL, 'clan', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(41, 'root', 1, 'root', 2, 'solo', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(49, '1233123', 1, 'aaa', 2, 'mix', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL),
(50, '2222', 1, 'eeee', 3, 'mix', '2008-09-20 16:16:54', NULL, NULL, NULL, NULL),
(56, 'erer', 1, 'rere', 3, 'mix', '2008-09-21 01:18:22', NULL, NULL, NULL, NULL),
(57, 'ava', 1, 'erre', 3, 'mix', '2008-09-21 01:21:16', NULL, NULL, NULL, NULL),
(58, 'petras', 30, 'petras', 2, 'solo', '2008-09-21 15:02:22', NULL, NULL, NULL, NULL),
(59, 'broniai', 32, 'br', 1, 'mix', '2008-09-21 15:07:01', NULL, NULL, NULL, NULL),
(60, 'broniaiz', 32, 'br', 1, 'mix', '2008-09-21 15:07:11', NULL, NULL, NULL, NULL),
(61, 'zonos', 33, 'zona', 2, 'mix', '2008-09-21 15:34:06', NULL, NULL, NULL, NULL),
(62, 'zona', 33, 'zona', 2, 'solo', '2008-09-21 15:40:15', NULL, NULL, NULL, NULL),
(63, 'aaazaaaa', 1, 'aaaa', 1, 'mix', '2008-09-27 16:52:39', NULL, NULL, NULL, NULL),
(64, 'root', 1, 'root', 3, 'solo', '2008-10-02 02:15:48', NULL, NULL, NULL, NULL),
(65, 'apci', 22, 'apci', 3, 'solo', '2008-10-02 02:17:35', NULL, NULL, NULL, NULL),
(66, 'olle', 14, 'olle', 2, 'solo', '2008-10-07 00:43:00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `threadcats`
-- 

CREATE TABLE `threadcats` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(20) collate utf8_unicode_ci default NULL,
  `game_id` int(11) unsigned default NULL,
  `lang_id` int(11) unsigned default NULL,
  `position` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `game_id` (`game_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `threadcats`
-- 

INSERT INTO `threadcats` (`id`, `name`, `game_id`, `lang_id`, `position`) VALUES 
(1, 'Main', 1, 1, NULL),
(2, 'Events', 1, 1, NULL),
(3, 'Renginiai', 1, 2, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `threads`
-- 

CREATE TABLE `threads` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(120) collate utf8_unicode_ci default NULL,
  `body` text collate utf8_unicode_ci,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `user_id` int(11) unsigned NOT NULL,
  `threadcat_id` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `threadcat_id` (`threadcat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `threads`
-- 

INSERT INTO `threads` (`id`, `title`, `body`, `created`, `modified`, `user_id`, `threadcat_id`) VALUES 
(1, 'LaÅ­ denta kasedo bo mil, help suomio predikato ses er', 'LaÅ­ denta kasedo bo mil, help suomio predikato ses er. Ie kelk celo subjekta ies, gibi egalo minusklo om log, enz ig aspektismo prirespondi. Fin solinfano nederlando as, u sin jugoslavo memmortigo instruitulo, iz bis stif leterskribi. Plus samo jen nj, muo ts helpi grado futuro, tria elparolo predikativo ad ial. On kune lanta miriametro kie, jokto neniaÄµo for uk, tc unun hekto men.', '2008-03-30 16:47:58', '2008-03-30 16:47:58', 1, 1),
(3, 'This is my thread tbh', 'Se ien milo onklo kaÅ­zo, ro nenie franjo latino un''. Nv plus jesigi ial, sekso ofteco kz nul. Ng zeta rolfinaÄµo sor, ali trae pentekosto ik, mebi nenio muo oj. Cii et ekde festo povus. Ie ekde fora estro kuo, tet to tiela anstataÅ­i.', '2008-03-30 18:57:28', '2008-03-30 18:57:28', 1, 1),
(4, 'Brand new', 'Brand newBrand newBrand newBrand newBrand newBrand new', '2008-03-30 23:20:14', '2008-03-30 23:20:14', 1, 2),
(5, 'Shitty thread with shitty title', 'Vestibulum imperdiet nulla cursus elit. Vivamus auctor odio vitae nisi. Ut dictum semper ante. Nulla pharetra lacus a nibh. Phasellus tincidunt. Curabitur eros felis, sodales non, varius eu, malesuada sed, turpis. Maecenas aliquet, justo eu ultricies pretium, nulla diam rutrum dui, in volutpat nunc felis eu arcu. In hac habitasse platea dictumst. Duis blandit. Nunc urna. Donec sapien odio, egestas et, fringilla porta, aliquet nec, erat. Fusce ligula. Vestibulum rutrum, dolor sit amet lobortis pretium, felis est adipiscing dui, et iaculis purus libero ac libero. Aliquam luctus velit at odio. Aliquam vulputate ultrices ligula. Aliquam varius blandit sem.', '2008-04-02 20:21:30', '2008-04-02 20:21:30', 1, 2),
(6, '1on1 cup', 'New cup !', '2008-06-27 14:21:32', '2008-06-27 14:21:32', 1, 3),
(7, 'My simple thread', 'I want to talk with you about my thread', '2008-09-09 15:02:41', '2008-09-09 15:02:41', 14, 3),
(8, 'olles first en thread', 'i like you, do you like Mee ?', '2008-09-09 23:15:13', '2008-09-09 23:15:13', 1, 1),
(9, 'adsasd', 'asdasd', '2008-10-10 14:54:09', '2008-10-10 14:54:09', 1, 1),
(10, 'aaaa', 'jkjalksjd\r\nasdasdasd', '2008-10-10 14:54:28', '2008-10-10 14:54:28', 1, 1),
(11, 'aaa', 'asdasd<br />\r\naasdasd', '2008-10-17 16:08:36', '2008-10-17 16:08:36', 1, 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `uniqueids`
-- 

CREATE TABLE `uniqueids` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) unsigned default NULL,
  `game_id` int(11) unsigned default NULL,
  `value` char(50) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `game_id` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `uniqueids`
-- 

INSERT INTO `uniqueids` (`id`, `user_id`, `game_id`, `value`) VALUES 
(3, 14, 1, '1234'),
(4, 1, 1, '123'),
(5, 1, 2, '321');

-- --------------------------------------------------------

-- 
-- Table structure for table `usercomments`
-- 

CREATE TABLE `usercomments` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `body` text collate utf8_unicode_ci,
  `created` datetime default NULL,
  `user_id` int(11) unsigned default NULL,
  `guest_id` int(11) unsigned default NULL,
  `seqnumber` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`guest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `usercomments`
-- 

INSERT INTO `usercomments` (`id`, `body`, `created`, `user_id`, `guest_id`, `seqnumber`) VALUES 
(1, 'aaaa', '2008-10-11 18:14:47', 1, NULL, 1),
(2, 'eee', '2008-10-11 18:25:07', 1, NULL, 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `userdetails`
-- 

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL auto_increment,
  `hardw_mouse` varchar(32) collate utf8_unicode_ci default NULL,
  `hardw_mousepad` varchar(32) collate utf8_unicode_ci default NULL,
  `hardw_headset` varchar(32) collate utf8_unicode_ci default NULL,
  `hardw_graphcard` varchar(32) collate utf8_unicode_ci default NULL,
  `hardw_memory` varchar(32) collate utf8_unicode_ci default NULL,
  `hardw_cpu` varchar(32) collate utf8_unicode_ci default NULL,
  `hardw_monitor` varchar(32) collate utf8_unicode_ci default NULL,
  `fav_drink` varchar(32) collate utf8_unicode_ci default NULL,
  `fav_movie` varchar(32) collate utf8_unicode_ci default NULL,
  `fav_game` varchar(32) collate utf8_unicode_ci default NULL,
  `fav_music` varchar(96) collate utf8_unicode_ci default NULL,
  `fav_sport` varchar(32) collate utf8_unicode_ci default NULL,
  `fav_car` varchar(32) collate utf8_unicode_ci default NULL,
  `pers_country` varchar(2) collate utf8_unicode_ci default NULL,
  `pers_city` varchar(32) collate utf8_unicode_ci default NULL,
  `pers_age` int(11) default NULL,
  `user_id` int(11) NOT NULL,
  `pers_more` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `userdetails`
-- 

INSERT INTO `userdetails` (`id`, `hardw_mouse`, `hardw_mousepad`, `hardw_headset`, `hardw_graphcard`, `hardw_memory`, `hardw_cpu`, `hardw_monitor`, `fav_drink`, `fav_movie`, `fav_game`, `fav_music`, `fav_sport`, `fav_car`, `pers_country`, `pers_city`, `pers_age`, `user_id`, `pers_more`) VALUES 
(1, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', 0, 0, 'aa'),
(2, '', '', 'a', '', '', '', '', 'aaa', '', '', '', '', '', NULL, 'Ryga', 26, 1, 'zzzzzzzasdasd\r\nasdasd\r\nasdasd'),
(3, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', 0, 1, 'asdasd'),
(4, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', 0, 1, 'asdasd'),
(5, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', 0, 1, 'asdasd'),
(6, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', 0, 1, 'asdasd');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `points` bigint(20) default NULL,
  `username` varchar(10) character set latin1 NOT NULL default '',
  `passwd` varchar(32) character set latin1 NOT NULL default '',
  `name` varchar(10) character set latin1 NOT NULL default '',
  `email` varchar(100) character set latin1 NOT NULL default '',
  `last_visit` datetime NOT NULL default '0000-00-00 00:00:00',
  `group_id` int(10) unsigned NOT NULL default '0',
  `active` tinyint(1) unsigned NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `skype` varchar(50) default NULL,
  `avatar_url` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`,`username`),
  UNIQUE KEY `username_2` (`username`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 3072 kB' AUTO_INCREMENT=34 ;

-- 
-- Dumping data for table `users`
-- 

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `custcomments`
-- 
ALTER TABLE `custcomments`
  ADD CONSTRAINT `custcomments_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `events`
-- 
ALTER TABLE `events`
  ADD CONSTRAINT `events_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Events_Event_types` FOREIGN KEY (`eventtype_id`) REFERENCES `eventtypes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Events_Games` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `eventteams`
-- 
ALTER TABLE `eventteams`
  ADD CONSTRAINT `fk_events_has_teams_events` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_events_has_teams_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Constraints for table `gamewords`
-- 
ALTER TABLE `gamewords`
  ADD CONSTRAINT `fk_gamedict_games` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `gamewords_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `infocats`
-- 
ALTER TABLE `infocats`
  ADD CONSTRAINT `infocats_fk` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Constraints for table `infocomments`
-- 
ALTER TABLE `infocomments`
  ADD CONSTRAINT `infocomments_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `infocomments_fk_info` FOREIGN KEY (`info_id`) REFERENCES `infos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

-- 
-- Constraints for table `infos`
-- 
ALTER TABLE `infos`
  ADD CONSTRAINT `infos_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `infos_fk1` FOREIGN KEY (`infocat_id`) REFERENCES `infocats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `infos_fk2` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `infos_fk3` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Constraints for table `maps`
-- 
ALTER TABLE `maps`
  ADD CONSTRAINT `maps_fk` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Constraints for table `matchcomments`
-- 
ALTER TABLE `matchcomments`
  ADD CONSTRAINT `matchcomments_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `matchcomments_fk_match` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

-- 
-- Constraints for table `matches`
-- 
ALTER TABLE `matches`
  ADD CONSTRAINT `fk_Matches_Events` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matches_playofftables` FOREIGN KEY (`playofftable_id`) REFERENCES `playofftables` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Matches_Teams` FOREIGN KEY (`team1_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Matches_Teams1` FOREIGN KEY (`team2_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `matchparts`
-- 
ALTER TABLE `matchparts`
  ADD CONSTRAINT `fk_matchparts_games` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `memberships`
-- 
ALTER TABLE `memberships`
  ADD CONSTRAINT `members_fk` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `members_fk1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

-- 
-- Constraints for table `playofftables`
-- 
ALTER TABLE `playofftables`
  ADD CONSTRAINT `fk_playofftables_events` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `posts`
-- 
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `posts_fk1` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE;

-- 
-- Constraints for table `resultdemos`
-- 
ALTER TABLE `resultdemos`
  ADD CONSTRAINT `fk_resultdemos_results` FOREIGN KEY (`result_id`) REFERENCES `results` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `resultpictures`
-- 
ALTER TABLE `resultpictures`
  ADD CONSTRAINT `fk_resultpictures_results` FOREIGN KEY (`result_id`) REFERENCES `results` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `results`
-- 
ALTER TABLE `results`
  ADD CONSTRAINT `fk_results_maps` FOREIGN KEY (`map_id`) REFERENCES `maps` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_results_matches` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_results_matchparts` FOREIGN KEY (`matchpart_id`) REFERENCES `matchparts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `servercomments`
-- 
ALTER TABLE `servercomments`
  ADD CONSTRAINT `servercomments_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servercomments_fk1` FOREIGN KEY (`server_id`) REFERENCES `servers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `staffs`
-- 
ALTER TABLE `staffs`
  ADD CONSTRAINT `staff_fk` FOREIGN KEY (`org_id`) REFERENCES `orgs` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `staff_fk1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

-- 
-- Constraints for table `statistics`
-- 
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_fk` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Constraints for table `teamplayers`
-- 
ALTER TABLE `teamplayers`
  ADD CONSTRAINT `teamplayers_fk` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teamplayers_fk1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `teams`
-- 
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_fk` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);

-- 
-- Constraints for table `threadcats`
-- 
ALTER TABLE `threadcats`
  ADD CONSTRAINT `threadcats_fk` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `threadcats_fk1` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Constraints for table `threads`
-- 
ALTER TABLE `threads`
  ADD CONSTRAINT `threads_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `threads_fk1` FOREIGN KEY (`threadcat_id`) REFERENCES `threadcats` (`id`);

-- 
-- Constraints for table `uniqueids`
-- 
ALTER TABLE `uniqueids`
  ADD CONSTRAINT `uniqueids_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `uniqueids_fk1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Constraints for table `usercomments`
-- 
ALTER TABLE `usercomments`
  ADD CONSTRAINT `usercomments_fk` FOREIGN KEY (`user_id`) REFERENCES `usercomments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `usercomments_fk1` FOREIGN KEY (`guest_id`) REFERENCES `usercomments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

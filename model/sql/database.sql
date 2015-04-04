SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cognome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP  
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

ALTER TABLE `utenti`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

CREATE TABLE IF NOT EXISTS fb_utenti (
    fb_id bigint(30) NOT NULL,
    rp_id int(11) NOT NULL,
    fb_firstname varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    fb_lastname varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    fb_email varchar(128) COLLATE utf8_unicode_ci NOT NULL,
    fb_avatar varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    date_created datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE fb_utenti ADD PRIMARY KEY (fb_id);

CREATE TABLE IF NOT EXISTS go_utenti (
    go_id varchar(255) NOT NULL,
    rp_id int(11) NOT NULL,
    go_firstname varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    go_lastname varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    go_email varchar(128) COLLATE utf8_unicode_ci NOT NULL,
    go_avatar varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    date_created datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE go_utenti ADD PRIMARY KEY (go_id);




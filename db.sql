-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 13 Oca 2025, 18:12:16
-- Sunucu sürümü: 8.3.0
-- PHP Sürümü: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `teamspeak_dns`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dns`
--

DROP TABLE IF EXISTS `dns`;
CREATE TABLE IF NOT EXISTS `dns`
(
    `id`        int                                                           NOT NULL AUTO_INCREMENT,
    `user`      int                                                           NOT NULL,
    `dns`       varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    `name`      varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    `domain`    varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    `ip`        varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci  NOT NULL,
    `port`      varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci   NOT NULL,
    `status`    enum ('0','1','2') DEFAULT '1',
    `time`      int                DEFAULT NULL,
    `edit_time` int                DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb3
  ROW_FORMAT = DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings`
(
    `id`        int          NOT NULL AUTO_INCREMENT,
    `skey`      varchar(255) NOT NULL,
    `sval`      longtext,
    `status`    enum ('0','1') DEFAULT '1',
    `time`      int            DEFAULT NULL,
    `edit_time` int            DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM
  AUTO_INCREMENT = 12
  DEFAULT CHARSET = utf8mb3
  ROW_FORMAT = DYNAMIC;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `skey`, `sval`, `status`, `time`, `edit_time`)
VALUES (1, 'title', 'Mirarus TeamSpeak DNS', '1', NULL, 1736788862),
       (2, 'description', 'Mirarus TeamSpeak DNS', '1', NULL, 1736788862),
       (3, 'keywords', 'Mirarus TeamSpeak DNS', '1', NULL, 1736788862),
       (4, 'favicon', 'files\\favicon.jpeg', '1', NULL, 1662153223),
       (5, 'logo', 'files\\favicon.jpeg', '1', NULL, 1656190144),
       (6, 'text_logo', 'Mirarus TeamSpeak DNS', '1', NULL, 1736788862),
       (7, 'text_logo_status', '1', '1', NULL, 1736788862),
       (8, 'site_status', '1', '1', NULL, 1736788862),
       (9, 'dns_email', 'aliguclutr@gmail.com', '1', NULL, 1736709788),
       (10, 'dns_api_key', '--apiKey--', '1', NULL, 1736709788),
       (11, 'dns_domains', 'mirarus.com.tr', '1', NULL, 1736709788);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets`
(
    `id`        int      NOT NULL AUTO_INCREMENT,
    `user`      int      NOT NULL,
    `url`       varchar(255)           DEFAULT NULL,
    `subject`   longtext NOT NULL,
    `priority`  enum ('1','2','3','4') DEFAULT '1',
    `status`    enum ('1','2','3','4') DEFAULT '2',
    `time`      int                    DEFAULT NULL,
    `edit_time` int                    DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb3;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ticket_replies`
--

DROP TABLE IF EXISTS `ticket_replies`;
CREATE TABLE IF NOT EXISTS `ticket_replies`
(
    `id`        int      NOT NULL AUTO_INCREMENT,
    `ticket`    int      NOT NULL,
    `user`      int      NOT NULL,
    `message`   longtext NOT NULL,
    `status`    enum ('1','2','3','4') DEFAULT '1',
    `time`      int                    DEFAULT NULL,
    `edit_time` int                    DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb3;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`
(
    `id`        int          NOT NULL AUTO_INCREMENT,
    `email`     varchar(200) NOT NULL,
    `password`  varchar(255) NOT NULL,
    `role`      enum ('admin','user') DEFAULT 'user',
    `status`    enum ('0','1')        DEFAULT '1',
    `time`      int                   DEFAULT NULL,
    `edit_time` int                   DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8mb3
  ROW_FORMAT = DYNAMIC;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `status`, `time`, `edit_time`)
VALUES (1, 'admin@site.com', '$2y$12$Tcm3BzIsy82iX8u63FDDu./FUdAsJwT2zcCjrBONniTqGSzoY9Pa.', 'admin', '1', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;

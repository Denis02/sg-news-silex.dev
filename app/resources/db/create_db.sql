# create database
CREATE DATABASE sg_news_silex CHARACTER SET utf8 COLLATE utf8_general_ci;


# create table
CREATE TABLE `news` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL UNIQUE,
  `description` mediumtext NOT NULL,
  `source` varchar(255) NOT NULL,
  `pub_date` datetime NOT NULL
) ENGINE='InnoDB';


# add sources table
CREATE TABLE `sources` (
`id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `source_link` varchar(255) NOT NULL ,
  `rss_feed_link` varchar(255) NOT NULL UNIQUE,
  `is_active` BOOLEAN NOT NULL DEFAULT true
) ENGINE='InnoDB';


# add users table
CREATE TABLE `users` (
`id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL
) ENGINE='InnoDB';
CREATE DATABASE todo;

USE todo;

CREATE TABLE `users` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
	`username` VARCHAR(20) UNIQUE NOT NULL,
	`password` VARCHAR(60) NOT NULL,
	`salt` VARCHAR(22) NOT NULL
);

CREATE TABLE `tasks` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_user` INT NOT NULL,
  `task` VARCHAR(25) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `time_creation` datetime NOT NULL,
  `time_start` datetime NOT NULL,  
  `time_end` datetime NOT NULL
);


INSERT INTO `users` (`id`, `username`, `password`, `salt`) VALUES
(1, 'Loic', '$2y$10$1ecc647f496f706d29f8fux56AgGfvk5x5vPNHec6hYd4PwGPUN6y', '1ecc647f496f706d29f8f9'),
(5, 'toto', '$2y$10$759a8dd51b415d14e73c6O.EAiTqmwsGE/Z.AmMIF.C0X4gt0GukG', '759a8dd51b415d14e73c6c');

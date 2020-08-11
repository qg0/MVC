SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `redbook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `redbook`;

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Vlad Piarov'),
(2, 'John Dow'),
(3, 'Alexey Pushkov'),
(4, 'Anna Kerina'),
(5, 'Bill Oreily'),
(7, 'Looker Stares'),
(8, 'Johny McDonald'),
(9, 'Anna Kendry');

CREATE TABLE `authors_books` (
  `book_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `authors_books` (`book_id`, `author_id`) VALUES
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(10, 1),
(11, 2),
(11, 4),
(11, 5),
(11, 9),
(12, 4),
(12, 5);

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `books` (`id`, `name`) VALUES
(9, 'book1'),
(10, 'book2'),
(11, 'book3'),
(12, 'book4');


ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `authors_books`
  ADD UNIQUE KEY `author_book_unique` (`book_id`,`author_id`),
  ADD KEY `author_book_authors_id_fk` (`author_id`);

ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;


ALTER TABLE `authors_books`
  ADD CONSTRAINT `author_book_authors_id_fk` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `author_book_books_id_fk` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

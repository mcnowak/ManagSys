-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `management_systems_db`;
CREATE DATABASE `management_systems_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `management_systems_db`;

DROP TABLE IF EXISTS `classroom`;
CREATE TABLE `classroom` (
  `classroom_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`classroom_id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `classroom_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `classroom` (`classroom_id`, `teacher_id`, `year`) VALUES
(1,	1,	'2013'),
(2,	1,	'2014');

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `grade_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `grade_id` (`grade_id`),
  CONSTRAINT `course_ibfk_2` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`grade_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `course` (`course_id`, `grade_id`, `name`) VALUES
(1,	1,	'Math'),
(2,	2,	'Math'),
(3,	2,	'IT');

DROP TABLE IF EXISTS `exam`;
CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`exam_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `exam` (`exam_id`, `course_id`, `name`, `date`) VALUES
(1,	1,	'Add & Sub',	'2013-10-18'),
(2,	2,	'Multiplication table',	'2014-10-17'),
(3,	3,	'Windows',	'2014-10-18'),
(4,	2,	'Multiplication table 2',	'2014-10-19');

DROP TABLE IF EXISTS `exam_result`;
CREATE TABLE `exam_result` (
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `marks` tinyint(4) DEFAULT NULL,
  KEY `exam_id` (`exam_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `exam_result_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `exam_result_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `exam_result` (`exam_id`, `student_id`, `marks`) VALUES
(1,	1,	68),
(1,	2,	55),
(1,	3,	61),
(2,	1,	36),
(2,	2,	87),
(2,	3,	59),
(3,	1,	23),
(3,	2,	91),
(3,	3,	44),
(4,	1,	68),
(4,	2,	4),
(4,	3,	100);

DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `grade` (`grade_id`, `name`) VALUES
(1,	'2'),
(2,	'3');

DROP TABLE IF EXISTS `grade_section`;
CREATE TABLE `grade_section` (
  `grade_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  KEY `grade_id` (`grade_id`),
  KEY `section_id` (`section_id`),
  KEY `student_id` (`student_id`),
  KEY `classroom_id` (`classroom_id`),
  CONSTRAINT `grade_section_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`grade_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `grade_section_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `grade_section_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `grade_section_ibfk_4` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`classroom_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `grade_section` (`grade_id`, `section_id`, `student_id`, `classroom_id`) VALUES
(1,	1,	1,	1),
(1,	1,	2,	1),
(1,	1,	3,	1),
(2,	1,	1,	2),
(2,	1,	2,	2),
(2,	1,	3,	2);

DROP TABLE IF EXISTS `section`;
CREATE TABLE `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `section` (`section_id`, `name`) VALUES
(1,	'B');

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `student` (`student_id`, `first_name`, `last_name`) VALUES
(1,	'Monica',	'Philips'),
(2,	'James',	'Wood'),
(3,	'Sheldon',	'Joys');

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `teacher` (`teacher_id`, `first_name`, `last_name`) VALUES
(1,	'Hellen',	'Brivic');

-- 2014-10-19 18:04:38


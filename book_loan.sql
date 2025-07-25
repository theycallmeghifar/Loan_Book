-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 08:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_loan`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `authors` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `authors`, `isbn`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kambing Jantan', 'This debut book is a collection of humorous diary entries from Raditya Dika\'s time as a student in Australia. It blends characteristic youth humor with underlying themes of loneliness, long-distance relationships, and self-discovery.', 'Raditya Dika', '9789793600697', '2025-07-24 08:02:55', '2025-07-24 08:02:55', NULL),
(2, 'Cinta Brontosaurus', 'Raditya Dika\'s second novel continues his exploration of love, often with a comically over-analytical perspective. It\'s a collection of short stories detailing his romantic mishaps from childhood to adulthood, including humorous observations about his quirky family.', 'Raditya Dika', '9789797800598', '2025-07-24 08:03:19', '2025-07-24 08:03:19', NULL),
(3, 'Radikus Makankakus', 'Maintaining his signature humor, this book features a collection of random and absurd stories, ranging from childhood anecdotes to everyday occurrences. Beneath the comedy, there are often subtle social critiques and life reflections.', 'Raditya Dika', '9789797801663', '2025-07-24 08:04:08', '2025-07-24 08:04:08', NULL),
(4, 'Babi Ngesot', 'A unique blend of horror and comedy. This book presents strange and humorous stories about mysterious events, delivered in a relaxed and amusing manner, while also incorporating sentimental elements through its love stories.', 'Raditya Dika', '9786028066105', '2025-07-24 08:04:34', '2025-07-24 08:04:34', NULL),
(5, 'Marmut Merah Jambu', 'One of Raditya Dika\'s more \"heartbreaking\" novels, it explores themes of young love and the \"friendzone.\" Many readers find its stories about unrequited love, secret crushes, and odd encounters relatable.', 'Raditya Dika', '9786028066648', '2025-07-24 08:04:54', '2025-07-24 08:04:54', NULL),
(6, 'The Henna Artist', 'Set in 1950s India, this novel follows the journey of Lakshmi Singh, a young woman who escapes an abusive marriage to become a renowned henna artist for the wealthy women of Jaipur. It explores themes of independence, social class, and tradition in a vivid cultural setting.', 'Alka Joshi', '978-0778331476', '2025-07-24 08:06:27', '2025-07-24 08:06:27', NULL),
(7, 'Project Hail Mary', 'From the author of The Martian, this book follows Ryland Grace, the sole survivor of a desperate mission to save humanity. He wakes up with amnesia on a spaceship, far from Earth, with two alien companions, and must piece together his memories and work with his unexpected allies to complete his critical task. It\'s known for its humor, scientific accuracy (within the realm of fiction), and compelling problem-solving.', 'Andy Weir', '978-0593135228', '2025-07-24 08:06:57', '2025-07-24 08:06:57', NULL),
(8, 'Circe', 'A stunning retelling of the Greek myth of Circe, the powerful witch from Homer\'s Odyssey. Miller gives voice to Circe, exploring her exile, her relationships with gods and mortals, and her journey of self-discovery and resilience. It\'s rich in character development and beautifully written.', 'Madeline Miller', '978-0316556347', '2025-07-24 08:07:24', '2025-07-24 08:07:24', NULL),
(9, 'Atomic Habits', 'This highly practical and actionable book provides a framework for improving every day. James Clear explains how tiny changes (atomic habits) can lead to remarkable results, focusing on strategies for building good habits, breaking bad ones, and mastering the small behaviors that lead to big outcomes.', 'James Clear', '978-0735211292', '2025-07-24 08:08:08', '2025-07-24 09:41:13', NULL),
(10, 'A Man Called Ove', 'This heartwarming and often hilarious novel tells the story of Ove, a curmudgeonly yet deeply empathetic widower whose grumpy exterior hides a profound sadness and a surprisingly compassionate heart. His life is unexpectedly turned upside down by the arrival of new, boisterous neighbors. It\'s a story about community, loss, and finding connection in unexpected places.', 'Fredrik Backman', '978-1476738024', '2025-07-24 08:09:21', '2025-07-24 08:09:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `book_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 8, '2025-07-24 08:09:35', '2025-07-24 08:09:35', NULL),
(2, 2, 8, '2025-07-24 08:09:43', '2025-07-24 08:09:43', NULL),
(3, 2, 8, '2025-07-24 08:09:43', '2025-07-24 08:09:43', NULL),
(4, 3, 8, '2025-07-24 08:09:50', '2025-07-24 08:09:50', NULL),
(5, 4, 8, '2025-07-24 08:09:59', '2025-07-24 08:09:59', NULL),
(6, 5, 8, '2025-07-24 08:10:08', '2025-07-24 08:10:08', NULL),
(7, 6, 7, '2025-07-24 08:10:27', '2025-07-24 08:10:27', NULL),
(8, 7, 2, '2025-07-24 08:10:42', '2025-07-24 08:10:42', NULL),
(9, 8, 1, '2025-07-24 08:10:52', '2025-07-24 08:10:52', NULL),
(10, 9, 10, '2025-07-24 08:11:11', '2025-07-24 08:11:11', NULL),
(11, 10, 8, '2025-07-24 08:11:27', '2025-07-24 08:11:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fantasy', '2025-07-24 05:12:21', '2025-07-24 05:12:21', NULL),
(2, 'Science Fiction', '2025-07-24 07:59:35', '2025-07-24 07:59:35', NULL),
(3, 'Mystery', '2025-07-24 08:00:02', '2025-07-24 08:00:02', NULL),
(4, 'Romance', '2025-07-24 08:00:15', '2025-07-24 08:00:15', NULL),
(5, 'Horror', '2025-07-24 08:00:26', '2025-07-24 08:00:26', NULL),
(6, 'Action & Adventure', '2025-07-24 08:00:34', '2025-07-24 08:00:34', NULL),
(7, 'Historical Fiction', '2025-07-24 08:00:43', '2025-07-24 08:00:43', NULL),
(8, 'Humor', '2025-07-24 08:00:53', '2025-07-24 08:00:53', NULL),
(9, 'Biography & Memoir', '2025-07-24 08:01:22', '2025-07-24 08:01:22', NULL),
(10, 'Self-Help & Personal Development', '2025-07-24 08:01:32', '2025-07-24 08:01:32', NULL),
(11, 'History', '2025-07-24 08:01:40', '2025-07-24 08:01:40', NULL),
(12, 'Cookbooks', '2025-07-24 08:01:46', '2025-07-24 08:01:46', NULL),
(13, 'True Crime', '2025-07-24 08:01:56', '2025-07-24 08:01:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `librarian_id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `loan_at` datetime NOT NULL,
  `returned_at` datetime DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `book_id`, `librarian_id`, `member_id`, `loan_at`, `returned_at`, `note`, `deleted_at`) VALUES
(1, 9, 2, 3, '2025-07-01 12:00:00', '2025-07-09 12:00:00', 'returned', NULL),
(2, 4, 2, 3, '2025-07-21 10:00:00', '2025-07-24 12:00:00', 'returned', NULL),
(3, 6, 2, 8, '2025-07-07 14:00:00', '2025-07-11 12:00:00', 'returned', NULL),
(4, 9, 2, 7, '2025-07-11 08:00:00', NULL, 'not yet returned', NULL),
(5, 10, 2, 6, '2025-07-14 11:00:00', '2025-07-17 12:00:00', 'returned', NULL),
(6, 2, 2, 6, '2025-07-21 13:00:00', '2025-07-24 12:00:00', 'returned', NULL),
(7, 6, 2, 5, '2025-07-19 10:00:00', NULL, 'not yet returned', NULL),
(8, 2, 2, 4, '2025-07-16 09:00:00', NULL, 'not yet returned', NULL),
(9, 5, 2, 6, '2025-07-09 12:00:00', NULL, 'not yet returned', NULL),
(10, 4, 2, 8, '2025-07-03 08:00:00', NULL, 'not yet returned', NULL),
(11, 3, 2, 4, '2025-07-22 23:03:00', NULL, 'not yet returned', NULL),
(12, 1, 2, 7, '2025-07-19 23:05:00', NULL, 'not yet returned', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` enum('librarian','member','admin') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ned Flanders', 'nedflanders@springmail.com', '$2y$12$D5l9.tpOayXZfqYcIRbzWOeTcGiQq7mS6uGnnnAYNLLZ6y/PvA3fa', '(555) 555-7890', '744 Evergreen Terrace, Springfield', 'admin', '2025-07-24 05:22:57', '2025-07-24 07:51:35', NULL),
(2, 'Montgomery Burns', 'montgomeryburns@springmail.com', '$2y$12$ZQE1eUl.dxo6LYrKOyCge.cz8tCynIOlmO8LVxxoBAn654TmrgiqG', '(555) 555-0001', '1000 Mammon Street, Springfield', 'librarian', '2025-07-24 06:23:32', '2025-07-24 06:23:32', NULL),
(3, 'Barney Gumble', 'barneygumbel@springmail.com', '$2y$12$VtCQXsQlXKjZOZj2XOmwC.DSmqK0htOCCIfcphgsEEVC9lQjlpD.C', '(555) 555-0723', '100 Main Street (behind Moe\'s Tavern), Springfield', 'member', '2025-07-24 07:53:42', '2025-07-24 07:53:42', NULL),
(4, 'Moe Szyslak', 'moeszyslak@springmail.com', '$2y$12$DjANZRpjn29yHWEzjzztCuer2nI6ZWDAOH3VXc0lpODoXP48V1l0.', '(555) 555-1234', '536 Maple Street, Springfield', 'member', '2025-07-24 07:54:34', '2025-07-24 07:54:34', NULL),
(5, 'Milhouse Van Houten', 'milhousevanhouten@springmail.com', '$2y$12$a4O4D37e192Ro0kWyDNN4uv0iiiEjbxk0pkhCQY3bUJ9/6HTOoDom', '(555) 555-0756', '352 West Park, Springfield', 'member', '2025-07-24 07:55:37', '2025-07-24 07:55:37', NULL),
(6, 'Patty Bouvier', 'pattybouvier@springmail.com', '$2y$12$xNpVB8r1BzLqgA.WxsXnXuxS1ZMnltpUKoq/dTIn/rjejuQTvxAAa', '(555) 555-0782', '1520 Walnut Street, Springfield', 'member', '2025-07-24 07:56:52', '2025-07-24 07:56:52', NULL),
(7, 'Dr. Julius Hibbert', 'juliushibbert@springmail.com', '$2y$12$jHCr2svsfbCWC0C6CkMJ..WAqJcEkITdh2sJiNPk.hr84LouRky76', '(555) 555-HEAL', '1 Medical Center Lane, Springfield`', 'member', '2025-07-24 07:57:48', '2025-07-24 07:57:48', NULL),
(8, 'Lenny Leonard', 'lennyleonard@springmail.com', '$2y$12$nW2vIc0sJq.Tpxwv0Qdig.LwEwBzIAdv2OYR3Py4w1Udz5C0syqoa', '(555) 555-0738', '400 Nuclear Power Plant Road, Springfield', 'member', '2025-07-24 07:58:40', '2025-07-24 07:58:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_categories_book_id_foreign` (`book_id`),
  ADD KEY `book_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_book_id_foreign` (`book_id`),
  ADD KEY `loans_librarian_id_foreign` (`librarian_id`),
  ADD KEY `loans_member_id_foreign` (`member_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD CONSTRAINT `book_categories_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_librarian_id_foreign` FOREIGN KEY (`librarian_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

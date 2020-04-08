-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2020 at 08:19 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `support_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_departments`
--

CREATE TABLE `agent_departments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `user_id`, `name`, `address`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jhorotek Bangladesh LTD', 'The survey also highlighted concerns about the sick note system, most employers believing doctors issued them too easily.: Workers who clock in while ill cost their employers 20 percent more per day than employees who take time off.: Private sector employers are furious that government ministers will continue to write blank cheques to up the pay for public servants.', 1, '2020-04-08 06:11:07', '2020-04-08 00:11:07'),
(2, 1, 'Service Chai', 'The survey also highlighted concerns about the sick note system, most employers believing doctors issued them too easily.: Workers who clock in while ill cost their employers 20 percent more per day than employees who take time off.: Private sector employers are furious that government ministers will continue to write blank cheques to up the pay for public servants.', 1, '2020-03-06 08:11:20', '2020-02-19 11:45:59'),
(3, 3, 'Debugger IT', 'Uttara', 1, '2020-04-05 00:46:29', '2020-04-05 00:46:29');

-- --------------------------------------------------------

--
-- Table structure for table `department_employees`
--

CREATE TABLE `department_employees` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `mobile_no` varchar(16) NOT NULL,
  `email` varchar(128) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_employees`
--

INSERT INTO `department_employees` (`id`, `department_id`, `name`, `mobile_no`, `email`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nashe Khan', '01943837967', 'khan@gmail.com', 1, '2020-03-31 11:13:40', '2020-03-31 11:13:40'),
(2, 1, 'Moumita Khan', '01943837965', 'khan@gmail.com', 1, '2020-04-06 01:24:01', '2020-04-06 01:24:01'),
(3, 1, 'Adeeb Imtiaz', '01943837966', 'alam@gmail.com', 1, '2020-04-06 01:24:44', '2020-04-06 01:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `department_employee_tickets`
--

CREATE TABLE `department_employee_tickets` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `dept_employee_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_employee_tickets`
--

INSERT INTO `department_employee_tickets` (`id`, `ticket_id`, `dept_employee_id`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2020-04-06 01:32:52', '2020-04-06 01:32:52'),
(2, 1, 1, 1, 1, '2020-04-06 01:34:14', '2020-04-06 01:34:14'),
(3, 1, 1, 1, 1, '2020-04-06 01:34:41', '2020-04-06 01:34:41'),
(4, 1, 2, 1, 1, '2020-04-06 01:34:41', '2020-04-06 01:34:41'),
(5, 1, 3, 1, 1, '2020-04-06 01:34:41', '2020-04-06 01:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `dept_ticket_categories`
--

CREATE TABLE `dept_ticket_categories` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `category` varchar(128) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept_ticket_categories`
--

INSERT INTO `dept_ticket_categories` (`id`, `department_id`, `category`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Infobuzzer Website', 1, '2020-02-19 11:47:20', '2020-02-19 11:47:20'),
(2, 1, 'SMS pull-Push', 1, '2020-02-19 11:47:20', '2020-02-19 11:47:20'),
(3, 2, 'CodeChecker', 1, '2020-04-01 15:37:41', '2020-02-24 06:45:32'),
(4, 2, 'FileCheckers', 1, '2020-02-24 06:45:32', '2020-02-24 06:45:32'),
(5, 3, 'Website Brakedown', 1, '2020-04-05 00:46:29', '2020-04-05 00:46:29'),
(6, 3, 'Website BackEnd Error', 1, '2020-04-05 00:46:29', '2020-04-05 00:46:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `dept_ticket_category_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `customer_name` varchar(128) DEFAULT NULL,
  `customer_phone` varchar(16) DEFAULT NULL,
  `priority` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `file_urls` text NOT NULL,
  `img_urls` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `department_id`, `dept_ticket_category_id`, `title`, `customer_name`, `customer_phone`, `priority`, `description`, `file_urls`, `img_urls`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 'Need to Learn Lavavel Cmd', 'Safwan', '8801703980587', 2, '<div>dsa</div>', '', '', 0, '2020-03-13 15:33:40', '2020-02-24 23:28:45'),
(2, 1, 2, 3, 'mari kha', 'safwan1', '88', 1, '<div><table class=\"table-1\"><tbody><tr><td>ga</td><td>f </td><td>d </td><td>a </td><td>a </td></tr><tr><td>f </td><td>d </td><td>d </td><td>a </td><td>a </td></tr><tr><td>d </td><td>a </td><td>d </td><td>a </td><td>a </td></tr><tr><td>d </td><td>d </td><td>d </td><td>a </td><td>a </td></tr></tbody></table><br></div>', '1_2002250603465002.tex,1_2002250603465093.tex', '1_2002250603460672.tex', 1, '2020-03-13 15:33:43', '2020-02-25 00:03:46'),
(4, 1, 1, 1, 'SADSD', 'sDFW', '8801911303704', 0, '<div>ASDADW</div>', '', '', 2, '2020-03-13 15:33:45', '2020-02-25 01:09:11'),
(12, 1, 2, 4, 'fdfdgdfgdfg', 'safwan101', '01931232134', 1, '<div>sadsdasdasdasdasd</div>', '', '', 1, '2020-03-13 09:35:09', '2020-03-13 09:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_comments`
--

INSERT INTO `ticket_comments` (`id`, `user_id`, `ticket_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Hello', '2020-03-31 23:45:12', '2020-03-31 23:45:12'),
(2, 1, 4, 'Hello', '2020-03-31 23:45:25', '2020-03-31 23:45:25'),
(3, 1, 4, 'Hello', '2020-03-31 23:47:10', '2020-03-31 23:47:10'),
(4, 1, 4, 'Hello', '2020-03-31 23:47:46', '2020-03-31 23:47:46'),
(5, 1, 4, 'Hello', '2020-03-31 23:48:23', '2020-03-31 23:48:23'),
(6, 1, 4, 'hello nigga', '2020-04-01 02:14:30', '2020-04-01 02:14:30'),
(7, 1, 2, 'Table dun look fine', '2020-04-01 02:49:57', '2020-04-01 02:49:57'),
(8, 1, 1, 'no Cmd file', '2020-04-05 05:02:38', '2020-04-05 05:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_level` enum('master_admin','department_admin','agent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile_no`, `access_level`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Riham', 'test@gmail.com', '019112342345', 'master_admin', NULL, '$2y$10$q2E3a.WQMXChfF5CrAnXLeAUQdje4qV9kdSK/IBdiHQ8j47BSURDu', NULL, '2020-02-17 06:06:03', '2020-02-17 06:06:03'),
(2, 'Tanvir Ahmed', 'tan.san@gmail.com', '019433244315', 'agent', NULL, 'tan12345', 'tan12345', '2020-03-13 23:02:33', '2020-03-13 23:02:33'),
(3, 'Jahid Hasan Shovon', 'jahid@gmail.com', '01943837967', 'department_admin', NULL, '$2y$10$EE6CPOOVyuckBzYYFQZn7eMf9Lr8C5zI1buHNltwNouFA2TVDoPGC', NULL, '2020-04-05 00:46:29', '2020-04-05 00:46:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_departments`
--
ALTER TABLE `agent_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_employees`
--
ALTER TABLE `department_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_employee_tickets`
--
ALTER TABLE `department_employee_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_ticket_categories`
--
ALTER TABLE `dept_ticket_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `agent_departments`
--
ALTER TABLE `agent_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department_employees`
--
ALTER TABLE `department_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department_employee_tickets`
--
ALTER TABLE `department_employee_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dept_ticket_categories`
--
ALTER TABLE `dept_ticket_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

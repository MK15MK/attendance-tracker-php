-- Schema + sample seed data for the attendance-tracker-php demo.
-- Import this into a fresh MySQL/MariaDB database named `attendance_manager`.
-- All names, contact details, and credentials below are fabricated sample data.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` tinytext NOT NULL,
  `attendance` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `attendance` (`id`, `name`, `date`, `time`, `attendance`) VALUES
(18, 'Alex Carter', '2024-01-08', '09:27', 'Present'),
(19, 'Jordan Lee', '2024-01-09', '09:45', 'Present'),
(20, 'Jordan Lee', '2024-01-10', '09:48', 'Present'),
(21, 'Alex Carter', '2024-01-09', '09:45', 'Present'),
(22, 'Alex Carter', '2024-01-10', '09:45', 'Present'),
(24, 'Jordan Lee', '2024-01-11', '10:20', 'Present'),
(25, 'Jordan Lee', '2024-01-12', '14:04', 'Present');

-- --------------------------------------------------------

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `details` (`id`, `name`, `dob`, `phone`, `email`, `institution`, `status`, `role`, `timestamp`) VALUES
(1, 'Jordan Lee', '15-01-1998', '5550100001', 'jordan.lee@example.com', 'Sample Institute', 'active', 'admin', '2024-01-08 15:18:34'),
(2, 'Alex Carter', '19-07-1999', '5550100002', 'alex.carter@example.com', 'Sample Institute', 'active', 'user', '2024-01-08 15:20:33');

-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Demo login: admin / demo123 (change immediately if you deploy this anywhere real)
INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'demo123');

-- --------------------------------------------------------

ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

COMMIT;

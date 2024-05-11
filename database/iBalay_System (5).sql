-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2024 at 01:26 AM
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
-- Database: `iBalay_System`
--

-- --------------------------------------------------------

--
-- Table structure for table `bh_information`
--

CREATE TABLE `bh_information` (
  `bh_id` int(11) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `BH_name` varchar(100) NOT NULL,
  `BH_address` varchar(255) DEFAULT NULL,
  `Document1` varchar(255) DEFAULT NULL,
  `Document2` varchar(255) DEFAULT NULL,
  `monthly_payment_rate` varchar(50) DEFAULT NULL,
  `number_of_kitchen` int(11) DEFAULT NULL,
  `number_of_living_room` int(11) DEFAULT NULL,
  `number_of_students` int(11) DEFAULT NULL,
  `number_of_cr` int(11) DEFAULT NULL,
  `number_of_beds` int(11) DEFAULT NULL,
  `number_of_rooms` int(11) DEFAULT NULL,
  `bh_max_capacity` int(11) DEFAULT NULL,
  `gender_allowed` enum('male','female','all') NOT NULL,
  `Status` enum('0','1','2') DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bh_information`
--

INSERT INTO `bh_information` (`bh_id`, `landlord_id`, `BH_name`, `BH_address`, `Document1`, `Document2`, `monthly_payment_rate`, `number_of_kitchen`, `number_of_living_room`, `number_of_students`, `number_of_cr`, `number_of_beds`, `number_of_rooms`, `bh_max_capacity`, `gender_allowed`, `Status`, `longitude`, `latitude`) VALUES
(12, 1, 'cord', 'brgy. imelda, tolosa, leyte', '/opt/lampp/htdocs/iBalay/uploads/documents/landlord_1/663ae38bbe1b3_Letter-of-intent-ADAS.pdf', '/opt/lampp/htdocs/iBalay/uploads/documents/landlord_1/663ae38bbe3f2_Letter-of-intent-ADAS.pdf', '1000 - 3243', 2, 2, 2, 2, 2, 2, 2, 'all', '1', 125.01156818078637, 11.097570201927695);

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `bookmark_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`bookmark_id`, `tenant_id`, `room_id`) VALUES
(1040, 1, 4),
(1041, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `landlord_acc`
--

CREATE TABLE `landlord_acc` (
  `landlord_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landlord_acc`
--

INSERT INTO `landlord_acc` (`landlord_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `address`) VALUES
(1, 'cord', 'moraleta', 'cordmorale101@gmail.com', '$2y$10$LPvuQzOxb/v/DC41/P9RyeQUkML8.EASXDR9jL6jXvttD0eo4BIzG', '234', 'wqe');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_room`
--

CREATE TABLE `reserved_room` (
  `reserved_id` int(11) NOT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `TenantID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `landlord_id` int(11) DEFAULT NULL,
  `room_number` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `room_price` decimal(10,2) DEFAULT NULL,
  `room_photo1` varchar(255) DEFAULT NULL,
  `room_photo2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `landlord_id`, `room_number`, `description`, `capacity`, `room_price`, `room_photo1`, `room_photo2`) VALUES
(4, 1, 11, 'sdsadsdsad', 22, 232332.00, 'photo_663cd60b3785e.jpg', 'photo_663cd3e9c2019.jpeg'),
(5, 1, 2, 'sdsadas', 23, 23213.00, 'photo_663cd3fb38c24.jpeg', 'photo_663cd3fb38df2.jpeg'),
(6, 1, 3, 'swewqqw', 2, 2.00, 'photo_663cd4063b720.jpeg', 'photo_663cd4063b817.jpeg'),
(7, 1, 1, 'A boarding house offers a shared living experience with private rooms and communal amenities. Ideal for students, young professionals, or travelers, it\'s an affordable and convenient housing option where residents share common spaces like kitchens and bathrooms. With flexible rental terms, boarding houses promote a sense of community and provide a supportive environment for those seeking a home away from home.', 2, 1000.00, 'photo_663d787f7df82.jpg', 'photo_663d787f7dfa3.jpeg'),
(8, 1, 4, 'A boarding house offers a shared living experience with private rooms and communal amenities. Ideal for students, young professionals, or travelers, it\'s an affordable and convenient housing option where residents share common spaces like kitchens and bathrooms. With flexible rental terms, boarding houses promote a sense of community and provide a supportive environment for those seeking a home away from home.', 2, 1000.00, 'photo_663d78954db98.jpeg', 'photo_663d78954dbad.jpeg'),
(9, 1, 5, 'A boarding house offers a shared living experience with private rooms and communal amenities. Ideal for students, young professionals, or travelers, it\'s an affordable and convenient housing option where residents share common spaces like kitchens and bathrooms. With flexible rental terms, boarding houses promote a sense of community and provide a supportive environment for those seeking a home away from home.', 2, 1000.00, 'photo_663d78a6d8157.jpeg', 'photo_663d78a6d816d.jpeg'),
(10, 1, 6, 'A boarding house offers a shared living experience with private rooms and communal amenities. Ideal for students, young professionals, or travelers, it\'s an affordable and convenient housing option where residents share common spaces like kitchens and bathrooms. With flexible rental terms, boarding houses promote a sense of community and provide a supportive environment for those seeking a home away from home.', 2, 1000.00, 'photo_663d78bc4f26d.jpg', 'photo_663d78bc4f287.jpg'),
(11, 1, 7, 'A boarding house offers a shared living experience with private rooms and communal amenities. Ideal for students, young professionals, or travelers, it\'s an affordable and convenient housing option where residents share common spaces like kitchens and bathrooms. With flexible rental terms, boarding houses promote a sense of community and provide a supportive environment for those seeking a home away from home.', 2, 1000.00, 'photo_663d78ccbf58f.jpg', 'photo_663d78ccbf5a4.jpg'),
(12, 1, 8, 'A boarding house offers a shared living experience with private rooms and communal amenities. Ideal for students, young professionals, or travelers, it\'s an affordable and convenient housing option where residents share common spaces like kitchens and bathrooms. With flexible rental terms, boarding houses promote a sense of community and provide a supportive environment for those seeking a home away from home.', 2, 1000.00, 'photo_663d78dd3273e.jpg', 'photo_663d78dd32753.jpg'),
(13, 1, 9, 'A boarding house offers a shared living experience with private rooms and communal amenities. Ideal for students, young professionals, or travelers, it\'s an affordable and convenient housing option where residents share common spaces like kitchens and bathrooms. With flexible rental terms, boarding houses promote a sense of community and provide a supportive environment for those seeking a home away from home.', 2, 500.00, 'photo_663d7927d78b0.jpg', 'photo_663d7927d78c6.jpeg'),
(14, 1, 10, 'A boarding house offers a shared living experience with private rooms and communal amenities. Ideal for students, young professionals, or travelers, it\'s an affordable and convenient housing option where residents share common spaces like kitchens and bathrooms. With flexible rental terms, boarding houses promote a sense of community and provide a supportive environment for those seeking a home away from home.', 5, 100.00, 'photo_663d79344ef36.jpg', 'photo_663d79344ef4e.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `room_reviews`
--

CREATE TABLE `room_reviews` (
  `review_id` int(11) NOT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `TenantID` int(11) DEFAULT NULL,
  `review_comment` varchar(255) DEFAULT NULL,
  `room_rating` int(11) DEFAULT NULL,
  `bh_rating` int(11) DEFAULT NULL,
  `cr_rating` int(11) DEFAULT NULL,
  `beds_rating` int(11) DEFAULT NULL,
  `kitchen_rating` int(11) DEFAULT NULL,
  `review_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_reviews`
--

INSERT INTO `room_reviews` (`review_id`, `room_id`, `TenantID`, `review_comment`, `room_rating`, `bh_rating`, `cr_rating`, `beds_rating`, `kitchen_rating`, `review_date`) VALUES
(2, 14, 1, 'Great room with beautiful viewsdfdsfsd fdsfsdfsdf sdfsdfs fsd fsd fsdfsd fdsf sdf dsf ds', 5, 5, 4, 5, 4, '2024-05-11'),
(11, 14, 2, 'Spacious and clean Great room with beautiful viewGreat room with beautiful viewGreat room with beautiful view', 4, 3, 5, 4, 5, '2024-05-11'),
(12, 14, 3, 'Nice and cozy Great room with beautiful viewGreat room with beautiful viewGreat room with beautiful view', 4, 4, 3, 4, 3, '2024-05-11'),
(13, 14, 2, 'Room was good, but needed some repairs', 3, 3, 3, 3, 2, '2024-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `TenantID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `checked_out` tinyint(1) DEFAULT 0,
  `Evsu_student` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`TenantID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Password`, `student_id`, `address`, `gender`, `checked_out`, `Evsu_student`) VALUES
(1, 'cord', 'sadkasmdk', 'cordmorale101@gmail.com', '423432', '$2y$10$dQC6eDkXVkrYsJbPXkypHeAsSM5nKQOF252LAUGpuUXrRiQ2UUtca', '232321', 'dsadas', 'Male', 1, 1),
(2, 'John', 'Doe', 'john.doe@example.com', '123-456-7890', 'password123', 'S12345', '123 Main St', 'Male', 0, 1),
(3, 'Jane', 'Smith', 'jane.smith@example.com', '098-765-4321', 'password123', 'S54321', '456 Elm St', 'Female', 0, 1),
(4, 'Emily', 'Johnson', 'emily.johnson@example.com', '555-555-5555', 'password123', 'S67890', '789 Pine St', 'Female', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bh_information`
--
ALTER TABLE `bh_information`
  ADD PRIMARY KEY (`bh_id`),
  ADD KEY `landlord_id` (`landlord_id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`bookmark_id`);

--
-- Indexes for table `landlord_acc`
--
ALTER TABLE `landlord_acc`
  ADD PRIMARY KEY (`landlord_id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `reserved_room`
--
ALTER TABLE `reserved_room`
  ADD PRIMARY KEY (`reserved_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `TenantID` (`TenantID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `fk_landlord` (`landlord_id`);

--
-- Indexes for table `room_reviews`
--
ALTER TABLE `room_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `TenantID` (`TenantID`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`TenantID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `idx_tenant_email` (`Email`),
  ADD UNIQUE KEY `idx_tenant_student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bh_information`
--
ALTER TABLE `bh_information`
  MODIFY `bh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `bookmark_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1042;

--
-- AUTO_INCREMENT for table `landlord_acc`
--
ALTER TABLE `landlord_acc`
  MODIFY `landlord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reserved_room`
--
ALTER TABLE `reserved_room`
  MODIFY `reserved_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `room_reviews`
--
ALTER TABLE `room_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `TenantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bh_information`
--
ALTER TABLE `bh_information`
  ADD CONSTRAINT `bh_information_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `landlord_acc` (`landlord_id`) ON DELETE CASCADE;

--
-- Constraints for table `reserved_room`
--
ALTER TABLE `reserved_room`
  ADD CONSTRAINT `reserved_room_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `reserved_room_ibfk_2` FOREIGN KEY (`TenantID`) REFERENCES `tenant` (`TenantID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_landlord` FOREIGN KEY (`landlord_id`) REFERENCES `landlord_acc` (`landlord_id`);

--
-- Constraints for table `room_reviews`
--
ALTER TABLE `room_reviews`
  ADD CONSTRAINT `room_reviews_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `room_reviews_ibfk_2` FOREIGN KEY (`TenantID`) REFERENCES `tenant` (`TenantID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

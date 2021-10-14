CREATE TABLE `department` (
  `IdD` int NOT NULL,
  `NameD` varchar(50) DEFAULT NULL
);

INSERT INTO `department` (`IdD`, `NameD`) VALUES
(320, 'Departement');

CREATE TABLE `users` (
  `Id` int NOT NULL,
  `Fullname` varchar(50) DEFAULT NULL,
  `Functions` varchar(50) DEFAULT NULL,
  `IdD` int DEFAULT NULL,
  `DateB` date DEFAULT NULL,
  `Images` varchar(50) DEFAULT NULL,
  `Addresss` varchar(50) DEFAULT NULL,
  `NumberM` varchar(50) DEFAULT NULL,
  `States` varchar(50) DEFAULT NULL,
  `Gander` enum('Homme','Femme') DEFAULT NULL,
  `Mobile` varchar(10) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Pwd` varchar(200) DEFAULT NULL,
  `Statuss` enum('Active','Deleted','Blocked') DEFAULT NULL,
  `Roles` enum('Admin','User','Secretaire','Receptioniste') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
);

INSERT INTO `users` (`Id`, `Fullname`, `Functions`, `IdD`, `DateB`, `Images`, `Addresss`, `NumberM`, `States`, `Gander`, `Mobile`, `Email`, `Pwd`, `Statuss`, `Roles`) VALUES
(11, 'jule3', 'dircap', 30, '2021-10-12', 'assets/img/doctor-thumb-05.jpg', 'BUYENZI', 'MPK10947', 'Bubanza', 'Homme', '75318023', 'jule3@gmail.com', '$2y$10$BAbcsA7rcdCMhIhvMQMpe.0SjHO0bNoLFAYNMXUN9d6VXLbg12mUe', 'Active', 'User'),
(12, 'jule4', 'dircap', 30, '2021-10-12', 'assets/img/doctor-thumb-05.jpg', 'BUYENZI', 'MPK10947', 'Bubanza', 'Homme', '75318023', 'jule4@gmail.com', '$2y$10$ka9KEZLMsFwif3cDqFk0keuek.3NWR3eD3QJ/votG0.CRLhFdUSnu', 'Active', 'User'),
(13, 'jule', 'dircap', 30, '2021-10-12', 'assets/img/doctor-thumb-05.jpg', 'BUYENZI', 'MPK10947', 'Bubanza', 'Homme', '75318023', 'jule@gmail.com', '$2y$10$dAAZPXK9xuqemblfiA2hweB7UJ26lLW8qiXOQjqH8z/xFQ2SM0beK', 'Active', 'User'),
(14, 'jule2', 'dircap', 30, '2021-10-12', 'assets/img/doctor-thumb-05.jpg', 'BUYENZI', 'MPK10947', 'Bubanza', 'Homme', '75318023', 'jule2@gmail.com', '$2y$10$YaJSXZan31xeOCxhJGcB2uWusLZdV/LC06dXqaQcubDRm3kvHYq7W', 'Active', 'User'),
(15, 'jule5', 'dircap', 30, '2021-10-12', 'assets/img/doctor-thumb-05.jpg', 'BUYENZI', 'MPK10947', 'Bubanza', 'Homme', '75318023', 'jule5@gmail.com', '$2y$10$zMHPJCvIwb/BfjkXpzjbEeesz15DuQI8PSeObhQQix1gsSymQJDgW', 'Active', 'User'),
(16, 'jule11', 'dircap', 30, '2021-10-12', 'assets/img/doctor-thumb-05.jpg', 'BUYENZI', 'MPK10947', 'Bubanza', 'Homme', '75318023', 'jule11@gmail.com', '$2y$10$s8Qm6cgwTzgo2ZeNhe.ZK.UqBmlQXBiCN78Qj/rI9.AKJGi4vVPWy', 'Active', 'User'),
(17, 'jule6', 'dircap', 30, '2021-10-12', 'assets/img/doctor-thumb-05.jpg', 'BUYENZI', 'MPK10947', 'Bubanza', 'Homme', '75318023', 'jule6@gmail.com', '$2y$10$g6tH4o1nrtkBKewJ.UYQLev.B1UNjGJG9AmaSJOpBueafc.GPDNiS', 'Active', 'User'),
(18, 'jule8', 'dircap', 30, '2021-10-12', 'assets/img/doctor-thumb-05.jpg', 'BUYENZI', 'MPK10947', 'Bubanza', 'Homme', '75318023', 'jule8@gmail.com', '$2y$10$jPzLZ95HJrN6ORi/ASLQRuTzfInfZ6ellal3ZjchkExzV29YfZfrq', 'Active', 'User'),
(19, 'jule9', 'dircap', 320, '2021-10-13', 'assets/img/doctor-thumb-05.jpg', 'BUYENZI', 'MPK10947', 'Bubanza', 'Homme', '75318023', 'jule9@gmail.com', '$2y$10$2BscJlH6.3ON0T2WketnAOW8CuzGuqAkfcujmKLFooDXmncStyO/y', 'Active', 'Admin'),
(20, 'Sadock M', 'DirCab', 320, '2021-10-08', 'assets/img/doctor-thumb-05.jpg', 'Kigobe', '124683', 'Bujumbura Mairie', 'Homme', '72057029', 'sadock@gmail.com', '$2y$10$gVJG/B5pAjz2uy1FuBvLye5HiCpSvUD1Xjo8ELDwoB/0Khn4Iz3Ne', 'Active', 'Receptioniste'),
(21, 'Charles M', 'Secretaire', 320, '2021-10-08', 'assets/img/doctor-thumb-05.jpg', 'Kigobe', '1246834', 'Bujumbura Mairie', 'Homme', '72057029', 'charles@gmail.com', '$2y$10$QNC8cpyJWhRnS4vFpIKT3ek7so20.T2CzD/t9Ppy8H3fAVfwtHeHu', 'Active', 'User');

ALTER TABLE `department`
  ADD PRIMARY KEY (`IdD`),
  ADD UNIQUE KEY `NameD` (`NameD`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

ALTER TABLE `department`
  MODIFY `IdD` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;


ALTER TABLE `users`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

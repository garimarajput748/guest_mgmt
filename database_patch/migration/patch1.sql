/**
* This will create guest list table in db
* SHOW CREATE TABLE <TABLE_NAME> this query will return create table structure
*/

--
-- Database: `guest_mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `guest_list`
--
 CREATE TABLE  IF NOT EXISTS `guest_list` (
  `user_id` varchar(20) NOT NULL,
  `guest_id` int(100) NOT NULL AUTO_INCREMENT,
  `guest_name` varchar(50) NOT NULL,
  `guest_mobile` int(10) NOT NULL,
  `guest_address` varchar(100) NOT NULL,
  `relationship` varchar(50) NOT NULL,
  PRIMARY KEY (`guest_id`)
);

--
-- Table structure for table `register_users`
--
CREATE TABLE IF NOT EXISTS `register_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
);

--
-- Table structure for table `event_list`
--
CREATE TABLE IF NOT EXISTS `event_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventName` varchar(50) NOT NULL,
  `totalGuests` varchar(50) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `eventDate` date DEFAULT NULL,
  `createdDate` date NOT NULL DEFAULT current_timestamp(),
  `updatedDate` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
);
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
  `guest_id` int(100) NOT NULL AUTO_INCREMENT,
  `guest_name` varchar(50) NOT NULL,
  `guest_mobile` int(10) NOT NULL,
  `guest_address` varchar(100) NOT NULL,
  PRIMARY KEY (`guest_id`)
);


CREATE TABLE IF NOT EXISTS `register_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
);
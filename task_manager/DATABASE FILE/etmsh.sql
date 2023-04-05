

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



-- Database: `etmsh`
--

-- --------------------------------------------------------

-- Table structure for table `task_progress`
--

CREATE TABLE IF NOT EXISTS `task_progress` (
`aten_id` int(20) NOT NULL,
  `atn_user_id` int(20) NOT NULL,
  `start_time` varchar(200) DEFAULT NULL,
  `end_time` varchar(150) DEFAULT NULL,
  `total_duration` varchar(100) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task_progress`
--

INSERT INTO `task_progress` (`aten_id`, `atn_user_id`, `start_time`, `end_time`, `total_duration`) VALUES
(1, 1, '22-06-2022 13:51:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_info`
--

CREATE TABLE IF NOT EXISTS `task_info` (
`task_id` int(50) NOT NULL,
  `t_title` varchar(120) NOT NULL,
  `t_description` text,
  `t_start_time` varchar(100) DEFAULT NULL,
  `t_end_time` varchar(100) DEFAULT NULL,
  `t_user_id` int(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = incomplete, 1 = In progress, 2 = complete'
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task_info`
--

INSERT INTO `task_info` (`task_id`, `t_title`, `t_description`, `t_start_time`, `t_end_time`, `t_user_id`, `status`) VALUES
(1, 'Communications', 'You''re assigned to handle incoming calls and other communications within the office.', '2022-06-22 15:20', '2022-06-22 15:20', 1, 2),
(2, 'Filing', 'You''re assigned to management of filing system.', '2022-06-22 15:20', '2022-06-22 15:20', 1, 2),
(3, 'Virtual Meeting', 'Please join the virtual meeting with your senior manager regarding your works on this placement.', '2022-06-22 15:20', '2022-06-22 15:20', 24, 0),
(4, 'Data Entry', 'Go through some data!', '2022-06-22 15:20', '2022-06-22 15:20', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
`user_id` int(20) NOT NULL,
  `fullname` varchar(120) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `temp_password` varchar(100) DEFAULT NULL,
  `user_role` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`user_id`, `fullname`, `username`, `email`, `password`, `temp_password`, `user_role`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1),
(2, 'Diana', 'diana', 'diana@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1),
(3, 'Lizie', 'lizie', 'lizie@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 2),
(4, 'Jay', 'jay', 'jay@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 2);

--
-- Indexes for dumped tables
--
--
-- Indexes for table `task_progress`
--
ALTER TABLE `task_progress`
 ADD PRIMARY KEY (`aten_id`);

--
-- Indexes for table `task_info`
--
ALTER TABLE `task_info`
 ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task_progress`
--
ALTER TABLE `task_progress`
MODIFY `aten_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `task_info`
--
ALTER TABLE `task_info`
MODIFY `task_id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;

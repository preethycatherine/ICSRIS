-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2016 at 11:05 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_list`
--

CREATE TABLE IF NOT EXISTS `tbl_admin_list` (
  `admin_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_user_id` varchar(50) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `d_flg` int(11) NOT NULL,
  PRIMARY KEY (`admin_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin_list`
--

INSERT INTO `tbl_admin_list` (`admin_auto_id`, `admin_user_id`, `admin_name`, `admin_email`, `admin_password`, `d_flg`) VALUES
(1, 'ADMINIPR001', 'Admin', 'admin@gmail.com', 'admin@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE IF NOT EXISTS `tbl_department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` text NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`dept_id`, `dept_name`) VALUES
(1, 'Aerospace Engineering'),
(2, 'Applied Mechanics'),
(3, 'Biotechnology'),
(4, 'CEWIT'),
(5, 'Chemical engineering'),
(6, 'Chemistry'),
(7, 'Civil Engineering'),
(8, 'Computer Science and Engineering'),
(9, 'Electrical Engineering'),
(10, 'Engineering Design'),
(11, 'Management Studies'),
(12, 'Materials Science and Research Centre'),
(13, 'Mechanical Engineering'),
(14, 'Metallurgical and Materials Engineering'),
(15, 'Ocean Engineering'),
(16, 'Physics'),
(17, 'Sophisticated Analytical Instrumentation Facility'),
(18, 'Mathematics');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_design`
--

CREATE TABLE IF NOT EXISTS `tbl_design` (
  `design_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `patent_no` varchar(500) NOT NULL,
  `patent_date` date NOT NULL,
  `appl_no` varchar(500) NOT NULL,
  `file_no` varchar(25) NOT NULL,
  `title` longtext NOT NULL,
  `abstract` longtext NOT NULL,
  `inventor` int(11) NOT NULL,
  `sub_inventor` longtext NOT NULL,
  `department` int(11) NOT NULL,
  `industry` int(11) NOT NULL,
  `technology` int(11) NOT NULL,
  `filing_date` date NOT NULL,
  `filing_year` int(11) NOT NULL,
  `filing_country` int(11) NOT NULL,
  `d_flg` int(11) NOT NULL,
  PRIMARY KEY (`design_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_design`
--

INSERT INTO `tbl_design` (`design_auto_id`, `patent_no`, `patent_date`, `appl_no`, `file_no`, `title`, `abstract`, `inventor`, `sub_inventor`, `department`, `industry`, `technology`, `filing_date`, `filing_year`, `filing_country`, `d_flg`) VALUES
(1, '254443', '2013-06-11', '254443', '1019', 'Water purifier design and line drawings\r\n', 'design-1019.jpg', 74, '', 6, 7, 142, '2013-06-11', 39, 1, 0),
(2, '257312', '2014-12-16', '257312', '1114', 'Amrit Drinking Water Tank\r\n\r\n\r\n', 'design-1114.jpg', 74, '', 6, 7, 142, '2013-09-09', 39, 1, 0),
(3, '', '2001-01-01', '260460', '1164', 'Anti-gravity water filter Cartridge\r\n\r\n\r\n\r\n', 'design-1164.jpg', 74, '', 6, 11, 151, '2014-02-19', 40, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_filing_country`
--

CREATE TABLE IF NOT EXISTS `tbl_filing_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(25) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_filing_country`
--

INSERT INTO `tbl_filing_country` (`country_id`, `country`) VALUES
(1, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_filing_year`
--

CREATE TABLE IF NOT EXISTS `tbl_filing_year` (
  `year_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(20) NOT NULL,
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `tbl_filing_year`
--

INSERT INTO `tbl_filing_year` (`year_id`, `year`) VALUES
(1, '1975'),
(2, '1976'),
(3, '1977'),
(4, '1978'),
(5, '1979'),
(6, '1980'),
(7, '1981'),
(8, '1982'),
(9, '1983'),
(10, '1984'),
(11, '1985'),
(12, '1986'),
(13, '1987'),
(14, '1988'),
(15, '1989'),
(16, '1990'),
(17, '1991'),
(18, '1992'),
(19, '1993'),
(20, '1994'),
(21, '1995'),
(22, '1996'),
(23, '1997'),
(24, '1998'),
(25, '1999'),
(26, '2000'),
(27, '2001'),
(28, '2002'),
(29, '2003'),
(30, '2004'),
(31, '2005'),
(32, '2006'),
(33, '2007'),
(34, '2008'),
(35, '2009'),
(36, '2010'),
(37, '2011'),
(38, '2012'),
(39, '2013'),
(40, '2014'),
(41, '2015'),
(42, '2016');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_industry`
--

CREATE TABLE IF NOT EXISTS `tbl_industry` (
  `indus_id` int(11) NOT NULL AUTO_INCREMENT,
  `indus_name` text NOT NULL,
  PRIMARY KEY (`indus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_industry`
--

INSERT INTO `tbl_industry` (`indus_id`, `indus_name`) VALUES
(1, 'Agri Based'),
(2, 'Automotive'),
(3, 'Bio Medical Engineering'),
(4, 'Capital Equipment/ OEM'),
(5, 'Electronic System & Design Manufacturing (ESDM)'),
(6, 'Energy/Infrastructure'),
(7, 'Environment Engineering'),
(8, 'Environment Engineering'),
(9, 'Information & Communication Technology (ICT)'),
(10, 'Manufacturing/Chemical'),
(11, 'Other Technologies'),
(12, 'Special Needs');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventor`
--

CREATE TABLE IF NOT EXISTS `tbl_inventor` (
  `invent_id` int(11) NOT NULL AUTO_INCREMENT,
  `invent_name` text NOT NULL,
  `inventor_url` text NOT NULL,
  PRIMARY KEY (`invent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

--
-- Dumping data for table `tbl_inventor`
--

INSERT INTO `tbl_inventor` (`invent_id`, `invent_name`, `inventor_url`) VALUES
(1, 'ABDUS SAMAD', ''),
(2, 'AJIT KUMAR KOLAR', ''),
(3, 'ANAND T N C', ''),
(4, 'ANIL PRABHAKAR', 'https://www.iitm.ac.in/info/fac/anilpr\n'),
(5, 'ANIRUDDHAN', 'https://www.iitm.ac.in/info/fac/ani\n'),
(6, 'ANJAN CHAKRAVORTY', 'https://www.iitm.ac.in/info/fac/anjan\n'),
(7, 'ANJU CHADHA', ''),
(8, 'ANURAG MITTAL', ''),
(9, 'ARUN K TANGIRALA', ''),
(10, 'ARUN PACHAIKANNU', ''),
(11, 'ARYA KUMAR BEDABRATA CHAND', ''),
(12, 'ASHIS KUMAR SEN', ''),
(13, 'ASHOK JHUNJHUNWALA', 'https://www.iitm.ac.in/info/fac/ashok'),
(14, 'ASOKAN T', 'http://ed.iitm.ac.in/~asokan/\n'),
(15, 'B.VISWANATHAN', ''),
(16, 'BALAJI SRINIVASAN', 'https://www.iitm.ac.in/info/fac/balajis'),
(17, 'Balaraju K', ''),
(18, 'BALKRISHNA C RAO', ''),
(19, 'BHASKAR RAMAMURTHI', ''),
(20, 'Bijoy M D', 'http://www.ee.iitm.ac.in/~bkdas/\n'),
(21, 'BOBY GEORGE', 'https://www.iitm.ac.in/info/fac/boby\n'),
(22, 'CHANDRA T S', ''),
(23, 'CHENNABASAVAN T S', ''),
(24, 'DEBASHIS CHAKRABORTY', ''),
(25, 'DHAMODHARAN R', ''),
(26, 'ENAKSHI BHATTACHARYA', ''),
(27, 'GANESH L S', ''),
(28, 'GIRIDHAR K', ''),
(29, 'GNANAMOORTHY R', ''),
(30, 'GOKULARATHNAM C V', ''),
(31, 'GONSALVES T A', ''),
(32, 'GOPALAKRISHNAN K V', ''),
(33, 'GYAN VARDHAN GUPTA', ''),
(34, 'H S N MURTHY', ''),
(35, 'INDRAPAL SINGH AIDHEN', ''),
(36, 'JAGADEESH KUMAR V', 'http://www.ee.iitm.ac.in/~vjkumar/index.html\n'),
(37, 'JANAKI RAM D', ''),
(38, 'JAYARAJ JOSEPH', ''),
(39, 'JAYASHANKAR V', ''),
(40, 'JITENDRA S SANGWAI', 'https://sites.google.com/site/drjitendraiitmadras/\n'),
(41, 'KARMALKAR S', ''),
(42, 'Karunanidhi S', ''),
(43, 'KAVITHA ARUNACHALAM', ''),
(44, 'KOTHANDARAMAN RAMANUJAM', 'https://www.iitm.ac.in/info/fac/rkraman\n'),
(45, 'KRISHNAMOORTHY S', ''),
(46, 'Krishnamurthy P', ''),
(47, 'KRISHNAMURTHY R', ''),
(48, 'KRISHNAN BALASUBRAMANIAM', 'https://www.iitm.ac.in/info/fac/balas\n'),
(49, 'KUMARASWAMY S', ''),
(50, 'LIGY PHILIP', ''),
(51, 'MADHULIKA DIXIT', 'https://biotech.iitm.ac.in/faculty/madhulika-dixit/'),
(52, 'MADHUSUDANA RAO M', ''),
(53, 'MAHESH V PANCHAGNULA', ''),
(54, 'MANI J S', ''),
(55, 'MANIVANNAN MUNIYANDI', ''),
(56, 'MANIVANNAN P V', ''),
(57, 'MAYURAM M M', ''),
(58, 'MISHRA A K', ''),
(59, 'MOHANASANKAR SIVAPRAKASAM', ''),
(60, 'MUKESH DOBLE', ''),
(61, 'MURALEEDHARAN K M', ''),
(62, 'MURTY B S', ''),
(63, 'NADEEM AKHTAR', ''),
(64, 'NAGALINGAM B', ''),
(65, 'NAGENDRA KRISHNAPURA', 'http://www.ee.iitm.ac.in/~nagendra/index.html\n'),
(66, 'NARAYANAN S S', ''),
(67, 'NILESH J.VASA', 'http://ed.iitm.ac.in/~vasa/\n'),
(68, 'NIRANJAN JOSHI KEERTHI RAM', ''),
(69, 'PADMANABHAN K A', ''),
(70, 'PARAMANAND SINGH', ''),
(71, 'PATIL K M', ''),
(72, 'PILLAI C N', ''),
(73, 'PRADEEP KIRAN SARVEPALLI', ''),
(74, 'PRADEEP T', 'https://www.iitm.ac.in/info/fac/pradeep\n'),
(75, 'PRAKASH MAIYA M', ''),
(76, 'PREEJITH S P', ''),
(77, 'PREM B BISHT', 'http://www.physics.iitm.ac.in/~prem/\n'),
(78, 'RADHAKRISHNAN V', ''),
(79, 'RAGHURAM CHETTY', ''),
(80, 'RAJAGOPALAN A N', ''),
(81, 'RAMA RAO K V S', ''),
(82, 'RAMACHANDRA RAO M S', ''),
(83, 'Ramakoteswara Rao K', ''),
(84, 'RAMAKRISHNA P A', ''),
(85, 'RAMAMURTHY K', ''),
(86, 'RAMANATHAN S', ''),
(87, 'RAMESH A', ''),
(88, 'RAMESH BABU N', ''),
(89, 'RAMMOHANA RAO A', ''),
(90, 'RASHMIN GANDHI', ''),
(91, 'SAMPATH KUMAR T S', ''),
(92, 'SANDIPAN BANDYOPADHYAY', ''),
(93, 'SANKARA J SUBRAMANIAN', ''),
(94, 'SANKARAN P', ''),
(95, 'SANKARAN S', 'https://www.iitm.ac.in/info/fac/ssankaran\n'),
(96, 'SANKARARAMAN S', ''),
(97, 'SANTHAKUMAR S', ''),
(98, 'SARAVANA KUMAR G', ''),
(99, 'SARIT KUMAR DAS', ''),
(100, 'SASIDHARA RAO P', ''),
(101, 'SASTRY V V', ''),
(102, 'SESHADRI S K', ''),
(103, 'SHANKAR BALACHANDRAN', ''),
(104, 'SHANKAR KRISHNAPILLAI', 'https://www.iitm.ac.in/info/fac/skris\n'),
(105, 'SHANKAR NARASIMHAN', 'http://www.che.iitm.ac.in/~naras/index.php'),
(106, 'SHANTHI PAVAN', 'https://www.iitm.ac.in/info/fac/shanthi.pavan\n'),
(107, 'SHEETAL KALYANI', ''),
(108, 'SHUNMUGAM M S', 'https://www.iitm.ac.in/info/fac/shun\n'),
(109, 'SMITA SRIVASTAVA', ''),
(110, 'SOMA GUHATHAKURTA', ''),
(111, 'SREENIVAS JAYANTI', 'https://www.iitm.ac.in/info/fac/sjayanti\n'),
(112, 'SRIKANTH VEDANTAM', 'https://www.iitm.ac.in/info/fac/srikanth\n'),
(113, 'SRINIVAS CHAKRAVARTHY', 'https://biotech.iitm.ac.in/faculty/srinivasa-chakravarthy-v/\n'),
(114, 'SRINIVASA REDDY K', 'https://www.iitm.ac.in/info/fac/ksreddy\n'),
(115, 'SRINIVASAN K', ''),
(116, 'SRIRAMA SRINIVAS', ''),
(117, 'Subha Rao G V', ''),
(118, 'SUBRAHMANYAM A', ''),
(119, 'SUJATHA SRINIVASAN', 'https://www.iitm.ac.in/info/fac/sujsree\n'),
(120, 'SUJITH R I', ''),
(121, 'SURAISH KUMAR G K', ''),
(122, 'VARADARAJU U V', ''),
(123, 'VARMA Y B G', ''),
(124, 'VASUDEVAN R', ''),
(125, 'VENKATARATNAM G', ''),
(126, 'VENKATESH BALASUBRAMANIAN', ''),
(127, 'VIGNESH KRISHNAKUMAR', ''),
(128, 'VIJAYARAGHAVAN L', 'https://www.iitm.ac.in/info/fac/lvijay\n'),
(129, 'VISWANATHAN B', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus`
--

CREATE TABLE IF NOT EXISTS `tbl_menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_menus`
--

INSERT INTO `tbl_menus` (`menu_id`, `menu_name`) VALUES
(1, 'Patents'),
(2, 'Softwares'),
(3, 'Designs'),
(4, 'Other IP');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_otherip`
--

CREATE TABLE IF NOT EXISTS `tbl_otherip` (
  `otherip_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `patent_no` varchar(500) NOT NULL,
  `patent_date` date NOT NULL,
  `appl_no` varchar(500) NOT NULL,
  `file_no` varchar(25) NOT NULL,
  `title` longtext NOT NULL,
  `abstract` longtext NOT NULL,
  `inventor` int(11) NOT NULL,
  `sub_inventor` longtext NOT NULL,
  `department` int(11) NOT NULL,
  `industry` int(11) NOT NULL,
  `technology` int(11) NOT NULL,
  `filing_date` date NOT NULL,
  `filing_year` int(11) NOT NULL,
  `filing_country` int(11) NOT NULL,
  `d_flg` int(11) NOT NULL,
  PRIMARY KEY (`otherip_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_otherip`
--

INSERT INTO `tbl_otherip` (`otherip_auto_id`, `patent_no`, `patent_date`, `appl_no`, `file_no`, `title`, `abstract`, `inventor`, `sub_inventor`, `department`, `industry`, `technology`, `filing_date`, `filing_year`, `filing_country`, `d_flg`) VALUES
(2, '', '0000-00-00', '2708277', '1170', 'KORE DHARA\r\n', 'otherip-1170.png', 37, '', 8, 9, 151, '2014-03-28', 40, 1, 0),
(3, '', '0000-00-00', '2708276', '1177', 'KORE MOOL\r\n\r\n', 'otherip-1177.png', 37, '', 8, 9, 151, '2014-03-28', 40, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patent`
--

CREATE TABLE IF NOT EXISTS `tbl_patent` (
  `patent_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `patent_no` varchar(500) NOT NULL,
  `patent_date` date NOT NULL,
  `appl_no` varchar(500) NOT NULL,
  `file_no` varchar(25) NOT NULL,
  `title` longtext NOT NULL,
  `abstract` longtext NOT NULL,
  `inventor` int(11) NOT NULL,
  `sub_inventor` longtext NOT NULL,
  `department` int(11) NOT NULL,
  `industry` int(11) NOT NULL,
  `technology` int(11) NOT NULL,
  `filing_date` date NOT NULL,
  `filing_year` int(11) NOT NULL,
  `filing_country` int(11) NOT NULL,
  `d_flg` int(11) NOT NULL,
  PRIMARY KEY (`patent_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=329 ;

--
-- Dumping data for table `tbl_patent`
--

INSERT INTO `tbl_patent` (`patent_auto_id`, `patent_no`, `patent_date`, `appl_no`, `file_no`, `title`, `abstract`, `inventor`, `sub_inventor`, `department`, `industry`, `technology`, `filing_date`, `filing_year`, `filing_country`, `d_flg`) VALUES
(1, '', '0000-00-00', '4708/CHE/2012', '1345', 'Interference mitigation technique for Heterogeneous/Homogeneous networks employing dynamic Downlink/Uplink configuration', '', 19, '', 9, 9, 98, '2012-11-09', 38, 1, 0),
(2, '', '0000-00-00', '4708/CHE/2012', '1344', 'Multi-Operator coexistence in Heterogeneous/Homogeneous networks', 'Embodiments disclosed herein relate to OFDM based data communication systems, and more particularly to multi-operator coexistence in heterogeneous/homogeneous networks using OFDM based data communication  systems.', 19, '', 9, 9, 98, '2012-11-09', 38, 1, 0),
(3, '', '0000-00-00', '571/CHE/2014', '1277', 'Adaptive link Adaptation Methods', '', 107, '', 9, 9, 149, '2014-02-07', 40, 1, 0),
(4, '', '0000-00-00', '3148/CHE/2014', '1187', 'A handheld portable device for coating electrospun polymer nanofibers on non-conductive surfaces.', 'A method for Wide-range fabrication of Nanofibre-webs for pest-control and extended life of farm produce is disclosed. Still further, an apparatus and system for safe operation as well as for controlling the environment of the electrospun fibres throughout their duration of flight from the spinneret nozzle to the targeted point of app lication is disclosed.', 22, '', 3, 1, 104, '2014-06-27', 40, 1, 0),
(5, '', '0000-00-00', '2582/CHE/2014', '1185', 'A new methodology to estimate heat loss of a passive direct methanol fuel cell', '', 2, '', 13, 6, 55, '2014-05-26', 40, 1, 0),
(6, '', '0000-00-00', '2023/CHE/2014', '1184', 'User perception-based prediction of graphical user interface', '\nThe embodiments herein provide a method and system for predicting GUI personalized for a user of an electronic device. The method includes identifying a plurality of elements present within an image frame. Further, the method includes computing a degree of similarity between one or more element within the image frame and a target element, wherein the degree of similarity is computed based on one or more parameters associated with the user. Furthermore, the method includes predicting the GUI for the user based on the degree of similarity ', 13, '', 9, 5, 65, '2014-04-21', 40, 1, 0),
(7, '', '0000-00-00', '2505/CHE/2014', '1180', 'Biopolymer-Based, Biodegradable, super Water-Absorbing polymers (SWAP) and Processes for the Preparation of the Same', 'A biodegradable super water absorbing  polymeric material (SWAP) is provided comprising of at least one biopolymer containing polysaccharides, at least one chelating agent, and at least one fertilizer(s) wherein the weight ratio of biopolymer to chelating\n		agent to fertilizer is 1:2:2. The invention further provides a process of preparing the biodegradable super water absorbing polymeric material comprising  the  steps  of, mixing the biopolymer in the weight ratio to the fertilizer-chelating agent  mixture; heating the reaction mixture; cooling and purifying the product and uses thereof.', 25, '', 6, 11, 141, '2014-05-20', 40, 1, 0),
(8, '', '0000-00-00', '2250/CHE/2014', '1179', 'Novel system for measuring permeability of drugs/toxic chemicals/pesticides/carcinogens/plasma protein binding/ADME properties through lipid layer to predict oral ingestion of these compounds into the blood stream', 'Suspension is the term given to the system of springs, shock absorbers and linkages that connects a vehicle to its wheels and allows relative motion between the two. Suspension systems serve a dual purpose contributing to the vehicle''s road holding I handling, breaking for good active safety, driving pleasure,  keeping vehicle occupants comfortable, reasonably well isolated  from road noise and vibrations, etc. The goal of this project is to create a suspension system for two wheelers using bow spring and open spring. At this present situation most of the two wheelers are mounted with open spring suspension system and it is outside from the wheel. In this hybrid suspension system combination of open and bow spring is used as suspension system inside the wheel. So it may create high suspension comparing to earlier  system.', 60, '', 3, 3, 45, '2014-05-23', 40, 1, 0),
(9, '', '0000-00-00', '2168/CHE/2014', '1178', 'System and method for early detection of oneset of instabilities in combustion or aero-mechnacial or aero-elastic systems by constructing complex networks', '', 120, '', 1, 4, 73, '2014-04-29', 40, 1, 0),
(10, '', '0000-00-00', '2408/CHE/2014', '1174', 'Method to monitor surface temperature of a passive direct methanol fuel cell', '', 2, '', 13, 6, 55, '2014-05-15', 40, 1, 0),
(11, '', '0000-00-00', '334/CHE/2014', '1169', 'Providing uninterrupted power supply to consumers', 'Embodiments herein disclose a method and system to supply an Uninterrupted-But-Limited Power (LUP) supply in Direct Current (DC) or Alternating current (AC) form to consumers using existing electrical supply networks. A brown-out state is created by supplying the LUP instead of completely cutting the power using at least two power lines. One line is limited but uninterrupted,	while the other line is not limited but may be interrupted.', 13, '', 9, 6, 137, '2014-01-27', 40, 1, 0),
(12, '', '0000-00-00', '945/CHE/2014', '1168', 'A brake energy recovery system in conventional vehicle with super-capacitor and battery energy storage devices', '', 116, '', 9, 2, 20, '2014-02-25', 40, 1, 0),
(13, '', '0000-00-00', '663/CHE/2014', '1167', 'A single remote control unit for controlling various devices', 'Embodiments herein disclose a system and method for controlling multiple classes of devices using a single remote control unit. More particularly, the remote  control  unit can be  used  for controlling (on,  off,  increase, and decrease) multiple classes of home devices without any modification to the existing electrical wiring or wireless system. Further, the user may select or deselect the required device from the remote control unit by choosing appropriate device-class button. Furthermore, the remote control unit can be pointed towards the respective device to perform intended operations on the devices.', 13, '', 9, 5, 40, '2014-02-12', 40, 1, 0),
(14, '', '0000-00-00', '659/CHE/2014', '1166', 'Non-invasive measurement of Hemoglobin in blood', '', 36, '', 9, 3, 90, '2014-02-12', 40, 1, 0),
(15, '', '0000-00-00', '1328/CHE/2014', '1165', 'Microwave hyperthermia device with compact heating applicator and low cost inline degassing for bolus circulation', '', 43, '', 10, 3, 24, '2014-03-13', 40, 1, 0),
(16, '', '0000-00-00', '2084/CHE/2014', '1158', 'Downlink Synchronization in heterogeneous cellular networks', '', 10, '', 9, 9, 26, '2014-02-24', 40, 1, 0),
(17, '', '0000-00-00', '2504/CHE/2014', '1153', 'Method of retrofitting and actuating variable profile cam for controlling lift and timing of engine valves', 'The  embodiments  herein provide  a  system  and  method  for  downlink synchronization in a Heterogeneous Network (HetNet). A User Equipment (UE) receives transmitted frames containing synchronization signal from multiple BS''s. The UE determines the timing of the synchronization signal in the frames using a Joint Cell Detection (JCD)  metric.  Based on the timing   detection,   an  observation  containing   the	training	sequences transmitted by the BS''s in the HetNet. A compressive sensing framework including a sensing matrix is built to extract the identity of the BS with weak signal strength, which can serve the UE and a set of interfering BS''s.', 112, '', 10, 2, 57, '2014-05-20', 40, 1, 0),
(18, '', '0000-00-00', '1039/CHE/2014', '1152', 'Bioceramic Nanocarrier Formulations for Simultaneous Drug Delivery Treatments', 'A novel bioceramic nanocarrier formulation based bone filler with multi-drug delivery mechanism. Calcium phosphate ceramic nanoparticles (e.g., HA, CDHA, and f3-TCP nanoparticles) are synthesized at optimal conditions in order thereby use the nanoparticles as bone fillers for infected parts of human body in wide range of surgical applications. The synthesized calcium phosphate ceramic nanoparticles are loaded with multiple drug compositions which enables the bone filler nanoparticles to act as local drug delivery systems. The nanoparticles are capable of simultaneously releasing multiple drug compositions thereby functioning as enhanced bone fillers with multi-drug delivery features.', 91, '', 14, 3, 37, '2014-02-28', 40, 1, 0),
(19, '', '0000-00-00', '138/CHE/2014', '1151', 'Engineered pericardium and Derivatives for uses in Medicine, Pharmaceuticals,Food and Cosmetics', 'A novel process for obtaining engineered pericardium and derivatives for uses in Medicine, Pharmaceuticals, Food and Cosmetics. Initially, pericardium can be harvested from a mammalian source in order thereby treat it with sodium deoxycholate or related salt of cholic acid to obtain 100% decellularization without damaging the basic collagen architecture. Further, DNAse and RNAse treatment can be given for 8-20 hours in the presence or absence of shaking. Next, the decellularized pericardium is strengthened by the use of non-glutaraldehyde cross- linking agents. A coating of biodegradable electro-spun biocompatible polymer nano-fibre can be used according to its usage before cross-linking. Finally, the engineered pericardium can be preserved in a solution of 50-90% ethanol. The container used for storage can be made up glass or any other related material.', 110, '', 10, 3, 1, '2014-01-10', 40, 1, 0),
(20, '', '0000-00-00', '940/CHE/2014', '1150', 'Electrophysiological monitoring of the heat dry electrodes on non-traditional, non-boney regions of the chest.', 'A system and method for  electrophysiological  monitoring  of heart using dry electrodes. An ultra-high channel jacket having at least one dry electrode for measuring the electrical activity at the high potential areas of a subject. The dry electrodes are designed by developing a polymer based 3-dimensional printed electrode in RPT. Further, the electrode  is subjected  to  electro-less  nickel  plating and gold plating sub.sequently. The information collected from the elect.rodes of high\n\npotential areas of the subject is further mapped with a three-dimensional geometry unit. The mapped results can be finally printed on to a media for providing accurate monitoring of electrophysiological activities of the  heart in order thereby permit the medical expert to effectively diagnose the heart failures of the subject.', 126, '', 10, 3, 106, '2014-02-25', 40, 1, 0),
(21, '', '0000-00-00', '6186/CHE/2013', '1149', 'N-Methylpyrrolidinone hydroperoxide as an efficient epoxidation reagent\r\n', '', 61, '', 6, 10, 28, '2013-12-31', 39, 1, 0),
(22, '', '0000-00-00', '6137/CHE/2013', '1148', 'Molecular Ionization from Carbon Nanotube Paper\r\n', 'The present invention relates to ambient ionization from impregnated I coated paper source for mass spectrometry and methods thereof. The said impregnations I coatings are achieved using  carbon nanotubes (CNTs). The CNT-impregnated paper is used to generate ions from organic molecules at potentials as  low as 3V. Further the present invention demonstrates the possibility of analytical mass spectrometry with a battery.', 74, '', 6, 3, 39, '2013-11-12', 39, 1, 0),
(24, '', '0000-00-00', '100/MUM/2014', '1147', 'Layered oxide catalyst composites for photo-catalytic reduction of carbon dioxide\n\n', 'The present invention relates to a catalyst composite based on strontium titanate, modified with elements like N, S, Fe, MgO and Al2O3, incorporated either separately or together. The process for photo catalytic reduction of CO2 comprises reacting carbon dioxide and alkaline water in the presence of the catalyst composite that is irradiated with radiation with wavelength in the range of 300-700 nm to produce lower hydrocarbons and hydrocarbon oxygenates.', 129, '', 6, 10, 109, '2014-01-10', 40, 1, 0),
(25, '', '0000-00-00', '5845/CHE/2013', '1146', 'Flow regulator for multi-feed fluid manifolds\n\n\n', 'The present invention relates to a novel robust tlow regulator for a multi-feed lluid  manii''nlds.  The invention makes use of optimally located guide vanes to achieve a desired tlow distribution in a blm\\ in g. manifold. The said flow regulator enables equal or desired flow distribution surrounded by a number ol" Jlow  paths  in  a  multi-feed  manifold.  The tlow  regulator  of the  invention  and  related  methods  can  be	applied in several cases of a varied area for tlow distribution.', 111, '', 5, 4, 75, '2013-12-16', 39, 1, 0),
(26, '', '0000-00-00', '3534/CHE/2013', '1144', 'A platform for screening for opthalmic problem\r\n', 'Embodiments herein provide a method and apparatus for performing ophthalmic image analysis. The method includes obtaining a fundus image. Further, the method includes enhancing the fundus image by pre-processingthe fundus image. Further, the method includes localizing normal anatomy structures of the enhanced fundus image. Further, the method includes detecting a candidate lesion on the localized image and determines a degree of abnormality of the candidate lesion. F urther, the method includes indicating an outcome of the image analysis.', 68, '', 9, 3, 101, '2013-08-07', 39, 1, 0),
(27, '', '0000-00-00', '2190/CHE/2013', '1143', 'System and method for ocular compression\r\n', 'System and method for ocular compression, the system includes a pressure administering means, a means receiving air supply, a pressure sensor, a solenoid valve, an air pump, a display unit, and a microcontroller. The pressure administering means is placed over the eye and the pressure parameters are provided in the display unit. Based on the data received from the display unit and the pressure sensor, the micro-controller controls the air pump and solenoid valve to apply and control the pressure inside the pressure administering means. The method for applying pressure includes providing a pressure administering means with air supply, providing a display unit with pressure parameters and applying and controlling the pressure, based on the pressure parameters using a micro-controller.', 76, '', 9, 3, 101, '2013-05-17', 39, 1, 0),
(28, '', '0000-00-00', '2023/CHE/2013', '1142', 'System and method for ophthalmic anesthesia training\n', 'System and method for training of regional ophthalmic anesthesia, the system includes at least one electrically conductive extraocular muscle structure, a data acquisition system (DAS), a syringe having a needle and a graphical user interface (GUI). The DAS is provided in communication with the syringe and eye structure, and configured to excite the needle of the syringe and locate the syringe having needle based on at least one of capacitance or resistance between the syringe having needle and the extraocular muscle structure. Further, the GUI receives data from the DAS and display the location of the syringe by suitable means. A method for locating a syringe having needle includes providing an electrically conductive eye structure, providing the syringe with an electrical signal and determining the location of syringe having needle based on at least one of the capacitance or resistance between the syringe having needle and the eye structure.', 21, '', 9, 3, 101, '2013-05-06', 39, 1, 0),
(29, '', '0000-00-00', '1993/CHE/2013', '1141', 'Measuring the rate of injection in a syringe\r\n', 'The embodiments herein provide a system and method for computing a rate of fluid injected from a syringe body. A ring magnet is mounted and fixed on  the  syringe  body  using  a  magnet  holder.  Two  Hall-effect  sensors,operating  in  push-pull  mode, are  placed  on  a piston  associated  with  the syringe body. The two Hall-effect sensors are placed such that the sum of their distances from respective pole faces of the ring magnet is constant and the sensors produce a voltage in response to a change in the position of the piston. A volume of the liquid present in the syringe body can be measured at pre-determined time intervals using the voltages produced by the Hall-effect sensors. A rate of fluid injected from the syringe body can be measured by determining a difference between the computed volumes of the fluid at the pre-determined time intervals.', 21, '', 9, 3, 101, '2013-05-03', 39, 1, 0),
(30, '', '0000-00-00', '3485/CHE/2012', '1140', 'Automated evaluation of arterial stiffness for a non-invassive screening\n', 'This invention relates to medical monitoring and analysis, and more particularly to automated evaluation of arterial stiffness for non-invasive cardiovascular   screening.  The  system  tracks  and  measures  motion  of carotid artery in the human body using ultrasound based mechanism. Once\n\nposition of the carotid artery is detected, a wall motion correlation check mechanism is used to measure motion of the artery wall echoes from one frame to another and to ensure that the artery wall motion only is continuously tracked and measured  for cardiovascular  screening. Further,\n		using values of certain parameters measured during the ultrasound tracking, arterial compliance is measured. Further, from the arterial compliance parameter, arterial stifthess and other associated heart diseases  are identified.', 38, '', 9, 3, 101, '2012-08-24', 38, 1, 0),
(31, '', '0000-00-00', '3996/CHE/2012', '1139', 'Sceening tool optic nerve and aterior pathway diseases\n', 'This invention relates to field of neuro-ophthalmology, and more particularly to detecting damage to anterior visual pathway. Suitable combinations of grid dots are displayed to the user who is being screened for identifying visual anomalies. Saturation levels of the grid dots displayed are selected  from a  database,  based on a threshold saturation  level of a central dot and age of the user being screened. The user may be prompted to provide inputs regarding color of the grid dots that are displayed in different quadrants of the display field of a user side screen. The inputs received from the user are analyzed to  determine if the user is suffering from any type of visual anomaly. A reliability test is performed to validate result of the tests being conducted on the user.', 90, '', 9, 3, 101, '2012-09-26', 38, 1, 0),
(32, '', '0000-00-00', '6060/CHE/2013', '1138', 'Processing of the bimodal ultrafine grained microalloyed dual phase steel sheets\n', 'The present invention relates to processing of the bimodal ultrafine grained microalloyed dual phase steel sheets with high ultimate tensile strength   (1200 - 1900 MPa), high uniform elongation ( 16 - 25 %) and high toughness (200 - 230 MJm) for automotive applications by method such as warm rolling and intercritical annealing. The method of the invention has the advantages of simple working procedure and industrially scalable prospect.', 95, '', 14, 2, 124, '2013-12-24', 39, 1, 0),
(33, '', '0000-00-00', '5590/CHE/2013', '1137', 'System and method for predecting the oneset of an impending instability in a practical system\n', '\nThe present invention relates to processing of the bimodal ultrafine grained microalloyed dual phase steel sheets with high ultimate tensile strength (1200 - 1900 MPa), high uniform elongation ( 16 - 25 %) and high toughness (200 - 230 MJ!m\\ for automotive applications by method such as warm rolling and intercritical annealing. The method of the invention has the advantages of simple working procedure and industrially scalable prospect.', 120, '', 1, 4, 73, '2013-12-04', 39, 1, 0),
(34, '', '0000-00-00', '1507/CHE/2014', '1135', 'Apparatus and method for wireless detection of wristwatch with condutcive back plate and wireless charging of its battery\r\n', '', 21, '', 9, 5, 140, '2014-03-21', 40, 1, 0),
(35, '', '0000-00-00', '6199/CHE/2013', '1134', 'Methods and apparatus to store and transport natural gas (Hydrocarbon Gas) in porous media\n', 'The invention discloses in various embodiments methods, apparatus and processes for forming hydrocarbon gas semi-clathrate hydrate in porous media, comprising injecting an aqueous solution of one or more of thermodynamic promoters, kinetic promoters, or ionic liquid into a porous media, and injecting natural gas into said porous media to form the semi-clathrate hydrate. The invention further  discloses apparatus for  efficient and safe storage of hydrocarbon gas such as natural gas or methane-rich gas in stationary or portable facilities.\n', 40, '', 15, 6, 97, '2013-12-31', 39, 1, 0),
(36, '', '0000-00-00', '5640/CHE/2013', '1133', 'Large Scale Sketch-based Image Retrival Invariant to Similarity Transformations\n', 'The embodiments herein achieve a method and system for sketch-based image retrieval invariant to similarities. Unlike conventional systems, the system and method is used to achieve a trade-off between robustness and query  time  by extracting and  storing  invariant  image  information and\n	matching it efficiently. Essential shape information in an image is captured\n\nas a set of long sequences of extracted contour segments, which can be represented by variable length descriptors in a position, scale, and rotation insensitive way. Second, an efficient Dynamic Programming based approximate substring matching technique is devised to determine sketch to\n	image similarity. Further, a hierarchical indexing structure for the image\n\ndatabase is used to enable fast retrieval of similar images.\n', 8, '', 8, 9, 132, '2013-12-06', 39, 1, 0),
(37, '', '0000-00-00', '5457/CHE/2013', '1132', 'Synthesis of Amorfrutin and Cajaninstibenes and their analogues from a common building block.\n', 'A process for synthesis of amorfrutin and cajaninistilbenes and their analogues from a common building block. A common building block can be adapted for synthesizing the chemical compounds, such as, but not limited to amorfrutin (prenylatedbibenzyl)  and  cajaninistilbenes  acid (prenylatedstilbenoids ).The process of synthesis of amorfrutin (prenylatedbibenzyl) involves alkylation of  the common building block with various substituted benzyl bromides and desulfonylation& hydrolysis process. Similarly, the process of synthesis of cajaninistilbenes acid (prenylatedstilbenoids) involves Julia olefination of the common building block with various substituted aromatic aldehydes and hydrolysis process. The novel common building block structure and the process can be therefore adapted to effectively synthesize multi- class compounds of prenylatedbibenzyls and prenylatedstilbenoids.', 35, '', 6, 3, 53, '2013-11-27', 39, 1, 0),
(38, '', '0000-00-00', '809/CHE/2014', '1131', 'User Controlled Configurable Authorisation Layer (UCCAL)\n', 'The embodiments herein provide a method and system for controlling a transaction associated with an object. The method includes receiving a request to perform the transaction from a user, and determining a match between the request and an intent related to the transaction to be performed, wherein the intent is received prior to the transaction is carried out. Further, the method includes allowing the transaction in response to determining the match.', 15, '', 11, 9, 134, '2014-02-19', 40, 1, 0),
(39, '', '0000-00-00', '5122/CHE/2013', '1130', 'Energy-based auto correction and Repitition-rate optimization of laser pulses-System, apparatus and methods therefor\n', 'The present invention relates to a technique, system and appa.ratus to minimize collateral (tissue) damage whilesustaining desirable attributes of a laser - including optimal pulse-width, energy,  repetition-rate  for  surgical  and  other  applications  is  disclosed.  The  said  technique\n	employs primarily, short pulsed pico-second lasers customized to suit a plurality of tissue types and other surgical conditions and requirements,', 16, '', 9, 3, 126, '2013-11-12', 39, 1, 0),
(40, '', '0000-00-00', '5381/CHE/2013', '1129', 'Enhancement of Hybrid Fuel Regression Rate Using a Bluff Body\n', 'Hybrid rocket engine having high regression rate includes an injector, a bluff body, a combustion chamber, a nozzle, a tube and a fuel grain. The bluff body is used for increasing the regression rate of the fuel grain in the hybrid rocket engine. The bluff body increases the regression rate of the\n	fuel grain in the hybrid rock et engine due to decrease in recirculation zone\n\nsize  near  head end  of  the  hybrid  rocket  engine  and	redistribution of oxidizer mass flux close to walls of the combustion chamber.', 84, '', 1, 11, 36, '2013-11-21', 39, 1, 0),
(41, '', '0000-00-00', '1514/CHE/2014', '1128', 'A Method for setting link weights in OSPF networks based on entrophy betweenness centrality measures\r\n', '', 45, '', 8, 9, 98, '2014-03-21', 40, 1, 0),
(42, '', '0000-00-00', '5777/CHE/2013', '1126', 'A Filtering Mechanism For Securing Linux Kernel\r\n', '', 37, '', 8, 9, 95, '2013-12-13', 39, 1, 0),
(43, '', '0000-00-00', '5778/CHE/2013', '1125', 'A Filtering Means For Tracking Information Flow in Android Operated Devices\n', 'Various methods have been proposed for protecting the Linux kernel against various vulnerabilities. However, many of them require changes in the kernel itself leading to long testing and debugging periods. They also run the risks of introducing new bugs.\n\n\nThe invention provides an alternate, safer method to do the same by providing wrappers around the kernel. This reduces the amount of testing needed since the new security code will be introduced only into the wrappers and also provides flexibility in various layers. The filters can be customized per se to suit the various security needs. The overhead incurred due to this is very low.', 37, '', 8, 9, 95, '2013-12-13', 39, 1, 0),
(44, '', '0000-00-00', '5805/CHE/2013', '1124', 'A Novel method for investigation of solubility of tank bottom sludge with solvents.\r\n', '', 40, '', 15, 10, 100, '2013-12-13', 39, 1, 0),
(45, '', '0000-00-00', '5300/CHE/2013', '1123', 'Formulations for dissolution of petroleum sludge or waxes and method for evaluation thereof\r\n', '', 40, '', 15, 10, 100, '2013-11-18', 39, 1, 0),
(46, '', '0000-00-00', '5599/CHE/2013', '1122', 'High yielding preparation and processing of omega-3 highly unsaturated fatty acid by locally isolated microbe.\r\n\r\n', '', 7, '', 3, 3, 1, '2013-12-05', 39, 1, 0),
(47, '', '0000-00-00', '1337/CHE/2014', '1121', 'Leakage Detection using the novel wireless sensor system.\r\n', '', 6, '', 9, 10, 59, '2014-03-13', 40, 1, 0),
(48, '', '0000-00-00', '4937/CHE/2013', '1120', 'Miniaturised Blood Serum Triglyceride Monitoring System\r\n', '', 26, '', 9, 3, 106, '0013-11-01', 39, 1, 0),
(49, '', '0000-00-00', '4578/CHE/2013', '1116', 'Device and methods for determining the elemental identity and analysis on moving target from a variable stand-off distance\r\n', '', 67, '', 10, 8, 73, '2013-10-09', 39, 1, 0),
(50, '', '0000-00-00', '5988/CHE/2013', '1115', 'Unusual Dehalogenation on Graphene nanocomposites: Degration of the pesticide, lindane to trichlorobenzenes and removal of the products from water.\n', 'The  present  invention  relates  to  the  degradation  I dechlorination  of  lindane  and  its removal from water by graphene nanocomposites.', 74, '', 6, 7, 142, '2013-12-20', 39, 1, 0),
(51, '', '0000-00-00', '104/CHE/2014', '1111', 'A device to pressurize and time the injection of gaseous fuel for direct injection in an IC engine\n', 'A method of combusting a gaseous fuel containing at least one combustible gas in an internal combustion engine comprises of steps such as subjecting to predetermined pressure. Such fuel is then stored in a chamber. Atmospheric air is allowed to enter the engine through known inlet. The pressurized fuel is injected from the chamber into the engine at a point when the piston of the engine is at a predetermined position near the beginning of compression. This is to enable the fuel to get compressed during the compression stroke and ignited thereafter. Then it is followed by the power stroke and exhaust strokes of the engine.', 87, '', 13, 1, 16, '0014-12-20', 40, 1, 0),
(52, '', '0000-00-00', '5170/CHE/2013', '1110', 'New Oxygen-Deficient Perovskite Nanomaterial for reversible CO2 Capture at Room Temperature\r\n', '', 82, '', 16, 8, 31, '2013-11-14', 39, 1, 0),
(53, '', '0000-00-00', '5041/CHE/2013', '1108', 'System and methods for predetermining the onest of an impending blowout in practical combustion.\n', 'A system and method for detecting and controlling  blowout  in  a combustion system includes a sensor, a precursor detection unit and a controller. The sensor measures variations in the dynamic state variables of the combustor and provides a time series data or signal to the precursor\n	detection  unit.  The  precursor  detection  unit  detects  the  precursors  for\n\nblowout based on the following principle. Blowout is preceded by the variation in multifractal behavior of the time series data or signal. Further, the time series signal exhibit intermittent behavior close to blow out. The precursor detection unit uses estimates such as Hurst exponent, burst count and  recurrence  plot  parameters  to  detect  the  variation  in  multifractality and/or intermittency in the time series signal, thereby identifying the precursors. On identifying the precursors, the precursor detection unit sends a signal to the controller for varying the operational parameters of the combustor to evade blow', 120, '', 1, 4, 73, '2013-11-08', 39, 1, 0),
(54, '', '0000-00-00', '4576/CHE/2013', '1107', 'Intelligent fare metring system for metropolitan transport services\r\n', '', 105, '', 1, 2, 48, '2013-10-09', 39, 1, 0),
(55, '', '0000-00-00', '5163/CHE/2013', '1106', 'Cyclic glucan blended with synthetic or natural polymer, netal or ceramics as carrier for drugs, food, flavouring agents, growth factors, natural products\r\n', '', 60, '', 3, 10, 53, '2013-11-14', 39, 1, 0),
(56, '', '0000-00-00', '4325/CHE/2013', '1104', 'Method for Determining Distortion Contributions From Individual Circuit Elements and Blocks in an Electronic Circuit\n', 'The invention relates to methods for determining distortion contributions of individual elements in an analog circuit. The distortion contribution of each element in the circuit is determined in turn. The circuit is simulated by replacing the selected element by another element, whose operating point and first order terms are the same as in the original circuit. Nonlinear terms of the original circuit are identified and the output distortion of the modified circuit is simulated by changing the scaling factors of nonlinear terms to obtain a set of linear equations. The output distortion of the selected element is determined by solving the linear equations to obtain the nonlinear terms', 65, '', 9, 5, 5, '2013-09-24', 39, 1, 0),
(57, '', '0000-00-00', '5162/CHE/2013', '1101', 'Antibiofilm and antimicrobial food packaging using enzyme modified polymer films and the process for the production thereof\n', 'An antibiofilm and antimicrobial polymer film using an enzyme modified polymer film and process of producing the same. Initially, curcumin {e.g., a cross linker) can be mixed with ethanol and coated on a polymer surface in order to thereby place into a Ultra Violet {UV) chamber for a defined time period {e.g., 10 minutes). The UV treatment can make a cross link between the functional group of the polymer and the curcumin. In another embodiment of the present invention, if the polymer surface does not possess a functional group, the polymer surface can be UV treated towards radical formation in order to form an activated polymer. The activated polymer can be further coated with the curcumin and further placed into the UV chamber for a defined time period. An enzyme {e.g., hydrolase) is coated on the curcumin liked polymer surface and UV treated in order to form a cross link between the functional group present on the curcumin and the functional  group present in the enzyme. Such a treatment  results in an improved hydrolase cross linked polymer film which can be adapted in a wide range\nof packaging applications of food packaging industry.', 60, '', 3, 10, 54, '2013-11-14', 39, 1, 0),
(58, '', '0000-00-00', '4033/CHE/2013', '1099', 'Formation of uniformly distributed abrasive slurry for Micro abrasive water jet machining applications.\n', 'The present invention relates to an apparatus to provide a supply of abrasive particles in the carrier fluid to generate a uniform mixture of high pressure carrier fluid and abrasive particles.The uniform mixture is then formed into a micro abrasive suspension jet for micro machining applications. The apparatus includes a slurry preparation unit that prevents agglomeration and settlement of abrasives in the flow circuit and also avoids clogging of orifice to enable continuous generation of micro abrasive suspension jet. The apparatus also includes a refill arrangement for continuous supply of abrasives into the slurry preparation  unit.', 88, '', 13, 10, 88, '2013-09-10', 39, 1, 0),
(59, '', '0000-00-00', '4391/CHE/2013', '1098', 'Compact Rf phase - shifters based on frequency translation\n', 'The  present   invention  relates  to  a  compact   multi-band   RF  phase-shifter   based   on frequency translation, useful for many modem communication  RF front ends and in any discrete microwave system, where phase shift is needed.', 5, '', 9, 9, 6, '2013-09-27', 39, 1, 0),
(60, '', '0000-00-00', '4392/CHE/2013', '1097', 'Effect of semi-labile multidentate ligands on oxygen reduction reaction performance of non-precious metal catalysts\r\n', 'The present invention relates to a novel catalyst used for fuel cells and metal-air batteries and the effect of semi-labile multidentate  ligands on oxygen reduction  reaction  performance  ofnon-precious metal catalysts. Non precious metal catalyst reported here  are,  metal-nitrogen carbon type, wherein metal could be iron (Fe), Cobalt (Co), Manganese (Mn), Nickel (Ni), Chromium (Cr) or Copper (Cu).', 44, '', 6, 6, 55, '2013-09-27', 39, 1, 0),
(61, '', '0000-00-00', '4032/CHE/2013', '1093', 'Method of Doping Potassium Into ammonium Perchlorate\r\n', 'The present  invention relates to a method  of doping potassium  into ammonium perchlorate  for enhancing composite solid propellant burning rates.', 84, '', 1, 11, 36, '2013-11-18', 39, 1, 0),
(62, '', '0000-00-00', '259/CHE/2014', '1092', 'A Composition for Dental Remineralization\r\n', '', 91, '', 14, 3, 37, '0014-01-12', 40, 1, 0),
(63, '', '0000-00-00', '2897/CHE/2014', '1091', 'A frequency up-conversion mixer with improved linearity and back-off efficiency using negative feedback\n', 'Embodiments herein disclose a method of producing a linear current signal in a baseband V-I converter. The baseband V-I converter includes a feedback converter, an operational amplifier. The feedback converter is configured to receive a plurality of first current signal from a plurality of first power transistors in a first stage and plurality of second current signals from a plurality of second power transistors in a second stage. Further, the feedback converter is configured to produce a plurality of feedback current signals in the first stage andthe second stage. Further, the operational amplifier is configured to receive the plurality of feedback current signals and plurality of reference current signals obtained from plurality of input voltage signals. The operational amplifier is configured to compare the plurality  of  reference  current  signals  with  received  plurality  of feedback current signals to produce output voltage signals.', 65, '', 9, 9, 94, '2014-06-13', 40, 1, 0),
(64, '', '0000-00-00', '5352/CHE/2013', '1090', 'tilt-controlled training and mobility device\r\n', '', 4, '', 9, 12, 42, '2013-11-20', 39, 1, 0),
(65, '', '0000-00-00', '3878/CHE/2013', '1089', 'A five degree-of-freedom haptic interface device for laparoscopic simulation\n', 'The present invention relates to a haptic interface device for minimally invasive surgical simulation in particular laparoscopic surgical simulation capable of performing five degrees of freedom movements. The developed device is a simple design without involving complex links and actuation mechanisms, occupies less space, less expensive alternate to a human/computer interface and less noise compared to other devices. The present haptic device can be interfaced to the  computer  via  1/0 boards  and  can  be  used  to  interact  or  manipulate  with  the  computer generated anatomical models providing a realistic experience for the laparoscopic surgeons .', 55, '', 2, 3, 91, '2013-08-30', 39, 1, 0),
(66, '', '0000-00-00', '4161/CHE/2013', '1088', 'Multiple inlets-outlets valveless micropump and micromixer\r\n', '', 12, '', 13, 5, 93, '2013-09-17', 39, 1, 0),
(67, '', '0000-00-00', '3713/CHE/2013', '1087', 'A new multilayer sandwich design of a Redox Flow Battery Cell\r\n', '', 44, '', 6, 6, 13, '2013-08-22', 39, 1, 0),
(68, '', '0000-00-00', '4103/CHE/2013', '1086', 'Lanthanum doping of ceria abrasive to obtain robust CMP polish rates\n', 'This invention relates to a method of chemical mechanical planarization for silicon abrasive pads are fixed on wafers, which contains ceria and lanthanum and/or polishing slurry of 7 PH having abrasive which is ceria and containing lanthanum and further the ceria may be of nano particle, or micro particle.', 86, '', 5, 4, 82, '2013-09-12', 39, 1, 0),
(69, '', '0000-00-00', '4196/CHE/2013', '1085', 'Preparation of a Dog-Bone shaped Micro-Specimen for Testing of Mechanical Properties\n', 'This invention relates to a method of technique for preparing small or micro dog bone shaped specimens with the use of a template and the polishing activity utilized in metallography to fabricate micro dog-bone specimens for mechanical testing from thin samples and  this technique avoids fabrication methods such as electric discharge machining (EDM) that are not effective in terms of cost and time and the specimen can bend and/or warp due to application of even small loads or thermal gradient during the process.', 34, '', 1, 4, 130, '2013-09-18', 39, 1, 0),
(70, '', '0000-00-00', '3638/CHE/2013', '1083', 'An improved bioprocess for producing camptothecin from endophytes\r\n', '', 109, '', 3, 3, 24, '2013-08-16', 39, 1, 0),
(71, '', '0000-00-00', '5458/CHE/2013', '1080', 'An cone plate instrument to apply laminar shear to cultured mammalian cells\n', 'An indigenous cone plate device for applying laminar shear to cultured mammalian cells (e.g., endothelial cells). The indigenous cone plate device includes a cone member connected to a removable top plate, at least one column, a vertically movable stage, a screw with an adjustable dial member and a base. The cone member made of a bio-compatible material (e.g., surgical grade steel) provides required shear with respect to the endothelial cell in vitro. The radius and angle of the cone is fixed in order to provide compatible shear to the endothelial cell in vitro by avoiding effects of external factors. The vertically movable stage configured at the frame member of the device holds the tissue culture dish. The adjustable dial member with a screw is used to adjust the height of the stage. A scale engraved on one of the columns is used to measure the position of the cone in the plate. The control unit of the cone plate device controls the shear stress of the cone in order thereby effectively apply laminar shear to cultured mammalian cells.', 51, '', 3, 3, 19, '2013-11-27', 39, 1, 0),
(72, '', '0000-00-00', '4101/CHE/2013', '1078', 'GPU assisted scheduling technique (GAS) for multicore operating system\n', 'In multicore operating systems, there is no approach which leverages GPU for computing a CPU process scheduling order. A scheduling algorithm can compute the near optimal scheduling order based on the per process runtime resource utilization, CPU performance counters, temperature distribution in CPU cores for all ''n'' processes and ''m'' CPU cores present in the system. Since a schedule is required every time a set of processes has to be scheduled on a per core basis as well, finding an optimal schedule is a compute intensive task. Hence computing it on the CPU is not practical because of the runtime overhead. Due to this implication, contemporary multicore operating system schedulers are based on simple heuristic based approach.', 37, '', 8, 9, 78, '2013-09-12', 39, 1, 0),
(73, '', '0000-00-00', '4228/CHE/2013', '1076', 'Electrospun nanofibrous membrane for sensing food spoilage\r\n', '', 22, '', 3, 10, 34, '2013-09-20', 39, 1, 0),
(74, '', '0000-00-00', '4611/CHE/2013', '1075', 'Sugar-triazole-cardanol conjugates as efficient low molecular weight gelators capable of forming gels in mixed-aqueous and non-aqueous solvents\r\n', '', 58, '', 6, 10, 108, '2013-10-14', 39, 1, 0),
(75, '', '0000-00-00', '400/CHE/2014', '1074', 'Biopotential signal acquisition system using multi-frequency chopping\n', 'The present invention discloses a method and system for processing a plurality of signals together in a single circuitry using a multi- frequency chopping. The system  is  configured  to  include  a  first  level  chopping,  a n  amplifier  for\n	amplification, a second level chopping, a filter for filtration and an Analog to\n\nDigital Converter (ADC). The system is further configured to receive low frequency input signals and apply the first level of chopping by translating signals to a higher frequency. Further, the system is configured to amplify the signals and apply the second level o f chopping to translate the signal back to\n	original frequency. During second level of chopping, signals are translated to\n\nnew frequencies other than their baseband by chopping each signal at a different frequency. Further, the signals are combined into a single signal and send to an Analog-to-Digital Converter (ADC) for digitizing.', 5, '', 9, 3, 87, '2014-12-09', 40, 1, 0),
(76, '', '0000-00-00', '103/CHE/2014', '1072', 'Zeolites-Mg based novel hydrogen storage nanomaterials\n', '1) A process for the manufacture of nanocomposites for removal of dyes from waste-waters of industrial effluents comprising the steps of preparing nano­ composites from at least one substance of the following group of nanometals and nanometal oxides, namely, An, Ag, Fe, Co, Ni, Pt, Pd, Ru, ZnO, Ti02, Fc203, Fe204, dispersed on a support material consisting of two or three difference dimensional nanomaterials selected from at least one of the following, namely, carbon nanotubes, thermally exfoliated graphite, chemicaklly exfoliated graphite oxide, graphene sheets, graphene, functionalized carbon nanotubes I graphene; passing the waste waters through at least one nanofiltration memberane which is made of a biocompatible material such as chitosan, polypyrole;  passing  the waste water thereafter over the nanocomposites  to enable the nanocomposites to adsorb the dyes in the said waste waters, the nanocomposites being then treated with an inorganic acid for re-using the said nanocomposites.', 0, '', 16, 6, 55, '0014-12-20', 40, 1, 0),
(77, '', '0000-00-00', '3378/CHE/2013', '1071', 'A method for placement to variable length guide vanes for flow control in manifolds\n', '1) A process for the manufacture of nanocomposites for removal of dyes from waste-waters of industrial effluents comprising the steps of preparing nanocomposites from at least one substance of the following group of nanometals and nanometal oxides, namely, An, Ag, Fe, Co, Ni, Pt, Pd, Ru, ZnO, Ti02, Fc203, Fe204, dispersed on a support material consisting of two or three difference dimensional nanomaterials selected from at least one of the following, namely, carbon nanotubes, thermally exfoliated graphite, chemicaklly exfoliated graphite oxide, graphene sheets, graphene, functionalized carbon nanotubes I graphene; passing the waste waters through at least one nanofiltration memberane which is made of a biocompatible material such as chitosan, polypyrole;  passing  the waste water thereafter over the nanocomposites  to enable the nanocomposites to adsorb the dyes in the said waste waters, the nanocomposites being then treated with an inorganic acid for re-using the said nanocomposites.', 111, '', 5, 4, 75, '2013-07-29', 39, 1, 0),
(78, '', '0000-00-00', '3119/CHE/2013', '1070', '"r-Wavelet method" : A Novel Wavelet based signal processing technique for signal enhancement\n', 'This invention relates to a process of using a known standard wavelet transform but relying on repetitive use of known wavelet transform to boost the components of the input signal that is representative to a particular failure mode while suppressing rest of the signal. The method can thereby be used not only to boost components to identify product failure but can be used as a denoising tool.', 48, '', 13, 4, 73, '2013-07-16', 39, 1, 0),
(79, '', '0000-00-00', '3088/CHE/2013', '1069', 'A semi-flexion orthotic knee\r\n', '', 119, '', 13, 12, 116, '2013-07-10', 39, 1, 0),
(80, '', '0000-00-00', '4715/CHE/2013', '1068', 'Condensed sparse single transmitter multiple receivers (STMR) array based structural health monitoring for large plate-like structures using ultrasonic guided waves\n', 'A structural health monitoring system for large plate-like structures is provided. The system comprises an array of transducers embedded on saidstructure. The transducers are distributed in an irregular fashion/manner using Poisson disk technique. Further the system includes anexciting element to generate ultrasonic guided waves of a predetermined frequencyin at least one of thetransducers. Furthermore the system includes a signal processing moduleto process received signals reflected from damage to detect said damage  in  the  structure.  The  system  also  includes  an  imaging  modulein communication with said signal processor to capture and re-construct at least a portion of the structure under observation.', 48, '', 13, 4, 73, '2013-10-18', 39, 1, 0),
(81, '', '0000-00-00', '1511/CHE/2014', '1065', 'Single-antenna full-duplex communication system employing transformer-based cancellation\r\n', '', 5, '', 9, 9, 94, '2014-03-21', 40, 1, 0),
(82, '', '0000-00-00', '1852/CHE/2010', '1064', 'Interference convariance matrix estimation\r\n', 'Interference covariance matrix estimation in a wireless communication network. This invention relates to wireless communication systems, and more particularly to estimating the interference covariance matrix in wireless communication systems.  The principal object of this invention is to propose methods for estimating the interference covariance matrix in the case of wireless systems. Embodiments  disclosed herein further improve the estimate of the interference covariance matrix by shrinking it towards a specific structure.', 107, '', 9, 9, 148, '2010-06-30', 36, 1, 0),
(83, '', '0000-00-00', '2551/CHE/2013', '1063', 'Method for efficient resource allocation for HARQ retransmission\r\n', '', 19, '', 9, 9, 136, '2012-06-13', 38, 1, 0),
(84, '', '0000-00-00', '1375/CHE/2012', '1062', 'Multi-RAT relay\r\n', 'Multi- RAT relay system is based on Radio access technology (RAT) where any RAT can be used or combination of RATs on the access and backhaul links. The proposed relay will be managed in the network by a MRR control unit (MCU). The MRR may support one or more RATs on the access link. The serving BS/MRR may request a terminal to start scanning beacons, depending on whether the terminal is connected to the BS or the MRR. The terminal will typically make several measurements on a beacon over a period of time, as requested by the serving BS or MRR. The network may allow multiple RATs to be used simultaneously on the backhaul, thereby increasing the aggregate backhaul capacity. Within the allowed transmit power for each access link RAT, the MRR ensures that it can adapt the rates at back- haul to the rates achievable in the access link.', 63, '', 4, 9, 136, '2012-04-04', 38, 1, 0),
(85, '', '0000-00-00', '1610/CHE/2011', '1061', 'Interference management for a distributed spatial network\r\n', '', 19, '', 9, 9, 98, '2011-05-09', 37, 1, 0),
(86, '', '0000-00-00', '227/CHE/2012', '1060', 'An ordered reduced set successive detector for low complexity, quasi-ML MIMO detection\n', 'An Ordered Reduced Set Successive Detector (RSSD) for the V- BLAST spatial multiplexing scheme that uses a general two-dimensional non-uniform set partitioning for different symbols, is proposed. The disclosed detector provides improved diversity and SNR gains at reduced complexity compared to a uniform set partitioning based detector. Embodiments disclosed herein can be used to reduce the complexity, with a small tradeoff in performance. Further, the embodiments herein show that it is possible to obtain a quasi-ML performance using the disclosed detector at a reduced, yet fixed, complexity.', 19, '', 9, 9, 147, '2012-11-19', 38, 1, 0),
(87, '', '0000-00-00', '2815/CHE/2010', '1059', 'Enhancements to a CDMA system to support in-band personal indoor relays\n', 'Enhancements to a CDMA system to support in-band personal indoor relays. This invention  relates to CDMA communication systems,  and more particularly to relays in CDMA communication systems. The principal object of this invention is to achieve the operating mechanism and method for introducing indoor personal relays in an existing CDMA system. The embodiments herein achieve an operating mechanism and method for introducing indoor personal relays in an existing CDMA system.', 19, '', 9, 9, 136, '2010-09-24', 36, 1, 0);
INSERT INTO `tbl_patent` (`patent_auto_id`, `patent_no`, `patent_date`, `appl_no`, `file_no`, `title`, `abstract`, `inventor`, `sub_inventor`, `department`, `industry`, `technology`, `filing_date`, `filing_year`, `filing_country`, `d_flg`) VALUES
(88, '', '0000-00-00', '1511/CHE/2008', '1058', 'Quasi orthogonal pilot design\r\n', 'Quasi Orthogonal Pilot Design. A method to improve the pilot Signal to Interference Noise Ratio (SINR) in Orthogonal Frequency Division Multiple Access (OFDMA) networks by using a combination of orthogonal and non orthogonal pilots along with a PN sequence as a cover. FIG. 2 illustrates a block  diagram  of  a base  station  with  a  PN  sequence  generator  202  that\n		generates the PN sequence. An orthogonal pilot code is taken, multiplied with the PN sequence, modulated with a subcarrier and transmitted after a resource block is assigned for the pilot sequence in the slot. Pilot sequences in neighboring clusters may also be 2-dimensionally shifted, power-boosted and transmitted. Also, a combination of orthogonal pilot codes covered by a PN\n	sequence can be used along with a 2-dimensional  shift before transmitting  the\n\npilot sequence.', 19, '', 9, 9, 21, '2008-06-20', 34, 1, 0),
(89, '', '0000-00-00', '352/CHE/2011', '1057', 'Method and systems for interference mitigation\r\n', '', 19, '', 9, 9, 98, '2011-01-17', 37, 1, 0),
(90, '', '0000-00-00', '2974/CHE/2010', '1056', 'Robust channel estimation and interpolation in OFDMA systems\r\n', '', 107, '', 9, 9, 148, '2010-10-07', 36, 1, 0),
(91, '', '0000-00-00', '7213/CHENP/2011', '1055', 'Cognitive interference management in wireless networks with relays macro cells micro cells pico cells and femto cells\r\n', '', 19, '', 9, 9, 147, '2011-10-04', 37, 1, 0),
(92, '', '0000-00-00', '1402/CHE/2012', '1053', 'Interference management in a heterogeneous CDMA cellular networks\n', 'Interference management in heterogeneous wireless CDMA packet data networks involves deploying a macro cellular deployment with an overlay of small cells in the coverage of each macro base station. These small cells can be created by Femto, relay or pico base-stations collectively referred to as SBS (small base stations). The user terminal (UT) may be connected either to the MBS or SBS. The SBS may reuse the MBS carrier frequencies or can have dedicated carriers. The UT associated with MBS is referred as MUT and those with SBS as SUT.', 19, '', 9, 9, 147, '2012-04-09', 38, 1, 0),
(93, '', '0000-00-00', '1461/CHE/2008', '1052', 'Interference mitigation enhancement using conjugate symbol repetition and phase randomization\r\n', '', 19, '', 9, 9, 147, '2008-06-17', 34, 1, 0),
(94, '', '0000-00-00', '1211/CHENP/2011', '1051', 'Method and system for single transmission and reception\n', 'An embodiment herein provides a method and system for enhancing interference mitigation using conjugate symbol repetition and phase randomization on a set of subcarriers. The repeated data tone in the signal is complex-conjugated before transmission, when the repetition factor is two. When the repetition factor is greater than two, a combination of conjugate repetition and random/deterministic phase variation of the repeated tones is used to mitigate the interference mitigation.', 19, '', 9, 9, 147, '2011-02-22', 37, 1, 0),
(95, '', '0000-00-00', '2095/CHE/2009', '1050', 'Rank one region in wireless systems for interference mitigation\r\n', '', 19, '', 9, 9, 147, '2009-08-28', 35, 1, 0),
(96, '', '0000-00-00', '2093/CHE/2009', '1049', 'Downlink pilots and data transmission in OL MIMO region\r\n', '', 19, '', 9, 9, 147, '2009-08-28', 35, 1, 0),
(97, '', '0000-00-00', '357/CHENP/2011', '1048', 'Procoding for multiple transmission streams in multiple atenna systems\n', 'Precoding for multiple transmission streams in multiple antenna systems. Embodiments herein disclose a general method that transmits signal from multiple antennas using a one/two dimensional precoder followed by STBC/SFBC or SM encoder. This precoder is fixed in a given resource block (RB) or slot, which is composed of P subcarriers and Q  OFDM symbols (where the values for P and Q are greater than or equal to 1). The precoder in each resource block may take same or different values, which span the two dimensional time-frequency grid. The precoder is chosen as a function of either logical frequency index or physical frequency index of the RB. ', 19, '', 9, 9, 147, '2011-02-08', 37, 1, 0),
(98, '', '0000-00-00', '352/CHENP/2011', '1047', 'Method and systems for interference mitigation\r\n', 'Embodiments herein provide methods and systems for enhancing interference mitigation using conjugate symbol repetition and phase randomization on a set of subcarriers. The repeated data tone in the signal\n	is complex-conjugated before transmission, when the repetition factor is two. When the repetition factor is greater than two, a combination of conjugate repetition and random/deterministic phase variation of the repeated tones is used to mitigate the interference mitigation. Embodiments further disclose Collision Free Interlaced Pilot PRU Structures that can be used with or without conjugate symbol repetition and phase randomization for interference mitigation.\n', 19, '', 9, 9, 147, '2011-11-07', 37, 1, 0),
(99, '', '0000-00-00', '972/CHE/2009', '1046', 'Method and apparatus for co-channel interference suppression\r\n', '', 19, '', 9, 9, 147, '2009-04-27', 35, 1, 0),
(100, '', '0000-00-00', '3138/CHE/2008', '1045', 'Frequency domain data repetition amongst co-channel interferes in cellular networks for effective interference management\n', 'An Ordered Reduced Set Successive Detector (RSSD) for the V- BLAST spatial multiplexing scheme that uses a general two-dimensional non-uniform set partitioning for different symbols, is proposed. The disclosed detector provides improved diversity and SNR gains at reduced complexity compared to a uniform set partitioning based detector. Embodiments disclosed herein can be used to reduce the complexity, with a small tradeoff in performance. Further, the embodiments herein show that it is possible to obtain a quasi-ML performance using the disclosed detector at a reduced, yet fixed, complexity.', 19, '', 9, 9, 147, '2008-12-12', 34, 1, 0),
(101, '', '0000-00-00', '1685/CHE/2008', '1044', 'Interference suppression OFDMA and Sc-FDMA systems\r\n', '', 19, '', 9, 9, 147, '2008-07-11', 34, 1, 0),
(102, '', '0000-00-00', '1493/CHE/2008', '1043', 'Methods to time-frequency multiplex pilot and data in OFDMA systems\r\n', '', 19, '', 9, 9, 147, '2008-06-19', 34, 1, 0),
(103, '', '0000-00-00', '6122/CHENP/2011', '1042', 'Pilot aided data transmission and reception with interference mitigation in wireless systems\r\n', '', 19, '', 9, 9, 147, '2011-08-26', 37, 1, 0),
(104, '', '0000-00-00', '229/CHE/2012', '1041', 'Stable CQI region in downlink\r\n', '', 19, '', 9, 9, 148, '2012-11-09', 38, 1, 0),
(105, '', '0000-00-00', '373/CHENP/2011', '1040', 'Precoding for single transmission streams in multiple antenna systems\r\n', '', 19, '', 9, 9, 147, '2011-11-08', 37, 1, 0),
(106, '', '0000-00-00', '2151/CHE/2011', '1039', 'Method for context aware service adaptation for heterogeneous wireless networks and devices\r\n', '', 31, '', 8, 9, 98, '2011-06-27', 37, 1, 0),
(107, '', '0000-00-00', '233/CHENP/2013', '1038', 'Robust channel estimation of OFDM systems\r\n', '', 28, '', 9, 9, 21, '0013-11-02', 39, 1, 0),
(108, '', '0000-00-00', '1075/CHENP/2012', '1037', 'Indoor personal relay\r\n', '', 19, '', 9, 9, 74, '2012-12-24', 38, 1, 0),
(109, '', '0000-00-00', '8665/CHENP/2012 ', '1036', 'Interference cancelling block modulation\r\n', '', 28, '', 9, 9, 147, '2012-10-10', 38, 1, 0),
(110, '', '0000-00-00', '355/CHE/2008', '1034', 'inter-cell interference mitigation using limted feed back in cellular networks\r\n', '', 19, '', 9, 9, 147, '2008-02-12', 34, 1, 0),
(111, '', '0000-00-00', '3046/CHE/2013', '1033', 'Development of a pedal powered water filtration system\r\n', '', 18, '', 10, 8, 142, '2013-07-08', 39, 1, 0),
(112, '', '0000-00-00', '4227/CHE/2013', '1031', 'Graded nano-and micro-crystalline composite diamond coatings for load-bearing tribological applications\r\n', '', 82, '', 16, 4, 33, '2013-09-20', 39, 1, 0),
(113, '', '0000-00-00', '4225/CHE/2013', '1030', 'Methods for synthesis of diamond thin films / coatings on sapphire\r\n', '', 82, '', 16, 4, 33, '2013-09-20', 39, 1, 0),
(114, '', '0000-00-00', '4226/CHE/2013', '1029', 'Dilute magnetic nanoparticles for fast removal of Arsenic from water\r\n', '', 82, '', 16, 7, 142, '2013-09-20', 39, 1, 0),
(115, '', '0000-00-00', '4756/CHE/2013', '1028', 'Mechanical system to achieve variable valve event operation by continuously varying valve lift height and duration to attain optimum volumetric efficiency at all speed and load conditions\r\n', '', 87, '', 13, 4, 52, '2013-10-22', 39, 1, 0),
(116, '', '0000-00-00', '3858/CHE/2013', '1027', 'Portable multi-utility multi-position holding device cum bag\r\n', '', 33, '', 13, 5, 77, '2013-08-29', 39, 1, 0),
(117, '', '0000-00-00', '3045/CHE/2013', '1026', 'Swimming pool lift for physically challenged\r\n', '', 119, '', 13, 12, 127, '2013-07-08', 39, 1, 0),
(118, '', '0000-00-00', '1246/CHE/2013', '1025', 'Providing uninterrupted DC supply to consumers\r\n', '', 13, '', 9, 5, 137, '2013-07-31', 39, 1, 0),
(119, '', '0000-00-00', '4745/CHE/2012', '1023', 'A system and method for recognition of handwritten telugu characters\r\n', '', 113, '', 3, 12, 120, '2012-11-13', 38, 1, 0),
(120, '', '0000-00-00', '5434/CHE/2013', '1022', 'A smart multi-output adaptive camera and video recording system\r\n', '', 8, '', 8, 5, 138, '2013-11-27', 39, 1, 0),
(121, '', '0000-00-00', '1923/CHE/2013', '1021', 'A combined reluctance-hall effect based angle sensor\r\n', '', 21, '', 9, 2, 12, '2013-04-30', 39, 1, 0),
(122, '', '0000-00-00', '3170/CHE/2013', '1020', 'A novel waveguide technique for the simultaneous measurement of temperature dependent properties of materials\r\n', '', 48, '', 13, 4, 73, '2013-07-16', 39, 1, 0),
(123, '', '0000-00-00', '2104/CHE/2013', '1011', 'Efficient Methodology for Optimal Linkage of Arbitrarily Oriented Fluid Flow Ducts using Single Parameter Bezier Curves\r\n', '', 111, '', 5, 4, 68, '2013-05-10', 39, 1, 0),
(124, '', '0000-00-00', '1897/CHE/2013', '1008', 'Novel segmented strip design for a magnetostriction sensor (MsS) using amorphous material for long range inspection and structural health monitoring at high temperatures\r\n', '', 48, '', 13, 4, 73, '2013-04-29', 39, 1, 0),
(125, '', '0000-00-00', '4737/CHE/2013', '1004', 'Overhead line and equipment inspection device\r\n', '', 127, '', 8, 5, 72, '2013-10-21', 39, 1, 0),
(126, '', '0000-00-00', '1745/DEL/2012', '985', 'Enhanced thermal management system for fuel cell applications using nanofluid coolant\r\n', '', 0, '', 16, 6, 55, '2012-06-07', 38, 1, 0),
(127, '', '0000-00-00', '4910/CHE/2013', '980', 'Passive cooling based secondary concentrator for solar concentrating photovoltiac system for uniform flux distribution and effective cooling\r\n', '', 114, '', 13, 6, 123, '2013-10-13', 39, 1, 0),
(128, '', '0000-00-00', '4909/CHE/2013', '978', 'Solar parabolic trough collector with integrated torque tube Ã¢â‚¬â€œ box support structure\r\n', '', 114, '', 13, 6, 123, '2013-10-31', 39, 0, 0),
(129, '', '0000-00-00', '1774/CHE/2013', '977', 'A wireless system to monitor and to predict the consumption and remaining gas in a cylinder\r\n', '', 73, '', 9, 5, 118, '2013-04-22', 39, 1, 0),
(130, '', '0000-00-00', '2062/CHE/2013', '976', 'a versatile tissue enginering bioreactor\r\n', '', 126, '', 10, 3, 15, '2013-05-08', 39, 1, 0),
(131, '', '0000-00-00', '2709/CHE/2013', '975', 'Novel resin matrix for dental composites with enhanced physical properties and biological response\r\n', '', 126, '', 10, 3, 37, '2013-06-21', 39, 1, 0),
(132, '', '0000-00-00', '1920/CHE/2013', '974', 'Intelligent universal steering cover for haptic and other feedback to monitor and provide intervention based on driver fatigue and / or behavior\r\n', '', 126, '', 10, 2, 122, '2013-04-30', 39, 1, 0),
(133, '1921/CHE/2013', '2013-04-30', '', '973', 'Intelligent universal seat and backrest cover for haptic and other feedback to monitor and provide intervention based on driver fatigue and / or behavior\r\n', '', 126, '', 10, 2, 122, '0000-00-00', 39, 1, 0),
(134, '', '0000-00-00', '1681/CHE/2013', '969', 'Piezo-electric, ultrasonic annular surface injection for emission reduction and better control in engines\r\n', '', 3, '', 13, 2, 56, '2013-04-15', 39, 1, 0),
(135, '', '0000-00-00', '405/CHE/2013', '968', 'Catalytically and chemically modified carbon nanostructures for storage of hydrogen\r\n', '', 0, '', 16, 10, 70, '2013-01-30', 39, 1, 0),
(136, '', '0000-00-00', '5398/CHE/2013', '968', 'Application of entropy of centrality measures of routing in tactical wireless networks\r\n', '', 45, '', 8, 9, 98, '2013-11-22', 39, 1, 0),
(137, '', '0000-00-00', '1149/CHE/2013', '966', 'Low cost television meter using aakash tablets\r\n', '', 13, '', 9, 5, 129, '2013-03-15', 39, 1, 0),
(138, '', '0000-00-00', '625/CHE/2014', '964', 'High performance electrocatalyst for proton exchange membrane fuel cell application\r\n', '', 0, '', 16, 6, 55, '2014-02-11', 40, 1, 0),
(139, '', '0000-00-00', '4886/CHE/2013', '959', 'Pipe Solar Concentrator\r\n', '', 115, '', 13, 6, 123, '2013-10-30', 39, 1, 0),
(140, '', '0000-00-00', '4438/CHE/2013', '956', 'Electrolysis assisted atomization\r\n', '', 115, '', 13, 10, 11, '2013-09-30', 39, 1, 0),
(141, '', '0000-00-00', '3251/CHE/2013', '954', 'The integrated hydro-mechanical system for deep ocean manganese nodule mining (HYMECHDOMS)\r\n', '', 49, '', 13, 4, 35, '2013-07-19', 39, 1, 0),
(142, '', '0000-00-00', '3250/CHE/2013', '953', 'A deep ocean remotely operated submersible dredge head with distributed propulsion units for collecting nodular minerals from soft ocean floor (DOROSMIN)\r\n', '', 49, '', 13, 4, 35, '2013-07-19', 39, 1, 0),
(143, '', '0000-00-00', '4476/CHE/2012', '897', 'Burst detection as a precursor to the onset of impending oscillatory instabilities in practical systems\r\n', '', 120, '', 1, 4, 46, '2012-11-16', 38, 1, 0),
(144, '', '0000-00-00', '4110/CHE/2012', '896', 'System and method for predetermining the onset of impending oscillatory instabilities in practical devices\r\n', '', 120, '', 1, 4, 46, '2012-10-01', 38, 1, 0),
(145, '', '0000-00-00', '5188/CHE/2012', '895', 'Method of preparing palladium dendrites on carbon paper\r\n', '', 79, '', 5, 6, 55, '2012-12-13', 38, 1, 0),
(146, '', '0000-00-00', '485/CHE/2013', '894', 'Sunlight mediated synthesis and antibacterial properties of monolayer protected silver quantum clusters\r\n', '', 74, '', 6, 7, 142, '2013-02-03', 39, 1, 0),
(147, '', '0000-00-00', '4108/CHE/2012', '892', 'Process and applications of encapsulated liquids in particulate materials: Formation of Liquid Micro-Marbles\r\n', '', 53, '', 2, 10, 81, '2012-10-01', 38, 1, 0),
(148, '', '0000-00-00', '4807/CHE/2012', '889', 'Electrochemical synthesis of palladium dendrites on carbon nanotubes\r\n', '', 79, '', 5, 6, 55, '2012-11-19', 38, 1, 0),
(149, '', '0000-00-00', '3816/CHE/2012', '888', 'Pedometer\r\n', '', 21, '', 9, 3, 66, '2012-09-13', 38, 1, 0),
(150, '', '0000-00-00', '3252/CHE/2013', '884', 'A method of computing strains from full-field data\r\n', '', 93, '', 10, 4, 73, '2013-07-19', 39, 1, 0),
(151, '', '0000-00-00', '4252/CHE/2012', '883', 'Design and assembly of a Clutch\r\n', '', 92, '', 10, 4, 30, '2012-10-11', 38, 1, 0),
(152, '', '0000-00-00', '4963/CHE/2012', '882', 'A non-destructive method to identify used syringes and thus prevent their re-use\r\n', '', 14, '', 10, 3, 69, '2012-11-29', 38, 1, 0),
(153, '', '0000-00-00', '3863/CHE/2012', '881', 'A method for the preparation of graphenic material from asphalt and its application in water purification\r\n', '', 74, '', 6, 8, 142, '2012-09-17', 38, 1, 0),
(154, '', '0000-00-00', '3277/CHE/2012', '878', 'MaPaMan: A reconfigurable parallel manipulator\r\n', '', 92, '', 10, 4, 119, '2012-08-09', 38, 1, 0),
(155, '', '0000-00-00', '3634/CHE/2012', '877', 'An apparatus to convert bidirectional linear motion to unidirectional rotary motion\r\n', '', 1, '', 15, 6, 143, '2012-09-20', 38, 1, 0),
(156, '', '0000-00-00', '3918/CHE/2012', '876', 'Bi-directional flow turbine\r\n', '', 1, '', 15, 6, 143, '2012-09-20', 38, 0, 0),
(157, '', '0000-00-00', '5385/CHE/2012', '875', 'Bharati-A universal script for indian languages with applications in online handwritten character recognition\r\n', '', 113, '', 3, 12, 120, '2012-12-24', 38, 1, 0),
(158, '', '0000-00-00', '3633/CHE/2012', '873', 'A human powered device\r\n', '', 113, '', 3, 6, 84, '2012-09-03', 38, 1, 0),
(159, '', '0000-00-00', '4806/CHE/2012', '872', 'Standing / reclining wheel chair\r\n', '', 119, '', 13, 12, 146, '2012-11-19', 38, 1, 0),
(160, '', '0000-00-00', '4253/CHE/2012', '871', 'FORCEps\r\n', '', 93, '', 10, 3, 37, '2012-10-11', 38, 1, 0),
(161, '', '0000-00-00', '4568/CHE/2011', '869', 'Metal free catalysts for the ring opening polymerization of cyclic esters and lactide\r\n', '', 24, '', 6, 10, 25, '2011-12-26', 37, 1, 0),
(162, '', '0000-00-00', '3733/CHE/2012', '865', 'Iron oxide-graphene nanocomposite electrodes for water purification\r\n', '', 0, '', 16, 7, 142, '2012-09-10', 38, 1, 0),
(163, '', '0000-00-00', '4091/CHE/2011', '863', 'Tactograph\r\n', '', 4, '', 9, 12, 43, '2011-11-28', 37, 1, 0),
(164, '', '0000-00-00', '4254/CHE/2012', '862', 'Non-destructive structural health monitoring using on-board device\r\n', '', 93, '', 10, 6, 73, '2012-09-20', 38, 1, 0),
(165, '', '0000-00-00', '2835/CHE/2012', '859', 'A point absorber system for wave energy extraction\r\n', '', 1, '', 15, 6, 143, '2012-07-12', 38, 1, 0),
(166, '', '0000-00-00', '3632/CHE/2012', '858', 'A universal approach to the synthesis of palladium dendrites on carbon based substrates\r\n', '', 79, '', 5, 10, 25, '2012-09-03', 38, 1, 0),
(167, '', '0000-00-00', '3586/CHE/2011', '854', 'Application of nanoscale Zinc Oxide in Peanut Crop\r\n', '', 74, '', 6, 1, 111, '2011-10-19', 37, 0, 0),
(168, '', '0000-00-00', '1174/CHE/2012', '853', 'Hi-Fidelity Chest Simulation for Effective CPR Training\r\n', '', 55, '', 2, 3, 91, '2012-03-23', 38, 1, 0),
(169, '', '0000-00-00', '1542/CHE/2012', '852', 'Synthesis of quinolone antibiotics from baylis-hillman adducts\r\n', '', 61, '', 6, 3, 9, '2012-04-18', 38, 1, 0),
(170, '', '0000-00-00', '1295/CHE/2011', '849', 'Predictive texting for communication over social television\r\n', '', 13, '', 9, 9, 10, '2011-04-14', 37, 1, 0),
(171, '', '0000-00-00', '1350/CHE/2011', '848', 'Synchronized media in social networks\r\n', '', 13, '', 9, 9, 10, '2011-04-14', 37, 1, 0),
(172, '', '0000-00-00', '4571/CHE/2011', '847', 'Metal free catalysts for the ring-opening polymerization of cyclic esters and lactide\r\n', '', 24, '', 6, 10, 25, '2011-12-26', 37, 1, 0),
(173, '', '0000-00-00', '612/CHE/2012', '844', 'Portable cable way for agricultural applications\r\n', '', 104, '', 13, 1, 84, '2012-02-20', 38, 1, 0),
(174, '', '0000-00-00', '794/CHE/2011', '843', 'A method of removing organic pollutants from water and wastewater\r\n', '', 50, '', 7, 10, 112, '2011-03-16', 37, 1, 0),
(175, '', '0000-00-00', '773/CHE/2011', '842', 'Mobile unit for cataract surgery\r\n', '', 59, '', 9, 3, 101, '2011-03-14', 37, 1, 0),
(176, '', '0000-00-00', '1513/CHE/2011', '840', 'An inductive loop vehicle detection system for heterogenenous and less-lane disciplined traffic conditions\r\n', '', 21, '', 9, 5, 76, '2011-05-22', 37, 1, 0),
(177, '', '0000-00-00', '61/CHE/2011', '839', 'Digital receipts depository system\r\n', '', 13, '', 9, 9, 10, '2011-01-07', 37, 1, 0),
(178, '', '0000-00-00', '3747/CHE/2010', '838', 'Synchronized T V viewing for social networks\r\n', '', 13, '', 9, 9, 10, '2010-12-08', 36, 1, 0),
(179, '', '0000-00-00', '214/CHE/2010', '837', 'Technique for imaging using virtual array of n sources using phased excitation\r\n', '', 48, '', 13, 10, 73, '2010-01-28', 36, 1, 0),
(180, '', '0000-00-00', '702/CHE/2011', '831', 'Solvent and ultrasound assisted dissolution of bone cement in revision arthroplasty\r\n', '', 25, '', 6, 3, 103, '2011-03-09', 37, 1, 0),
(181, '', '0000-00-00', '2362/CHE/2011', '824', 'Novel transducers for non-invasive measurement of blood flow and arterial distensibility\r\n', '', 39, '', 9, 3, 87, '2011-07-11', 37, 1, 0),
(182, '', '0000-00-00', '2597/CHE/2010', '821', 'A hands-free device for enabling the disabled to turn the pages of a book while reading\r\n', '', 98, '', 10, 12, 42, '2010-09-07', 36, 1, 0),
(183, '', '0000-00-00', '2479/CHE/2010', '817', 'Fuel Cell with enhanced cross-flow serpentine flow fields\r\n', '', 111, '', 5, 6, 55, '2010-08-27', 36, 1, 0),
(184, '', '0000-00-00', '134/CHE/2009', '812', 'An optimized manufacturing process for stable fiber bragg gratings (FBGs)\r\n', '', 16, '', 9, 5, 122, '2009-07-21', 35, 1, 0),
(185, '', '0000-00-00', '2550/CHE/2010', '811', 'Group 4 metal aryloxy compounds as bulk polymerization catalysts for lactide polymerization\r\n', '', 24, '', 6, 10, 105, '2010-09-02', 36, 1, 0),
(186, '', '0000-00-00', '2769/CHE/2010', '808', 'An online method for measuring moisture in a power transformer\r\n', '', 39, '', 9, 6, 73, '2010-09-23', 36, 1, 0),
(187, '', '0000-00-00', '2931/CHE/2010', '807', 'A twin unidirectional impulse turbine topology incorporating a bluff body for oscillating flow as in a wave energy plant\r\n', '', 39, '', 9, 6, 143, '2010-10-04', 36, 1, 0),
(188, '', '0000-00-00', '1911/CHE/2009', '803', 'A device for direct injection of gasoline into a combustion system\r\n', '', 20, '', 13, 2, 56, '2009-08-12', 35, 1, 0),
(189, '', '0000-00-00', '995/CHE/2009', '802', 'Low Distortion Filters\r\n', '', 106, '', 9, 5, 128, '2009-04-29', 35, 1, 0),
(190, '263655', '2014-11-12', '3099/CHE/2009', '801', 'A method for synthesis of polymers and copolymers\r\n', '', 24, '', 6, 10, 105, '2009-12-15', 35, 1, 0),
(191, '', '0000-00-00', '781/CHE/2009', '799', 'Method and apparatus for low power continuous-time sigma delta modulation\r\n', '', 106, '', 9, 5, 128, '2009-04-03', 35, 1, 0),
(192, '', '0000-00-00', '956/CHE/2010', '797', 'Selective conversion of glycerol to 1,2 and 1,3 propane diol\r\n', '', 129, '', 6, 8, 16, '2010-04-06', 36, 1, 0),
(193, '', '0000-00-00', '264/CHE/2009', '796', 'A Herbal route for the synthesis of pure nano copper powder\r\n', '', 62, '', 14, 8, 142, '2009-02-06', 35, 1, 0),
(194, '', '0000-00-00', '1016/DEL/2009', '795', 'Tripod for submicron level positioning\r\n', '', 42, '', 13, 4, 47, '2009-05-18', 35, 1, 0),
(195, '', '0000-00-00', '3249/CHE/2008', '794', 'A method for providing multi level security to prevent .x-ray microscopies at the mesoscale\r\n', '', 74, '', 6, 11, 7, '2008-12-23', 34, 1, 0),
(196, '', '0000-00-00', '155/CHE/2009', '792', 'Functionally graded aluminium alloy based in-situ metal matrix composites (FG-AMC)\r\n', '', 62, '', 14, 2, 85, '2009-01-23', 35, 1, 0),
(197, '', '0000-00-00', '1016/CHE/2009', '791', 'Inorganic-Organic hybrid membranes with low methanol permeability characteristics\r\n', '', 129, '', 6, 6, 55, '2009-05-01', 35, 0, 0),
(198, '', '0000-00-00', '2082/CHE/2009', '789', 'Removal of fluoride, alkalinity, heavy metals and suspended solids simultaneously - adsorbent synthesis, adsorbent composition and a device for affordable drinking water\r\n', '', 74, '', 6, 8, 142, '2009-08-28', 35, 1, 0),
(199, '267052', '2015-06-24', '3194/CHE/2008', '788', 'A method of measuring the air-fuel ratio of a spark ignition engine\r\n', '', 56, '', 13, 2, 57, '2008-12-19', 34, 1, 0),
(200, '', '0000-00-00', '169/CHE/2009', '787', 'A method for removing inorganic mercury from drinking water\r\n', '', 74, '', 6, 7, 142, '2009-01-27', 35, 1, 0),
(201, '', '0000-00-00', '349/CHE/2009', '786', 'A process for covalently bonding a drug to the surface of chemically exfoliated graphite oxide (CEGO) without spacer for the treatment of cancer\r\n', '', 0, '', 16, 3, 45, '2009-02-18', 35, 1, 0),
(202, '', '0000-00-00', '350/CHE/2009', '785', 'A process for the preparation of nanocomposite adsorbents for the removal of dyes from waste waters of industrial effluents\r\n', '', 0, '', 16, 8, 142, '2009-02-18', 35, 1, 0),
(203, '', '0000-00-00', '3057/CHE/2008', '784', 'A method of Oxy-fuel combustion\r\n', '', 111, '', 5, 6, 58, '2008-12-04', 34, 1, 0),
(204, '', '0000-00-00', '1223/CHE/2009', '782', 'Synchronized optical and electrical pulse generation for gated avalanche photodetection\r\n', '', 4, '', 9, 5, 92, '2009-05-27', 35, 1, 0),
(205, '', '0000-00-00', '402/CHE/2009', '781', 'Liquefaction of gases on small scale\r\n', '', 125, '', 13, 10, 80, '2009-02-25', 35, 1, 0),
(206, '', '0000-00-00', '1391/CHE/2008', '779', 'A device for facilitating the use of brailee by the visually disabled\r\n', '', 92, '', 10, 3, 101, '2008-06-09', 34, 1, 0),
(207, '260949', '2014-05-29', '1390/CHE/2008', '778', 'A hands-free device for enabling the disabled to turn the pages of a book while reading\r\n', '', 92, '', 10, 12, 42, '2008-06-09', 34, 1, 0),
(208, '', '0000-00-00', '30/CHE/2009', '777', 'A device for the manufacture of vykom type rope\r\n', '', 104, '', 13, 1, 139, '2009-01-07', 35, 1, 0),
(209, '', '0000-00-00', '2262/CHE/2008', '774', 'Facile synthesis of highly anisotropic gold nanoflowers: A new class of infrared absorbing nanomaterials with applications in labeling and printing\r\n', '', 74, '', 6, 6, 131, '2008-09-17', 34, 1, 0),
(210, '', '0000-00-00', '2643/CHE/2008', '773', 'A new dye with high quantum yield for applications in dye lasers and nonlinear optics and as a fluorescence lifetime standard\r\n', '', 77, '', 16, 4, 79, '2008-10-30', 34, 1, 0),
(211, '', '0000-00-00', '1328/CHE/2008', '771', 'A Multiwalled carbon nanotube biosensor for the detection of paraoxon contained in organophosphorous nerve agents\r\n', '', 0, '', 16, 3, 45, '2008-06-02', 34, 1, 0),
(212, '', '0000-00-00', '94/CHE/2009', '769', 'An automated system for early detection of diabetic retinopathy\r\n', '', 8, '', 8, 3, 44, '2009-01-13', 35, 1, 0),
(213, '', '0000-00-00', '625/CHE/2008', '768', 'Process for the biocatalyst-mediated preparation of optically active alpha-amino acids by deracemisation technique\r\n', '', 7, '', 3, 10, 63, '2008-03-13', 34, 1, 0),
(214, '', '0000-00-00', '1438/CHE/2008', '767', 'A process and an apparatus for the removal of dissolved solids from water\r\n', '', 129, '', 6, 6, 112, '2008-06-13', 34, 1, 0),
(215, '259651', '2014-03-21', '1682/CHE/2008', '766', 'A device for descaling the inner wall of a tank\r\n', '', 14, '', 10, 10, 38, '2008-07-11', 34, 1, 0),
(216, '', '0000-00-00', '2245/CHE/2007', '765', 'An air-fuel mixture injection system for two stroke internal combution engines\r\n', '', 87, '', 13, 2, 56, '2007-10-05', 33, 1, 0),
(217, '', '0000-00-00', '1879/CHE/2007', '764', 'A method to produce supported noble metal nanoparticles in commercial quantities for drinking water purification\r\n', '', 74, '', 17, 8, 142, '2007-08-02', 33, 1, 0),
(218, '', '0000-00-00', '416/CHE/2008', '761', 'A method to use single walled carbon nanotube composite for gas sensing applications\r\n', '', 74, '', 17, 10, 60, '2008-02-19', 34, 1, 0),
(219, '', '0000-00-00', '1569/CHE/2007', '760', 'A method of propagation of ultrasonic guided wave modes traveling long distances between the walls of structures\r\n', '', 48, '', 13, 10, 73, '2007-07-20', 33, 1, 0),
(220, '', '0000-00-00', '1568/CHE/2007', '759', 'Transient eddy current heating thermography\r\n', '', 48, '', 13, 10, 73, '2007-07-20', 33, 1, 0),
(221, '265418', '2015-02-24', '1612/CHE/2007', '758', 'An Analog Digital alternative and Augmentative Communication Device useful for individuals with Multiple Disabilities\r\n', '', 4, '', 9, 12, 41, '2007-07-26', 33, 1, 0),
(222, '258154', '2013-12-10', '2933/CHE/2007', '756', 'A method of, and an apparatus for, combusting hydrocarbon fuels for providing a clean heat/energy source\r\n', '', 111, '', 5, 6, 58, '2007-12-07', 33, 1, 0),
(223, '251049', '2012-02-20', '1488/CHE/07', '753', 'Electrode based on Tungsten Trioxide Nanorods for a Supercapacitor\r\n', '', 129, '', 6, 6, 113, '2007-07-11', 33, 1, 0),
(224, '248139', '2011-06-21', '1578/CHE/2007', '752', 'An electrode based on Ru-polyoxometalate for supercapacitor\r\n', '', 129, '', 6, 6, 0, '2007-07-20', 33, 1, 0),
(225, '246826', '2011-03-16', '943/CHE/2007', '750', 'A method to transform metallic single walled carbon nanotubes into semiconducting nanotubes\r\n', '', 74, '', 17, 5, 92, '2007-05-03', 33, 1, 0),
(226, '254754', '2012-12-14', '298/CHE/2007', '749', 'Multi-antenna cellular broad band wireless communication system with interference mitigation\r\n', '', 19, '', 9, 9, 74, '2007-02-12', 33, 1, 0),
(227, '', '0000-00-00', '2445/CHE/2006', '743', 'Reusable Printing Paper\r\n', '', 96, '', 6, 11, 117, '2006-12-28', 32, 1, 0),
(228, '253683', '2012-08-13', '1720/CHE/2007', '740', 'A method of spatial multiplexing for high data rate wireless communication\r\n', '', 28, '', 9, 9, 147, '2007-08-06', 33, 1, 0),
(229, '', '0000-00-00', '376/CHE/2007', '739', 'A Process for the preparation of activated carbon from botanical sources\r\n', '', 129, '', 6, 7, 142, '2007-02-22', 33, 1, 0),
(230, '247547', '2011-04-19', '670/CHE/2007', '737', 'A method of and an apparatus for continous humidification of hydrogen gas at a predetermined relative humidity delivered to a fuel cell\r\n', '', 9, '', 5, 6, 55, '2007-03-30', 33, 1, 0),
(231, '', '0000-00-00', '1189/CHE/2007', '732', 'Single Wavelenght Scheme for Measurement of Oxygen Saturation (SPO2) in Arterial Blood\r\n', '', 36, '', 9, 3, 89, '2007-06-08', 33, 1, 0),
(232, '264838', '2015-12-07', '529/CHE/2007', '731', 'A Linear Variable Capacitive Transducer for sensing planer angles\r\n', '', 36, '', 9, 2, 12, '2007-03-14', 33, 1, 0),
(233, '', '0000-00-00', '970/MUM/2006', '730', 'Variable valve timing assembly for a 4-stroke internal combustion engine\r\n', '', 87, '', 13, 2, 56, '2006-06-21', 32, 1, 0),
(234, '240302', '2010-05-04', '1447/CHE/2006', '729', 'A Multi - block heat exchanger\r\n', '', 99, '', 13, 4, 67, '2006-08-17', 32, 1, 0),
(235, '245629', '2011-01-28', '492/CHE/2006', '728', 'A broadband wireless communication system\r\n', '', 19, '', 9, 9, 147, '2006-03-20', 32, 1, 0),
(236, '264979', '2015-01-30', '1073/CHE/2006', '727', 'A device for online measurement of partial discharge in an electric winding\r\n', '', 39, '', 9, 4, 96, '2006-06-23', 32, 1, 0),
(237, '239070', '2006-07-04', '1150/CHE/2006', '726', 'A combined capacitive and electromagnetic voltage transformer\r\n', '', 39, '', 9, 4, 135, '2006-07-04', 32, 1, 0),
(238, '244913', '2010-12-24', '2023/CHE/2006', '723', 'Rubber compound for inner and outer soles for Diabetic footwear\r\n', '', 71, '', 2, 3, 44, '2006-11-03', 32, 1, 0),
(239, '232313', '2009-03-25', '848/CHE/2006', '722', 'A composition containing nanophase calcium deficient hydroxyapatite with Mg, Sr and Si synthesized from egg shell by microwave processing\r\n', '', 91, '', 14, 3, 37, '2006-05-15', 32, 1, 0),
(240, '235278', '2006-03-09', '421/CHE/2006', '721', 'Manufacture of single walled carbon nanotubes providing visible emission for imaging of nanostructures\r\n', '', 74, '', 6, 10, 59, '2006-03-09', 32, 1, 0),
(241, '250303', '2006-11-14', '2110/CHE/2006', '720', 'A Method and a system for enabling representation of UML class diagram in lisp format and design pattern detection using such representation\r\n', '', 37, '', 8, 9, 32, '2006-11-15', 32, 1, 0),
(242, '', '0000-00-00', '1273/CHE/2005', '719', 'An optical material exhibiting the highest known laser damage threshold, an optical limiting device method of preparation thereof\r\n', '', 74, '', 6, 5, 18, '2005-09-12', 31, 1, 0),
(243, '239890', '2010-04-07', '262/CHE/2006', '718', 'Synthesis of various salts of cross-linked Polyallylamine Polymers by Ion exhange metathesis\r\n', '', 97, '', 6, 3, 53, '2006-02-20', 32, 1, 0),
(244, '237658', '2010-01-01', '263/CHE/2006', '717', 'An improved stage procedure for the synthesis of cross-linked polyallylamine Hydrochloride\r\n', '', 96, '', 6, 3, 53, '2006-03-20', 32, 1, 0),
(245, '234846', '2009-06-17', '427/CHE/2006', '712', 'A device and a method for the preparation of oxygen for artificial infusion in human blood\r\n', '', 118, '', 16, 3, 87, '2006-03-10', 32, 1, 0),
(246, '234955', '2009-06-22', '1289/CHE/2005', '710', 'An axial flow impeller with twistless or single curvature shape vanes or blades particularly, though not exclusively, for axial flow turbomachines\r\n', '', 49, '', 13, 6, 143, '2005-09-14', 31, 1, 0),
(247, '234686', '2009-06-11', '779/CHE/2006', '708', 'A method and apparatus for carrying out oil jet peening\r\n', '', 29, '', 13, 2, 83, '2006-04-28', 32, 1, 0),
(248, '239587', '2010-03-25', '1368/CHE/2005', '704', 'A device for converting single phase AC to three phase balanced AC\r\n', '', 100, '', 9, 6, 114, '2005-09-28', 31, 1, 0),
(249, '234770', '2009-06-15', '565/CHE/2005', '703', 'A Bioreactor for Plant Shoot Culture\r\n', '', 121, '', 3, 1, 15, '2005-05-12', 31, 1, 0),
(250, '252904', '2012-06-08', '3333/DEL/2005', '701', 'A nove bioprocess for the preparation of sulfide compounds of cerium\r\n', '', 122, '', 12, 10, 110, '2005-12-09', 31, 1, 0),
(251, '216479', '2008-03-13', '1424/CHE/04', '700', 'A Process For The Preparation Of Wear And Corrosion Resistant Coatings For Electroless Deposition On Metal Substrates\r\n', '', 102, '', 14, 10, 144, '2004-12-23', 30, 1, 0),
(252, '234769', '2009-06-15', '602/CHE/2005', '697', 'A Method of Detecting the Change in Concentration of an organic dye in a Sample\r\n', '', 77, '', 16, 10, 73, '2005-05-19', 31, 1, 0),
(253, '220156', '2008-05-16', '1213/CHE/2004', '696', 'A Novel Diabetic Footwear for Healing of Foot Sole Ulcers\r\n', '', 71, '', 2, 3, 44, '2004-11-18', 30, 1, 0),
(254, '211873', '2007-11-13', '1214/CHE/2004', '695', 'A Novel Diabetic Footwear for Prevention of Foot Sole Ulcers\r\n', '', 71, '', 2, 3, 44, '2004-11-18', 30, 1, 0),
(255, '238500', '2010-02-08', '566/CHE/2005', '694', 'Boron Carbide powder and a Method of Manufacture Thereof\r\n', '', 91, '', 14, 6, 99, '2005-05-12', 31, 1, 0),
(256, '230725', '2009-02-27', '1113/CHE/2005', '692', 'A Method of Manufacture of a Device to Monitor the Flow of rate of Liquids\r\n', '', 74, '', 6, 3, 17, '2005-08-11', 31, 1, 0),
(257, '219111', '2008-04-25', '891/CHE/2004', '690', 'Polyurethane Foam Coated with Silver Nanoparticles\r\n', '', 74, '', 6, 7, 142, '0004-09-03', 30, 1, 0),
(258, '206754', '2007-05-11', '705/CHE/2004', '689', 'A Multi Axial Fatigue Testing Machine\r\n', '', 57, '', 13, 4, 73, '2004-07-20', 30, 1, 0),
(259, '211880', '2007-11-13', '548/CHE/2004', '688', 'A method of Manufacture of Supported Metal Catalysis\r\n', '', 129, '', 6, 10, 25, '2004-06-11', 30, 1, 0),
(260, '201326', '2006-07-26', '215/CHE/2004', '687', 'A bromate ion sensitive electrode\r\n', '', 129, '', 6, 10, 145, '2004-03-10', 30, 1, 0),
(261, '201000', '2006-06-15', '117/CHE/04', '686', 'A process for the manufacture of an inorganic - organic composite membrane.\r\n', '', 129, '', 6, 6, 55, '2004-02-16', 30, 1, 0),
(262, '200767', '2006-06-02', '51/CHE/2004', '685', 'A Method of preparing drinking water with pesticide content 0.1 PPM and below and drinking water prepared by the said method\r\n', '', 74, '', 17, 7, 142, '2004-01-22', 30, 1, 0),
(263, '194871', '2005-12-13', '636/MAS/2003', '684', 'A device for reducing backlash in gear drives\r\n', '', 108, '', 13, 4, 61, '2003-08-04', 29, 1, 0),
(264, '203490', '2006-11-16', '955/CHE/2003', '683', 'A process for the preparation of Calcium Phosphate from egg shell waste\r\n', '', 91, '', 13, 3, 37, '2003-11-21', 29, 1, 0),
(265, '203512', '2006-11-21', '857/CHE/2003', '681', 'A Broadband Internet Connectivity System\r\n', '', 13, '', 9, 9, 133, '2003-10-23', 29, 1, 0),
(266, '210059', '2007-09-20', '1609/MAS/98', '680', 'A Bi-directional flow impulse turbine with uni-directional rotation\r\n', '', 97, '', 1, 6, 143, '1998-07-20', 24, 1, 0),
(267, '202143', '2006-09-11', '248/CHE/2003', '677', 'A Grinding Wheel and a Method of Manufacture thereof\r\n', '', 128, '', 13, 4, 64, '2003-03-24', 29, 1, 0),
(268, '202127', '2006-09-11', '223/CHE/2003', '675', 'Electrically Conducting coated kapton Film\r\n', '', 118, '', 16, 11, 50, '2003-03-18', 29, 1, 0),
(269, '210198', '2003-09-25', '195/MAS/2003', '674', 'Scratch Resistant Coated plastic ophthalmic lenses\r\n', '', 118, '', 16, 3, 101, '2003-03-10', 29, 1, 0),
(270, '201822', '2006-08-31', '222/MAS/2003', '673', 'A Process for the manufacture of a nanocomposite for harnessing solar energy\r\n', '', 129, '', 6, 6, 123, '2003-03-18', 29, 1, 0),
(271, '200818', '2006-06-09', '777/MAS/2001', '670', 'Post Sintered WC Cutting Tools and a method of Manufacture thereof\r\n', '', 47, '', 13, 10, 33, '2001-09-20', 27, 1, 0),
(272, '199106', '2006-03-31', '563/MAS/2001', '668', 'A method of manufacture of articles of glazed ceramic composites on metal substrates\r\n', '', 47, '', 13, 10, 27, '2001-09-14', 27, 1, 0),
(273, '199123', '2006-03-01', '384/MAS/2001', '667', 'A Method of Manufacture of Carbon Nanotubes and such tubes whenever so manufactured\r\n', '', 129, '', 6, 5, 122, '2001-05-11', 27, 1, 0),
(274, '226100', '2008-12-10', '408/MAS/2001', '666', 'A Process for the preparation of Long afterglow Phosphors\r\n', '', 122, '', 12, 11, 2, '2002-08-01', 28, 1, 0),
(275, '198400', '2006-01-20', '206/MAS/2001', '665', 'A Variable Stiffness Regulating Wheel for a Centreless Grinding Machine\r\n', '', 78, '', 13, 10, 33, '2001-03-08', 27, 0, 0),
(276, '206297', '2007-04-23', '542/MAS/2001', '664', 'A Dual Space Split Air Conditioner\r\n', '', 75, '', 13, 4, 3, '2001-09-14', 27, 1, 0),
(277, '228535', '2009-02-16', '802/MAS/2001', '662', 'A Self - powered Electronically Error - Compensated Current Transformer\r\n', '', 94, '', 9, 6, 135, '2001-09-28', 27, 1, 0),
(278, '226101', '2008-12-10', '1087/MAS/2000', '658', 'A Jet Pump\r\n\r\n', '', 52, '', 13, 4, 115, '2000-12-18', 26, 1, 0),
(279, '208017', '2007-07-06', '25/MAS/2000', '657', 'A Direct Internet Access System (Commercialized)\r\n', '', 13, '', 9, 9, 133, '2000-05-08', 26, 1, 0),
(280, '201014', '2006-06-15', '1219/MAS/1999', '656', 'A Cutting Tool Insert with Built-in Provision for Detecting Flank Wear of a Predetermined Value\r\n', '', 78, '', 13, 10, 33, '1999-12-23', 25, 1, 0),
(281, '204528', '2007-02-22', '1090/MAS/99', '655', 'A process for the Homogeneous Oxidation of Alkylbenze Catalyzed by Heteropoly Compounds\r\n', '', 129, '', 6, 10, 102, '1999-11-11', 25, 1, 0),
(282, '216206', '2008-03-10', '556/MAS/1999', '654', 'A Lan Trainer Lab Apparatus\r\n', '', 13, '', 9, 9, 133, '1999-05-13', 25, 1, 0),
(283, '207914', '2007-07-02', '1233/MAS/98', '650', 'A method of manufacture of Ceramic bodies by microwave joining\r\n', '', 47, '', 13, 10, 27, '1998-06-08', 24, 1, 0),
(284, '226099', '2008-12-10', '1056/MAS/98', '649', 'A process of producing a silicon substrate with a uniform and adherent deposit of palladium or other metal thereon by electroless plating\r\n', '', 41, '', 9, 5, 121, '1998-05-18', 24, 1, 0),
(285, '201086', '2006-06-27', '534/MAS/98', '648', 'Microfines Pneumatic Fine Classifier for the classification of fine powders\r\n', '', 66, '', 5, 10, 51, '1998-03-16', 24, 1, 0),
(286, '210078', '2007-09-17', '533/MAS/98', '647', 'Microfines Fludized Bed Jet Mill for producing Ultra-Fine Powders\r\n', '', 66, '', 5, 10, 51, '1998-03-16', 24, 1, 0),
(287, '201553', '2006-07-31', '535/MAS/98', '646', 'Microfines Circular Fluid Energy Mill for producing Ultra-Fine Powders\r\n', '', 66, '', 5, 10, 51, '1998-03-16', 24, 1, 0),
(288, '204480', '2007-03-22', '463/MAS/98', '645', 'A Breakwater for Seawaves\r\n', '', 54, '', 15, 6, 143, '1998-03-06', 24, 1, 0),
(289, '220398', '2008-05-28', '1737/MAS/96', '640', 'A method of Manufature of a Steel Worm and Worm Wheel for a Worm Drive\r\n', '', 57, '', 13, 4, 150, '1996-10-03', 22, 1, 0),
(290, '198719', '0000-00-00', '1997/MAS/96', '639', 'A Fluidized Abrasive Polishing Machine\r\n', '', 78, '', 13, 4, 33, '1996-11-12', 22, 1, 0),
(291, '196336', '2006-01-04', '521/MAS/97', '637', 'A self calibrating resistive Gauge for the Measurement of Liquid levels\r\n', '', 36, '', 9, 10, 73, '1997-04-17', 23, 1, 0),
(292, '198263', '2006-01-16', '522/MAS/97', '635', 'A device for reducing the exciting current drawn by a magnetising winding\r\n', '', 94, '', 9, 4, 96, '1997-04-17', 23, 1, 0),
(293, '188368', '1995-07-12', '874/MAS/95', '634', 'A Device for Fatigue Testing of Materials\r\n', '', 124, '', 14, 4, 73, '1995-07-12', 21, 1, 0),
(294, '188558', '2003-07-18', '545/MAS/1995', '633', 'An apparatus for Maintaining a steady Plating Current in Pulse Electroplating Operations\r\n', '', 41, '', 9, 5, 121, '1995-05-08', 21, 1, 0),
(295, '187557', '2002-11-29', '1248/MAS/94', '628', 'A device for measuring Elasti Creep in a Belt Drive\r\n', '', 83, '', 13, 4, 14, '1994-12-14', 20, 1, 0),
(296, '187576', '2002-11-29', '1083/MAS/1994', '624', 'A Method of Manufacture of a Giant Magnetostrictive Material\r\n', '', 81, '', 16, 6, 96, '1994-11-08', 20, 1, 0),
(297, '187631', '2002-12-05', '1292/MAS/94', '622', 'A Process for the preparation of new antifriction material\r\n', '', 70, '', 14, 4, 8, '1994-12-28', 20, 1, 0),
(298, '188242', '2003-05-02', '261/MAS/1995', '621', 'A Telemetry Device for regulating the speed and feed of a tool in machining operations\r\n', '', 46, '', 13, 10, 33, '1995-03-06', 21, 1, 0),
(299, '180028', '1993-11-12', '813/MAS/93', '619', 'A Hollow Block Structural System\r\n', '', 85, '', 7, 6, 29, '1993-11-12', 19, 1, 0),
(300, '181505', '1999-07-02', '655/MAS/93', '618', 'A swift-stop device for use in friction welding\r\n', '', 108, '', 13, 10, 145, '1993-09-20', 19, 1, 0),
(301, '187590', '2002-12-05', '6/MAS/95', '617', 'A Process for the preparation of FCC catalyst for use in Petroleum refining(Process I)\r\n', '', 72, '', 6, 10, 25, '1995-01-03', 21, 1, 0),
(302, '181440', '1999-06-25', '410/MAS/93', '614', 'An improved Spur Gear\r\n', '', 89, '', 13, 4, 61, '1993-06-16', 19, 1, 0),
(303, '180431', '1998-12-24', '1/MAS/92', '612', 'A method of preparation of a fluid for use in the flow testing of carburettors\r\n', '', 123, '', 5, 2, 56, '1992-01-03', 18, 1, 0),
(304, '179002', '1998-04-03', '823/MAS/90', '698', 'A device to produce continuous helicoid out of long metal strips\r\n', '', 83, '', 13, 4, 49, '1990-10-19', 16, 1, 0),
(305, '179312', '1998-06-19', '781/MAS/90', '607', 'A Keyway Bush Assembly\r\n', '', 23, '', 13, 4, 22, '1990-10-04', 16, 1, 0),
(306, '177833', '1997-09-12', '313/MAS/90', '606', 'A novel process for the manufacture of an alluminium alloy\r\n', '', 69, '', 14, 10, 4, '1990-04-14', 16, 1, 0),
(307, '173678', '1995-01-20', '17/MAS/90', '605', 'A process for the manufacture of Zirconia-yttria compacts for use as cutting tool inserts\r\n', '', 30, '', 14, 10, 33, '1990-01-04', 16, 1, 0),
(308, '173531', '1994-12-30', '16/MAS/89', '603', 'A method of and an apparatus for the preparation of oxygen enriched orthorhombic superconducting yttrium barium copper oxide powder\r\n', '', 117, '', 12, 11, 125, '1989-01-06', 15, 1, 0),
(309, '173119', '1994-10-21', '862/MAS/88', '602', 'Microprocessor based smart induction motor controller\r\n', '', 101, '', 9, 4, 96, '1988-12-01', 14, 1, 0),
(310, '', '0000-00-00', '591/MAS/87', '601', 'A method of, and a device for, boring holes through thin sheets of hard and /or brittle metallic members\r\n', '', 124, '', 14, 4, 33, '1987-08-13', 13, 1, 0),
(311, '167195', '0000-00-00', '416/MAS/87', '599', 'A device for lifting and tilting an object having a cylindrical core\r\n', '', 83, '', 13, 4, 86, '1987-06-05', 13, 1, 0),
(312, '164385', '0000-00-00', '873/MAS/85', '596', 'An improved two stroke spark ignition engine\r\n', '', 64, '', 13, 2, 46, '1985-11-01', 11, 1, 0),
(313, '757/MAS/85', '1985-09-27', '757/MAS/85', '595', 'A device to determine the Co-efficient of friction of Rollers or Idlers\r\n', '', 83, '', 13, 4, 73, '1985-09-27', 11, 1, 0),
(314, '162979', '1985-07-12', '530/MAS/85', '593', 'A compact and portable apparatus for welding metal wires and the like\r\n', '', 124, '', 14, 10, 145, '1985-07-12', 11, 1, 0),
(315, '162980', '1989-03-23', '582/MAS/1985', '590', 'An improved grinding wheel for use in plunge grinding\r\n', '', 78, '', 13, 4, 64, '1985-07-29', 11, 1, 0),
(316, '159196', '0000-00-00', '201/MAS/83', '588', 'A process of preparing a superplastic alloy of Al-Cu-Zr\r\n', '', 69, '', 14, 10, 4, '1983-09-26', 9, 1, 0),
(317, '149389', '0000-00-00', '73/MAS/79', '556', 'An internal combustion engine\r\n', '', 32, '', 13, 2, 46, '1979-05-21', 5, 1, 0),
(318, '261431', '2014-06-25', '1327/CHE/2008', '199', 'Spacerless carbon nanotubes for cancer treatment and drug delivery\r\n', '', 0, '', 16, 3, 45, '2008-06-02', 34, 1, 0),
(319, '', '0000-00-00', '2235/CHE/2008', '197', 'An Online security system based on the automated teller machine of a bank\r\n', '', 103, '', 8, 9, 134, '2008-09-15', 34, 1, 0),
(320, '', '0000-00-00', '1329/CHE/2008', '196', 'Online security system serving as a unique and exclusive password generator for every internet transaction\r\n', '', 27, '', 11, 9, 134, '2008-06-02', 34, 1, 0),
(321, '', '0000-00-00', '1530/CHE/2008', '195', 'Online security system serving as a unique and exclusive password generator by random and dynamic substitution of symbols with variable length boolean strings for user authentication over internet\r\n', '', 27, '', 11, 9, 134, '2008-06-24', 34, 1, 0),
(322, '', '0000-00-00', '1991/CHE/2008', '194', 'Online internet security system based on USB flash drive\r\n', '', 17, '', 11, 9, 134, '2008-08-14', 34, 1, 0),
(323, '', '0000-00-00', '1191/CHE/2007', '192', 'a non invasive method and device for the measurement of oxygen saturation in arterial blood 2\r\n', '', 36, '', 9, 3, 87, '2007-06-08', 33, 1, 0),
(324, '202154', '2006-09-07', '909/CHE/2003', '187', 'Portable Pedopowergraph\r\n', '', 71, '', 2, 3, 44, '2003-11-06', 29, 1, 0),
(325, '228524', '2009-02-05', '1738/MAS/96', '184', 'A method of Manufature of a Steel Worm and Worm Wheel for a Worm Drive\r\n', '', 57, '', 13, 4, 150, '1996-10-03', 22, 1, 0),
(326, '188131', '1995-02-13', '159/MAS/95', '178', 'A Process for the preparation of FCC catalyst for use in Petroleum refining(Process III)\r\n', '', 129, '', 6, 10, 107, '1995-02-13', 21, 1, 0),
(327, '187611', '2002-11-29', '7/MAS/95', '177', 'A Process for the preparation of FCC catalyst for use in Petroleum refining(Process II)\r\n', '', 72, '', 6, 10, 25, '1995-01-03', 21, 1, 0),
(328, '176756', '1997-02-21', '312/MAS/90', '175', 'A novel thermomechanical process for the manufature of laboratory made alluminium alloy in superplastic form\r\n', '', 69, '', 14, 10, 4, '1990-04-24', 16, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_software`
--

CREATE TABLE IF NOT EXISTS `tbl_software` (
  `software_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `patent_no` varchar(500) NOT NULL,
  `patent_date` date NOT NULL,
  `appl_no` varchar(500) NOT NULL,
  `file_no` varchar(25) NOT NULL,
  `title` longtext NOT NULL,
  `abstract` longtext NOT NULL,
  `inventor` int(11) NOT NULL,
  `sub_inventor` longtext NOT NULL,
  `department` int(11) NOT NULL,
  `industry` int(11) NOT NULL,
  `technology` int(11) NOT NULL,
  `filing_date` date NOT NULL,
  `filing_year` int(11) NOT NULL,
  `filing_country` int(11) NOT NULL,
  `d_flg` int(11) NOT NULL,
  PRIMARY KEY (`software_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_software`
--

INSERT INTO `tbl_software` (`software_auto_id`, `patent_no`, `patent_date`, `appl_no`, `file_no`, `title`, `abstract`, `inventor`, `sub_inventor`, `department`, `industry`, `technology`, `filing_date`, `filing_year`, `filing_country`, `d_flg`) VALUES
(1, 'SW-4003/2009', '2009-02-24', '10030/2008-CO/SW', '790', 'X imager (Computer Software)', '', 120, '', 1, 11, 71, '2008-12-02', 34, 1, 0),
(2, 'SW-4148/2009', '2009-07-06', '3364/2009-CO/SW', '800', 'Predicting FBG decay from growth\r\n', '', 16, '', 9, 5, 122, '2009-04-13', 35, 1, 0),
(3, 'SW-6221/2013', '2013-02-11', '907/2011-COSW', '841', 'IPCV-IITM Laser Graffiti\r\n', '', 80, '', 9, 11, 62, '2011-01-27', 37, 1, 0),
(4, 'L-58926/2014', '2014-07-02', '47808/2014-CO/L', '1009', 'Fractal interpolation curves and surfaces with fundamental shapes\n', '', 11, '', 18, 4, 23, '2014-04-15', 40, 1, 0),
(5, 'L-55793/2013', '2013-10-28', '8343/2013-CO/L', '1010', 'A new fractal model for shape preserving curves\r\n', '', 11, '', 18, 4, 23, '2013-08-19', 39, 1, 0),
(6, 'L-56224/2013', '2013-11-06', '8372/2013-CO/L', '1081', 'a-Fractal rational splines for constrained interpolation\r\n', '', 11, '', 18, 4, 23, '2013-08-23', 39, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_solution`
--

CREATE TABLE IF NOT EXISTS `tbl_solution` (
  `solution_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `patent_no` varchar(500) NOT NULL,
  `patent_date` date NOT NULL,
  `appl_no` varchar(500) NOT NULL,
  `file_no` varchar(25) NOT NULL,
  `title` longtext NOT NULL,
  `abstract` longtext NOT NULL,
  `inventor` int(11) NOT NULL,
  `sub_inventor` longtext NOT NULL,
  `department` int(11) NOT NULL,
  `industry` int(11) NOT NULL,
  `technology` int(11) NOT NULL,
  `filing_date` date NOT NULL,
  `filing_year` int(11) NOT NULL,
  `filing_country` int(11) NOT NULL,
  `d_flg` int(11) NOT NULL,
  PRIMARY KEY (`solution_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_solution`
--

INSERT INTO `tbl_solution` (`solution_auto_id`, `patent_no`, `patent_date`, `appl_no`, `file_no`, `title`, `abstract`, `inventor`, `sub_inventor`, `department`, `industry`, `technology`, `filing_date`, `filing_year`, `filing_country`, `d_flg`) VALUES
(1, '', '0000-00-00', '', '1389', 'Bioremediation of Cr(VI) Contaminated Soil and Aquifers', 'A technology for the bioremediation of Cr(VI) contaminated soil and aquifers is developed. This \r\n\r\ntechnology has been used in many industrial sites for bioremediation. This technology uses \r\n\r\nbacteria for reducing Cr(VI) to Cr(III).These bacteria are isolated from contaminated soil. They \r\n\r\nare not genetically modified. Hence, there is no threat to local flora and fauna.  No chemical \r\n\r\naddition or aeration is needed. Only some organic matter as food to micro organism needs to be \r\n\r\nadded. After remediation, there will not be any residual pollution left over. The cost of \r\n\r\nremediation by this technology is about 10% of that of chemical/electrochemical based \r\n\r\ntechnologies. The reduced chromium will be adsorbed onto soil particles. Cr(III) is much more \r\n\r\nstable and less toxic compared to Cr(VI). Under normal conditions Cr(III) will not get oxidized \r\n\r\nto Cr(VI).\r\n\r\nKey words: Bioremediation , Cr(VI) contaminated soil , Aquifer', 50, '', 7, 7, 152, '0000-00-00', 40, 1, 0),
(2, '', '0000-00-00', '', '1390', 'Complete Treatment of Coke-Oven Wastewater', 'Coke-Oven wastewater contains phenolic compounds, poly-nuclear aromatic hydrocarbons, and \n\ncyanides. This is a very complex wastewater. Many of the conventional wastewater treatment \n\ntechnologies often fail to treat such wastewaters. We have developed a hybrid system for the \n\ncomplete treatment of Coke-Oven wastewater. This consists of anaerobic, anoxic and oxic \n\nsystems followed by a photocatalytic polishing unit. The treated wastewater meets the discharge \n\nstandards. This system is able to take care of all the complex pollutants present in the coke oven \n\nwastewater. The cost of treatment is comparable to conventional treatment systems. \n\nKey words: Coke-Oven wastewater, Complete treatment, anaerobic, anoxic and oxic', 50, '', 7, 7, 142, '0000-00-00', 40, 1, 0),
(3, '', '0000-00-00', '', '1391', 'VOC treatment from Paint industries', 'The VOC emissions from paint industry typically contain low concentration mixture of various \n\nVOC species. High flow rate, low heat value gaseous emissions are generally considered un-\n\neconomical for the application of physico-chemical processes involving thermal oxidation \n\nbecause of their auxiliary fuel or chemical requirement. We have developed a biological system \n\nfor the treatment of VOC emissions from paint industry. The system uses acclimatized micro \n\norganisms and doesn''t need any chemical addition. There will not be any sludge generation. It is \n\nan environmentally friendly and economically viable system. This can treat any VOCs or \n\ninorganic emissions like ammonia, SOx etc. The cost of such treatment will be around 20% of \n\nany chemical or advanced oxidation technologies. \n\nKey words: Paint industry, VOC, Biotrickling filter, Rotating biological contactor', 50, '', 7, 3, 152, '0000-00-00', 40, 1, 0),
(4, '', '0000-00-00', '', '1392', 'Onsite wastewater treatment systems', 'a) Constructed wetlands for Grey water treatment\n\nA hybrid constructed wetland is being developed for the treatment of grey water. This system \n\nneeds minimal operation and maintenance and no power or chemical requirement. The treated \n\nwater from the system meets the requirements of recycling for toilet flushing, gardening etc. The \n\nsystem works on the principle of biodegradation, phyto-remediation and physico-chemical \n\nprocesses. Plants for the system can be any native species, with good root zone. Plants can be \n\nflowering plants, fodder grass or fruit bearing plants such as banana. The accumulation of \n\npollutants in the plants is minimal. Therefore, there are no ill effects on health if these plants are \n\nused.\n\nKey words: Grey water, hybrid constructed wet land, recycling, phyto-remediation  \n\nb) Onsite system for complete recycling\n\nMore than 60% of the population depends on septic tanks or soak pits for their black water \n\ntreatment. The effluent coming out of septic tank is rich in organic matter and pathogens. As a \n\nresult many of the ground water sources are getting contaminated. A sustainable onsite \n\nwastewater treatment system has been developed, which can work off the grid. It is a solar \n\npowered system, but without any battery storage. The treated wastewater meets the recycle \n\nstandards for toilet flushing, gardening and cleaning. The cost of the system is comparable with \n\nconventional onsite treatment systems. \n\nKey words: Onsite wastewater treatment system, Complete recycle, Solar powered, off the grid.', 50, '', 7, 3, 142, '0000-00-00', 40, 1, 0),
(5, '', '0000-00-00', '', '1393', 'Point of use water treatment system', 'A simple, easy to make and easy to use domestic filter has been developed for treating drinking \n\nwater. This system is able to remove turbidity, organic matter, colour and odor. Most of the \n\nbacteriological contamination can be removed by this filter. The filtered water is collected in a \n\ncontainer, with proper lid and tap and chlorine tablet is added for complete removal of microbes. \n\nThe maintenance of the system is very simple. Locally available materials are used as filter \n\nmedia. This has been field tested successfully. This system is suitable for under privileged \n\ncommunities and rural areas where good quality piped drinking water is not available.\n\nKey Words: Domestic filter, Under privileged communities, Rural areas', 50, '', 7, 11, 142, '0000-00-00', 40, 1, 0),
(6, '', '0000-00-00', '', '1394', 'RO reject Management System', 'A natural solar and wind aided cross-flow evaporator has been developed for the management of \n\nreject from RO plants. This will be very useful for reducing the volume of RO reject from \n\nindustries which practice zero liquid discharge. This system can significantly reduce the energy \n\nrequirement for mechanical evaporators. Operation and maintenance of this system is very \n\nminimal. Design protocol has been developed based on wind speed, humidity and solar radiation \n\nof the place, where the system needs to installed. The natural evaporator does not create much air \n\nand soil pollution. The system is appropriate for arid and semi arid regions. \n\nKey Words: Solar and wind aided cross-flow evaporator, RO reject management, Arid and semi \n\narid regions', 50, '', 7, 11, 152, '0000-00-00', 40, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_technology`
--

CREATE TABLE IF NOT EXISTS `tbl_technology` (
  `tech_id` int(11) NOT NULL AUTO_INCREMENT,
  `tech_area` text NOT NULL,
  PRIMARY KEY (`tech_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `tbl_technology`
--

INSERT INTO `tbl_technology` (`tech_id`, `tech_area`) VALUES
(1, 'Additives'),
(2, 'After Glow'),
(3, 'Air Conditioner'),
(4, 'Alloys'),
(5, 'Analog Simulations tools'),
(6, 'Antenna Receivers'),
(7, 'Anti counterfeit'),
(8, 'Anti Friction Material'),
(9, 'Antibacterial'),
(10, 'Application'),
(11, 'Atomized spray'),
(12, 'Automotive Sensor'),
(13, 'Batteries'),
(14, 'Belt Drive'),
(15, 'Bio Reactor'),
(16, 'Biofuel'),
(17, 'Biological Fluid Flow'),
(18, 'Biological Protection Prompt Intense Laser, Optical Transmission'),
(19, 'Biotech Research'),
(20, 'Braking System'),
(21, 'BS / HS'),
(22, 'Bush assembly'),
(23, 'CAD Software'),
(24, 'Cancer Treatment'),
(25, 'Catalyst'),
(26, 'Cellular Networks'),
(27, 'Ceramites'),
(28, 'Chemical Synthesis'),
(29, 'Civil'),
(30, 'Clutch'),
(31, 'CO2 Capture'),
(32, 'Code screening tool'),
(33, 'Cutting tools'),
(34, 'Dairy, Food Packaging'),
(35, 'Deepsea Mining'),
(36, 'Defense, Space'),
(37, 'Dental'),
(38, 'De-scaling Device'),
(39, 'Detection of Biological and Chemical Phrases'),
(40, 'Device Control Unit'),
(41, 'Device for Cerebral Palsy'),
(42, 'Device for Disable'),
(43, 'Device for Visually Impired'),
(44, 'Diabetics'),
(45, 'Drug delivery'),
(46, 'Engines'),
(47, 'Equipment'),
(48, 'Fare Metering'),
(49, 'Farming Equipment'),
(50, 'Films'),
(51, 'Fine Powder'),
(52, 'Flow control device'),
(53, 'Food & Drugs'),
(54, 'Food packaging, Medical'),
(55, 'Fuel Cells'),
(56, 'Fuel Injection'),
(57, 'Fuel Injection Testing'),
(58, 'Furnaces'),
(59, 'Gas level Sensor'),
(60, 'Gas Sensing'),
(61, 'Gears'),
(62, 'Graffiti'),
(63, 'Green Technology'),
(64, 'Grinding Wheel'),
(65, 'GUI'),
(66, 'Health'),
(67, 'Heat Exchanger'),
(68, 'Heat Exchanger / Pipeline (Oil & Gas Industry)'),
(69, 'Hospital Safety'),
(70, 'Hydrogen storage'),
(71, 'Image Sensing'),
(72, 'Imaging Device'),
(73, 'Industrial Test Equipment'),
(74, 'Infrastructure'),
(75, 'Instrumentation (Fluid Flow)'),
(76, 'Internal Transport Management'),
(77, 'Laptop Table'),
(78, 'Laptops/Servers'),
(79, 'Lasers'),
(80, 'Liquefaction'),
(81, 'Liquid Storage and Handling'),
(82, 'Localized Polishing'),
(83, 'Machining'),
(84, 'Material Handling'),
(85, 'Materials'),
(86, 'Mechanical Handling'),
(87, 'Medical Equipments'),
(88, 'Medical Technology, Watch making, Motor Sports, Electronics and Arts'),
(89, 'Medical Testing'),
(90, 'Medical Testing Device'),
(91, 'Medical Training Solution'),
(92, 'Microelectronic Device'),
(93, 'Micropumps'),
(94, 'Mobile Technology'),
(95, 'Mobiles/Ipads/Laptops'),
(96, 'Motors & Controllers'),
(97, 'Natural Gas Store & Transport'),
(98, 'Network Equipment'),
(99, 'Nuclear Power'),
(100, 'Oil Sludge Dissolution'),
(101, 'Ophthalmic'),
(102, 'Organic Chemicals'),
(103, 'Orthopaedic'),
(104, 'Packaging'),
(105, 'Packaging, Drug Delivery'),
(106, 'Patient Monitoring'),
(107, 'Petroleum refining'),
(108, 'Pharma, Cosmetics, Petroleum'),
(109, 'Photocatalysis'),
(110, 'Pigments'),
(111, 'Plant Nutrients'),
(112, 'Pollution Control'),
(113, 'Power Capacitors/Electrochemical'),
(114, 'Power Converter'),
(115, 'Pumps'),
(116, 'Replacement Knee Joint'),
(117, 'Reusepaper'),
(118, 'RFID, Sensors'),
(119, 'Robotics'),
(120, 'Script Recognition'),
(121, 'Semiconducters'),
(122, 'Sensors'),
(123, 'Solar'),
(124, 'Steel Sheets'),
(125, 'Super Conducting Powder'),
(126, 'Surgical Tool'),
(127, 'Swimming Pool Lift'),
(128, 'System'),
(129, 'T.V controling device'),
(130, 'Testing of mechanical properties'),
(131, 'Thermal Insulation'),
(132, 'Touchscreen imaging'),
(133, 'Training Kit'),
(134, 'Transaction Security'),
(135, 'Transformer'),
(136, 'TS / BS'),
(137, 'UPS'),
(138, 'Video Surveilance System'),
(139, 'Vykom Rope'),
(140, 'Watches & Mobiles'),
(141, 'Water Absorbing Polymer'),
(142, 'Water Treatment'),
(143, 'Wave Energy'),
(144, 'Wear Resistant Coating'),
(145, 'Welding'),
(146, 'Wheel Chair'),
(147, 'Wireless - BS'),
(148, 'Wireless - HS'),
(149, 'Wirelss'),
(150, 'Worm Drive'),
(151, 'N/A'),
(152, 'Waste Management');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

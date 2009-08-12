-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2009 at 07:39 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `donavonsreefdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(6) NOT NULL auto_increment,
  `page` varchar(100) NOT NULL,
  `section` varchar(50) NOT NULL,
  `text` longtext NOT NULL,
  `visible` enum('y','n') NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=6 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `page`, `section`, `text`, `visible`, `date`) VALUES
(1, 'home_page', 'top_white_box', '&lt;span style=&quot;font-weight: bold;&quot;&gt;Hi I''m Donavon,&lt;/span&gt;&lt;br&gt;Welcome to my Reef!&lt;br&gt;&amp;nbsp;&lt;br&gt;&lt;b&gt;I\nwill do my very best to cherry pick only the finest, most colorful\n&amp;amp; healthy corals for you. &lt;/b&gt;Being a hobbyist myself for some eight\nyears now, I know how disappointing it is to go to your local fish\nstore just to find the same old dull brown &amp;amp; green corals. I assure you, you will not find them on this site.', 'y', '12/24/2008'),
(2, 'home_page', 'middle_white_box', '&lt;span style=&quot;font-weight: bold;&quot;&gt;I will be updating weekly&lt;/span&gt; and special requests for a species or\ncolor are encouraged. If it''s out there, I''ll do my best to track it\ndown for you. &lt;br&gt;&lt;br&gt;&lt;big&gt;&lt;span style=&quot;font-style: italic;&quot;&gt;Please feel free to e-mail me with any questions at:&lt;/span&gt;&lt;/big&gt;&lt;br&gt;&lt;a href=&quot;mailto:Sales@DonavonsReef.com&quot;&gt;Sales@DonavonsReef.com&lt;/a&gt;&lt;br&gt;&lt;big&gt;&lt;br&gt;&lt;/big&gt;&lt;span style=&quot;font-style: italic;&quot;&gt;Thank you,&lt;/span&gt;&lt;font style=&quot;font-style: italic;&quot; size=&quot;2&quot; color=&quot;blue&quot; face=&quot;cancun&quot;&gt;&lt;br&gt;&lt;/font&gt;&lt;span style=&quot;font-style: italic;&quot;&gt;Enjoy the Site!&lt;/span&gt;', 'y', '12/24/2008'),
(3, 'home_page', 'top_black_box', '', 'n', '12/29/2008'),
(4, 'about_page', 'top_white_box', '&lt;BIG&gt;&lt;BIG&gt;&lt;BIG&gt;&lt;SPAN style=&quot;FONT-WEIGHT: bold&quot;&gt;Hi, I''m Donavon!&lt;/SPAN&gt;&lt;/BIG&gt;&lt;/BIG&gt;&lt;/BIG&gt;&lt;BR&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;BR&gt;&lt;B&gt;I''m located in sunny South Florida. &lt;/B&gt;In the event you would like to pick up your order you can reach me at &lt;A href=&quot;mailto:Sales@DonavonsReef.com&quot;&gt;Sales@DonavonsReef.com&lt;/A&gt;. I prefer local pick up if you are in Broward County. If you are located in Dade I would be willing to meet at a predetermined place. In the event you are looking for that something special or have a request please feel free to &lt;A href=&quot;mailto:Sales@DonavonsReef.com&quot;&gt;e-mail me&lt;/A&gt; and I will do my best to track it down.&lt;B&gt;&lt;BR&gt;&lt;/B&gt;&lt;BR&gt;\n&lt;DIV style=&quot;TEXT-ALIGN: right&quot;&gt;&lt;SPAN style=&quot;FONT-WEIGHT: bold&quot;&gt;&lt;/SPAN&gt;&lt;IMG src=&quot;../images/logos/logo.jpg&quot;&gt;&lt;/DIV&gt;\n&lt;DIV style=&quot;TEXT-ALIGN: right&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;BR&gt;\n&lt;DIV style=&quot;TEXT-ALIGN: left&quot;&gt;&amp;nbsp; &lt;BIG&gt;&lt;SPAN style=&quot;FONT-STYLE: italic&quot;&gt;-Donavon&lt;/SPAN&gt;&lt;/BIG&gt;&lt;BR&gt;&lt;/DIV&gt;&lt;/DIV&gt;&lt;BR&gt;', 'y', '01/21/2009'),
(5, 'contact_page', 'top_white_box', '&lt;big&gt;&lt;big&gt;&lt;big&gt;&lt;font size=&quot;3&quot; color=&quot;blue&quot; face=&quot;CANCUN&quot;&gt;&lt;big&gt;&lt;big&gt;&lt;big&gt;Contact Info.&lt;/big&gt;&lt;/big&gt;&lt;/big&gt;&lt;/font&gt;&lt;/big&gt;&lt;/big&gt;&lt;/big&gt;&lt;b&gt;&lt;br&gt;&lt;br&gt;&lt;/b&gt;I ship &lt;span style=&quot;font-weight: bold;&quot;&gt;FedEx standard overnight,&lt;/span&gt; a single coral for $49.00 or up to 6 corals for $59.00. I make my drop off at 8:00PM. Delivery is usually before noon so\nyour coral will only be in transit for around 16 hours.&lt;span style=&quot;font-weight: bold;&quot;&gt; Shipping for\neach additional small coral is only $5.00 more.&lt;/span&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt; Florida shipping is only $25.00.&lt;/span&gt; &lt;span style=&quot;font-style: italic; text-decoration: underline;&quot;&gt;&lt;/span&gt;&lt;br&gt;&lt;div style=&quot;text-align: center;&quot;&gt;&lt;br&gt;&lt;div style=&quot;text-align: left;&quot;&gt;Please inform me of the weather conditions in your area. I will add\nheat/cold packs upon request. &lt;span style=&quot;font-weight: bold;&quot;&gt;You must be present for the first\ndelivery attempt in order to be even considered for compensation.&lt;/span&gt; In\nthe event some disaster should happen, I must be notified within one\nhour of delivery or you forfeit any compensation. Accidents do happen\nand I am always willing to try and rectify any problem within reason.\nThank You.\n&lt;br&gt;&lt;/div&gt;&lt;/div&gt;&lt;br&gt;\n&lt;big&gt;&lt;big&gt;Contact me at: &lt;a href=&quot;mailto:Sales@DonavonsReef.Com&quot;&gt;Sales@DonavonsReef.Com&lt;/a&gt;&lt;br&gt;&lt;br&gt;&lt;/big&gt;&lt;/big&gt;&lt;div style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-style: italic; text-decoration: underline;&quot;&gt;Disclaimer:&lt;/span&gt;&lt;br style=&quot;font-style: italic;&quot;&gt;&lt;span style=&quot;font-style: italic;&quot;&gt;Due to the sensitive nature of these\nanimals, I can''t guarantee their state once they have left my hands. I\nwill do everything possible to make sure these animals get to you alive\n&amp;amp; healthy. I have no control over weather or sloppy mail carriers.&lt;/span&gt;\n&lt;br&gt;&lt;/div&gt;', 'y', '12/15/2008');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL auto_increment,
  `product_ids` varchar(1000) NOT NULL,
  `quantities` varchar(1000) NOT NULL,
  `shipping_info_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `total` int(11) NOT NULL,
  `order_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `payment_received` varchar(50) NOT NULL default '0',
  `payment_sent` varchar(50) NOT NULL default '0',
  `ship_date` varchar(50) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=150 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_ids`, `quantities`, `shipping_info_id`, `user_id`, `total`, `order_date`, `payment_received`, `payment_sent`, `ship_date`) VALUES
(91, '81, 83', '1, 2', 91, 0, 753, '2008-12-25 15:34:54', '0', '0', '0'),
(92, '41, 50, 69', '2, 1, 1', 92, 11, 71, '2008-12-25 20:35:29', '0', '0', '0'),
(93, '92', '2', 93, 0, 164, '2008-12-25 20:57:42', '0', '0', '0'),
(94, '87', '3', 94, 0, 10009, '2008-12-25 21:03:45', '0', '0', '0'),
(95, '89, 91', '2, 4', 95, 0, 257, '2008-12-26 11:36:07', '0', '0', '0'),
(96, '89', '2', 96, 12, 211, '2008-12-26 18:54:15', '0', '0', '0'),
(97, '87, 40', '1, 1', 98, 0, 10027, '2008-12-26 19:11:11', '0', '0', '0'),
(98, '40, 41, 50, 69', '1, 1, 1, 1', 99, 14, 117, '2008-12-26 19:13:39', '0', '0', '0'),
(99, '41, 50, 69, 83, 87', '2, 2, 1, 3, 4, 1', 100, 0, 11058, '2008-12-27 06:05:13', '0', '0', '0'),
(100, '50, 69, 83', '1, 2, 4', 101, 15, 1100, '2008-12-27 06:08:08', '0', '0', '0'),
(116, '17, 29', '5, 3', 117, 0, 170, '2008-12-27 20:30:43', '0', '0', '0'),
(117, '40, 41, 83, 50', '1, 6, 1, 2', 118, 0, 683, '2008-12-27 21:50:39', '0', '0', '0'),
(118, '83', '2', 119, 16, 998, '2008-12-27 21:56:29', '0', '0', '0'),
(119, '87', '1', 120, 17, 9999, '2008-12-27 22:49:38', '0', '0', '0'),
(120, '81, 83', '1, 1', 121, 0, 698, '2008-12-28 03:02:26', '0', '0', '0'),
(121, '50', '1', 122, 0, 0, '2008-12-28 03:03:22', '0', '0', '0'),
(122, '17, 29, 50, 83', '1, 1, 3, 2', 123, 0, 1095, '2008-12-28 18:02:44', '0', '0', '0'),
(123, '69', '1', 124, 0, 35, '2008-12-28 18:49:48', '0', '0', '0'),
(124, '91, 93, 95', '1, 1, 1', 125, 0, 323, '2008-12-28 18:52:30', '0', '0', '0'),
(125, '88', '1', 126, 0, 10, '2008-12-29 00:09:44', '0', '0', '0'),
(126, '69', '1', 127, 0, 84, '2008-12-29 00:35:22', '0', '0', '0'),
(127, '81', '1', 128, 0, 248, '2008-12-29 11:29:22', '0', '0', '0'),
(128, '81', '1', 129, 0, 248, '2008-12-29 11:31:20', '0', '0', '0'),
(129, '81', '1', 130, 0, 248, '2008-12-29 11:31:37', '0', '0', '0'),
(130, '88', '1', 131, 0, 59, '2008-12-29 11:32:50', '0', '0', '0'),
(131, '69', '1', 132, 0, 94, '2008-12-29 11:48:18', '0', '0', '0'),
(132, '88', '1', 133, 0, 59, '2008-12-29 14:54:20', '0', '0', '0'),
(133, '40', '1', 134, 0, 77, '2008-12-29 15:01:09', '0', '0', '0'),
(134, '69', '1', 135, 0, 84, '2008-12-29 15:06:54', '0', '0', '0'),
(135, '69', '1', 136, 0, 84, '2008-12-29 15:11:24', '0', '0', '0'),
(136, '41, 50, 69, 81', '1, 1, 1, 1', 137, 0, 319, '2008-12-29 17:00:56', '0', '0', '0'),
(137, '40', '2', 138, 0, 115, '2008-12-29 17:05:37', '0', '0', '0'),
(138, '88', '3', 139, 0, 89, '2008-12-29 17:08:14', '0', '0', '0'),
(139, '91, 93, 95', '2, 3, 4', 140, 0, 1014, '2008-12-29 21:03:52', '0', '0', '0'),
(140, '81', '1', 141, 0, 237, '2009-01-06 16:29:55', '0', '0', '0'),
(141, '81', '1', 142, 0, 237, '2009-01-06 16:30:16', '0', '0', '0'),
(142, '81', '1', 143, 0, 224, '2009-01-06 16:32:33', '0', '0', '0'),
(143, '81', '1', 144, 0, 224, '2009-01-06 16:33:22', '0', '0', '0'),
(144, '81', '1', 145, 0, 237, '2009-01-06 16:35:29', '0', '0', '0'),
(145, '91', '1', 146, 0, 108, '2009-01-06 16:44:59', '0', '0', '0'),
(146, '83', '1', 147, 0, 566, '2009-01-07 13:12:00', '0', '0', '0'),
(147, '69, 88', '1, 3', 148, 0, 104, '2009-01-20 15:40:34', '0', '0', '0'),
(148, '88', '1', 149, 0, 35, '2009-01-21 15:45:30', '0', '0', '0'),
(149, '69', '2', 150, 0, 105, '2009-01-21 16:09:42', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(50) NOT NULL,
  `visible` enum('y','n') NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(6) NOT NULL,
  `price` int(6) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=97 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `type`, `visible`, `title`, `description`, `quantity`, `price`, `image`) VALUES
(17, 'zoanthids', 'y', 'Eagle Eyes', 'Lorem Ipsum is simply dummy text of typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 10, 30, '17.jpg'),
(29, 'ricordea', 'y', 'Baby Blue Florida Ricordea colony', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable.', 5, 0, '29.jpg'),
(40, 'ricordea', 'y', 'Single Polyps Orange Ricordea', 'Description text here Description text here Description text here Description text here Description text here Description text here Description text here ', 0, 28, '40.jpg'),
(41, 'ricordea', 'y', 'Single Polyps Deep Blue Ricordea', 'Description text here Description text here Description text here Description text here Description text here Description text here Description text here ', 0, 26, '41.jpg'),
(50, 'ricordea', 'y', 'Red Florida Ricordea', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 3, 0, '50.jpg'),
(69, 'zoanthids', 'y', 'Yellow Solomon Island zoos', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English.', 1, 35, '69.jpg'),
(81, 'zoanthids', 'y', 'Super Coralicious', 'Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC.', 10, 199, '81.jpg'),
(83, 'ricordea', 'y', 'Coralacula', 'embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator', 3, 499, '83.jpg'),
(88, 'zoanthids', 'y', 'Coral Castle', 'stone structure created by the Latvian-American eccentric Edward Leedskalnin north of the city of Homestead', 10, 10, '88.jpg'),
(89, 'Totally', 'y', 'Tubular', 'if i did everything correctamundoicious', 2, 99, '89.jpg'),
(91, 'Spooky', 'y', 'Coralactus', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 6, 59, '91.jpg'),
(92, 'Test', 'y', 'Product', 'testing testing testing testing testing testing ', 10, 77, '92.jpg'),
(93, 'Spooky', 'y', 'Nasty Buttons', 'I''m telling ya... this shit is nasty yo! ', 6, 199, '93.jpg'),
(94, 'Test', 'y', 'Farfromdrunken', 'This shit''ll fuck you up homes.', 10, 1, '94.jpg'),
(95, 'Spooky', 'y', 'Tortle', 'Super Cool', 5, 55, '95.jpg'),
(96, 'Test', 'y', 'Test product', 'Totally testing this thang', 6, 45, '96.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_info`
--

CREATE TABLE `shipping_info` (
  `id` int(11) NOT NULL auto_increment,
  `customer_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `email` varchar(50) NOT NULL,
  `s_phone` int(20) NOT NULL default '0',
  `street` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=151 ;

--
-- Dumping data for table `shipping_info`
--

INSERT INTO `shipping_info` (`id`, `customer_name`, `user_id`, `email`, `s_phone`, `street`, `city`, `state`, `zip`) VALUES
(91, 'Test 1', 0, 'test@tester.com', 0, '123 main st', 'baca ratan', 'FL', 33333),
(92, 'TEst 2', 11, 'me@mail.com', 0, '123 fuck me', 'ny city', 'NY', 43434),
(93, 'dude man bro', 0, 'mail@mail.cm', 0, '123 hells yea', 'baca ratan', 'FL', 33333),
(94, 'ACHEW', 0, 'achew@achh.com', 0, '123 main st', 'Deerfield Beach', 'FL', 33333),
(95, 'Diddy Kong', 0, 'diddy@kong.com', 0, '123 hells yea', 'assmunch', 'DE', 44322),
(96, 'Due McGee', 12, 'Dude@email.com', 0, '123 old st', 'Mexico', 'FL', 33455),
(97, 'Due McGee', 13, 'Dude@email.com', 0, '123 old st', 'Mexico', 'FL', 33455),
(98, 'blasph', 0, 'am@ee.com', 0, '123 main', 'baca ratan', 'GA', 33444),
(99, 'yo bitch', 14, 'mail@mail.com', 0, '123 hells yea', 'tokyo', 'RI', 12345),
(100, 'tron', 0, 'ast@risk.com', 0, '23 high lander', 'wwanado', 'DC', 46598),
(117, 'test 3', 0, 'test3@tester.com', 555, '123 hells yea', 'Cornholio', 'FL', 34455),
(118, 'test', 0, 'test@tester.com', 432, 'main 123', 'Boca Raton', 'GA', 33344),
(119, 'Test 4', 16, 'test4@tester.com', 555, '123 main st Apt 5', 'wisecrackin hamster', 'CA', 95813),
(120, 'Test 5', 17, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(121, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(122, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(123, 'dude', 0, 'Dude@email.com', 555, 'wow lane', 'rockafella', 'FL', 45323),
(124, 'testing 1', 0, 'testaccount@test.com', 123, '5443 qwerty st', 'uioop', 'HI', 55443),
(125, 'yoyo', 0, '44@mail.com', 432, '123 main st', 'baca ratan', 'RI', 45678),
(126, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(127, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(128, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(129, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(130, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(131, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(132, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(133, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(134, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(135, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(136, 'Test 5', 0, 'test5@tester.com', 555, '432 wasted rd', 'chimichangaville', 'RI', 45566),
(137, 'Whoaly shit', 0, 'hot@damn.com', 555, 'Woosah lane', 'Wackattack', 'CA', 98373),
(138, 'Hot Damn', 0, 'mo@fo.com', 555, '123 califragilistic way', 'doobie do waa', 'CT', 65434),
(139, 'Hot Damn', 0, 'mo@fo.com', 555, '123 califragilistic way', 'doobie do waa', 'CT', 65434),
(140, 'Hammy Jo', 0, 'ham@sandwich.com', 454, '34 lobster ln', 'rome', 'TN', 23452),
(141, 'Test User', 0, 'master_1231275984_per@gmail.com', 0, '1 Main St', 'San Jose', 'CA', 95131),
(142, 'Test User', 0, 'master_1231275984_per@gmail.com', 0, '1 Main St', 'San Jose', 'CA', 95131),
(143, 'Test User', 0, 'master_1231275984_per@gmail.com', 0, '1 Main St', 'San Jose', 'CA', 95131),
(144, 'Test User', 0, 'master_1231275984_per@gmail.com', 0, '1 Main St', 'San Jose', 'CA', 95131),
(145, 'Test User', 0, 'master_1231275984_per@gmail.com', 0, '1 Main St', 'San Jose', 'CA', 95131),
(146, 'Test User', 0, 'master_1231275984_per@gmail.com', 0, '1 Main St', 'San Jose', 'CA', 95131),
(147, 'Test User', 0, 'master_1231275984_per@gmail.com', 0, '1 Main St', 'San Jose', 'CA', 95131),
(148, 'Test User', 0, 'master_1231275984_per@gmail.com', 0, '1 Main St', 'San Jose', 'CA', 95131),
(149, 'Test User', 0, 'master_1231275984_per@gmail.com', 0, '1 Main St', 'San Jose', 'CA', 95131),
(150, 'Test User', 0, 'master_1231275984_per@gmail.com', 0, '1 Main St', 'San Jose', 'CA', 95131);

-- --------------------------------------------------------

--
-- Table structure for table `site_links`
--

CREATE TABLE `site_links` (
  `id` int(6) NOT NULL auto_increment,
  `link` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `visible` enum('y','n') NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=5 ;

--
-- Dumping data for table `site_links`
--

INSERT INTO `site_links` (`id`, `link`, `title`, `image`, `visible`) VALUES
(2, 'http://www.reefdoctormicromussas.com', 'Reef Doctor', 'reefdoctorbanner.gif', 'y'),
(3, 'http://www.stomatopod.com', 'Stomatopod', 'stomatopod_logo.jpg', 'y'),
(4, 'http://www.keepersofthereef.com', 'Keepers of the Reef', 'Keepers_of_the_Reef.jpg', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL auto_increment,
  `name` char(40) NOT NULL,
  `abbrev` char(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=66 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `abbrev`) VALUES
(1, 'Alaska', 'AK'),
(2, 'Alabama', 'AL'),
(3, 'American Samoa', 'AS'),
(4, 'Arizona', 'AZ'),
(5, 'Arkansas', 'AR'),
(6, 'California', 'CA'),
(7, 'Colorado', 'CO'),
(8, 'Connecticut', 'CT'),
(9, 'Delaware', 'DE'),
(10, 'District of Columbia', 'DC'),
(11, 'Federated States of Micronesia', 'FM'),
(12, 'Florida', 'FL'),
(13, 'Georgia', 'GA'),
(14, 'Guam', 'GU'),
(15, 'Hawaii', 'HI'),
(16, 'Idaho', 'ID'),
(17, 'Illinois', 'IL'),
(18, 'Indiana', 'IN'),
(19, 'Iowa', 'IA'),
(20, 'Kansas', 'KS'),
(21, 'Kentucky', 'KY'),
(22, 'Louisiana', 'LA'),
(23, 'Maine', 'ME'),
(24, 'Marshall Islands', 'MH'),
(25, 'Maryland', 'MD'),
(26, 'Massachusetts', 'MA'),
(27, 'Michigan', 'MI'),
(28, 'Minnesota', 'MN'),
(29, 'Mississippi', 'MS'),
(30, 'Missouri', 'MO'),
(31, 'Montana', 'MT'),
(32, 'Nebraska', 'NE'),
(33, 'Nevada', 'NV'),
(34, 'New Hampshire', 'NH'),
(35, 'New Jersey', 'NJ'),
(36, 'New Mexico', 'NM'),
(37, 'New York', 'NY'),
(38, 'North Carolina', 'NC'),
(39, 'North Dakota', 'ND'),
(40, 'Northern Mariana Islands', 'MP'),
(41, 'Ohio', 'OH'),
(42, 'Oklahoma', 'OK'),
(43, 'Oregon', 'OR'),
(44, 'Palau', 'PW'),
(45, 'Pennsylvania', 'PA'),
(46, 'Puerto Rico', 'PR'),
(47, 'Rhode Island', 'RI'),
(48, 'South Carolina', 'SC'),
(49, 'South Dakota', 'SD'),
(50, 'Tennessee', 'TN'),
(51, 'Texas', 'TX'),
(52, 'Utah', 'UT'),
(53, 'Vermont', 'VT'),
(54, 'Virgin Islands', 'VI'),
(55, 'Virginia', 'VA'),
(56, 'Washington', 'WA'),
(57, 'West Virginia', 'WV'),
(58, 'Wisconsin', 'WI'),
(59, 'Wyoming', 'WY'),
(60, 'Armed Forces Africa', 'AE'),
(61, 'Armed Forces Americas (except Canada)', 'AA'),
(62, 'Armed Forces Canada', 'AE'),
(63, 'Armed Forces Europe', 'AE'),
(64, 'Armed Forces Middle East', 'AE'),
(65, 'Armed Forces Pacific', 'AP');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_joined` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `unsubscribe` enum('y','n') NOT NULL default 'n',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=30 ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `name`, `email`, `date_joined`, `unsubscribe`) VALUES
(10, 'yodawg', 'yea@man.com', '2008-12-02 10:59:59', 'n'),
(11, 'Test 1', 'test@tester.com', '2008-12-25 15:34:54', 'n'),
(12, 'TEst 2', 'me@mail.com', '2008-12-25 20:35:28', 'n'),
(13, 'ACHEW', 'achew@achh.com', '2008-12-25 21:03:44', 'n'),
(14, 'Diddy Kong', 'diddy@kong.com', '2008-12-26 11:36:07', 'n'),
(15, 'Due McGee', 'Dude@email.com', '2008-12-26 18:54:14', 'n'),
(16, 'Due McGee', 'Dude@email.com', '2008-12-26 18:56:46', 'n'),
(17, 'blasph', 'am@ee.com', '2008-12-26 19:11:11', 'n'),
(18, 'yo bitch', 'mail@mail.com', '2008-12-26 19:13:38', 'n'),
(19, 'tron', 'ast@risk.com', '2008-12-27 06:05:13', 'n'),
(20, 'test', 'test@tester.com', '2008-12-27 06:08:07', 'n'),
(21, 'Test 5', 'test5@tester.com', '2008-12-27 22:49:37', 'n'),
(22, 'dude', 'Dude@email.com', '2008-12-28 18:02:44', 'n'),
(23, 'testing 1', 'testaccount@test.com', '2008-12-28 18:49:48', 'n'),
(24, 'yoyo', '44@mail.com', '2008-12-28 18:52:30', 'n'),
(25, 'Whoaly shit', 'hot@damn.com', '2008-12-29 17:00:55', 'n'),
(26, 'Hot Damn', 'mo@fo.com', '2008-12-29 17:05:36', 'n'),
(27, 'Hammy Jo', 'ham@sandwich.com', '2008-12-29 21:03:52', 'n'),
(28, 'Test User', 'master_1231275984_per@gmail.com', '2009-01-06 16:29:54', 'n'),
(29, 'Test User', 'master_1231275984_per@gmail.com', '2009-01-06 16:30:16', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `role` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(14) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pwd`, `role`, `email`, `phone`) VALUES
(1, 'donavonsreef.com', '4aa2472ea92c4efbb0d5b16f856ef2ac512acb44', 'owner', 'me@donavonsreef.com', '(555) 555-5555'),
(11, 'TEst 2', '2ed1cecb36161ab7d99697aa52db95f3a83578f0', 'Customer', 'me@mail.com', '555-555-5555'),
(12, 'Due McGee', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Customer', 'Dude@email.com', '555-555-5555'),
(13, 'Due McGee', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Customer', 'Dude@email.com', '555-555-5555'),
(14, 'yo bitch', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Customer', 'mail@mail.com', '123-123-1233'),
(15, 'test', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Customer', 'test@tester.com', '432-234-5665'),
(16, 'Test 4', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Customer', 'test4@tester.com', '555-444-3322'),
(17, 'Test 5', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Customer', 'test5@tester.com', '555-444-3322');

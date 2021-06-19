-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2021 at 06:29 PM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kohulo_search_engine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE IF NOT EXISTS `admin_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'd033e22ae348aeb5660fc2140aec35850c4da997', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

-- --------------------------------------------------------

--
-- Table structure for table `search_bar_placeholder`
--

DROP TABLE IF EXISTS `search_bar_placeholder`;
CREATE TABLE IF NOT EXISTS `search_bar_placeholder` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `search_bar_placeholder`
--

INSERT INTO `search_bar_placeholder` (`id`, `value`) VALUES
(1, 'Search the internet to plant trees and save water...');

-- --------------------------------------------------------

--
-- Table structure for table `site_meta_info`
--

DROP TABLE IF EXISTS `site_meta_info`;
CREATE TABLE IF NOT EXISTS `site_meta_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `site_keywords` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_meta_info`
--

INSERT INTO `site_meta_info` (`id`, `site_title`, `site_description`, `site_keywords`) VALUES
(1, 'Kohulo - The Search Engine That Plants Trees And Saves Water | Made In India', 'The Kohulo search engine spends about 70% of its income on planting trees wherever we need them on this earth. Not only this, this search engine also spends to prevent wastage of drinking water and supply water to the places where drinking water is needed. So on the other hand, using the Kohulo search engine, you are also helping us to redesign this world.', 'kohulo, green, search, engine, planting trees, save water, save earth, search engine, eco-friendly search engine, privacy search engine');

-- --------------------------------------------------------

--
-- Table structure for table `site_pages`
--

DROP TABLE IF EXISTS `site_pages`;
CREATE TABLE IF NOT EXISTS `site_pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `page_contents` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_pages`
--

INSERT INTO `site_pages` (`id`, `page_name`, `page_contents`) VALUES
(1, 'about', '<div class=\"about_page\"><div class=\"about_page_box\"><div class=\"about_page_box_title\"><h1 align=\"center\"><br></h1><div><div class=\"container\" style=\"width: 1320px; padding-right: var(--bs-gutter-x,0.75rem); padding-left: var(--bs-gutter-x,0.75rem); color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;;\"><div class=\"about_page\"><div class=\"about_page_box\"><div class=\"about_page_box_title\"><h1 align=\"center\">About Us</h1><div><u><br></u></div></div><h3 align=\"center\"><u>What is Kohulo?</u></h3><div align=\"center\">Kohulo is a search engine based in India. You can search using Kohulo without any fear.</div><div align=\"center\"><br></div><h2 align=\"center\"><u>Our Mission</u></h2><div align=\"center\">Our mission is to plant trees on this earth to rebuild the earth beautiful again. The Kohulo search engine spends about 70% of its income on planting trees wherever we need them on this earth.&nbsp;Not only this, this search engine also spends to prevent wastage of drinking water and supply water to the places where drinking water is needed. So on the other hand, using the Kohulo search engine, you are also helping us to redesign this world.<br></div><div align=\"center\"><u><br></u></div><h2 align=\"center\"><u>Safe and Secure Browsing</u></h2><div align=\"center\">Browse without the fear of your privacy. There is not any road between your searching and server. So search Unlimited safely and securely.</div><div><br></div></div></div></div></div></div></div></div>'),
(2, 'privacy', '<div><div class=\"preview\">\r\n<h1 align=\"center\"><br></h1><h1 align=\"center\"><u>Privacy Policy for Kohulo Search Engine<br></u></h1><div><br></div>\r\n<div>At Kohulo, accessible from https://kohulo.com, one of our main \r\npriorities is the privacy of our visitors. This Privacy Policy document \r\ncontains types of information that is collected and recorded by Kohulo \r\nand how we use it.</div>\r\n<div>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</div>\r\n<div>This Privacy Policy applies only to our online activities and is \r\nvalid for visitors to our website with regards to the information that \r\nthey shared and/or collect in Kohulo. This policy is not applicable to \r\nany information collected offline or via channels other than this \r\nwebsite. Our Privacy Policy was created with the help of the <a href=\"https://www.privacypolicyonline.com/privacy-policy-generator/\">Online Generator of Privacy Policy</a>.</div>\r\n<h2><br></h2><h2>Consent</h2>\r\n<div>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</div><div><br></div>\r\n<h2>Information we collect</h2>\r\n<div>The personal information that you are asked to provide, and the \r\nreasons why you are asked to provide it, will be made clear to you at \r\nthe point we ask you to provide your personal information.</div>\r\n<div>If you contact us directly, we may receive additional information \r\nabout you such as your name, email address, phone number, the contents \r\nof the message and/or attachments you may send us, and any other \r\ninformation you may choose to provide.</div>\r\n<div>When you register for an Account, we may ask for your contact \r\ninformation, including items such as name, company name, address, email \r\naddress, and telephone number.</div>\r\n<h2><br></h2><h2>How we use your information</h2>\r\n<div>We use the information we collect in various ways, including to:</div>\r\n<ul><li>Provide, operate, and maintain our website</li><li>Improve, personalize, and expand our website</li><li>Understand and analyze how you use our website</li><li>Develop new products, services, features, and functionality</li><li>Communicate with you, either directly or through one of our \r\npartners, including for customer service, to provide you with updates \r\nand other information relating to the website, and for marketing and \r\npromotional purposes</li><li>Send you emails</li><li>Find and prevent fraud</li></ul>\r\n<h2>Log Files</h2>\r\n<div>Kohulo follows a standard procedure of using log files. These files \r\nlog visitors when they visit websites. All hosting companies do this and\r\n a part of hosting services\' analytics. The information collected by log\r\n files include internet protocol (IP) addresses, browser type, Internet \r\nService Provider (ISP), date and time stamp, referring/exit pages, and \r\npossibly the number of clicks. These are not linked to any information \r\nthat is personally identifiable. The purpose of the information is for \r\nanalyzing trends, administering the site, tracking users\' movement on \r\nthe website, and gathering demographic information.</div>\r\n<h2><br></h2><h2>Cookies and Web Beacons</h2>\r\n<div>Like any other website, Kohulo uses \'cookies\'. These cookies are used\r\n to store information including visitors\' preferences, and the pages on \r\nthe website that the visitor accessed or visited. The information is \r\nused to optimize the users\' experience by customizing our web page \r\ncontent based on visitors\' browser type and/or other information.</div>\r\n<div>For more general information on cookies, please read <a href=\"https://www.privacypolicyonline.com/what-are-cookies/\">\"What Are Cookies\" from Cookie Consent</a>.</div>\r\n<h2><br></h2><h2>Google DoubleClick DART Cookie</h2>\r\n<div>Google is one of a third-party vendor on our site. It also uses \r\ncookies, known as DART cookies, to serve ads to our site visitors based \r\nupon their visit to www.website.com and other sites on the internet. \r\nHowever, visitors may choose to decline the use of DART cookies by \r\nvisiting the Google ad and content network Privacy Policy at the \r\nfollowing URL – <a href=\"https://policies.google.com/technologies/ads\">https://policies.google.com/technologies/ads</a></div>\r\n<h2><br></h2><h2>Our Advertising Partners</h2>\r\n<div>Some of advertisers on our site may use cookies and web beacons. Our \r\nadvertising partners are listed below. Each of our advertising partners \r\nhas their own Privacy Policy for their policies on user data. For easier\r\n access, we hyperlinked to their Privacy Policies below.</div>\r\n<ul><li>\r\n<div>Google</div>\r\n<div><a href=\"https://policies.google.com/technologies/ads\">https://policies.google.com/technologies/ads</a></div>\r\n</li></ul>\r\n<h2>Advertising Partners Privacy Policies</h2>\r\n<div>You may consult this list to find the Privacy Policy for each of the advertising partners of Kohulo.</div>\r\n<div>Third-party ad servers or ad networks uses technologies like cookies,\r\n JavaScript, or Web Beacons that are used in their respective \r\nadvertisements and links that appear on Kohulo, which are sent directly \r\nto users\' browser. They automatically receive your IP address when this \r\noccurs. These technologies are used to measure the effectiveness of \r\ntheir advertising campaigns and/or to personalize the advertising \r\ncontent that you see on websites that you visit.</div>\r\n<div>Note that Kohulo has no access to or control over these cookies that are used by third-party advertisers.</div>\r\n<h2><br></h2><h2>Third Party Privacy Policies</h2>\r\n<div>Kohulo\'s Privacy Policy does not apply to other advertisers or \r\nwebsites. Thus, we are advising you to consult the respective Privacy \r\nPolicies of these third-party ad servers for more detailed information. \r\nIt may include their practices and instructions about how to opt-out of \r\ncertain options. </div>\r\n<div>You can choose to disable cookies through your individual browser \r\noptions. To know more detailed information about cookie management with \r\nspecific web browsers, it can be found at the browsers\' respective \r\nwebsites.</div>\r\n<h2><br></h2><h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>\r\n<div>Under the CCPA, among other rights, California consumers have the right to:</div>\r\n<div>Request that a business that collects a consumer\'s personal data \r\ndisclose the categories and specific pieces of personal data that a \r\nbusiness has collected about consumers.</div>\r\n<div>Request that a business delete any personal data about the consumer that a business has collected.</div>\r\n<div>Request that a business that sells a consumer\'s personal data, not sell the consumer\'s personal data.</div>\r\n<div>If you make a request, we have one month to respond to you. If you \r\nwould like to exercise any of these rights, please contact us.</div>\r\n<h2><br></h2><h2>GDPR Data Protection Rights</h2>\r\n<div>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</div>\r\n<div>The right to access – You have the right to request copies of your \r\npersonal data. We may charge you a small fee for this service.</div>\r\n<div>The right to rectification – You have the right to request that we \r\ncorrect any information you believe is inaccurate. You also have the \r\nright to request that we complete the information you believe is \r\nincomplete.</div>\r\n<div>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</div>\r\n<div>The right to restrict processing – You have the right to request that\r\n we restrict the processing of your personal data, under certain \r\nconditions.</div>\r\n<div>The right to object to processing – You have the right to object to \r\nour processing of your personal data, under certain conditions.</div>\r\n<div>The right to data portability – You have the right to request that we\r\n transfer the data that we have collected to another organization, or \r\ndirectly to you, under certain conditions.</div>\r\n<div>If you make a request, we have one month to respond to you. If you \r\nwould like to exercise any of these rights, please contact us.</div>\r\n<h2><br></h2><h2>Children\'s Information</h2>\r\n<div>Another part of our priority is adding protection for children while \r\nusing the internet. We encourage parents and guardians to observe, \r\nparticipate in, and/or monitor and guide their online activity.</div>\r\n<div>Kohulo does not knowingly collect any Personal Identifiable \r\nInformation from children under the age of 13. If you think that your \r\nchild provided this kind of information on our website, we strongly \r\nencourage you to contact us immediately and we will do our best efforts \r\nto promptly remove such information from our records.</div> </div></div>'),
(3, 'contact', '<div class=\"about_page_box_title\"><h2 align=\"center\"><br></h2><div><div class=\"container\" style=\"width: 1320px; padding-right: var(--bs-gutter-x,0.75rem); padding-left: var(--bs-gutter-x,0.75rem); color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;;\"><div class=\"about_page_box_title\"><h2 align=\"center\"><br></h2><h2 align=\"center\">Contact Us</h2></div><div align=\"center\"><span style=\"font-size: 18px;\">If you have any questions about Kohulo search engine, You can contact us:<br></span></div><div align=\"center\"><span style=\"font-size: 18px;\"><a href=\"mailto:nura57764@gmail.com\" target=\"_blank\">nura57764@gmail.com</a></span></div><div align=\"center\"><span style=\"font-size: 18px;\"><br></span></div></div></div></div><div align=\"center\"><span style=\"font-size:16px;\"></span></div>');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

DROP TABLE IF EXISTS `social_links`;
CREATE TABLE IF NOT EXISTS `social_links` (
  `id` int NOT NULL AUTO_INCREMENT,
  `github` text COLLATE utf8mb4_general_ci NOT NULL,
  `facebook` text COLLATE utf8mb4_general_ci NOT NULL,
  `youtube` text COLLATE utf8mb4_general_ci NOT NULL,
  `instagram` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `github`, `facebook`, `youtube`, `instagram`) VALUES
(1, 'HiddenPirates', 'TeamHiddenPirates', 'WeAreServantsOfAllah', '__nur_alam__');

-- --------------------------------------------------------

--
-- Table structure for table `visitors_counter`
--

DROP TABLE IF EXISTS `visitors_counter`;
CREATE TABLE IF NOT EXISTS `visitors_counter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `time_and_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_visitors` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors_counter`
--

INSERT INTO `visitors_counter` (`id`, `time_and_date`, `total_visitors`) VALUES
(1, '2021-05-10 12:40:19', 2),
(2, '2021-05-17 00:34:37', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

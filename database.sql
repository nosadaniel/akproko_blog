-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2018 at 01:07 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akprokoblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(100) NOT NULL,
  `user_name_comment` varchar(200) NOT NULL,
  `comment_content` tinytext NOT NULL,
  `comment_time` varchar(200) NOT NULL,
  `post_id` int(100) NOT NULL,
  `parent_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_name_comment`, `comment_content`, `comment_time`, `post_id`, `parent_id`) VALUES
(3, 'Tega', 'Ok', '2018-01-11 12:01:46', 13, 0),
(4, 'Moses', 'Akproko blog....make who na try drop her fone number na..', '2018-01-11 12:04:38', 12, 0),
(5, 'Nosa', 'Ok o', '2018-01-14 19:39:03', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(100) NOT NULL,
  `news` enum('Events','Lifestyle','Politics','Inspiration','Crime Alert','Gossip','Football','Basketball','Tennis','Wrestle','Gaming','Golf','Athletic') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news`) VALUES
(1, 'Events'),
(2, 'Lifestyle'),
(3, 'Politics'),
(4, 'Inspiration'),
(5, 'Crime Alert'),
(6, 'Gossip'),
(7, 'Football'),
(8, 'Basketball'),
(9, 'Tennis'),
(10, 'Gaming'),
(11, 'Golf'),
(12, 'Athletic');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(100) NOT NULL,
  `post_author` varchar(200) NOT NULL,
  `post_title` tinytext NOT NULL,
  `post_content` mediumtext NOT NULL,
  `post_heading` varchar(200) NOT NULL,
  `post_image` varchar(100) NOT NULL,
  `post_news` varchar(200) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(100) NOT NULL,
  `total_comment` int(100) NOT NULL,
  `visitor` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_author`, `post_title`, `post_content`, `post_heading`, `post_image`, `post_news`, `post_date`, `user_id`, `total_comment`, `visitor`) VALUES
(10, 'Super admin', 'New photos of rapper Bobby Shmurda in prison surfaces', '<p style=\"text-align:justify\"><span style=\"font-size:16px\"><span style=\"font-family:Times New Roman,Times,serif\">New photos of the Brooklyn rapper, Bobby Shmurda in jail has surfaced online after someone took some images of the New York&#39;s GS9 member.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\"><span style=\"font-family:Times New Roman,Times,serif\">In the photos, the rapper appears to be holding up well and strong in prison as he poses for the camera.</span></span></p>\r\n\r\n<blockquote>\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\"><span style=\"font-family:Times New Roman,Times,serif\">Last year, Shmurda was sentenced to one-to-three years for conspiracy in the fourth degree and seven more years for criminal possession of a weapon. About six months ago, Shmurda was sentenced to four additional years for attempting to promote prison contraband.</span></span></p>\r\n</blockquote>\r\n', 'Crime Alert', 'bobby.png', '5', '2017-12-29 10:10:57', 4, 0, 0),
(11, 'Super admin', 'More shocking details about the tragic marriage of Bilyaminu Bello to Maryam Sanda, claims the first wife was forced on Bilyaminu and that Maryam was the main chic', '<p style=\"text-align:justify\"><span style=\"font-size:16px\"><span style=\"font-family:Times New Roman,Times,serif\">The information was dropped in our comment section. Read below</span></span></p>\r\n\r\n<blockquote>\r\n<p style=\"text-align:justify\"><em><span style=\"font-size:16px\"><span style=\"font-family:Times New Roman,Times,serif\">Let me give you the real story!! Number1: Her killing him can never be justified and she should face the legal system. Now the real story.. Maryam and Bills started dating since university days! Then his family pushed him and forced him into marrying Fakriya while he was dating Maryam. Bilya married Fakriya, but the marriage didn&#39;t last up to 2 weeks and he divorced her. Bilya and maryam then got married. Before the wedding her family and close relatives didn&#39;t want her to marry Bilya as they believed he just liked her for her mother&#39;s position. Bilya is not the son of the former Pdp chairman but rather his nephew. Bill&#39;s father is an ordinary civilian with no political background. The wedding was very small as Maryam&#39;s mother refused to spend so much money on the wedding and was upset Bilya didn&#39;t want to spend a dime and just expected her family to do everything. Maryam&#39;s mum got them an apartment in Maitama and fully furnished it! She even bought Maryam a brand new Mercedes-Benz. Plus Maryam already had a farm business that was doing well. Fast forward to the marriage.. Maryam started to realise Bilya had lied to her so much about his family, job and source of income. And he was dating so many women outside promising them he would marry them. Bilya turned Maryam&#39;s car to his main car and also started using all Maryam&#39;s money telling her he is starting a business. This got so bad that the money started to seize things from Maryam. maryam will cry and pack her things and move to her family but they will send her back saying when they warned her to marry him she refused. She had begged for divorce over and over but Bilya never agreed saying that he doesn&#39;t want the world to think he can&#39;t hold a marriage and that they will work it out. But Bilya never stopped sleeping around and using her like a fool. She was frustrated, depressed and suicidal. On the night the fight broke out - Maryam and Bilya fought in the living room and she left him in there bleeding and went to the kitchen She later asked her maid has Bilya not gone to the hospital and the maid should go and check on him The maid came in shouting that he is in a pool of blood and that is when he was rushed to the hospital and died. It is clear her intention was to inflict pain on him not kill him but sadly he bleed too much and died. There is no excuse for killing another person so she should face the law for that! But we need to be careful how we are too quick to judge a situation. The same maryam we are insulting in custody in shock of what she did and might at this point be suicidal. Bilya has since been buried. Sadly their marriage failed due to: Greed, what will people say, built up frustration and pain</span></span></em></p>\r\n</blockquote>\r\n', 'Crime Alert', 'bello_murdered.png', '5', '2017-12-29 10:20:10', 4, 0, 0),
(12, 'Monique', 'Singer, Waje&#39;s daughter is so beautiful! (photo)', '<p style=\"text-align:justify\"><span style=\"font-size:18px\">The proud single mum shared this photo of her daughter, Emerald with the hashtag,&nbsp;<img alt=\"yes\" src=\"http://localhost/akproko/assets/ckeditor/plugins/smiley/images/thumbs_up.png\" style=\"height:23px; width:23px\" title=\"yes\" /><a href=\"https://www.instagram.com/explore/tags/whengodblessesyou/\">#whenGodblessesyou</a>&nbsp;?&#39;. She is so&nbsp;beautiful!&nbsp;</span></p>\r\n', 'Gossip', 'waje.png', '6', '2017-12-29 16:49:41', 6, 0, 0),
(13, 'Grace', 'Child sex trafficker bags 472 years in jail, the longest in U.S. history', '<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">A 31-year-old convicted child sex trafficker,&nbsp;<strong>Brock Franklin</strong>, has received the longest sentence for human trafficking in U.S. history. According to Fox News, Franklin was sentenced to 472 years in prison for running a prostitution ring in Colorado that preyed on young girls. .</span></span><br />\r\n&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Back in March, a jury found Franklin guilty on 30 counts including human trafficking, sexual exploitation of a child, child prostitution, and kidnapping.</span></span><br />\r\n&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">&ldquo;A 400 year sentence sends a strong message across the country that we&rsquo;re not going to tolerate this kind of violence to women and vulnerable populations,&rdquo; Janet Drake with the Colorado Attorney General&rsquo;s office told Fox 31.<br />\r\n<br />\r\nProsecutors said Franklin used drugs and violence to control young girls, forcing them to have sex with him and selling the girls for sex online.<br />\r\n<br />\r\n&ldquo;I can&rsquo;t begin to even explain what he did to my life,&rdquo; Brehannah Leary, one of Franklin&rsquo;s victims, told the court.<br />\r\n<br />\r\nBelow is a list of the gcharges that he pled guilty to........</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">-Violating the Colorado Organized Crime Control Act<br />\r\n-Human trafficking of a minor<br />\r\n-Pimping a child<br />\r\n-Patronizing a prostituted child<br />\r\n-Soliciting for child prostitution<br />\r\n-Inducement of child prostitution<br />\r\n-Pandering of a child<br />\r\n-Procurement of a child<br />\r\n-Sexual exploitation of a child &mdash; producing a performance<br />\r\n-Contributing to the delinquency of a minor<br />\r\n-Human trafficking of a minor<br />\r\n-Second-degree kidnapping<br />\r\n-Pimping a child<br />\r\n-Patronizing a prostituted child<br />\r\n-Soliciting for child prostitution<br />\r\n-Inducement of child prostitution<br />\r\n-Pandering of a child<br />\r\n-Procurement of a child<br />\r\n-Contributing to the delinquency of a minor &mdash; prostitution<br />\r\n-Contributing to the delinquency of a minor &mdash; unlawful use of controlled substance<br />\r\n-Distribution of a Schedule 1 or 2 controlled substance to a minor<br />\r\n-Soliciting for child prostitution<br />\r\n-Human trafficking of an adult<br />\r\n-Five counts of pimping<br />\r\n-Sexual assault<br />\r\n-Attempt to commit pimping</span></span></p>\r\n', 'Crime Alert', '5a1719f7e57ab.png', '5', '2018-01-05 10:15:10', 4, 0, 0),
(14, 'Monique', '&#39;I was a groomsman at their wedding, father lord take control&#39; OAP N6 prays for Simi and Dr Sid following reports of their marital crisis', '<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Times New Roman,Times,serif\">OAP N6 has reached out in prayers to&nbsp;DrSid and Simi Esiri following reports of their marital crisis. Three days ago, LIB reported that the couple who got married three years ago have been having issues in their marriage and have even unfollowed each other on social media. Though they keep up appearances in public, sources within say, sadly, all is not well with them. N6 who was a groomsman at their wedding, has asked God to fix their marital crisis. His comment as shared on his Instastory below</span></span></p>\r\n', 'Gossip', 'dr_sid.jpg', '6', '2018-01-05 10:42:18', 6, 0, 0),
(15, 'Super admin', 'I Prefer Being a Boy to a President Than a Clown of a Senator-Reno to Bolaji Abdullahi', '<p dir=\"ltr\"><span style=\"font-size:18px\"><span style=\"font-family:Times New Roman,Times,serif\">As he shared on his page.</span></span></p>\r\n', 'Politics', '5a1794211ae28.jpg', '3', '2018-01-06 18:57:42', 4, 0, 0),
(16, 'Super admin', 'Here&#39;s what BankyW thinks about Ebuka Obi-Uchendu&#39;s outfit that Nigerians fell in love with', '<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">As we all know, Ebuka Obi-Uchebdu basically stole the show at BankyW and Adesua Etomi&#39;s traditional wedding ceremony on Sunday with his unique Agbada outfit and even the groom was also confused for a minute at who was actually getting married.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">According to BankyW who says he&#39;s also ready for Ebuka at the white wedding; &quot;I was genuinely momentarily confused as to which of us was the groom... Lol.. I was about to switch into groomsmen mode and offer my guy a drink or small chops..&quot;</span></span></p>\r\n', 'Events', '5a13d441326d9.jpg', '1', '2018-01-06 19:02:05', 4, 0, 0),
(17, 'Super admin', 'Cassper Nyovest shares pic of what he used to look like before he lost weight', '<p><span style=\"font-size:18px\"><span style=\"font-family:Times New Roman,Times,serif\">The musician has worked really hard to look fit.<img alt=\"yes\" src=\"http://localhost/akproko/assets/ckeditor/plugins/smiley/images/thumbs_up.png\" style=\"height:23px; width:23px\" title=\"yes\" /></span></span></p>\r\n', 'Gossip', 'cassper.jpg', '6', '2018-01-12 05:13:54', 4, 0, 0),
(18, 'Super admin', 'Nigerian Tailors strike swiftly as they re-create knockoff version of Ebuka-Obi-Uchendu&#39;s famous agbada', '<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Ebuka Obi-Uchendu basically broke the internet when he stepped out in his carefully crafted Agbada, made by fahsion designer Ugo Monye, for BankyW&#39;s&nbsp;lavish traditional wedding on Sunday. It&nbsp;reportedly costs 280,000 naira to purchase but some Nigerian men&nbsp;are making attempts to create cheaper versions.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">A&nbsp;tailor has now struck. Lol.. See more photos and the original look below.</span></span></p>\r\n', 'Gossip', '5a151723e4d51.png', '6', '2018-01-12 05:21:54', 4, 0, 0),
(21, 'Super admin', 'These photos of Adesua Etomi with her mother-in-law and sister-in-law is everything!', '<p><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">So much joy. What a lucky girl!&nbsp;</span></span></p>\r\n', 'Events', 'img_20171120_165426_560.jpg', '1', '2018-01-12 06:06:01', 4, 0, 0),
(22, 'Super admin', 'PDP has gone and will never return to power&#39; Lai Mohammed says', '<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Minister of Information, Culture and Tourism, Lai Muhammad, said the Peoples Democratic Party PDP&nbsp;has&nbsp;gone forever and will never return&nbsp;to power at the Federal&nbsp;and most of the state government. Mohammed said this&nbsp;while speaking to newsmen in Dutse, Jigawa state yesterday November 23rd.&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">&ldquo;The opposition People Democratic Party (PDP) has gone forever and will never come back to rule Nigeria talk less of 2019.&nbsp;Nigerians have been convinced with the tremendous achievements recorded in the period of two years of APC administration under president Muhammad Buhari. Believe&nbsp;me, nobody will give his vote to PDP again&rdquo; he said</span></span></p>\r\n', 'Politics', 'lai.png', '3', '2018-01-12 06:17:26', 4, 0, 0),
(23, 'Super admin', 'Photos: Army recovers more corpses, skulls from den of former militant leader, General Don Wanni', '<p dir=\"ltr\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">The 6 Division of the Nigerian Army, in Port Harcourt, have recovered more corpses and skulls from the den of a former militant leader, General Don Wanni, in Aligwu community, Omoku, in Ogba/Egbema/Ndoni Local Government Area (ONELGA) of Rivers State.</span></span></p>\r\n\r\n<p dir=\"ltr\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">The decomposed bodies and skulls were recovered, in the early hours of&nbsp;Wednesday, after the General Officer Commanding (GOC), Major-General Enobong Udoh, led men of the Division to comb the forest where the notorious kidnap kingpin used as shrine and graveyard.</span></span></p>\r\n\r\n<p dir=\"ltr\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">This is coming a day after a combined security operatives had exhumed several skulls, bones and other human body parts from the forest behind Wanni&#39;s camp.</span></span></p>\r\n\r\n<p dir=\"ltr\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Meanwhile, the Army has launched a manhunt of the former militant leader, who embraced the Rivers State Amnesty programme in October 2016.</span></span></p>\r\n\r\n<p dir=\"ltr\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">-Photo of the latest recovered skulls.</span></span></p>\r\n', 'Crime Alert', 'militant.jpg', '5', '2018-01-12 06:19:31', 4, 0, 0),
(24, 'Super admin', 'Sociologist asks why there&#39;s no widespread outrage following Adamawa terrorist attack', '<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">When terrorists strike in the West, everyone queues up for a show of solidarity, but there&#39;s been no such effort after a terrorist killed 50 people in one attack in Adamawa attack. An attack with such a high casualty rate is sure draw a strong sure of support had it happened in the West.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Sociologist, Dr Craig Considine wonders why Adamawa has been met with silence. He wrote:</span></span></p>\r\n', 'Events', '5a177464db52a.jpg', '1', '2018-01-12 06:21:31', 4, 0, 0),
(25, 'Super admin', 'Fathia Williams shares more fierce photos', '<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Popular Yoruba actress, Fathia Williams is rebranding and her new look really suits her.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">The actresswho recently changed her surname from Balogun (her ex-wife husband&#39;s&nbsp; name) to Williams isn&#39;t stopping just with the surname. She&#39;s changing everything, including her looks. She&#39;s been posting new photos of the new her with the hashtag #Rebirth #Renew.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">See more amazing photos below.</span></span></p>\r\n', 'Lifestyle', '5a174379b338b.png', '2', '2018-01-12 06:23:01', 4, 0, 0),
(26, 'Super admin', 'Nigerian, Zimbabwean, Malawi nationals owe South African hospitals millions', '<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">The Gauteng health department, South Africa said foreign nationals including Nigerians are owing hospitals around R160-million</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">The embattled department sent letters of demand to foreign embassies as it launched its debt recovery process against foreigners who failed to settle their bills.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">The department&#39;s spokesman, Lesemang Matuka (pictured)&nbsp;on Wednesday,&nbsp; said that embassies were sent letters indicating the amounts owed by their citizens.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">The department is in the grip of a financial crisis. It owes service providers at least R5-billion, accumulated over two years.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Zimbabwean nationals owe the largest amount, a R114-million unpaid health bill.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Malawi was second with a bill of almost R11.6-million.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Nigeria was third on the list, with a R7.9-million unpaid bill.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Matuka said the embassies were engaged to &quot;make financial contributions to the debts of their citizens&quot;.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">He said the department would only take legal action against individual debtors, not the embassies.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Gauteng attracts millions of migrants who use public health and education facilities, putting a strain on public coffers.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">According to the department, the most debts were accumulated at Charlotte Maxeke Johannesburg Academic Hospital in Parktown, followed by Dr George Mukhari in GaRankuwa and Steve Biko Academic Hospital in Pretoria.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Finance MEC Barbara Creecy, who allocated an additional R1.7-billion to the health department last week, said it was crucial that the department collected money from those who utilise public health facilities and can afford to pay.<br />\r\nThe health department&#39;s budget for the year stands at R40.2-billion.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">The department was also owed millions of rands by other provinces who refer patients - for treatment and surgeries - to Gauteng.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">Matuka said the three provinces that owed a total of R93-million were North West, Limpopo and Mpumalanga.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">He said North West and Mpumalanga have already begun to service their debts, having paid R1.7-million and R421000 respectively.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">DA spokesman Jack Bloom said he believed that the department&#39;s move against foreigners to recoup money was &quot;a futile exercise&quot;.</span></span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><span style=\"font-size:18px\">-Sowetan LIVE</span></span></p>\r\n', 'Politics', 'zx.png', '3', '2018-01-12 07:05:51', 4, 0, 0),
(31, 'Super admin', '0jiojoi', '<p>faaw</p>\r\n', 'Tennis', '20170622_172236.jpg', '9', '2018-01-15 12:01:57', 4, 0, 0),
(32, 'Super admin', 'afwa', '<p>awfaaw</p>\r\n', 'Crime Alert', '20170622_172233.jpg', '5', '2018-01-15 12:02:44', 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE `suggestions` (
  `sug_id` int(100) NOT NULL,
  `sug_name` varchar(100) NOT NULL,
  `sug_email` varchar(100) NOT NULL,
  `sug_body` text NOT NULL,
  `sug_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suggestions`
--

INSERT INTO `suggestions` (`sug_id`, `sug_name`, `sug_email`, `sug_body`, `sug_date`) VALUES
(3, 'Nosa daniel', 'nosa@gmail.com', 'Nice...got a job for u', '2018-01-15 01:50:15'),
(4, 'Daniel', 'daniel@ajw.com', 'Nice', '2018-01-15 02:18:25'),
(5, 'Tega', 'tega@gmail.com', 'Nice work...team akprokoblog', '2018-01-15 06:00:47'),
(6, 'Godwin', 'godwin@gmail.com', 'Nice job...', '2018-01-15 11:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `total_all`
--

CREATE TABLE `total_all` (
  `total_id` int(100) NOT NULL,
  `total_comment` int(100) NOT NULL,
  `total_post` int(100) NOT NULL,
  `total_user` int(100) NOT NULL,
  `total_visitor` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `total_all`
--

INSERT INTO `total_all` (`total_id`, `total_comment`, `total_post`, `total_user`, `total_visitor`) VALUES
(1, 3, 17, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_dob` date NOT NULL,
  `user_gender` enum('Male','Female') NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_dob`, `user_gender`, `time_created`) VALUES
(1, 'meshach', 'meshach@gmail.com', 'meafawaw', '1994-06-02', 'Male', '2017-12-26 20:01:56'),
(4, 'super admin', 'nosadaniel02@gmail.com', 'c08cd47ae53c434536b3fe7bf96f0510', '1999-02-02', 'Male', '2017-12-26 20:03:04'),
(6, 'monique', 'monique@gmail.com', '6c4f158d214fab78e77b36922dad2ba3', '2000-12-15', 'Female', '2017-12-26 20:54:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`sug_id`);

--
-- Indexes for table `total_all`
--
ALTER TABLE `total_all`
  ADD PRIMARY KEY (`total_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `sug_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `total_all`
--
ALTER TABLE `total_all`
  MODIFY `total_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

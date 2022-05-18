-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2022 at 08:42 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_blog`
--
CREATE DATABASE IF NOT EXISTS `simple_blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `simple_blog`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(1200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`) VALUES
(18, 9, 27, 'Nice!'),
(19, 9, 28, 'Super!'),
(20, 10, 28, 'Cool!'),
(21, 11, 29, 'Wow!'),
(22, 10, 29, 'Nice!'),
(23, 9, 29, 'Very nice!'),
(24, 10, 26, 'Good one!'),
(25, 11, 26, 'Mind blowing!'),
(26, 12, 26, 'How about that!');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_title` varchar(200) NOT NULL,
  `post` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_title`, `post`) VALUES
(9, 26, '“A Guide To…” Titles', 'The title of this post is “… : A Beginner’s Guide.” Why did I choose it? Well, first of all, “a guide” communicates to readers that it’ll be an article giving you the most important information about a topic, in this case – blog post tiles.\r\n\r\nSecondly, since my guide is a “beginner’s guide,” it should attract those who don’t have any or have little experience in creating catchy blog headlines.\r\n\r\nSo, why do “guide” topics work?\r\n\r\n“Guide” topics work because they promise readers they’ll find all the necessary information about a topic, so there’s no need to search for more.\r\n\r\nNow, when creating a “guide” headline, be creative! There are many ways to expand on a common “…: A Guide” topic. Create your own unique guide! Here are a few ideas that you can use:\r\n\r\n“…: The Only Guide You Need”\r\n“…: A Step-By-Step Guide”\r\n“The Advanced Guide To…”\r\n“A Start-To-Finish Guide…”\r\n“The In-Depth Guide To…”\r\nAlso, check out the three posts below. Look at the number of shares they got on social media. Aren’t their titles creative? (click “read” to go to the particular article)\r\n\r\nThe Martin Luther King, Jr. Guide To Inspirational Writing (read).\r\nThe Introvert’s Guide To Surviving (And Thriving) At A Conference: Five Tips (read).\r\nHow To Use Canva: An 8-Step Guide To Creating Visual Content (read).\r\nAs you can see, there are many ways you can change the common “Guide” title. Remember, expand on your idea!\r\n\r\nIf you don’t know how to change your idea into an amazing title, write it down and improve on it the way I did below:\r\n\r\nIdea: Feeding Toddlers.\r\n\r\nGood Title: A Guide To Feeding Toddlers.\r\n\r\nGreat Title: A Simple Guide To Feeding Toddlers.\r\n\r\nPerfect Title: A Simple Guide To Quickly Feeding Your Toddler.'),
(10, 27, ' “10, 15, 20…” Titles', 'Many readers, as well as writers, fall in love with list articles at first sight and there is a reason for it.\r\n\r\nListicles are easy to read and easy to write. They also get clicked and read more often than other articles.\r\n\r\nWhat makes listicles work? Why do they stand out?\r\n\r\nListicles are eye-catching because they organize information, inform you up-front how long the article will be and how many new things you’ll learn.\r\n\r\nHere are some ideas on how to create interesting listicles:\r\n\r\n“X Ways You Can… While…”\r\n“X Myths About…”\r\n“X Secrets Of…”\r\n“X Reasons Why…”\r\n“X Mindblowing Facts About…”\r\nAlso, check the three articles below. Aren’t their titles noticeable?\r\n\r\nThe 17 Best Tools For Spying On Your Competition (read).\r\n26 Insanely Useful iPhone Tips That You May Not Know About (read).\r\n5 Elements That Build A Roster Of Terrific Clients (read).\r\nLet’s now try to change a simple idea into a creative, eye-catching title like those above:\r\n\r\nIdea: Harry Potter.\r\n\r\nGood Title: 25 Harry Potter Gadgets.\r\n\r\nGreat Title: 25 Harry Potter Gadgets Every Fan Should Have.\r\n\r\nPerfect Title: 25 Unique Harry Potter Gadgets Every True Fan Should Have.'),
(11, 28, ' “… No One Will Tell You” Titles', 'Do you like the idea of missing out on something? No? Well, neither do your readers.\r\n\r\nThus…\r\n\r\n“… No One Will Tell You” title works because it promises you that once you click it, you’ll learn something unknown. Also, you’ll no longer be out of the loop.\r\n\r\nLet’s brainstorm for some ideas on how to write creative “… No One Will Tell You” titles that instantly draw people’s attention.\r\n\r\n“What No One Will Tell You But You Need To Hear About…”\r\n“X Things No One Will Tell You Before…”\r\n“The… Advice No One Will Give You”\r\n“X… Secrets No One Has Told You About…”\r\n“…? Here Are X Realities No One Will Tell You”\r\nAlso, take a look at the three articles below. Can you resist reading them?\r\n\r\n5 Things No One Will Tell You About Your First Job (read).\r\nThe Problem With All-White Kitchens That No One Will Tell You (read).\r\n15 Brutally Honest Pieces Of Advice About Relationships No One Will Tell You (read).\r\nNow, let’s try to create a perfect “… No One Will Tell You” title. What would you say about such topic as fauna and flora? Let’s narrow it down to insects.\r\n\r\nIdea: Mosquitoes.\r\n\r\nGood Title: What No One Will Tell You About Mosquitoes.\r\n\r\nGreat Title: 20 Things No One Will Tell You About Mosquitoes.\r\n\r\nPerfect Title: 20 Mindblowing Facts No One Will Ever Tell You About Mosquitoes.'),
(12, 29, '4 “How To” Titles', '“How To” titles are some of the most popular for blog posts. Check some of your favorite websites. How many “How To” titles do they have? Q\r\n\r\n“How To” titles get clicked by hundreds because they promise to teach you some new vital skills.\r\n\r\nAlso, think about what do we use search engines for? To find the information we lack, right? So, when we want to learn something new, acquire new skills or improve those we already possess, “how to” articles are the first we click since they offer us help as well as solutions.\r\n\r\nCheck out these ideas on how to change the common “How To” title into a more interesting one:\r\n\r\n“Why… And How To…”\r\n“Beginner’s Guide: How To…”\r\n“How To Create… Even If…”\r\n“…: What It Is And How To Use It”\r\n“X… Mistakes And How To Avoid Them”\r\nAlso, take a look at the three posts below. Are they popular?\r\n\r\nHow To Get More Likes On Facebook Without Buying Fans (read).\r\nHow To Write Conversationally: 7 Tips To Engage And Delight Your Audience (read).\r\nHow To Create The Perfect Thank You Page: An Epic Guide (read).\r\nNow, since we know that “How To” titles work and get hundreds of clicks, let’s try to create our own “How To” title that’ll interest our readers:\r\n\r\nIdea: Changing tires.\r\n\r\nGood Title: How To Change A Tire.\r\n\r\nGreat Title: How To Easily And Quickly Change A Tire.\r\n\r\nPerfect Title: How To Easily And Quickly Change Your Tire Alone: 12 Steps.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('female','male','') DEFAULT NULL,
  `b_date` date DEFAULT NULL,
  `phone_num` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `email`, `gender`, `b_date`, `phone_num`, `password`) VALUES
(25, 'Nina', 'Mohab', 'nina@gmail.com', 'female', '1986-09-27', '01298478755', '$2y$10$hRpJ734X2n/SjiWzAlMO2eMKckf4izfvRIfmPXElNANnhck2OYBQC'),
(26, 'Karam', 'Ali', 'karam@gmail.com', '', NULL, '', '$2y$10$wepeuG0PJfTPVRr5C8OYbOPeOyxoN8zQyxSlT3IGK8mtjW3/RYxGa'),
(27, 'Salma', 'Yehya', 'salma@gmail.com', '', NULL, '', '$2y$10$pVterTGiQgr4LJQ/19jweuyxgGaVcWcRFIc2oBccwLt6WcAtjZmg6'),
(28, 'Mohab', 'Fathy', 'mohab@gmail.com', '', NULL, '', '$2y$10$HIobv4NIACzi/DcAGEW8mOp2gYvMNxWI/2xGaotzJg2eGB77penMO'),
(29, 'Samira', 'Albert', 'samira@gmail.com', '', NULL, '', '$2y$10$oltnh55A8IwTD16doEvY/eXLVqZLT3AkRkQ62nNSa32JTJBsmCHNa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

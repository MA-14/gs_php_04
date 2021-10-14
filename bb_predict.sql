-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2021 年 10 月 14 日 13:24
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `baseball`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `bb_predict`
--

CREATE TABLE `bb_predict` (
  `id` int(12) NOT NULL,
  `getscore` int(12) NOT NULL,
  `lostscore` int(12) NOT NULL,
  `winlose` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `bb_predict`
--

INSERT INTO `bb_predict` (`id`, `getscore`, `lostscore`, `winlose`, `name`, `comment`, `date`) VALUES
(70, 0, 3, 'lose', 'テスト２ちゃん', '', '2021-10-14 21:58:25'),
(71, 3, 7, 'lose', 'テスト２ちゃん', '', '2021-10-14 22:01:52'),
(72, 3, 8, 'lose', 'テスト２ちゃん', '', '2021-10-14 22:02:40'),
(73, 9, 3, 'win', 'テスト２ちゃん', '頑張れ阪神！', '2021-10-14 22:02:56');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `bb_predict`
--
ALTER TABLE `bb_predict`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `bb_predict`
--
ALTER TABLE `bb_predict`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

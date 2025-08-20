-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2025-07-29 07:25:45
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `quizion`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `answer`
--

CREATE TABLE `answer` (
  `quiz_id` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `answer_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `answer`
--

INSERT INTO `answer` (`quiz_id`, `answer`, `answer_name`) VALUES
(1, 3, 'ウ'),
(3, 3, 'ウ'),
(4, 4, 'エ');

-- --------------------------------------------------------

--
-- テーブルの構造 `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `categoryname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`category_id`, `categoryname`) VALUES
(1, 'IT'),
(2, '英語'),
(6, '一般常識');

-- --------------------------------------------------------

--
-- テーブルの構造 `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `choice1` text NOT NULL,
  `choice2` text NOT NULL,
  `choice3` text NOT NULL,
  `choice4` text NOT NULL,
  `Explanation` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `category_id`, `title`, `choice1`, `choice2`, `choice3`, `choice4`, `Explanation`, `answer`) VALUES
(1, 1, '電源の瞬断に対処したり、停電時にシステムを修了させるのに必要な時間だけ電力を供給することを目的とした装置はどれか。', 'AVR', 'CVCF', 'UPS', '自家発電装置', 'UPS（Uninterruptible Power Supply）は、落雷などによる突発的な停電が発生したときに自家発電装置が電源を供給し始めるまでの間、サーバに電源を供給する装置です。また、電源の瞬断に対処したり停電時にシステムを安全に終了させるための役目を果たしたりします。', '3'),
(3, 1, 'OCSPクライアントとOCSPレスポンダとの通信に関する記述のうち，適切なものはどれか', 'デジタル証明書全体をOCSPレスポンダに送信し，その応答でデジタル証明書の有効性を確認する。', 'デジタル証明書全体をOCSPレスポンダに送信し，その応答としてタイムスタンプトークンの発行を受ける。', 'デジタル証明書のシリアル番号，証明書発行者の識別名(DN)のハッシュ値などをOCSPレスポンダに送信し，その応答でデジタル証明書の有効性を確認する。', 'エデジタル証明書のシリアル番号，証明書発行者の識別名(DN)のハッシュ値などをOCSPレスポンダに送信し，その応答としてタイムスタンプトークンの発行を受ける。', 'OCSP(Online Certificate Status Protocol)は、リアルタイムでデジタル証明書の失効情報を検証し、有効性を確認するプロトコルです。OCSPクライアントは、確認対象となるデジタル証明書のシリアル番号等をOCSPレスポンダに送信し、有効性検証の結果を受け取ります。この仕組みを利用することで、クライアント自身がCRL(証明書失効リスト)を取得・検証する手間を省くことができます。', '3'),
(4, 1, '現在の動向から未来を予測したり，システム分析に使用したりする手法であり，専門的知識や経験を有する複数の人にアンケート調査を行い，その結果を互いに参照した上で調査を繰り返して，集団としての意見を収束させる手法はどれか。', '因果関係分析法', 'クロスセクション法', '時系列回帰分析法', 'デルファイ法', 'デルファイ法は、複数の専門家から個別に意見の収集を行い、得られた意見の集約をフィードバックするということを繰り返して、最終的に意見の収束をしていく手法です。技術革新や社会変動などに関する未来予測においてよく用いられます。\r\n\r\nデルファイ法は次の手順に従って行われます。\r\n複数の専門家を回答者として選定し、個別に質問を行う\r\n質問に対する回答結果をフィードバックし、再度質問を行う\r\n回答結果を統計的に処理し，確率分布とともに回答結果を示す\r\n因果関係分析法\r\n複数の対象データ間の因果関係を分析する手法です。\r\n\r\nクロスセクション法\r\n時間の経過につれて変動していく現象を、ある一時点で横断的に取ったデータを分析する方法です。時系列分析とは対比的な分析概念です。\r\n\r\n時系列回帰分析法\r\n時系列データを分析することで、それらの関係を表す「回帰モデル」と呼ばれる数式を明らかにし、将来の売り上げ予測などに用いる手法です。\r\nデルファイ法\r\n正しい。', '4');

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(23, 'ryota', '$2y$10$TtehPEZxjky9jK1DfAEkuOvl1Ipm/5B0D7lPDTtd3hszNAzy4l8Ny');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_score`
--

CREATE TABLE `user_score` (
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `E_correct_rate` float NOT NULL,
  `IT_correct_rate` float NOT NULL,
  `C_correct_rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- テーブルのインデックス `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- テーブルのインデックス `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `category_id` (`category_id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- テーブルのインデックス `user_score`
--
ALTER TABLE `user_score`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

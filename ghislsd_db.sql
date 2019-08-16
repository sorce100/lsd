-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2019 at 02:38 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ghislsd_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `advert_company`
--

CREATE TABLE `advert_company` (
  `advert_com_id` int(11) NOT NULL,
  `advert_com_name` varchar(200) NOT NULL,
  `advert_com_address` varchar(500) NOT NULL,
  `advert_com_location` varchar(200) NOT NULL,
  `advert_com_tel` int(11) NOT NULL,
  `advert_com_category` varchar(50) NOT NULL,
  `record_hide` varchar(4) NOT NULL,
  `made_by` int(11) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advert_company`
--

INSERT INTO `advert_company` (`advert_com_id`, `advert_com_name`, `advert_com_address`, `advert_com_location`, `advert_com_tel`, `advert_com_category`, `record_hide`, `made_by`, `date_done`) VALUES
(1, 'asdfasdf', 'asdfasdf', '22', 23423, 'services', 'YES', 41, '2019-01-14 15:30:50'),
(2, 'sorce100', 'Company 1 address', '1235', 2147483647, 'services', 'NO', 41, '2019-01-15 10:36:15'),
(3, 'ASDF', 'ASDFA', 'ASDF', 2343, 'services', 'NO', 41, '2019-01-15 12:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `api_request`
--

CREATE TABLE `api_request` (
  `api_request_id` int(11) NOT NULL,
  `http_method` varchar(10) NOT NULL,
  `request_type` varchar(50) NOT NULL,
  `diploma_number` varchar(50) NOT NULL,
  `api_headers` text NOT NULL,
  `transaction_id` varchar(20) NOT NULL,
  `credit_amount` varchar(10) NOT NULL,
  `debit_amount` varchar(10) NOT NULL,
  `api_headers_time` varchar(100) NOT NULL,
  `api_response` text NOT NULL,
  `api_response_time` varchar(100) NOT NULL,
  `amount_debited` varchar(5) NOT NULL,
  `date_amount_debited` varchar(50) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_request`
--

INSERT INTO `api_request` (`api_request_id`, `http_method`, `request_type`, `diploma_number`, `api_headers`, `transaction_id`, `credit_amount`, `debit_amount`, `api_headers_time`, `api_response`, `api_response_time`, `amount_debited`, `date_amount_debited`, `date_done`) VALUES
(54, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"fb99073a-bbe7-4e35-9bc7-11ad6ed91ea8\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"91\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', 'TT35550I40009', '300', '', '27-June-2019 02:32:02 AM', '{\r\n\"amount\":\"300\",\r\n\"transaction_id\":\"TT35550I40009\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 02:32:02 AM', '', '', '2019-06-27 00:32:02'),
(55, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"fd1182eb-9316-4216-840b-7a8bf2cabef2\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"133\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', '', '', '300', '27-June-2019 02:40:55 AM', '{\r\n\"amount\":\"300\",\r\n\"transaction_id\":\"TT35550I40019\",\r\n\"credit_transaction_id\":\"TT35550I40009\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 02:40:55 AM', '', '', '2019-06-27 00:40:55'),
(56, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"48bb9189-e0aa-455f-be53-971f45d16938\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"133\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', '', '', '300', '27-June-2019 03:09:14 AM', '{\r\n\"amount\":\"300\",\r\n\"transaction_id\":\"TT35550I40019\",\r\n\"credit_transaction_id\":\"TT35550I40009\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:09:14 AM', '', '', '2019-06-27 01:09:14'),
(57, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"8bf6b9bf-cb94-439e-8674-8d00c7dd5c67\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"93\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', 'TT35550I40019', '900', '', '27-June-2019 03:11:05 AM', '{\r\n\"amount\":\"900\",\r\n\"transaction_id\":\"TT35550I40019\",\r\n\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:11:05 AM', '', '', '2019-06-27 01:11:05'),
(58, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"bfd7a31a-870b-47c0-ac73-544e11dc160f\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"133\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', 'TT35550I40090', '900', '', '27-June-2019 03:13:51 AM', '{\r\n\"amount\":\"900\",\r\n\"transaction_id\":\"TT35550I40090\",\r\n\"credit_transaction_id\":\"TT35550I40019\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:13:51 AM', '', '', '2019-06-27 01:13:51'),
(59, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"018de2ed-3ac4-4f3a-be22-7b8c7635b091\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"134\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', 'TT35550I400910', '', '900', '27-June-2019 03:14:28 AM', '{\r\n\"amount\":\"900\",\r\n\"transaction_id\":\"TT35550I400910\",\r\n\"credit_transaction_id\":\"TT35550I40019\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:14:28 AM', '', '', '2019-06-27 01:14:28'),
(60, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"f7ba4073-69a8-4850-a445-ce517eda1d99\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"137\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', 'TT35550I400910221', '500', '', '27-June-2019 02:38:51 PM', '{\r\n\"amount\":\"500\",\r\n\"transaction_id\":\"TT35550I400910221\",\r\n\"credit_transaction_id\":\"TT35550I40019\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 02:38:51 PM', '11', '27-June-2019 02:38:51 PM', '2019-06-27 12:38:51'),
(61, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"4ac9850d-a960-42ff-b037-4c62da57f693\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"137\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', 'TT35550I400910951', '500', '', '27-June-2019 02:43:04 PM', '{\r\n\"amount\":\"500\",\r\n\"transaction_id\":\"TT35550I400910951\",\r\n\"credit_transaction_id\":\"TT35550I40019\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 02:43:04 PM', 'YES', '27-June-2019 03:17:43 PM', '2019-06-27 12:43:04'),
(62, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"ddc40843-9f60-4117-a46f-1283475c7b84\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"142\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', 'TT35550I4009109571', '', '500', '27-June-2019 02:43:45 PM', '{\r\n\"amount\":\"500\",\r\n\"transaction_id\":\"TT35550I4009109571\",\r\n\"credit_transaction_id\":\"TT35550I400910951\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 02:43:45 PM', 'YES', '27-June-2019 02:43:45 PM', '2019-06-27 12:43:45'),
(63, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"6c5a01be-c964-4c38-b144-2965f7f0c270\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"144\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', 'TT35550I400910957981', '', '500', '27-June-2019 02:44:27 PM', '{\r\n\"amount\":\"500\",\r\n\"transaction_id\":\"TT35550I400910957981\",\r\n\"credit_transaction_id\":\"TT35550I400910951\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 02:44:27 PM', 'YES', '27-June-2019 02:44:27 PM', '2019-06-27 12:44:27'),
(64, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"application\\/json\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"ba44a95b-39d9-43dc-8000-da42c9c4cd7b\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"141\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"ghislsdapi\"],\"PHP_AUTH_PW\":[\"apiTest@123\"],\"HTTP_AUTHORIZATION\":[\"Basic Z2hpc2xzZGFwaTphcGlUZXN0QDEyMw==\"]}', 'TT355500910957981', '', '500', '27-June-2019 02:46:00 PM', '{\r\n\"amount\":\"500\",\r\n\"transaction_id\":\"TT355500910957981\",\r\n\"credit_transaction_id\":\"TT35550I400910951\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 02:46:00 PM', 'YES', '27-June-2019 02:46:01 PM', '2019-06-27 12:46:00'),
(65, 'GET', 'SEARCH', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"e1fed5ce-9ab2-4fcc-993f-fbdb8d9265c4\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"141\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', '', '', '', '27-June-2019 01:08:43 PM', 'HTTP/1.1 200 OK\r\nContent-Type: application/json\r\n\r\n{\"message\":\"Successful\",\"diplomaNumber\":\"11\",\"code\":\"200\"}', '27-June-2019 01:08:43 PM', '', '', '2019-06-27 13:08:43'),
(66, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"2654811a-57a6-48df-ba9b-c13fbc8e3ba3\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"143\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT35550091095723981', '', '500', '27-June-2019 03:09:24 PM', '{\r\n\"amount\":\"500\",\r\n\"transaction_id\":\"TT35550091095723981\",\r\n\"credit_transaction_id\":\"TT35550I400910951\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:09:24 PM', 'YES', '27-June-2019 03:09:24 PM', '2019-06-27 13:09:24'),
(67, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"7f955c80-bb61-4899-b5a6-e4ca5fa21a10\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"144\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT35550091095723w981', '', '500', '27-June-2019 03:09:34 PM', '{\r\n\"amount\":\"500\",\r\n\"transaction_id\":\"TT35550091095723w981\",\r\n\"credit_transaction_id\":\"TT35550I400910951\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:09:34 PM', 'YES', '27-June-2019 03:09:34 PM', '2019-06-27 13:09:34'),
(68, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"8f1b1d66-fa1d-4552-9542-87fafefd7f96\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"145\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500910957232w98', '', '500', '27-June-2019 03:10:50 PM', '{\r\n\"amount\":\"500\",\r\n\"transaction_id\":\"TT355500910957232w981\",\r\n\"credit_transaction_id\":\"TT35550I400910951\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:10:50 PM', '', '', '2019-06-27 13:10:50'),
(69, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"d0a9fa74-3999-4504-9740-f081e98d2509\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"145\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500910957232w98', '', '500', '27-June-2019 03:11:54 PM', '{\r\n\"amount\":\"500\",\r\n\"transaction_id\":\"TT355500910957232w981\",\r\n\"credit_transaction_id\":\"TT35550I400910951\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:11:54 PM', '', '', '2019-06-27 13:11:54'),
(70, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"126f3982-12ea-4974-a94c-da91c0c4c1ef\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"145\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500910957232w98', '', '500', '27-June-2019 03:17:43 PM', '{\r\n\"amount\":\"500\",\r\n\"transaction_id\":\"TT355500910957232w981\",\r\n\"credit_transaction_id\":\"TT35550I400910951\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:17:43 PM', '', '', '2019-06-27 13:17:43'),
(71, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"90dd1c90-cbba-49f3-82a4-38e7e71c0d7e\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"148\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT3555009109547232w5', '1000', '', '27-June-2019 03:19:53 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT3555009109547232w5981\",\r\n\"credit_transaction_id\":\"TT35550I400910951\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:19:53 PM', 'YES', '27-June-2019 03:21:53 PM', '2019-06-27 13:19:53'),
(72, 'POST', 'DEBIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"248a47a2-7046-4ae7-8535-193311f5a553\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"147\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT35550091095472321', '', '1000', '27-June-2019 03:21:53 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091095472321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:21:53 PM', '', '', '2019-06-27 13:21:53'),
(73, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.0\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"669bf77b-5bb4-4f1b-9726-e9b9b6df14cf\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"149\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500910954437232', '1000', '', '27-June-2019 03:22:22 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT3555009109544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '27-June-2019 03:22:22 PM', 'NO', '', '2019-06-27 13:22:22'),
(74, 'GET', 'SEARCH', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"44e6ac92-8dc1-4440-98d7-faf7f5530ee7\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"149\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', '', '', '', '30-July-2019 06:52:22 PM', 'HTTP/1.1 200 OK\r\nContent-Type: application/json\r\n\r\n{\"message\":\"Successful\",\"diplomaNumber\":\"11\",\"code\":\"200\"}', '30-July-2019 06:52:22 PM', '', '', '2019-07-30 18:52:22'),
(75, 'GET', 'SEARCH', '11', '{\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"c1b7e903-8c3b-48fc-a7ce-2d4a9e912430\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', '', '', '', '30-July-2019 06:54:04 PM', 'HTTP/1.1 200 OK\r\nContent-Type: application/json\r\n\r\n{\"message\":\"Successful\",\"diplomaNumber\":\"11\",\"code\":\"200\"}', '30-July-2019 06:54:04 PM', '', '', '2019-07-30 18:54:04'),
(76, 'GET', 'SEARCH', '119', '{\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"a2e77532-bfff-4d75-85b3-2208abb27a3a\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', '', '', '', '30-July-2019 06:54:11 PM', 'HTTP/1.1 400 Bad Request\r\nContent-Type: application/json\r\n\r\n{\"message\":\"Bad Request\",\"code\":\"400\"}', '30-July-2019 06:54:11 PM', '', '', '2019-07-30 18:54:11'),
(77, 'GET', 'SEARCH', '119', '{\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"57cdccb6-360a-47bd-b474-ea0165120402\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', '', '', '', '30-July-2019 06:55:33 PM', 'HTTP/1.1 400 Bad Request\r\nContent-Type: application/json\r\n\r\n{\"message\":\"Bad Request\",\"code\":\"400\"}', '30-July-2019 06:55:33 PM', '', '', '2019-07-30 18:55:33'),
(78, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"581c1fb8-18db-47cc-828f-cc5b04036049\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"149\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500910954437232', '1000', '', '30-July-2019 08:56:17 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT3555009109544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 08:56:17 PM', 'NO', '', '2019-07-30 18:56:17'),
(79, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"d5097172-5374-43b9-819f-7e5a684d9ebf\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"149\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500910954437232', '1000', '', '30-July-2019 08:58:05 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT3555009109544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 08:58:05 PM', 'NO', '', '2019-07-30 18:58:05'),
(80, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"81f55223-6f0c-41dd-9e59-59120ed81a2c\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"149\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500910954437232', '1000', '', '30-July-2019 08:58:09 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT3555009109544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 08:58:09 PM', 'NO', '', '2019-07-30 18:58:09'),
(81, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"81cc4c07-7abc-4f04-9ffb-b79d8bdf3001\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"149\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500910954437232', '1000', '', '30-July-2019 08:59:20 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT3555009109544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 08:59:20 PM', 'NO', '', '2019-07-30 18:59:20'),
(82, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"a7cd50c8-54af-45ab-879e-5a0c945c1813\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"149\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500910954437232', '1000', '', '30-July-2019 09:02:04 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT3555009109544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:02:04 PM', 'NO', '', '2019-07-30 19:02:04'),
(83, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"146a0892-c49c-45d1-bc20-3fb6893c2bec\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"150\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:02:37 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:02:37 PM', 'NO', '', '2019-07-30 19:02:37'),
(84, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"0d90964a-555e-4c1a-9791-ddaff7a64220\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"150\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:02:38 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:02:38 PM', 'NO', '', '2019-07-30 19:02:38'),
(85, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"7ed56d0b-a7b5-4328-8818-768b2538073e\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"150\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:02:39 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:02:39 PM', 'NO', '', '2019-07-30 19:02:39'),
(86, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"c9353458-8dc8-4cf4-83f7-320822832dc0\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"150\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:02:40 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:02:40 PM', 'NO', '', '2019-07-30 19:02:40'),
(87, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"f80982e2-450f-4122-ba7e-bd8bc7489f9b\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"103\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:02:55 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:02:55 PM', 'NO', '', '2019-07-30 19:02:55'),
(88, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"75867a98-a60f-48d7-a721-f0126b706cc7\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"103\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:02:56 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:02:56 PM', 'NO', '', '2019-07-30 19:02:56'),
(89, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"60f5710f-da24-4ed4-ac84-b37a740633c3\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"103\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:02:57 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:02:57 PM', 'NO', '', '2019-07-30 19:02:57'),
(90, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"982572c5-b5bd-4e87-8b7e-2088e98d107c\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"103\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:02:58 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:02:58 PM', 'NO', '', '2019-07-30 19:02:58'),
(91, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"fc1556d1-0469-466c-9a67-7463ce9594e6\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"150\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:10:33 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:10:33 PM', 'NO', '', '2019-07-30 19:10:33'),
(92, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"52c00687-c564-4bba-a613-b9fe34af5e83\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"150\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"NIB\"],\"PHP_AUTH_PW\":[\"#-BU&q6nI\"],\"HTTP_AUTHORIZATION\":[\"Basic TklCOiMtQlUmcTZuSQ==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:10:35 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:10:35 PM', 'NO', '', '2019-07-30 19:10:35'),
(93, 'POST', 'CREDIT', '11', '{\"CONTENT_TYPE\":[\"text\\/plain\"],\"HTTP_USER_AGENT\":[\"PostmanRuntime\\/7.15.2\"],\"HTTP_ACCEPT\":[\"*\\/*\"],\"HTTP_CACHE_CONTROL\":[\"no-cache\"],\"HTTP_POSTMAN_TOKEN\":[\"6cc492b9-51de-482b-b9e7-2ffdecd238fe\"],\"HTTP_HOST\":[\"localhost\"],\"HTTP_ACCEPT_ENCODING\":[\"gzip, deflate\"],\"CONTENT_LENGTH\":[\"150\"],\"HTTP_CONNECTION\":[\"keep-alive\"],\"PHP_AUTH_USER\":[\"UMB\"],\"PHP_AUTH_PW\":[\"#-M&q6UIB\"],\"HTTP_AUTHORIZATION\":[\"Basic VU1COiMtTSZxNlVJQg==\"]}', 'TT355500913095443723', '1000', '', '30-July-2019 09:15:23 PM', '{\r\n\"amount\":\"1000\",\r\n\"transaction_id\":\"TT35550091309544372321\",\r\n\"credit_transaction_id\":\"TT3555009109547232w5\",\r\n\"timestamp\":\"2019-06-18 18:18:20\"\r\n}', '30-July-2019 09:15:23 PM', 'NO', '', '2019-07-30 19:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `committee_library`
--

CREATE TABLE `committee_library` (
  `committee_library_id` int(11) NOT NULL,
  `committee_library_subject` varchar(200) NOT NULL,
  `committee_library_task` int(11) NOT NULL,
  `committee_library_folderName` varchar(100) NOT NULL,
  `committee_library_files` text NOT NULL,
  `committee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee_library`
--

INSERT INTO `committee_library` (`committee_library_id`, `committee_library_subject`, `committee_library_task`, `committee_library_folderName`, `committee_library_files`, `committee_id`, `user_id`, `division`, `date_done`) VALUES
(1, 'Testing', 0, '221mEiI', '[\"mtn-fibre-broadband-packages.pdf\",\"asdfsf.docx\",\"Koala.jpg\"]', 1, 6, 1, '2019-06-05 21:17:11'),
(2, 'Committee Research', 0, '221mEiI', '[\"Penguins.jpg\",\"bavarian-calculator.pdf\"]', 1, 6, 1, '2019-06-05 21:18:22'),
(3, 'For testing', 0, '221mEiI', '[\"GhISLSD_api.pdf\"]', 1, 73, 1, '2019-06-29 21:42:44'),
(4, 'test', 0, '251eXiy', '[\"0321832183.pdf\"]', 2, 73, 1, '2019-08-09 14:24:29'),
(5, 'test upload', 0, '221mEiI', '[\"doc.pdf\",\"home-marathon-challenge.pdf\"]', 1, 73, 1, '2019-08-15 15:11:21'),
(6, 'For approval', 2, 'v1srFX8', '[\"Assignment_1.pdf\"]', 4, 73, 1, '2019-08-15 17:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `committee_notes`
--

CREATE TABLE `committee_notes` (
  `committee_note_id` int(11) NOT NULL,
  `committee_note_title` varchar(200) NOT NULL,
  `committee_note_message` text NOT NULL,
  `committee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_hide` varchar(10) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee_notes`
--

INSERT INTO `committee_notes` (`committee_note_id`, `committee_note_title`, `committee_note_message`, `committee_id`, `user_id`, `record_hide`, `date_done`) VALUES
(1, 'sorce', 'sorce', 1, 73, 'NO', '2019-06-05 13:56:29'),
(2, 'dfasd', 'f', 1, 73, 'NO', '2019-06-05 13:57:57'),
(3, 'Content', 'Cintent', 1, 73, 'NO', '2019-06-05 13:59:02'),
(4, 'New Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, 73, 'NO', '2019-06-05 15:21:51'),
(6, '', '', 1, 6, 'NO', '2019-06-05 18:09:57'),
(7, 'fresh', 'Testing fresh note', 2, 6, 'NO', '2019-06-05 18:28:08'),
(8, 'Sample', 'If your buttons are not to submit form data to a server, be sure to set their type attribute to button. Otherwise they will try to submit form data and to load the (nonexistent) response, possibly destroying the current state of the document.', 1, 6, 'NO', '2019-06-05 21:55:31'),
(9, 'new one', 'lipsum', 1, 73, 'NO', '2019-08-15 14:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `committee_setup`
--

CREATE TABLE `committee_setup` (
  `committee_id` int(11) NOT NULL,
  `committee_name` varchar(100) NOT NULL,
  `committee_members` text NOT NULL,
  `committee_folder` varchar(10) NOT NULL,
  `committee_admins` text NOT NULL,
  `committee_pages` text NOT NULL,
  `division` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_hide` varchar(10) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee_setup`
--

INSERT INTO `committee_setup` (`committee_id`, `committee_name`, `committee_members`, `committee_folder`, `committee_admins`, `committee_pages`, `division`, `user_id`, `record_hide`, `date_done`) VALUES
(1, 'Finance', '[\"19\",\"11\"]', '221mEiI', '', '', 1, 64, 'NO', '2019-06-04 22:56:38'),
(2, 'education', '[\"19\",\"11\"]', '251eXiy', '', '', 1, 64, 'NO', '2019-06-04 22:59:15'),
(3, 'Welfare', '[\"11\"]', '', '', '', 1, 64, 'NO', '2019-06-04 23:06:41'),
(4, 'PagesTest', '[\"19\"]', 'v1srFX8', '[\"19\"]', '[\"9\",\"28\",\"26\"]', 1, 64, 'NO', '2019-06-29 22:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `committee_task`
--

CREATE TABLE `committee_task` (
  `committee_task_id` int(11) NOT NULL,
  `committee_task_name` varchar(500) NOT NULL,
  `committee_task_complete_date` varchar(50) NOT NULL,
  `committee_task_description` text NOT NULL,
  `committee_id` int(11) NOT NULL,
  `record_hide` varchar(5) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee_task`
--

INSERT INTO `committee_task` (`committee_task_id`, `committee_task_name`, `committee_task_complete_date`, `committee_task_description`, `committee_id`, `record_hide`, `date_done`) VALUES
(1, 'asdf', '16-08-2019', 'asdfasdf090', 1, 'NO', '2019-08-15 13:30:24'),
(2, 'Pages test name 1', '30-08-2019', 'Pages test task description', 4, 'NO', '2019-08-15 13:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_members_id` text NOT NULL,
  `record_hide` varchar(5) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_members_id`, `record_hide`, `date_done`) VALUES
(2, 'TEST', '[\"102\",\"1028\",\"1030\",\"1032\",\"979\",\"981\",\"982\",\"987\"]', 'NO', '2018-12-04 13:28:49'),
(3, 'sorce', '[\"102\",\"1028\",\"935\"]', 'NO', '2018-12-08 17:46:01'),
(4, '', 'null', 'NO', '2019-03-27 12:50:17'),
(5, '', 'null', 'NO', '2019-03-27 12:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `contribution`
--

CREATE TABLE `contribution` (
  `contribution_id` int(11) NOT NULL,
  `contribution_name` varchar(100) NOT NULL,
  `due_date` varchar(100) NOT NULL,
  `division` varchar(15) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contribution`
--

INSERT INTO `contribution` (`contribution_id`, `contribution_name`, `due_date`, `division`, `date_done`) VALUES
(2, 'FUNERAL OF MR', '30-11-2018', '', '2018-11-21 14:03:56'),
(3, 'NAMING CEREMONY OF MRS AMOAKO', '21-11-2018', '', '2018-11-26 23:16:47'),
(5, 'MONEY FOR SORCE', '12-08-2019', '', '2019-08-11 21:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `contribution_register`
--

CREATE TABLE `contribution_register` (
  `contributions_reg_id` int(11) NOT NULL,
  `contribution_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `contributed_amount` varchar(10) NOT NULL,
  `division` varchar(15) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contribution_register`
--

INSERT INTO `contribution_register` (`contributions_reg_id`, `contribution_id`, `member_id`, `contributed_amount`, `division`, `date_done`) VALUES
(1, 2, 102, '50', '', '2018-12-02 15:06:22'),
(2, 4, 102, '100', '', '2018-12-02 15:07:16'),
(3, 2, 102, '600', '', '2018-12-02 15:20:09'),
(4, 2, 102, '600', '', '2018-12-02 15:20:21'),
(5, 3, 102, '500', '', '2018-12-02 15:20:27'),
(6, 2, 11, '500', '', '2019-08-15 10:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_level` int(11) NOT NULL,
  `course_semester` varchar(20) NOT NULL,
  `course_details` text NOT NULL,
  `school_id` varchar(10) NOT NULL,
  `record_hide` varchar(5) NOT NULL,
  `division` varchar(15) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_code`, `course_name`, `course_level`, `course_semester`, `course_details`, `school_id`, `record_hide`, `division`, `date_done`) VALUES
(4, 'cs51', 'The name of the course', 300, '2nd Semester', 'Thhis is the name of the course', '6', 'NO', '1', '2019-02-20 20:29:30'),
(5, 'SUV101', 'Elective survey', 300, '1st Semester', 'This takes the survey into more details', '6', 'NO', '1', '2019-02-20 20:44:00'),
(6, 'OM201', 'Introduction to computing', 300, '2nd Semester', 'This introduces the student to Computing in survery', '6', 'NO', '1', '2019-02-20 20:45:07'),
(7, 'PR1', 'Equipment Handling', 300, '1st Semester', 'This is for equipment handling', '6', 'NO', '1', '2019-02-20 20:45:48'),
(8, 'the101', 'testing', 300, '3rd semester', 'testing', '6', 'NO', '1', '2019-02-24 15:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `division_id` int(11) NOT NULL,
  `division_fullname` varchar(200) NOT NULL,
  `division_alias` varchar(200) NOT NULL,
  `division_youtube` varchar(200) NOT NULL,
  `record_hide` varchar(10) NOT NULL,
  `made_by` int(11) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`division_id`, `division_fullname`, `division_alias`, `division_youtube`, `record_hide`, `made_by`, `date_done`) VALUES
(1, 'Land surveying division', 'lsd', 'zadfasdfasdfasdfasdf', 'NO', 56, '2019-03-19 12:23:03'),
(3, 'FOR ALL DIVISION', 'all', 'none', 'NO', 45, '2019-03-19 13:58:15'),
(4, 'ghana something', 'ghis', 'asd', 'NO', 64, '2019-03-20 11:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `email_sent`
--

CREATE TABLE `email_sent` (
  `email_sent_id` int(11) NOT NULL,
  `receiver_email` varchar(200) NOT NULL,
  `delivery_response` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_sent`
--

INSERT INTO `email_sent` (`email_sent_id`, `receiver_email`, `delivery_response`, `user_id`, `date_done`) VALUES
(1, '', '1', 96, '2019-04-12 00:28:13'),
(2, '', '1', 96, '2019-04-12 00:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `events_id` int(11) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `events_theme` text NOT NULL,
  `event_venue` text NOT NULL,
  `event_fee` varchar(10) NOT NULL,
  `event_date_start` varchar(12) NOT NULL,
  `event_date_end` varchar(12) NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `hotel_names` text NOT NULL,
  `hotel_prices` text NOT NULL,
  `division` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_hide` varchar(5) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`events_id`, `event_type`, `events_theme`, `event_venue`, `event_fee`, `event_date_start`, `event_date_end`, `start_time`, `end_time`, `hotel_names`, `hotel_prices`, `division`, `user_id`, `record_hide`, `date_done`) VALUES
(2, 'Event', 'Annual Seminar', 'koforidua', '200', '08-12-2018', '21-12-2018', '', '', '[\"Adenta finest\",\"Adenta guest house\",\"Adenta 5 star\"]', '[\"50\",\"50\",\"50\"]', '1', 73, 'NO', '2018-11-27 23:58:32'),
(4, 'Event', 'Annual seminar123', 'koforidua', '50', '30-11-2018', '08-12-2018', '', '', '[\"Madina finest\",\"Madina guest house\",\"Madina 5 star\"]', '[\"100\",\"100\",\"100\"]', '1', 73, 'NO', '2018-11-28 00:13:11'),
(5, 'Event', 'LAND SURVEYING AND MAPPING: THE CRITICAL FOUNDATION TO NATIONAL INFRASTRUCTURAL DEVELOPMENT IN GHANA', 'SKY PLUS HOTEL (HO) VOLTA REGION', '500', '01-12-2018', '08-12-2018', '09:00', '10:00', '[\"Adenta finest\",\"Adenta guest house\",\"Adenta 5 star\"]', '[\"100\",\"100\",\"100\"]', '1', 73, 'NO', '2018-11-28 00:14:44'),
(6, 'Meeting', 'Meeting first meeting 123', 'at adenta 123', '', '', '12-08-2019', '08:00', '14:00', '', '', '1', 73, 'NO', '2019-07-10 18:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `events_register`
--

CREATE TABLE `events_register` (
  `events_reg_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `member_id` varchar(100) NOT NULL,
  `event_fee_payed` varchar(10) NOT NULL,
  `event_ticket` varchar(20) NOT NULL,
  `meeting_attend_name` varchar(200) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_register`
--

INSERT INTO `events_register` (`events_reg_id`, `event_id`, `member_id`, `event_fee_payed`, `event_ticket`, `meeting_attend_name`, `date_done`) VALUES
(1, 5, '102', '500', 'GhIS5102', '', '2018-11-29 10:46:13'),
(2, 6, '11', '0', 'Meeting6', 'sorce kwarteng', '2019-07-11 16:33:25'),
(3, 6, '11', '0', 'Meeting6', 'merling kwarteng', '2019-07-11 16:34:26'),
(4, 6, '', '0', 'Meeting6', '', '2019-07-13 20:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `exam_center_setup`
--

CREATE TABLE `exam_center_setup` (
  `exam_center_id` int(11) NOT NULL,
  `exam_center_name` varchar(200) NOT NULL,
  `exam_center_region` varchar(100) NOT NULL,
  `exam_subjects` text NOT NULL,
  `division` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_hide` varchar(5) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_center_setup`
--

INSERT INTO `exam_center_setup` (`exam_center_id`, `exam_center_name`, `exam_center_region`, `exam_subjects`, `division`, `user_id`, `record_hide`, `date_done`) VALUES
(3, 'New Subject', 'Greater Accra', '', 1, 64, 'NO', '2019-07-15 11:40:13'),
(4, 'South Exam Center', 'Greater Accra', '', 1, 64, 'NO', '2019-07-15 13:06:08'),
(5, 'North Exams Center', 'Northern', '', 1, 64, 'NO', '2019-07-15 13:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `exam_center_subjects`
--

CREATE TABLE `exam_center_subjects` (
  `subject_id` int(11) NOT NULL,
  `center_exam_part` varchar(200) NOT NULL,
  `subject_name` text NOT NULL,
  `center_id` int(11) NOT NULL,
  `record_hide` varchar(5) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_center_subjects`
--

INSERT INTO `exam_center_subjects` (`subject_id`, `center_exam_part`, `subject_name`, `center_id`, `record_hide`, `date_done`) VALUES
(1, 'Part A', '[\"Merlin Exams\",\"Merlin 101\"]', 3, 'NO', '2019-07-15 11:40:13'),
(2, 'Part C', '[\"First Exams\",\"Resit Exams\"]', 4, 'NO', '2019-07-15 13:06:08'),
(3, 'Part C', '[\"First Exams 123\",\"Resit Exams nerlin\",\"hello\"]', 5, 'NO', '2019-07-15 13:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `exam_register`
--

CREATE TABLE `exam_register` (
  `exam_register_id` int(11) NOT NULL,
  `exam_center_id` int(11) NOT NULL,
  `exam_name` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_registered` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `exam_score` text NOT NULL,
  `exam_score_name` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_hide` varchar(5) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_register`
--

INSERT INTO `exam_register` (`exam_register_id`, `exam_center_id`, `exam_name`, `student_id`, `date_registered`, `status`, `exam_score`, `exam_score_name`, `user_id`, `record_hide`, `date_done`) VALUES
(5, 3, '[\"Merlin Exams\",\"Merlin 101\"]', 8, '15-07-2019', 'OLD', '[\"50\",\"98765\"]', '[\"Merlin Exams\",\"Merlin 101\"]', 64, 'NO', '2019-08-11 20:39:01');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `group_pages` text NOT NULL,
  `division` varchar(20) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_pages`, `division`, `date_done`) VALUES
(9, 'Admin', '[\"9\",\"28\",\"39\",\"17\",\"34\",\"22\",\"7\",\"40\",\"12\",\"33\",\"32\",\"41\",\"8\",\"31\",\"38\",\"5\",\"11\",\"20\",\"36\",\"24\",\"13\"]', '1', '2018-11-26 19:55:24'),
(11, 'sample', '[\"26\"]', '', '2018-11-26 21:11:46'),
(13, 'members', '[\"7\",\"33\",\"41\",\"35\",\"31\",\"19\",\"6\",\"37\",\"21\",\"10\"]', '1', '2019-02-24 13:20:48'),
(14, 'students', '[\"7\",\"12\",\"33\",\"35\",\"31\",\"19\",\"37\",\"27\",\"26\",\"21\",\"10\"]', '1', '2019-02-25 22:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `library_id` int(11) NOT NULL,
  `library_subject` varchar(200) NOT NULL,
  `library_category` varchar(50) NOT NULL,
  `library_description` text NOT NULL,
  `folder_name` varchar(30) NOT NULL,
  `division` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_hide` varchar(10) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`library_id`, `library_subject`, `library_category`, `library_description`, `folder_name`, `division`, `user_id`, `record_hide`, `date_done`) VALUES
(2, 'Test123', 'CPD', 'Test 1123', '03-27-20190710-166', 1, 66, 'NO', '2019-03-27 19:08:08'),
(4, 'sorce', 'Libray', 'sorce', '03-30-20195043-166', 1, 66, 'NO', '2019-03-30 02:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `members_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `other_name` varchar(100) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `personal_contact` varchar(20) NOT NULL,
  `emergency_contact` varchar(20) NOT NULL,
  `house_number` varchar(50) NOT NULL,
  `house_location` varchar(255) NOT NULL,
  `postal_address` varchar(255) NOT NULL,
  `professional_number` varchar(20) NOT NULL,
  `year_elected` int(11) NOT NULL,
  `surveyor_type` varchar(50) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_type` varchar(255) NOT NULL,
  `company_contact` varchar(255) NOT NULL,
  `corporate_email` varchar(100) NOT NULL,
  `region` varchar(50) NOT NULL,
  `office_location` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `current_balance` varchar(100) NOT NULL,
  `committes` text NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp(),
  `division` varchar(20) NOT NULL,
  `user_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`members_id`, `first_name`, `last_name`, `other_name`, `dob`, `personal_contact`, `emergency_contact`, `house_number`, `house_location`, `postal_address`, `professional_number`, `year_elected`, `surveyor_type`, `designation`, `company_name`, `company_type`, `company_contact`, `corporate_email`, `region`, `office_location`, `company_address`, `current_balance`, `committes`, `date_done`, `division`, `user_id`) VALUES
(1, 'GUSTAV', 'ASAMOAH', 'KPLOM KOMLA', '04/04/1978', '244589339', '', 'BAATSONA SPINTEX ROAD- ACCRA', '', 'P. O. BOX ST517 KANESHIE ACCRA', '1147', 0, 'LICENSED', '', 'GEOSTATE SURVEY', '', '', 'GUSMOAH@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:38', '1', '64'),
(2, 'ANGELA', 'BRIANDT', 'CHELSEA', '26/05/1986', '249953963', '', 'COMMUNITY 25, TEMA', '', 'P. O. BOX 46 TEMA', '1228', 0, 'PROFESSIONAL', '', 'TDC DEVELOPMENT COMPANY LIMITED', '', '', 'CHELSY265@YAHOO.CO.UK', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:38', '1', '64'),
(3, 'JOSEPH', 'MENSAH-DEBRAH', 'N/A', '04/06/1990', '246345627', '', 'PATASI ESTATE - KUMASI', '', 'P.O. BOX 372, F.N.T. - KUMASI', '1633', 0, 'PROFESSIONAL', '', 'EMO GEOMATICS CONSULT', '', '', 'JOE2MENS08@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:38', '1', '64'),
(4, 'FRANCIS', 'DONKOR', 'NONE', '09/03/1988', '207560840', '', 'KUMASI', '', 'C/O KWAME OBENG KNUST DEPT OF GEOMATIC ENGINEERING', '0', 0, 'STUDENT', '', 'KNUST', '', '', 'FADDONKOR', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:38', '1', '64'),
(5, 'WATSON', 'BEDZRAH', 'KOFI', '26/04/1991', '203155672', '', 'ADENTA, ACCRA', '', 'P. O. BOX AF 763, ADENTA FLATS, ACCRA', '0', 0, 'PROBATIONER', '', 'BASELINE SOLUTIONS', '', '', 'KOFIWATSON@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:38', '1', '64'),
(6, 'ISAAC', 'ANAMAN', 'EKOW', '', '507766693', '', 'BUNGALOW 34A', '', 'BOX 2, NSUTA-WASSA', '1328', 0, 'PROFESSIONAL', '', 'GHANA MANGANESE COMPANY LIMITED', '', '', 'EKOWANAMAN2002@YAHOO.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:38', '1', '64'),
(7, 'EDMUND', 'AMOAKO', 'AMANING', '06/02/1990', '+233 243 757 888 / +', '', 'Z1/G014, ASHAIMAN LEBANON.', '', 'BOX GP 2982, ACCRA.', '0', 0, 'PROBATIONER', '', 'A-M SURVEYS LIMITED', '', '', 'KOFIIAMOAKO@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:38', '1', '64'),
(9, 'NUTEPE', 'TUDZI', 'FUI KOFI', '19/06/1981', '244972260', '', 'LASHIBI, TEMA COMMUNITY 17,VIVIAN FARM. PLOT 108A', '', 'C/O ASSOCIATED CONSULTANTS LTD \r\nP. O.  BOX MB 259,  ACCRA', '1550', 0, 'PROFESSIONAL', '', 'ASSOCIATED CONSULTANTS LTD', '', '', 'KENTUDZI@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:38', '1', '64'),
(10, 'RHODEN', 'DOGBE', 'DZIFA', '10/02/1973', '244801926', '', 'TEMA', '', 'BOX CS 8544', '934', 0, 'LICENSED', '', 'TDC', '', '', 'RHODKING@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:38', '1', '64'),
(11, 'MICHAEL', 'NYOAGBE', 'WORLANYO', '16/04/1982', '244971602', '', 'C2/C8 REDCO FLATS MADINA', '', 'GP18306 ACCRA', '1030', 0, 'LICENSED', '', 'GWCL', '', '', 'MICHAEL.NYOAGBE@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '[\"1\",\"1\",\"2\",\"3\"]', '2019-03-23 23:09:38', '1', '64'),
(12, 'GLADYS', 'APPIAH', 'IVY', '03/07/1993', '264716045', '', 'AMASAMAN', '', '', '0', 0, 'STUDENT', '', 'BIGDATA GHANA LTD', '', '', 'IVY.WARTEMBERG@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(13, 'BISMARK', 'TENKORANG', 'KWASI', '12/11/1989', '248664955', '', 'NO 38, AMLI STREET, ADENTA', '', 'BOX AP450, AKROPONG-AKUAPEM', '0', 0, 'OTHER', '', 'BEACON SURVEY LIMITED', '', '', 'TENBIS2008@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(14, 'DIANA', 'AHIAKU', 'MAWUENA', '06/08/2018', '0248142593/027446503', '', 'KANDA,  ADJASCENT NADMO', '', 'P.O.BOX 901 ACCRA -CANTONMENTS', '0', 0, 'TECHNICIAN', '', 'CSS PRECISE SYSTEMS LTD.', '', '', 'DYANGREATER@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(15, 'ISAAC', 'BLEBOO', 'ISAAC', '25/02/1974', '244745334', '', 'PR A1 030. ABIA - PRAMPRAM', '', 'BOX TN 1428 TECHIE NUNGUA ESTATE', '805', 0, 'LICENSED', '', 'BLEBS GEO-CONSULT', '', '', 'ISAACBLEBOO@YAHOO.CO.UK', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(16, 'CULBERT', 'ABAGULUM', 'KWAME', '11/08/1976', '244735842', '', 'SUNYANI BRONG AHAFO', '', 'BOX 830 SUNYANI', '0', 0, 'STUDENT', '', 'LANDS COMMISSION(SURVEY AND MAPPING DIVISION)', '', '', 'ABAGULUMCULBERTKWAME@YMAIL.COM', 'BRONG AHAFO', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(17, 'ALEX', 'FUGOR', 'KWABENA', '10/18/0001', '243049832', '', 'LAPAZ', '', 'BOX 71 NSAWAM', '10', 0, 'TECHNICIAN', '', 'GHANA SCHOOL OF SURVEYING AND MAPPING', '', '', 'ALEXFUGOR@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '67'),
(18, 'EMMANUEL', 'ARYEETEY', 'NII AYI', '14/08/1988', '0249920224/ 02649369', '', 'NUNGUA', '', 'P.O. BOX CO 2728 TEMA', '0', 0, 'PROFESSIONAL', '', 'BASELINE SOLUTIONS', '', '', 'EMMANUELARYEETEY442@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(19, 'ISAAC', 'AGYEI', 'NII OKAI KWEKU', '20/07/2018', '243049925', '', 'PANTANG EAST 483', '', 'BOX ABK83 ABOKOBI- ACCRA', '11', 0, 'OTHER', 'FGhIS', '', '', '', 'ISAACADJEI83@GMAIL.COM', '', '', '', '11095', '[\"1\",\"2\",\"4\"]', '2019-03-23 23:09:39', '1', '98'),
(20, 'AARON', 'FREMPAH', 'ADOM', '07/07/1989', '0241273751/055626866', '', 'ABRUKUTUASO,MAMPONG ASHANTI', '', 'COCOA HEALTH AND EXTENSION DIVISION&#13;&#10;P.O. BOX 32&#13;&#10;MAMPONG DISTRICT', '19', 0, 'PROFESSIONAL', 'FGhIS', '', '', '', 'ADOMAARONFREMPAH55@YAHOO.COM', '', '', '', '500', '', '2019-03-23 23:09:39', '1', '92'),
(21, 'RICHARD', 'OTCHERE', 'K', '12/04/1977', '244667171', '', 'OYARIFA', '', 'P.O.BOX. CO 1955 TEMA', '1051', 0, 'PROFESSIONAL', '', 'FREELANCE', '', '', 'OSOKITI@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(22, 'FELIX', 'BOTE-KWAME', 'B', '11/07/1977', '244607913', '', 'KPONE', '', 'P O BOX CE 11507, TEMA', '1322', 0, 'PROFESSIONAL', '', 'WILLIX CONSULT', '', '', 'FELIXXBK@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(23, 'KINGSLEY', 'SAM', 'YAW', '01/12/1988', '245989572', '', 'SEPE DOTE KUMASI', '', 'P. O. BOX 4083', '1635', 0, 'PROFESSIONAL', '', 'ASANTEHENE?S LANDS SECRETARIAT', '', '', 'SHIZUMEBACHI@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(24, 'TERAH', 'ANTWI', '', '24/02/1993', '240655554', '', 'P.O.BOX AK 109', '', '', '0', 0, 'STUDENT', '', 'KNUST', '', '', 'SURVEYOR153@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(25, 'JOSEPH', 'ANTWI', '', '27/10/1981', '+233266775177', '', 'PLOT 19 BLOCK D KWAASOWA, KUMASI', '', 'P. O. BOX SN 272, KUMASI', '1641', 0, 'PROFESSIONAL', '', 'ASANTEHENES\' LAND SECRETARIAT', '', '', 'GOSPOJOEY@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(26, 'BENEDICTA', 'REINARH', 'DEDE BARKEY', '12/03/2018', '244972184', '', 'ASHIYIE', '', 'P. O. BOX CT 228, CANTONMENT,  ACCRA', '1029', 0, 'PROFESSIONAL', '', 'PETROLEUM COMMISSION', '', '', 'BENDEBAR1@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(27, 'ISAAC', 'ANSAH', '', '18/10/1975', '244768757', '', '63/13F ABOOM WELLS CAPE COAST', '', 'P O BOX CC 42 CAPE COAST', '1732', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION', '', '', 'ANSTECHCONSULT@GMAIL.COM', 'UPPER EAST', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(28, 'GODWIN', 'BOATENG', 'AKWASI', '25/06/1989', '0267857468/054891018', '', 'E 17 SOUTH SUNTRESO', '', 'SN 679 SANTASI - KUMASI', '0', 0, 'OTHER', '', 'GEOMATRIX ENGINEERING SERVICES', '', '', 'GAKWASIBOATENG@GMAIL', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(29, 'GILBERT', 'DJANETEY', 'ETIAKO', '25/03/2018', '244173313', '', 'AMASAMAN, ACCRA', '', 'P. O. BOX CT608, CANTONMENTS-ACCRA', '0', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION', '', '', 'ETIAKOGILBERT@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(30, 'SAMUEL', 'LAMPTEY', '', '04/01/1992', '501370862', '', 'A662/4 LARTEBIOKORSHIE- NEAR RADIO GOLD', '', 'P. O. BOX MP 205', '0', 0, 'PROBATIONER', '', 'PRISMOIDAL COMPANY LIMITED', '', '', 'LAMPTEYSAMUEL92@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(31, 'DANIEL', 'AGBEMORDZIE', 'LIGHT', '26/12/1991', '244663093', '', 'MADINA', '', 'PMB CT489, CANTONMENTS. ACCRA', '0', 0, 'STUDENT', '', 'GHANA SCHOOL OF SURVEYING AND MAPPING', '', '', 'AGBEMORDZIEYAO@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(32, 'FLORENCE', 'LAMPTEY', '', '03/10/1977', '244225980', '', 'GRADE ONE, BOGOSO', '', 'BOX AN 18629, ACCRA - NORTH', '1134', 0, 'LICENSED', '', 'ROCKSURE INTERNATIONAL', '', '', 'NINALAMPTEY@YAHOO.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(33, 'ASAA', 'ABUNKUDUGU', 'AKUNAI PETER', '15/04/1976', '+233202423079/246170', '', 'PLOT NUMBER 47 BLOCK B BEHIND YIKENE CHIEF PALACE', '', 'BOX 767', '1232', 0, 'PROFESSIONAL', '', 'BOLGATANGA POLYTECHNIC', '', '', 'NKUDUGAA@HOTMAIL.COM', 'UPPER EAST', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(34, 'MERCY', 'ACHEAMPONG', 'OBENEWAH', '17/04/1971', '277482996', '', 'HO.NO. A41 BULEMI ,GBAWE , MALLAM', '', 'BOX  OD 435 ODORKOR ACCRA', '238', 0, 'LICENSED', '', 'C.T.K NETWORK AVIATION AND ROKMER', '', '', 'MERCYDECKER@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(35, 'GEORGE', 'FRIMPONG', 'OKWABI', '08/02/1958', '208135831', '', 'ACCRA', '', 'P.O. BOX CT 4697, CANTONMENTS -ACCRA', '555', 0, 'LICENSED', '', 'PRIVATE PRACTICE', '', '', 'OKWABIGFM@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(36, 'EVANS', 'MGBORLA', 'ACKAH', '27/06/1992', '247986671', '', 'TAKORADI', '', '0208, TAKORADI', '0', 0, 'PROFESSIONAL', '', 'DEPARTMENT OF URBAN ROADS', '', '', 'EVMGBOLA@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(37, 'EDEM', 'BEKOR', 'ERIC', '31/07/1982', '244419056', '', 'TESHIE', '', 'POST OFFICE BOX OS 834, OSU - ACCRA', '0', 0, 'OTHER', '', 'PRIVATE', '', '', 'EDEMBEKOR@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:39', '1', '64'),
(38, 'PRINCE', 'ACQUAH', 'CHARLES', '23/11/1977', '0244971688 / 0260787', '', 'PLT 14 BLOCK K, KOTEI TWUMDUASE, KUMASI', '', 'CIVIL ENGINEERING DEPARTMENT, FACULTY OF ENGINEERING AND TECHNOLOGY, P.O.BOX 854, KUMASI', '1148', 0, 'PROFESSIONAL', '', 'KUMASI TECHNICAL UNIVERSITY', '', '', 'ACQUAHPRINCE@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(39, 'GILBERT', 'QUASHIE', 'KOBLA', '30/05/1972', '244266835', '', 'HNO. 1, MANGO LANE ASHONGMAN', '', 'POST OFFICE BOX GP3707, ACCRA', '1143', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION (SMD)', '', '', 'GILBERTKOBLAQUASHIE@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(40, 'EDWARD', 'OSEI JNR', 'MATTHEW', '10/07/1960', '244487620', '', 'N. 26 NORTH SUNTRESO', '', 'P. O. BOX OS 84, OSU-ACCRA', '314', 0, 'LICENSED', '', 'KNUST', '', '', 'CHIEF_OSEI@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(41, 'SETH', 'OPOKU AKOMEAH', '', '23/03/1993', '501372732', '', 'GYINYASE - KUMASI', '', 'P. O. BOX KS 10780, ADUM - KUMASI', '0', 0, 'OTHER', '', 'FREELANCE', '', '', 'SOPOKUAKOMEAH@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(42, 'DELALI', 'AHEDOR', '_', '28/09/1984', '249422575', '', 'HOHOE-BLAVE', '', 'BOX 181 HOHOE, CHED COCOBOD', '0', 0, 'OTHER', '', 'COCOBOD', '', '', 'DELAHEDOR@GMAIL.COM', 'VOLTA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(43, 'GHH', 'SAM', '', '01/01/2018', '5677', '', 'GHHJ', '', 'HHJJJ', '1234', 0, 'PROBATIONER', '', 'GHHHH', '', '', 'TYIJHH', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(44, 'SELIKEM', 'ABURU', 'KOFI', '30/12/2018', '246675252', '', 'ADENTA', '', 'BOX MD 2046, MADINA', '1722', 0, 'PROFESSIONAL', '', 'IMPACT HOMES LTD', '', '', 'SELIABURU@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(45, 'SELIKEM', 'ABURU', 'KOFI', '30/12/2018', '246675252', '', 'ADENTA', '', 'BOX MD 2046, MADINA', '1722', 0, 'PROFESSIONAL', '', 'IMPACT HOMES LTD', '', '', 'SELIABURU@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(46, 'MAWUENYEGA', 'FIAXE', 'DZIGBORDI KOFI', '20/05/1966', '0244093136/055367056', '', '#12 DODI ROAD, COMMUNITY ONE, AKOSOMBO.', '', 'P. O. BOX AK. 312, AKOSOMBO.', '1548', 0, 'PROFESSIONAL', '', 'VOLTA RIVER AUTHORITY', '', '', 'MEGAFIXE@YAHOO.COM', 'EASTERN', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(47, 'KWAME', 'TENADU', '', '', '243241121', '', 'NEAR JUBILEE SCHOOL, NSADWIR, DUTCH KOMENDA', '', 'BOX CC 564', '815', 0, 'LICENSED', '', 'UDANET LIMITED', '', '', 'KWAMETENADU@GMAIL.COM', 'CENTRAL', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(48, 'KWESI', 'ADDEY- BLANKSON', '', '14/02/1960', '208118129', '', 'TAKORADI', '', 'BOX  MC 1330 TAKORADI', '1456', 0, 'PROFESSIONAL', '', 'SMD-LANDS COMMISSION', '', '', 'KADBLANKSON@YAHOO.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(49, 'KWASI', 'ASAMOAH-TWUM', '', '20/03/1983', '244634373', '', 'GYENYASE-RAMSEYER', '', '', '1743', 0, 'PROFESSIONAL', '', 'EUROGET DE-INVEST', '', '', 'KASAMOAHTWUM@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(50, 'ISAAC', 'SELBY', 'YAW ABIRI', '12/10/1963', '244255189', '', 'ASHIYIE', '', 'P.O.BOX 1912 MAMPROBI', '370', 0, 'TECHNICIAN', '', 'SURVEY DEPARTMENT', '', '', 'GYADAMCITY @HOTMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(51, 'ANTHONY', 'ARKO-ADJEI', '', '21/07/1970', '244232447', '', 'BLOCK E PLOT 18 AYIGYA, KUMASI', '', 'DEPARTMENT OF GEOMATIC ENGINEERING, KNUST, KUMASI', '837', 0, 'PROFESSIONAL', '', 'KWAME NKRUMAH UNIVERSITY OF SCIENCE AND TECH', '', '', 'ARKOADJEI@HOTMAIL.COM.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(52, 'VIVIAN', 'LUTTERODT', '', '21/06/2018', '272186581', '', 'ADENTA', '', '', '0', 0, 'OTHER', '', 'GEOMATRIX ENGINEERING SERVICES', '', '', 'LUTTERODTVIV.VL@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(53, 'CHRISCENCIA', 'NAAH', '', '28/11/1993', '247291679', '', 'KANDA NEAR NADMO HEADQUARTERS', '', 'P.O BOX 998,DARKUMAN, ACCRA WEST.', '0', 0, 'TECHNICIAN', '', 'GHANA WATER COMPANY LIMITED', '', '', 'CHRISTYNAAH20@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(54, 'CHRISCENCIA', 'NAAH', '', '28/11/1993', '247291679', '', 'KANDA NEAR NADMO HEADQUARTERS', '', 'P.O BOX 998,DARKUMAN, ACCRA WEST.', '0', 0, 'TECHNICIAN', '', 'GHANA WATER COMPANY LIMITED', '', '', 'CHRISTYNAAH20@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(55, 'JACK', 'NTI ASAMOAH', '', '14/10/1986', '242681607', '', 'PLOT 137 BLOCK EE DABAN NEW SITE KUMASI', '', 'P. O. BOX 854', '1429', 0, 'PROFESSIONAL', '', 'KUMASI TECHNICAL UNIVERSITY', '', '', 'JACCEPHAS@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(56, 'DANIEL', 'AMOAKO', 'ODURO', '10/05/2018', '275577965', '', 'RM7, BLOCK 59, ADENTA SSNIT FLATS.', '', 'LG 657, LEGON', '0', 0, 'PROFESSIONAL', '', 'JOEAMAH GEOMATICS CONSULT LTD.', '', '', 'DANNYKODURO@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(57, 'WINIFRED', 'ACQUAH', '', '18/07/1992', '248025165', '', 'KANDAH(NADMO)', '', 'P.O.BOX 903 ACCRA(CANTOMENT)', '0', 0, 'STUDENT', '', 'INSTITUTION', '', '', 'ACQUAHWINIFRED92@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(58, 'WINIFRED', 'ACQUAH', '', '18/07/1992', '248025165', '', 'KANDAH(NADMO)', '', 'P.O.BOX 903 ACCRA(CANTOMENT)', '0', 0, 'STUDENT', '', 'INSTITUTION', '', '', 'ACQUAHWINIFRED92@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(59, 'FRED', 'ABOAGYE-LARBI', '', '01/01/1966', '244067365', '', 'PLOT C1/10 NAA AFII AVE.ATOMIC  HILLS ESTATE ASHON', '', 'P.O. BOX 1367 DANSOMAN ACCRA', '972', 0, 'LICENSED', '', 'BEACON SURVEY LIMITED', '', '', 'FABOAGYELARBI1966@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(60, 'DESMOND', 'APEDU', 'PRINCE', '05/07/1987', '244903249', '', 'BOGOSO', '', 'P.O. BOX 30. PRESTEA', '1638', 0, 'PROFESSIONAL', '', 'GOLDEN STAR RESOURCES LTD', '', '', 'APEDU2003@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(61, 'FELIX', 'TANOEH', '', '02/03/1988', '241789308', '', 'ADENTA', '', '', '0', 0, 'PROFESSIONAL', '', 'MICHELETTI AND CO GH. LTD', '', '', 'TANOEH.FELIX@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(62, 'ADWOA', 'AMOAH', 'SARPONG', '05/05/2018', '244842650', '', 'EE 44, KWADASO ESTATE, KUMASI', '', 'BOX 7603', '1227', 0, 'PROFESSIONAL', '', 'KUMASI TECHNICAL UNIVERSITY', '', '', 'LAWRENA80@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(63, 'PHILIP', 'OSEI BANAHENE', 'YAW', '24/05/1984', '0204441642, 02649752', '', '1948 MILITARY STREET, ALOGBOSHIE -ACHIMOTA', '', 'BOX R.Y 361', '1625', 0, 'PROFESSIONAL', '', 'SKEPIC SERVICES LIMITED', '', '', 'OKATAKYIEYAWBEE@GMAIL.COM BANAKING2000@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:40', '1', '64'),
(64, 'PATRICK', 'ANSU-GYEABOUR', '', '17/05/1992', '+233207707914', '', 'DOME PILLAR TWO', '', 'BOX 1059, SUNYANI-BA', '0', 0, 'OTHER', '', 'JOHN MURPHY CONSTRUCTION', '', '', 'PAGSNET@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(65, 'EMMANUEL', 'SEFA', '', '20/12/1986', '0276202049/024094431', '', 'TAIFA BURKINA, ACCRA', '', 'P. O. BOX GO 935, ACCRA', '1438', 0, 'PROFESSIONAL', '', 'DAOVTECH DESIGN GROUP LIMITED', '', '', 'SEFASES2005@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(66, 'GIDEON', 'VUNASE', '', '04/03/1989', '0243930806/050632085', '', 'JERUSALEM -TARKWA', '', 'C/O DR ISSAKA YAKUBU, UMAT, BOX 237, TARKWA', '0', 0, 'PROFESSIONAL', '', 'UNIVERSITY OF MINES AND TECHNOLOGY', '', '', 'VUNASEG@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(67, 'MICHAEL', 'DORKENU', 'MENSAH', '03/02/1986', '246231306', '', 'HOUSE NUMBER 21 NORTH LEGON', '', 'P. 0 BOX 257 HAATSO', '0', 0, 'STUDENT', '', 'GSSM', '', '', 'DORKENUMICHAEL@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(68, 'EMMANUEL', 'ADU-AFARI', '', '16/07/1993', '2247622803', '', 'GRADUATE STUDENTS HOSTEL', '', 'P.O.BOX AN 11685 ACCRA-NORTH', '12', 0, 'PROBATIONER', '', 'KWAME NKRUMAH UNIVERSITY OF SCIENCE AND TECHNOLOGY', '', '', 'SPYCHI99.EAA@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(69, 'BEATRICE', 'KOM', 'AKPENE AHIAFOR', '15/08/1974', '244261001', '', 'H/NO CP 16 NEW GBAWE', '', 'BOX CT 5633 CANTOMENTS- ACCRA', '1445', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION/GSSM', '', '', 'BEAKOM@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(70, 'EMMANUEL', 'ACQUAH', '', '16/03/1968', '0244214071, 02058532', '', 'AFIAMAN, POKUASE', '', 'P.O. BOX M154 MINISTRIES-ACCRA', '1248', 0, 'PROFESSIONAL', '', 'GHANA IRRIGATION DEVELOPMENT AUTHORITY', '', '', 'EKACQUA@YAHOO.CO.UK,  EACQUAH68@GMAIL', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(71, 'OKYERE', 'ADUBOFUOR', '', '09/09/1989', '207130460', '', 'PLOT 4 BLOCK 4 SARFO STREET - KOTEI EXTENSION', '', 'P.O. BOX 17 BONWIRE-ASHANTI', '0', 0, 'OTHER', '', 'GEOMATRIX ENGINEERING SERVICES', '', '', 'OKSBERG89@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(72, 'GIDEON', 'OPOKU', '', '08/10/1988', '542630831', '', 'ACCRA', '', 'BOX LATER 12278,KUMASI', '0', 0, 'PROFESSIONAL', '', 'LOSAMILLS CONSULT', '', '', 'GID32132@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(73, 'ALEXANDER', 'AYETTEY', '', '17/10/2018', '245176148', '', 'ACCRA', '', '', '0', 0, 'PROBATIONER', '', 'LANDS COMMISSION', '', '', 'STLEXISAAA@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(74, 'REDUWAN', 'KASSIM', '', '', '0508956050/024804360', '', 'WA, MALLAM ISSA STREET, HSE NO. DL3', '', 'BOX 272, WA, UPPER WEST REGION', '1718', 0, 'PROFESSIONAL', '', 'P&W GHANEM MESSRS', '', '', 'KASSIMREDUWAN@GMAIL.COM', 'NORTHERN', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(75, 'DAVID', 'AMEKU', '', '22/07/1993', '507757781', '', 'DANSOMAN CONTROL', '', 'P. O BOX 45 , MADINA', '0', 0, 'PROBATIONER', '', 'GEOSTATE SURVEY', '', '', 'SELASIAMEKU09@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(76, 'PRINCE', 'ODEI', 'CHARLES', '12/06/1993', '248166944', '', 'ACCRA & TAKORADI', '', 'C/O MOTIVATE THE WORLD, P.O. BOX KN 4828, KANESHIE.', '0', 0, 'PROFESSIONAL', '', 'SELF EMPLOYED', '', '', 'ODEIKWAME5@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(77, 'CHRISTIAN', 'MENSAH', 'LOUIS', '10/11/1991', '240064659', '', 'PLT 61 BLK D', '', '2343 ASHTOWN', '0', 0, 'OTHER', '', 'PENT GEOCONSULT', '', '', 'CRYSTALGECS@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(78, 'CYRIL', 'GADEGBEKU', '', '09/05/1987', '240800901', '', 'NORTH LEGPN', '', 'P.O.BOX GP. 3707 ACCRA', '1142', 0, 'PROFESSIONAL', '', 'DECK ENGINEERING LIMITED', '', '', 'CYRILGADEGBEKU@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(79, 'GEORGE', 'KOOMSON', '', '04/04/1976', '244747484', '', 'HNO. A3 KWAMO FLAT', '', 'P. O. BOX 854 KUMASI', '0', 0, 'OTHER', '', 'KUMASI TECHNICAL UNIVERSITY', '', '', 'POCOINI@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(80, 'AUGUSTINE', 'TETTEH', 'OPLEM', '15/08/2018', '246482405', '', 'H/25 HAATSO-ECOMOG', '', 'ABUSCO, PMB, KIBI-E/R', '0', 0, 'OTHER', '', 'FORTRESS GHANA', '', '', 'AUGUSTINETETTEH477@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(81, 'JACOB', 'BOATENG', 'KWAME', '22/08/1982', '207914472', '', 'AWOSHIE-NIC. OFF ABLEKUMA-POKUASI ROAD', '', '', '1236', 0, 'PROFESSIONAL', '', 'JOEAMAH GEOMATIC CONSULT', '', '', 'KWAABOAT@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(82, 'EBENEZER', 'DOKU', 'TETTEH', '07/10/1990', '275440804', '', 'AMASAMAN-ACCRA', '', '', '32094', 0, 'PROFESSIONAL', '', 'KNUST', '', '', 'BYGONEDOKU90@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(83, 'KWEKU', 'BAFFOE', '', '30/08/1989', '208603458', '', 'SYCAMORE MEDICAL CENTER, TAKORADI', '', 'P.O.BOX 1330, TAKORADI', '1708', 0, 'PROFESSIONAL', '', 'FREELANDS', '', '', 'KWEKUB4@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(84, 'GABRIEL', 'OWIREDU', 'KOFI', '03/06/1981', '0209532776/054305092', '', 'SQ 56 AHINSAN ESTATE KUMASI', '', 'P.O.BOX 3280 ADUM KUMASI', '1745', 0, 'PROFESSIONAL', '', 'KUMASI TECHNICAL UNIVERSITY', '', '', 'OWUGAB@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(85, 'KENNETH', 'COFFIE', '', '12/11/1989', '242635051', '', 'TEMA', '', '', '1713', 0, 'PROFESSIONAL', '', 'TDC DEVELOPMENT COMPANY LTD.', '', '', 'KENNETHCOFFIE2@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(86, 'MAXWELL', 'APPIAH', '', '13/08/1986', '541296746', '', 'PLT28,ASARE BREMPONG STREET.AMOABEN', '', 'P O BOX KY2415,KWABENYA ACCRA', '1747', 0, 'PROFESSIONAL', '', 'EMO GEOMATIC CONSULT', '', '', 'MAXASEM@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(87, 'ISAAC', 'ADJEI', 'KOFI', '26/05/1989', '246893018', '', 'NY 38 D, NEW NYAMSO, OBUASI', '', 'BOX 118, OBUASI', '0', 0, 'PROBATIONER', '', 'BGP-BAY', '', '', 'QUOPHYADJEI@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(88, 'EUGENE', 'ANIPAH', 'KODZO', '09/09/1985', '246740929', '', 'POST CODE GM-251-5429', '', 'POST CODE GM-251-5429', '0', 0, 'PROBATIONER', '', 'LANDS COMMISSION-SMD', '', '', 'EKANIPAH@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:41', '1', '64'),
(89, 'NANA', 'DUAH', 'KYERE', '28/07/1993', '546801696', '', 'KWADASO ESTATE', '', 'P. O. BOX 763, OBUASI', '0', 0, 'STUDENT', '', 'KNUST', '', '', 'NANADUAHSA@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(90, 'BERNARD', 'BOATENG', 'KOFI', '24/11/1983', '243866176', '', 'ANAJI_TAKORADI, SAVOY_CAPE COAST', '', 'BOX CC 42 CAPE COAST', '1737', 0, 'PROFESSIONAL', '', 'LANDS COMMIISSION - SMD', '', '', 'BENBOAT2G6@YAHOO.COM', 'CENTRAL', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(91, 'KINGSLEY', 'WIAFE-KWAKYE', 'KOJO', '', '201460744', '', 'J22 COMMUNITY 9 TEMA', '', 'P.O. BOX CT 175 CANTONMENTS', '1700', 0, 'PROFESSIONAL', '', 'GHANA PORTS AND HARBOURS AUTHORITY', '', '', 'KWAJIKWAKYE@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(92, 'EMMANUEL', 'MOHENU', 'ADJEI', '11/05/1950', '242868201', '', 'ABLORADJEI NEAR OLD ASHONGMAN', '', 'C/O P.O.BOX CT903 CANTONMENTS ACCRA', '224', 0, 'LICENSED', '', 'NIL', '', '', 'EAM1950@HOTMAIL.CO.UK', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(93, 'RABIU', 'ABDUL SALAM TOURE', '', '03/07/1984', '262380830', '', 'SAWABA KINTAMPO', '', '', '1703', 0, 'PROFESSIONAL', '', 'FREELANCE', '', '', 'CAPTAINRABAH05@YAHOO.CO.UK', 'BRONG AHAFO', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(94, 'CHRISTIAN', 'GAISEY - OTOO', '', '22/08/2018', '207130898', '', 'MADINA, LIBYA QUARTERS', '', '', '1715', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION (SMD)', '', '', 'CGAISEYOTOO@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(95, 'FELIX', 'DARKWAH', 'MUSTAPHA', '06/10/2018', '208210928', '', 'PLT 19 BLK E, FANKYENEBRA - KUMASI', '', 'SN 927, SANTASI - KUMASI', '0', 0, 'OTHER', '', 'YOPAC LINK SOLUTIONS', '', '', 'FELIXDARKWAH5@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(96, 'BEATRICE', 'ACHEAMPONG', '', '19/01/2018', '273457384', '', 'BOADI', '', 'GEOMATIC ENGINEERING DEPARTMENT, KNUST.  PMB KUMASI', '1634', 0, 'PROFESSIONAL', '', 'KNUST', '', '', 'BEAYAACH@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(97, 'PRISCILLA', 'ABASI', 'MBAMA', '13/04/1993', '205302691', '', 'NMAI DZORN', '', '', '2', 0, 'PROFESSIONAL', '', 'WALULEL LIMITED', '', '', 'TALAPRISY@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '84'),
(98, 'JEFFREY', 'AMLALO', 'DORNU', '30/08/1991', '265405972', '', 'WESTLANDS BLVD HN112 PAPAO LEGON', '', 'OS 3445', '0', 0, 'PROBATIONER', '', 'METRISYS GHANA LTD', '', '', 'JEFFREYAMLALO@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(99, 'CYRIL', 'OWIAFE', 'SETUSA', '24/09/1992', '247680879', '', 'TESHIE', '', '', '0', 0, 'PROBATIONER', '', 'LOSAMILLS COMSULT LIMITED', '', '', 'SETUS249@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(100, 'ATO', 'ARHIN', 'KWAMENA', '18/07/1992', '209392184', '', 'TAKORADI', '', 'EF 45, EFFIA, TAKORADI', '0', 0, 'STUDENT', '', 'PRIVATE', '', '', 'ATOARHIN11@YAHOO.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(101, 'ESTHER', 'ANKAMU', 'SERWAA', '23/09/1991', '207063890', '', 'DANSOMAN-EBENEZER DOWN', '', '', '0', 0, 'PROBATIONER', '', 'AFCONS INFRASTRUCTURE LIMITED', '', '', 'ANKYSTAR2009@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(102, 'JOHN', 'OPPONG-TWUM', 'EAKIN', '29/06/1985', '0549074579 / 0263986', '', 'TEBIBIANO, NEAR THE MOSQUE', '', 'BOX AH 8157 AHINSAN KUMASI', '1742', 0, 'PROFESSIONAL', '', 'EAKJOP GEOINFO CONSULT', '', '', 'OPPONGTWUM@YAHOO.COM; EAKJOP@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(103, 'ERNEST', 'ASONGO', '', '12/01/1990', '246157909', '', 'NORTH KANESHIE', '', 'BOX 136,BOLGA.', '0', 0, 'PROFESSIONAL', '', 'KNUST', '', '', 'ERNESTASONGO@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(104, 'SAMPSON', 'ACKAH', 'JNR', '02/04/1990', '266771611', '', 'KUMASI', '', '', '0', 0, 'PROFESSIONAL', '', 'PW MINING -GHANA', '', '', 'ACKAH79@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(105, 'JEFF', 'OSEI', 'DACOSTA', '24/02/1994', '240345610', '', 'AB 34/C OBUASI', '', 'SDA CHURCH BOX88', '0', 0, 'STUDENT', '', 'KNUST', '', '', '2230414@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(106, 'EPHRAIM', 'OWUSU', 'ATTA', '19/11/1990', '207040066', '', 'KOTEI.  P & G EXECUTIVE HOSTEL', '', 'P. O. BOX 407. \r\nAKIM ODA\r\nEASTERN REGION \r\nGHANA', '0', 0, 'STUDENT', '', 'KNUST', '', '', 'EPHRAIMOWUSU273@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(107, 'YAKUBU', 'ALHASSAN', '', '04/08/1993', '248321130', '', 'HOUSE NUMBER 37 BLK K, ABOASO-ASHANTI', '', 'P.O.BOX KJ 29, KEJETIA-KUMASI', '130467', 0, 'PROBATIONER', '', 'LANDS COMMISSION-ACCRA', '', '', 'YALHASSANPRO@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(108, 'DANIEL', 'SASU', 'EFFAH', '28/10/1981', '264828895', '', 'B 292 / 25', '', 'BOX AN 7369, ACCRA- NORTH', '1698', 0, 'PROFESSIONAL', '', 'COMPTRAN ENGINEERS & PLANNERS ASSOCIATION', '', '', 'ZAGA_BOTHA@HOTMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(109, 'ABDUL BASIR', 'ISSAH', '', '27/08/1988', '202808623', '', 'SSNIT FLAT BLOCK 27A,WA', '', 'GHANA HIGHWAY AUTHORITY, BOX 1641,HEAD OFFICE, ACCRA', '1725', 0, 'PROFESSIONAL', '', 'GHANA HIGHWAY AUTHORITY', '', '', 'ISSAHABDULBASIR@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(110, 'KAFUI', 'DADZOE', 'NOEL', '17/01/1960', '208195041', '', 'DANFA/MADINA', '', 'BOX  CO 315 , TEMA', '1240', 0, 'PROFESSIONAL', '', 'JGC', '', '', 'KAFUIDADZOE@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(111, 'ROOSELER', 'GYIMAH', 'AKOSUA', '29/03/1998', '265732605', '', 'ATAFOA-TIKESE', '', '', '0', 0, 'STUDENT', '', 'STUDENT', '', '', 'CHICAGOTYCOON.CT@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(112, 'AUGUSTINE', 'OBENG-FORI', '', '27/11/1965', '242088468', '', 'ASOFAN, OFANKOR', '', 'P.O.BOX AJ 13, ALAJO ACCRA', '1644', 0, 'PROFESSIONAL', '', 'JOEAMAH GEOMATICS CONSULT LTD', '', '', 'AOBENGF@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(113, 'BABA ZAKARIA', 'SALIFU', '', '13/06/1971', '244375560', '', 'BOLGA', '', 'P.O..BOX CT 5937, CANTONMENTS-ACCRA', '1137', 0, 'PROFESSIONAL', '', 'SMD-LANDS COMMISSION', '', '', 'SBZAKARIA@GMAIL.COM', 'UPPER EAST', '', '', '500', '', '2019-03-23 23:09:42', '1', '64'),
(114, 'NESTA', 'KOMLADZEI', 'MAWUNYO', '23/10/1990', '201460236', '', 'ADENTA FRAFRAHA', '', '', '0', 0, 'PROFESSIONAL', '', 'DE SIMONE LTD', '', '', 'MARVESTA1@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(115, 'ISAAC', 'YIRENKYI', 'KORANTENG', '06/11/1971', '545761735', '', 'LC 15 DEVTRAVO ESTATE COMM 25 TEMA', '', 'P.0.BOX  CO \r\n3860', '1032', 0, 'LICENSED', '', 'GHANA PORTS  AND HABOURS AUTHORITY', '', '', 'IKEYIRENKYI@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(116, 'JOHN', 'ANNAN', 'VICTOR', '10/10/1956', '0244276619/020295739', '', 'H/N:10A ROOM4,SITE B,C3 TEMA', '', 'P.O.BOXCO2401,TEMA.', '809', 0, 'LICENSED', '', 'JOVIAN SURVEY CONSULT', '', '', 'JOVIAN119@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(117, 'RANSFORD', 'TETTEH', '', '21/09/2018', '249086200', '', 'SSNIT FLAT KOFORIDUA', '', 'BOX KF 139 , KOFORIDUA', '19460', 0, 'PROFESSIONAL', '', 'HAMAXYS', '', '', 'RANSFORD.TTTH@GMAIL.COM', 'EASTERN', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(118, 'NANA', 'KUSI-APPIAH', 'ADWOA', '02/10/2018', '242984264', '', 'DOME', '', 'AH78', '1552', 0, 'PROFESSIONAL', '', 'SELF EMPLOYED', '', '', 'MZNANADJ@GMAIL COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(119, 'BENONY', 'FIAH', 'AGBEWONU', '19/10/1937', '3244279235', '', 'ABLENKPE NO 11 TOTRO STREET', '', 'BOX AN 10227, ACCRA-NORTH', '171', 0, 'PROFESSIONAL', '', 'GEO ENGINEERING SERVICES', '', '', 'GEOENGINEERING@YAHOO.COM', 'VOLTA', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(120, 'ABIGAIL', 'OPOKU AFRIYIE', '', '21/02/1985', '244676073', '', 'PLOT NO. 11, BLK A, NYANKYERENIASE', '', '7310, ADUM, KUMASI', '0', 0, 'PROFESSIONAL', '', 'PVLMD', '', '', 'OPOKUAFRIYIEA@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(121, 'ERNEST', 'EKUBAN', '', '30/04/2018', '243983924', '', '30 TESANO STREET', '', 'P.O.BOX AF 3238', '1723', 0, 'PROFESSIONAL', '', 'GHANA HIGHWAY AUTHORITY', '', '', 'ERNEKUBAN@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(122, 'BENNET', 'AKPALU', '', '04/01/1993', '0203396392/054145926', '', 'HSE NO KS 257A/4 WINNEBA', '', 'BOX 227 KPANDO', '0', 0, 'TECHNICIAN', '', 'PAABADU CONSTRUCTIONS LIMITED', '', '', 'BENNETKAFUI@GMAIL.COM', 'CENTRAL', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(123, 'VICTOR', 'DODODZA', '', '26/11/1986', '244381106', '', 'C669 PROF. AKP KLUDZE ST. KOTOBABI NORTH', '', 'BOX GP3172, ACCRA - CENTRAL', '0', 0, 'OTHER', '', 'KNUST', '', '', 'VICHUG266@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(124, 'RICHARD', 'KPEKPENA', 'GAMELI', '28/03/1981', '244677905', '', 'MEDIE', '', 'BOX 1993 MADINA', '84212', 0, 'PROBATIONER', '', 'SELF EMPLOYED', '', '', 'RICHSTONNY@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(125, 'STEPHEN', 'KPALEGA', 'ONTOANEYIN', '16/08/2018', '246019638', '', 'CHOGGU YAPALSI HSE NO. 358 BLK C', '', 'C/O VRA/NEDCO BOX 77 TAMALE', '0', 0, 'PROFESSIONAL', '', 'VRA/NEDCO', '', '', 'KPALEGASTEPHEN@YAHOO.COM', 'NORTHERN', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(126, 'PROSPER', 'AKORTSU', 'MAWUSI', '23/03/1988', '207296295', '', 'NAVY WARDROOM TEMA', '', 'GHANA NAVY, PMB TEMA-ACCRA', '0', 0, 'OTHER', '', 'GHANA NAVY', '', '', 'M.AKORTSU@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(127, 'NICHOLAS', 'GBLORKPOR', 'KOMLA', '06/09/1988', '248759172', '', 'ADW/G93A', '', 'P.O.BOX KF 1427, KOFORIDUA', '0', 0, 'STUDENT', '', 'TOTAL LAND SOLUTION COMPANY LIMITED, KOFORIDUA', '', '', 'NICHOLASKOMLA@GMAIL.COM', 'EASTERN', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(128, 'GEORGE', 'ETO', 'MUMUNI', '14/11/1952', '208140954', '', 'HOUSE NO. 19A BLK W. A?EDUASE  KUMASI. NEAR KNUST', '', 'P.?. B?X AK69.ANLOGA KUMASI.', '256', 0, 'LICENSED', '', 'GMT SURVEYS LIMITED', '', '', 'GMTSURVEYS60@GMA?L.COMGMT', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:43', '1', '64'),
(129, 'BRIGHT', 'ASIO', '', '28/07/1982', '507314828', '', 'TEMA', '', '', '6253002', 0, 'OTHER', '', 'PROMAPPERS ENGINEERING LTD', '', '', 'BRYTEASIO@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(130, 'LILY LISA', 'YEVUGAH', '', '30/12/1988', '201810116', '', 'ODUOM PLOT 11 BLKA', '', 'P. O. BOX UP1516 KNUST, KUMASI.', '1735', 0, 'PROFESSIONAL', '', 'GEOMATIC ENGINEERING DEPART.', '', '', 'LLYEVUGAH@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(131, 'AKUFFO', 'ADDO-GYAN', 'KWAO', '21/09/1984', '0242009651/ 02350096', '', 'AWUTU BREKU, CENTRAL REGION', '', 'BOX 19 AWUTU BREKU', '1734', 0, 'PROFESSIONAL', '', 'LANDS (SMD)', '', '', 'UNCLERICH1900@YAHOO.COM', 'CENTRAL', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(132, 'JOSHUA', 'AZORLIADE', 'KWASI', '19/07/1987', '244994859', '', 'B343/7 AWUDOME ESTATE', '', 'P. O. BOX KN5651 KANESHIE ACCRA', '0', 0, 'PROBATIONER', '', 'QUEST CONSOLIDATED LIMITED', '', '', 'JOSHAZOR@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(133, 'PAA_KWESI', 'AKUFFO OWUSU-ENSAW', 'EZANETOR', '17/07/1994', '501372166', '', 'HSE 20, DUNKONAH SSNIT FLATS, WEIJA', '', 'C/O DR EDWARD OSEI, DEPARTMENT OF GEOMATIC ENGINEERING, PMB KNUST.', '0', 0, 'PROBATIONER', '', 'KNUST', '', '', 'KWESIKUFFA@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(134, 'PADRAIC', 'FREEMAN', 'BIRCH', '15/10/2018', '244587015', '', '17 BATHUR STREET, SHIASHIE, EAST LEGON', '', 'P.O.BOX MP74, MAMPROBI, ACCRA', '1139', 0, 'LICENSED', '', 'ELECTRICITY COMPANY OF GHANA', '', '', 'SPADDYX@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(135, 'JERRY', 'ASAANA', 'ANAMZUI-YA', '11/06/1981', '206297736', '', 'BOLGATANGA', '', 'BOX 767, BOLGATANGA POLYTECHNIC', '1231', 0, 'PROFESSIONAL', '', 'BOLGATANGA POLYTECHNIC', '', '', 'NAMZUIYA@GMAIL.COM', 'UPPER EAST', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(136, 'YAW', 'AMOAH', 'ACHEAMPONG', '24/07/1973', '244653386', '', 'HSE NO 5 RESIDENCY AREA NEAR ATEKYEM KOFORIDUA', '', 'P.O.BOX KF 983 KOFORIDUA', '916', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION (SURVEY & MAPPING  DIVISION)', '', '', 'AYAAKAY@YAHOO.COM', 'EASTERN', '', '', '500', '', '2019-03-23 23:09:44', '1', '87'),
(137, 'JOHN', 'AYER', '', '17/02/1958', '208533925', '', 'H7B AHENSAN ESTATES', '', 'PMB', '580', 0, 'PROFESSIONAL', '', 'KNUST', '', '', 'JOHNNYAYER@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(138, 'ISAAC-MARCEL', 'AZORLIADE', '', '16/01/1990', '200154757', '', 'BLOCK 12, SANGO, 1ST JUNCTION, TESHIE-NUNGUA, ACCR', '', 'BOX CT 1311 CANTONMENTS, ACCRA', '0', 0, 'PROBATIONER', '', 'QUEST CONSOLIDATED LIMITED, GHANA', '', '', 'ISAACAZORLIADE@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(139, 'EDWARD', 'ASANTE AWUAH', '', '12/04/1964', '243329372', '', 'BOX SC 502 TEMA', '', 'BOX 191 ACCRA', '1548', 0, 'PROFESSIONAL', '', 'SMD', '', '', 'ASANTEAWUAH@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(140, 'PATRICIA', 'GRANAHAM', '', '', '243419443', '', 'H. NO. 35 HAATSO-ECOMOC ROAD, CLINIC ROAD ROAD', '', 'PIWC-ATOMIC, P. O. BOX WY 456, KWABENYA, ACCRA', '1730', 0, 'PROFESSIONAL', '', 'FREELANCE', '', '', 'PGRANAHAM@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(141, 'RICHARD', 'AGBANYO', 'MAWULI', '07/06/1965', '244625497', '', 'EAST OYARIFA', '', 'BOXC5633 CANTONMENT', '1720', 0, 'PROFESSIONAL', '', 'SURVEY AND MAPPING DIV.', '', '', 'RICHARDAGBANYO@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(142, 'BENJAMIN', 'ACQUAH', 'BENYI', '05/06/1966', '0262325005 / 0244325', '', '22 FRIMPOMAA REVENUE. BATSONAA', '', 'BX CT 4568. CANTS-ACCRA', '0', 0, 'LICENSED', '', 'NARPACK CONSULT', '', '', 'BBKIKO7@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(143, 'ILIASU', 'EWUNTOMAH', '', '25/11/1981', '208246012', '', 'PLOT 84 DABAN KUMASI', '', 'P.O.BOX KS16403', '1150', 0, 'PROFESSIONAL', '', 'DEPARTMENT OF URBAN ROADS', '', '', 'EILFAT@YAHOO.COM', 'NORTHERN', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(144, 'ILIASU', 'EWUNTOMAH', '', '25/11/1981', '208246012', '', 'PLOT 84 DABAN KUMASI', '', 'P.O.BOX K.S16403 ADUM KUMASI', '1153', 0, 'PROFESSIONAL', '', 'DEPARTMENT OF URBAN ROADS', '', '', 'EILFAT@YAHOO.COM', 'NORTHERN', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(145, 'KAFUI', 'DADZOE', 'NOEL', '17/01/1960', '208195041', '', 'DANFA/MADINA', '', 'BOX CO 315, TEMA', '1240', 0, 'PROFESSIONAL', '', 'JGC', '', '', 'KAFUIDADZOE@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(146, 'SENKYIRE', 'ACQUAH', 'THOMAS', '19/06/1954', '0277770300/026340195', '', 'NO. 15A TOP KINGS ESTATE FETTEH NKWANTANAN', '', 'BOX CT4183 ACCRA', '614', 0, 'PROFESSIONAL', '', 'PRIVATE LICENSED SURVEYOR', '', '', 'SENKYIRE@GMAIL.COM0', 'CENTRAL', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(147, 'FRANK', 'ANYAH', 'KWASI', '08/06/1986', '246498825', '', 'SRAHA ASHALEY BOTWE', '', 'DT 2530, ADENTA', '0', 0, 'PROBATIONER', '', 'XQUISITE ENGINEERING SERVICES LIMITED', '', '', 'FRANKANYAH@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(148, 'HERBERT', 'DJABA', 'KOMESOUR', '11/05/1972', '548717820', '', 'MARKET STREET, OKPOI GONNO, TESHIE', '', 'P . O . BOX TN 466, TESHIE NUNGUA ESTATES, ACCRA', '834', 0, 'PROFESSIONAL', '', 'HD CONSULT', '', '', 'HERBERT.DJABA@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(149, 'NUTEPE', 'TUDZI', 'FUI KOFI', '19/06/1981', '244972260', '', 'LASHIBI, VIVIAN FARM, TEMA COMMUNITY 17', '', 'C/O ASSOCIATED CONSULTANTS LIMITED, P. O. BOX M259 ACCRA', '1550', 0, 'PROFESSIONAL', '', 'ASSOCIATED CONSULTANTS LTD', '', '', 'KENTUDZI@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(150, 'SAMUEL', 'OPPONG-ANTWI', '', '30/05/1958', '0209977876,  0244211', '', 'ASHALE BOTWE, ACCRA', '', 'P. O. BOX CT 4385, CANTONMENTS-ACCRA', '415', 0, 'PROFESSIONAL', '', 'SURVEY & MAPPING DIVISION, LANDS COMMISSION', '', '', 'SAMOPANT@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(151, 'ERIC', 'AMAKYI-BOATENG', '', '23/07/1980', '0208447283/027435877', '', 'NO. 14 KWASHIBU OPPOSITE PRINCE OF PEACE ROMAN CAT', '', 'P. O. BOX ML 121 MALLAM-ACCRA', '1710', 0, 'PROFESSIONAL', '', 'LAKESIDE ESTATE LTD', '', '', 'EAMAKYI@YAOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(152, 'SALIHU', 'MADAH', 'ISMAIL', '10/03/1982', '208909204', '', 'WA', '', 'BOX 329  WA UWR', '1312', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION', '', '', 'MSISALIHU@YAHOO.COM', 'UPPER WEST', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(153, 'ERIC', 'MENSAH-OKANTEY', 'NII OKANTEY', '27/05/1967', '244637005', '', 'WEST END', '', 'BOX CT 7288 CANTONMENT', '842', 0, 'PROFESSIONAL', '', 'SURVEY & MAPPIND', '', '', 'EROKANTEY@GMAIL.COM', 'CENTRAL', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(154, 'IAN', 'AKOTO', 'CECIL MAWULI', '08/12/1993', '0501426384/054993119', '', 'PARADISE LODGE, KOTIE-KUMASI', '', 'P.O.BOX 186, OBUASI MUNICIPAL', '0', 0, 'STUDENT', '', 'KNUST', '', '', 'IANCECILAKOTO@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(155, 'KOFI', 'ADJEI', 'ABABIO', '12/01/1988', '207057257', '', '210 UCOMS ROAD, NEW APLAKU, ACCRA', '', 'P. O. BOX 1809, KUMASI', '0', 0, 'PROFESSIONAL', '', 'BASELINE SOLUTIONS LIMITED', '', '', 'ABABIOK@YMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(156, 'DA-COSTA', 'ASARE', 'BOAKYE MENSAH', '19/07/1992', '543569211', '', 'PLT 11/E NKETIA, ATWIMA NWABIAGYA', '', 'DEPT. OF GEOMATIC ENG. PMB KNUST', '0', 0, 'STUDENT', '', 'KNUST', '', '', 'DACOSTAASARE73@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(157, 'IVY', 'SOSA', 'ASEYE', '', '208857449', '', 'ABEKA', '', 'P.O.  BOX 137, MADINA', '1613', 0, 'PROFESSIONAL', '', 'JOEAMAH GEOMATICS CONSULT', '', '', 'ASTRABABE30@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(158, 'CLEMENCE', 'ANYAH', 'RICHARD KOFI', '16/03/2018', '246969142', '', 'EAST LEGON ADJIRINGANOR', '', 'P.O.BOX DT 2530 ADENTA', '31', 0, 'LICENSED', '', 'PURE SURVEYING SERVICES', '', '', 'CRKANYAH@GMAIL.CON', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(159, 'MERCY', 'ACHEAMPONG', 'OBENEWAH', '17/04/1971', '283', '', 'MALLAM-GBAWE-BULEMIN', '', 'BOX OD 435 ODORKOR ACCRA', '705', 0, 'LICENSED', '', 'C.T.K NETWORK & ROKMER', '', '', 'MERCYDECKER@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:44', '1', '64'),
(160, 'BENEDICTA', 'REINARH', 'DEDE BARKEY', '', '244972184', '', 'ASHIYIE', '', 'P.  O. BOX CT 228, CANTONMENTS - ACCRA', '1029', 0, 'PROFESSIONAL', '', 'PETROLEUM COMMISSION', '', '', 'BTAMATEY@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(161, 'SAMUEL', 'DARKO', 'LARBI', '20/05/1959', '202110138', '', '13 YASMINE PLACE TRASSACO', '', 'CT 262 CANTONMENTS ACCRA', '288', 0, 'LICENSED', '', 'LOSAMILLS CONSULT LTD', '', '', 'SLDARKO@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(162, 'JANET', 'BAFFOUR-AWUAH', '', '26/06/1985', '243855699', '', '#B156/14 OUTER RING ROAD', '', 'P O BOX KN5651, KANESHIE-ACCRA', '17', 0, 'PROFESSIONAL', '', 'QUEST CONSOLIDATED LIMITED', '', '', 'JANEBAWUAH@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '83'),
(163, 'WILLIE', 'AMADI', 'YEBOAH', '02/01/1987', '243154147', '', 'ABURI', '', 'BOX 15466 ACCRA NORTH', '1709', 0, 'PROFESSIONAL', '', 'DE-MAPPERS LTD', '', '', 'AMADIWILLY@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(164, 'KWAME', 'ASANTE', 'NKANSAH', '01/02/2018', '241397217', '', 'ASHALEY BOTWE NO 6 SLATER ROAD', '', 'GP 17641, ACCRA', '0', 0, 'PROFESSIONAL', '', 'COMPTRAN ENGINEERING AND PLANNING ASSOCIATE', '', '', 'KANKWAME@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(165, 'EDNA', 'KURUGU', 'ANTHOINETTE AKIWELEI', '02/01/1993', '545580806', '', 'BOLGATANGA', '', '', '0', 0, 'PROFESSIONAL', '', 'MYTURN', '', '', 'EKURUGU@GMAIL.COM', 'UPPER EAST', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(166, 'JEAN', 'DOTSE', '', '16/03/2018', '0244657987/020149257', '', 'HOUSE NO. 141HALLELUJA JUN?TION WEST ADENTA', '', 'BOX 10227,ACCRA NORTH', '172', 0, 'LICENSED', '', 'PENSIONER', '', '', 'JEANDOTSE@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(167, 'AIDEN', 'BAYOR', '', '30/11/1989', '241728344', '', 'BAGABAGA LOWCOST, 30B, TAMALE.', '', 'P. O. BOX 4, TAMALE.', '0', 0, 'PROFESSIONAL', '', 'LOGISTICS SUPPORT SERVICES', '', '', 'JAITHEO7@GMAIL.COM', 'NORTHERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(168, 'CYRIL', 'OPPONG-YEBOAH', '', '29/06/1988', '208337363', '', 'V1/8 BERLIN-TOP, FIAPRE SUNYANI', '', 'BOX 1508, SUNYANI', '1699', 0, 'PROFESSIONAL', '', 'DESIMONE GHANA LTD.', '', '', 'COY.GOAL@GMAIL.COM', 'BRONG AHAFO', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(169, 'FRANCIS', 'OPPONG', '', '19/08/1967', '244170300', '', 'PRESTEA', '', 'POST OFFICE BOX 30 PRESTEA', '1234', 0, 'PROFESSIONAL', '', 'GOLDEN STAR GHANA', '', '', 'FOPPONGK@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(170, 'WILLIAMS', 'ODURO', '', '25/05/1988', '542768606', '', 'KUMASI', '', '', '0', 0, 'PROFESSIONAL', '', 'CHUCATEL COMPANY LIMITED', '', '', 'WILLIAMSODURO10@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(171, 'EMMANUEL', 'KISSI', 'SOMUAH', '25/12/1982', '244988252', '', 'GHANA POST : GD 224 -7722', '', 'P. O. BOX 3506, ACCRA', '1035', 0, 'LICENSED', '', 'ALLIANCE SURVEYING LIMITED', '', '', 'SOMUAHKISSI@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(172, 'ERIC', 'HELOO', '', '08/11/1981', '244541754', '', 'MC02, MARK CUTIFANI ESTATE, MILE 1, TARKWA', '', 'P. O. BOX 284', '1611', 0, 'PROFESSIONAL', '', 'ANGLOGOLD ASHANTI IDUAPRIEM LTD', '', '', 'EHELOO@ANGLOGOLDASHANTI.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(173, 'GODFRED', 'ADDAI', '', '07/08/1990', '272118148', '', 'P. O. BOX 5399 ADUM KUMASI', '', '', '0', 0, 'PROBATIONER', '', 'HEILAND RESOURCES LIMITED', '', '', 'QUABENA007@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(174, 'ERNEST', 'EKUBAN', '', '30/04/2018', '243983924', '', '30 TESANO ROAD', '', '', '1723', 0, 'PROFESSIONAL', '', 'INTEL E-GEO LIMITED', '', '', 'ERNEKUBAN@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(175, 'PRINCE', 'AMOH', '', '26/06/1986', '245917177', '', 'BRENUAKYIM AMA SAAH STREET1', '', 'AGL PO BOX 208 TARKWA', '0', 0, 'PROFESSIONAL', '', 'GOLDFIELDS GHANA,DAMAG', '', '', 'AMOHP@ROCKETMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(176, 'CONFIDENCE', 'ANYORMI', '', '14/02/1988', '+233245155568', '', 'TARKWA', '', 'PMB, TARKWA', '0', 0, 'PROFESSIONAL', '', 'GOLDEN STAR WASSA LTD', '', '', 'CANYORMI@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(177, 'OBED', 'OWUSU-MENSAH', '', '25/07/1992', '501358762', '', 'AK/OT/087', '', 'P.O.BOX 17', '0', 0, 'PROFESSIONAL', '', 'GOLDEN STAR WASSA MINES', '', '', 'OBEDOWUSU801@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(178, 'ISAAC', 'ANSAH', '', '18/10/1975', '244768757', '', 'CAPE COAST', '', 'P O BOX CC 43 CAPE COAST', '1732', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION', '', '', 'ANSTECHCONSULT@GMAIL.COM', 'UPPER EAST', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(179, 'EBO', 'KOOMON', '', '17/06/1986', '276291282', '', 'TAKORADI', '', 'SK 516,SAKUMONO ESTATES, TEMA', '1311', 0, 'PROFESSIONAL', '', 'AYA ENGINEERING', '', '', 'EBOKOOMSON2003@YAHOO.CO.UKK', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(180, 'MICHAEL', 'DORDOR', 'ENAM', '09/05/1968', '244788230', '', 'GREDA ESTATES, TESHIE, ACCRA', '', 'BOX CT 1646, ACCRA', '664', 0, 'LICENSED', '', 'BASELINE SOLUTIONS LTD', '', '', 'MDORDOR@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(181, 'ALEXANDER', 'OWUSU ANSAH', '', '08/07/1989', '249343157', '', 'P.O.BOX KS 15416, ADUM - KUMASI,', '', '', '0', 0, 'TECHNICIAN', '', 'MR', '', '', 'AS.OWUSUANSAH@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(182, 'ABIGAIL', 'QUAYE', 'AYELEY', '05/05/1981', '244449925', '', 'MANCHIE', '', 'P.O.BOX CT 8544 ,CANTONMENTS  ACCRA', '1724', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION (SMD)', '', '', 'ABBY.QUAYE@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64');
INSERT INTO `members` (`members_id`, `first_name`, `last_name`, `other_name`, `dob`, `personal_contact`, `emergency_contact`, `house_number`, `house_location`, `postal_address`, `professional_number`, `year_elected`, `surveyor_type`, `designation`, `company_name`, `company_type`, `company_contact`, `corporate_email`, `region`, `office_location`, `company_address`, `current_balance`, `committes`, `date_done`, `division`, `user_id`) VALUES
(183, 'PRINCE', 'AMPONSAH', '', '04/09/1985', '+233246139520', '', 'AK-334-8789', '', 'P. O. BOX KJ 443, KUMASI', '1739', 0, 'PROFESSIONAL', '', 'CHIRANO GOLDMINE LIMITED', '', '', 'PRINCEKWABENAAMPONSAH@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(184, 'MICHAEL', 'ADUAH', 'S', '', '249447799', '', 'TARKWA', '', '', '1674', 0, 'PROFESSIONAL', '', 'GEOMATIC ENGINEERING DEPT, UMAT', '', '', 'MSADUAH@MAT.EDU.GH', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(185, 'JONATHAN', 'QUAYE-BALLARD', 'ARTHUR', '16/09/2018', '277474073', '', 'DEPARTMENT OF GEOMATIC ENG., KNUST', '', '13422, ADUM, KUMASI', '975', 0, 'PROFESSIONAL', '', 'KNUST', '', '', 'QUAYEBALLARD@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(186, 'FREDERICK', 'BEDIAKO-MENSAH', '', '19/09/1974', '+233244642294', '', 'CODE: GW-0299-7313; ADDRESS: KWABENYA-POKUASE ROAD', '', 'P. O. BOX CT5936, ACCRA', '919', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION/GSSM', '', '', 'FBEDMESH@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(187, 'JOSEPH', 'OKAE', 'KWESI', '16/03/1943', '249459449', '', 'NO ONE  PAWPAW STREET, EASTLEGON ACCRA', '', 'P.O.BOX CT 39 CANTOMENTS, ACCRA', '94', 0, 'LICENSED', '', 'GHANA INSTITUTION OF SURVEYORS', '', '', 'JOSEPHKOKAEGMAIL.COM', 'VOLTA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(188, 'JOSEPH', 'OKAE', 'KWESI', '16/03/1943', '249459449', '', 'NO ONE PAWPAW STREET, EASTLEGON ACCRA', '', 'P.O.BOX CT 39 CANTOMENTS, ACCRA', '94', 0, 'LICENSED', '', 'GHANA INSTITUTION OF SURVEYORS', '', '', 'JOSEPHKOKAE@GMAIL.COM', 'VOLTA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(189, 'CHRISTIAN', 'OTU', 'TETTEH', '24/04/1957', '244012027', '', 'BLUE HOSTEL/MIOTSO', '', 'P. O. BOX  CE 11657, TEMA', '342', 0, 'LICENSED', '', 'HYDROLAND SURVEYS', '', '', 'CHRISOTUY@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(190, 'FRANKLIN', 'LIGGIE-KUDONOO', '', '02/10/1971', '240259270', '', 'PLOT 25 NII ASOYI I ROAD MEMPEASEM', '', 'BOX MD 137 MADINA', '1323', 0, 'PROFESSIONAL', '', 'JOEAMAH GEOMATICS CONSULT LIMITED', '', '', 'FKLIGGIE@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(191, 'JOSEPH', 'ESSAH', 'BAIDEN', '22/11/1977', '205165545', '', 'ADJIRINGANOR, ACCRA', '', 'KN 3677, KANESHIE-ACCRA', '1313', 0, 'PROFESSIONAL', '', 'SURVEYWORLD COMPANY LIMITED', '', '', 'EAJOBDD@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(192, 'BEN', 'CAIQUO', 'BRIGHT', '21/07/1985', '245804452', '', '18A GRADE ONE BOGOSO', '', 'P O BOX LS 836 SEKONDI', '0', 0, 'PROBATIONER', '', 'GOLDEN STAR RESOURCES', '', '', 'BCBENLOT@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(193, 'SAMUEL', 'DANSO', 'OFOSU', '29/09/2018', '202853550', '', 'TARKWA', '', 'POBOX 208, TARKWA', '0', 0, 'PROFESSIONAL', '', 'GOLDFIELDS GHANA LTD', '', '', 'SAMUELODANSO@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(194, 'ONESIMUS', 'GYAPONG', 'YEBOAH', '03/04/1993', '240158749', '', 'BOGOSO,B-LINE D10', '', 'BOX 77 BOGOSO', '0', 0, 'OTHER', '', 'GOLDEN STAR RESOURCES', '', '', 'GONISMOUS@YAHOO.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(195, 'NATHAN', 'SAGOE', 'WINFRED OBENG', '08/04/1989', '543024730', '', 'LAWSON PLAZA, ARENA, ACCRA CENTRAL', '', 'BOX 3355, OSU', '0', 0, 'PROFESSIONAL', '', 'MOB CONSULT', '', '', 'NATHANSAGOE@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:45', '1', '64'),
(196, 'FRANKIE', 'BONYE-KANCHINEE', '', '01/09/1992', '541848902', '', 'WEIJA', '', '', '0', 0, 'PROFESSIONAL', '', 'LANDS COMMISSION', '', '', 'FRANKIEILOCC@GMAIL.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(197, 'GEORGE', 'DORDAH', 'ALEXANDER', '28/03/1980', '203767213', '', 'X2&3, CATERING BOLGATANGA', '', 'BOX 87, BOLGATANGA', '1314', 0, 'PROFESSIONAL', '', 'BOLGATANGA POLYTECHNIC', '', '', 'GADORDAH@GMAIL.COM', 'UPPER EAST', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(198, 'PATRICK', 'APENKWAH', 'KORANKYE', '', '240738002', '', 'NO. 22 LABADI VILLAS, BURMA CAMP', '', 'P. O. BOX OS 2204, OSU, ACCRA.', '1038', 0, 'LICENSED', '', 'GHANA ARMED FORCES', '', '', 'PATRICKAPK@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(199, 'ANTHONY', 'NUVOR', 'YAOVI', '01/02/1968', '244640828', '', 'LAKESIDE ESTATES, ASHALEY BOTWE', '', 'BOX 71, ADOAGYIRI-NSAWAM', '1041', 0, 'LICENSED', '', 'RAY GLOBAL ASSOCIATES LTD', '', '', 'TONYNUVOR@GMAIL.COM', 'EASTERN', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(200, 'SAMUEL', 'AHENKORAH', 'OFOSU', '02/05/1979', '244560294', '', 'PANTANG EAST, NEAR FOCUS HOSPITAL', '', 'P .O. BOX 830 SUNYANI, BRONG AHAFO REGION', '1706', 0, 'PROFESSIONAL', '', 'SURVEY & MAPPING DIVISION, LANDS COMMISSION', '', '', 'SAMMYFOSU@YMAIL.COM', 'BRONG AHAFO', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(201, 'EMMANUEL', 'AKROFI', 'OFFEI', '16/09/1960', '244895832', '', 'PLOT 52 BLK C, EKYEM, KUMASI', '', 'P.O. BOX UP1442, KNUST, KUMASI', '987', 0, 'LICENSED', '', 'KNUST', '', '', 'EOFFEIAKROFI@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(202, 'JUSTICE', 'OFOSU', '', '', '242171686', '', 'HNO 51 NORTH AGRIC HILL, TARKWA', '', '', '0', 0, 'PROFESSIONAL', '', 'MAXMASS LTD', '', '', 'NHYIRABAOFOSU@GMAIL.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(203, 'DESMOND', 'YANKSON', 'EGYIRE', '16/11/1989', '0508212508/050247336', '', 'TEMA COMM 3', '', 'C/O DIANA EPHRAIM,GBC P.O BOX 1633, KANDA-ACCRA', '0', 0, 'PROBATIONER', '', 'TRASACCO ESTATE DEVELOPMENT COMPANY LTD', '', '', 'DESMONDYANKSON@YAHOO.COM', 'GREATER ACCRA', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(204, 'KWADWO', 'AKOTO', 'OPPONG', '06/02/1989', '207935189', '', 'DANSOMAN, ACCRA', '', 'P. O. BOX DS 221, DANSOMAN ,ACCRA', '0', 0, 'PROBATIONER', '', 'HIGH BRAINS LIMITED', '', '', 'KWADWOAKOTO@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(205, 'RICHFIELD', 'OHEMENG', 'YAW', '12/06/1986', '207614443', '', 'TAKORADI', '', 'P. O. BOX TD 60', '0', 0, 'PROFESSIONAL', '', 'BRIGHT STAR SURVEYS', '', '', 'RYOHEMENG@YAHOO.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(206, 'EMMANUEL', 'NKEBI', 'KOFI', '09/10/1953', '209894978', '', 'HOUSE NO. 92T, ADIEMBRA. SEKONDI', '', 'BOX MC 2411, TAKORADI', '808', 0, 'LICENSED', '', 'BRIGHTSTAR SURVEYS LTD', '', '', 'EKNKEBI@YAHOO.COM', 'WESTERN', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(207, 'DA-COSTA', 'ASARE', 'BOAKYE MENSAH', '19/07/1992', '543569211', '', 'PLT 11BLK E NKETIA', '', 'GEOMATIC ENGINEERING DEPARTMENT, KNUST - PMB', '0', 0, 'TRAINEE', '', 'KNUST', '', '', 'DACOSTAASARE73@GMAIL.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:46', '1', '64'),
(208, 'LINDA', 'ABOSI', 'ADWOA', '14/04/1980', '244528955', '', 'OSEI TUTU SHS, BUNGALOW 14B', '', 'C/O SAMUEL ABOSI, OSEI TUTU SHS, PMB, AKROPONG-ASHANTI', '1436', 0, 'PROFESSIONAL', '', 'SURVEY AND MAPPING DIVISION', '', '', 'LINDA.ABOSI@YAHOO.COM', 'ASHANTI', '', '', '500', '', '2019-03-23 23:09:46', '1', '64');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message_group` varchar(10) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `message_receivers` text NOT NULL,
  `message_subject` varchar(200) NOT NULL,
  `message_content` text NOT NULL,
  `message_mode` varchar(10) NOT NULL,
  `message_status` varchar(10) NOT NULL,
  `record_hide` varchar(10) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message_group`, `message_sender`, `message_receivers`, `message_subject`, `message_content`, `message_mode`, `message_status`, `record_hide`, `date_done`) VALUES
(2, 'all', 57, '[\"56\",\"59\",\"58\",\"55\",\"54\",\"51\"]', 'TEST SUBJECT', '<pre>Dear sir,\r\nthis is uit</pre>', 'SENT', 'NEW', 'NO', '2019-03-21 15:45:15'),
(3, 'group', 57, '[\"57\"]', 'asdf', '<pre>asdf</pre>', 'SENT', 'NEW', 'NO', '2019-03-22 04:39:14'),
(4, 'all', 57, '[\"56\",\"58\",\"44\"]', 'To general people', '<pre>This is the message content for obia</pre>', 'SENT', 'NEW', 'NO', '2019-03-22 04:52:23'),
(5, 'group', 57, '[\"57\"]', 'This is another one', '<pre>Hello,\r\n         This is another one\r\n                                         bye!\r\n</pre>', 'SENT', 'NEW', 'NO', '2019-03-22 05:06:21'),
(6, 'group', 56, '[\"56\"]', 'NO PRE', 'Hi THERE,\r\n                THERE is \r\n                                no pre\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nsincerely,\r\n\r\n', 'SENT', 'NEW', 'NO', '2019-03-23 23:45:57'),
(7, 'all', 73, '[\"56\"]', '08-05-2019', 'This is the messages sent for testing on today', 'SENT', 'NEW', 'NO', '2019-05-08 23:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_title` varchar(200) NOT NULL,
  `news_category` varchar(50) NOT NULL,
  `news_content` text NOT NULL,
  `folder_name` varchar(100) NOT NULL,
  `file_name` text DEFAULT NULL,
  `made_by` varchar(10) NOT NULL,
  `division` varchar(20) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_category`, `news_content`, `folder_name`, `file_name`, `made_by`, `division`, `date_done`) VALUES
(13, 'Unlicensed Group Deceives California Property Owners', 'general', '<p><em>This article is being reprinted by permission of the original author, Ric Moore, and theBoard for Professional Engineers,</em><em>Land Surveyors, and Geologists (BPELSG).</em></p>\r\n\r\n<p><a href=\"http://www.bpelsg.ca.gov/\" target=\"_blank\">BPELSG</a>, with the help of several licensees, has investigated and monitored the activities associated with a small group of unlicensed individuals in the Southern California region who have deceived multiple property owners by representing themselves as legitimately authorized to perform land surveying services and providing those services in a manner that directly fails to meet the standards which the public can rely upon. While initially successful with disciplining the couple of licensees that were formally aiding and abetting the unlicensed practice, BPELSG has spent considerable effort and expense over the last several years towards investigating these unlicensed individuals.</p>\r\n\r\n<p>This group has changed company names several times while maintaining a core group of individuals that are not authorized to practice in this manner. BPELSG has multiple investigations in progress on these individuals and continue to try and work with the Attorney General&rsquo;s office on these matters. BPELSG has traveled and met with local law enforcement agencies and local offices of state investigation services seeking assistance only to be turned away with limited or no support due to various reasons.</p>\r\n\r\n<p>Recently, we began receiving reports that these individuals have changed their tactics and are now allegedly representing themselves, falsely and without authorization, as legitimately licensed practitioners and the firms that these practitioners are employed by. These reports are more alarming due to the increased nature of deception being employed towards harming the health, safety, and welfare of the public not to mention the reputation of the legitimate licensed practitioners and firms that strive to serve the citizens of California.</p>\r\n\r\n<p>BPELSG strongly recommends that each licensee and engineering or land surveying firm immediately confirm the security of your license and how your firm is currently portrayed to the public. This may come in the form of receiving calls from individuals that state that you or your firm has performed work for them recently and these individuals or the properties are unknown to you. There are even reports of monuments being tagged with the license number of a legitimate licensee without their knowledge and not under their responsible supervision.</p>\r\n\r\n<p>If you or your firm believes your name, license, or firm name has been compromised and falsely represented as performing land surveying services, BPELSG recommends that you immediately contact your local law enforcement for support and advice. In addition, the more incidents that BPELSG is made aware of, the more likely it is for BPELSG to convince local law enforcement and state investigations that this is a real problem that needs attention. BPELSG is here to assist the public, the licensee, and local enforcement in any way we can in this matter. If you have any questions or wish to alert BPELSG of an incident that you are aware of, please send a quick email with contact information to&nbsp;<a href=\"mailto:BPELSG.Enforcement.Information@dca.ca.gov\">BPELSG.Enforcement.Information@dca.ca.gov</a></p>\r\n\r\n<p>Thank you</p>\r\n', '12-10-20184103', '[\"unlicended1.jpg\",\"unlicended2.jpg\",\"unlicended3.png\"]', '41', '', '2018-12-10 11:41:03'),
(14, 'ALLOCATE LANDS TO FULANI HERDSMEN &#38;amp;#38;ndash; GHANA SURVEYORS', 'general', '<p>The Ghana Institute of Surveyors is advocating for nomadic Fulani herdsmen to be given their own land as a solution to tensions between them and and local farmers.<br />\r\nThe activities of Fulani herdsmen have led to clashes between them and some local communities, where&nbsp; they operate, leading to the loss of lives and destruction of property.</p>\r\n\r\n<p><br />\r\n<br />\r\nSpeaking at the 11th Surveyors week and 47th annual General meeting, the President of the Ghana Institute of Surveyors, Ekow Budu-Anugah, suggested that herdsmen must be given a separate land in the areas they operate.<br />\r\n<br />\r\n&ldquo;We are saying that the Fulani issue is worrying to Ghanaians and that we don&rsquo;t have to lose the crops that they need, and we don&rsquo;t have to lose the meat that they bring, so we don&rsquo;t have to kill the cows or hurt them. We should find an amicable solution to this problem. That is why we are saying that, they must try to give them land for grazing and land for farming,&rdquo; he added.<br />\r\nMr. Budu-Anugah also recommended that the Districts consider registering the Fulani herdsmen to better regulate their activities.<br />\r\nGive Fulani herdsmen ranches &ndash; Hannah Bissiw<br />\r\nThe suggestion by the Ghana Institute of Surveyors, is similar to a proposal by the Deputy Minister for Food and Agriculture, Dr. Hannah Bissiw.<br />\r\nDr. Hannah Bissiw, a veterinary doctor, has already proposed the establishment of a permanent cattle ranch as the solution to the problem.<br />\r\nThe Deputy Minister&rsquo;s comments are also in line with that of Security analyst, Dr. Kwesi Anning, pointed out that in 1986, Ghana was a member of an ECOWAS team which agreed that there should be regulations on trans-human movement that characterizes the Fulani nomadic lifestyle.<br />\r\nThe Ghana National Association of Cattle Farmers also proposed the enactment of specific bye-laws to regulate the activities of Fulani herdsmen, which will by extension address various conflicts between them and locals around the country.<br />\r\n&ndash;<br />\r\nBy Delali Adogla-Bessa/citifmonline.com/Ghana</p>\r\n', '12-10-20184142', '[\"fulani1.jpg\",\"fulani2.jpg\",\"fulani3.jpg\",\"IMG-20140514-WA0001.jpg\"]', '41', '', '2018-12-10 11:41:42'),
(15, 'test', 'general', '<p>testing</p>\r\n', '12-11-20181459', '[\"Desert.jpg\",\"Jellyfish.jpg\"]', '41', '', '2018-12-11 21:14:59'),
(16, 'News From Around the World', 'general', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n', '08-14-20195901', '[\"561480_383146661762492_1136315275_n.jpg\",\"IMG-20130322-WA0001.jpg\"]', '64', '', '2019-08-14 10:59:01'),
(18, 'This is te progess bar testirng', 'general', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n', '08-14-20193440', '[\"18149.jpg\",\"1398423101531.jpg\"]', '64', '', '2019-08-14 13:34:40'),
(20, 'sdfghjkl', 'general', '<p><strong>aafsafasdfsasdsd</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>sfdghjk</td>\r\n			<td>1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>hjbnm</td>\r\n			<td>2</td>\r\n		</tr>\r\n		<tr>\r\n			<td>ghjkl</td>\r\n			<td>3</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n', '08-14-20191819', '[\"WIN_20190624_15_45_33_Pro.jpg\",\"302669_437437119648133_768500914_n.jpg\",\"Da-Vinci-Great-Works_Mona-Lisa.jpg\",\"1398369255150.jpg\"]', '64', '1', '2019-08-14 14:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `new_application`
--

CREATE TABLE `new_application` (
  `new_application_id` int(11) NOT NULL,
  `application_division` varchar(100) NOT NULL,
  `application_code` varchar(100) NOT NULL,
  `application_stage` varchar(15) NOT NULL,
  `folder_name` varchar(100) NOT NULL,
  `files_subject` text NOT NULL,
  `files_name` text NOT NULL,
  `college_email` varchar(100) NOT NULL,
  `employer_email` varchar(100) NOT NULL,
  `application_startDate` varchar(20) NOT NULL,
  `col_instructor_title` varchar(10) NOT NULL,
  `col_instruct_fullname` varchar(200) NOT NULL,
  `col_name` varchar(100) NOT NULL,
  `col_stu_startDate` varchar(20) NOT NULL,
  `col_competence_div` varchar(50) NOT NULL,
  `col_principal_name` varchar(100) NOT NULL,
  `col_principal_profNum` varchar(10) NOT NULL,
  `col_declare_date` varchar(50) NOT NULL,
  `emp_com_name` varchar(100) NOT NULL,
  `emp_com_loc` text NOT NULL,
  `emp_tel` varchar(30) NOT NULL,
  `emp_tec_division` varchar(50) NOT NULL,
  `emp_stu_branch` varchar(100) NOT NULL,
  `com_trianer_name` varchar(100) NOT NULL,
  `emp_trianer_profNum` varchar(10) NOT NULL,
  `emp_declare_date` varchar(20) NOT NULL,
  `member_declare_id` int(11) NOT NULL,
  `member_declare_note` text NOT NULL,
  `member_declare_date` varchar(100) NOT NULL,
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `app_accept_status` varchar(20) NOT NULL,
  `app_assigned_profnum` varchar(10) NOT NULL,
  `app_accept_reason` text NOT NULL,
  `app_accept_date` varchar(20) NOT NULL,
  `app_accept_user_id` int(11) NOT NULL,
  `record_hide` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pages_id` int(11) NOT NULL,
  `pages_name` varchar(100) NOT NULL,
  `pages_url` text NOT NULL,
  `page_file_name` varchar(200) NOT NULL,
  `division` varchar(20) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pages_id`, `pages_name`, `pages_url`, `page_file_name`, `division`, `date_done`) VALUES
(5, 'News Setup', '<li><a href=\"admin_news.php\" class=\"waves-effect\"><i class=\"fa fa-newspaper-o fa-fw\" aria-hidden=\"true\"></i>News Setup</a></li>', 'admin_news.php', '1', '0000-00-00 00:00:00'),
(6, 'Member Profile', '<li><a href=\"profile.php\" class=\"waves-effect\"><i class=\"fa fa-user fa-fw\" aria-hidden=\"true\"></i>Profile</a></li>', 'profile.php', '1', '0000-00-00 00:00:00'),
(7, 'Events Register', '<li><a href=\"event_register.php\" class=\"waves-effect\"><i class=\"fa fa-calendar fa-fw\" aria-hidden=\"true\"></i>Events Register</a></li>', 'event_register.php', '1', '0000-00-00 00:00:00'),
(8, 'Members Setup', '<li><a href=\"admin_members.php\" class=\"waves-effect\"><i class=\"fa fa-users fa-fw\" aria-hidden=\"true\"></i>Members Setup</a></li>', 'admin_members.php', '1', '0000-00-00 00:00:00'),
(9, 'Actors Setup', '<li><a href=\"admin_users.php\" class=\"waves-effect\"><i class=\"fa fa-user fa-fw\" aria-hidden=\"true\"></i>Actors Setup</a></li>', 'admin_users.php', '1', '0000-00-00 00:00:00'),
(10, 'Wallet', '<li><a href=\"wallet.php\" class=\"waves-effect\"><i class=\"fa fa-credit-card fa-fw\" aria-hidden=\"true\"></i>Wallet</a></li>', 'wallet.php', '1', '0000-00-00 00:00:00'),
(11, 'Pages Setup', '<li><a href=\"super_pages.php\" class=\"waves-effect\"><i class=\"fa fa-file-text fa-fw\" aria-hidden=\"true\"></i>Pages Setup</a></li>', 'super_pages.php', '3', '0000-00-00 00:00:00'),
(12, 'Groups Setup', '<li><a href=\"admin_groups.php\" class=\"waves-effect\"><i class=\"fa fa-users fa-fw\" aria-hidden=\"true\"></i>Groups Setup</a></li>', 'admin_groups.php', '1', '0000-00-00 00:00:00'),
(13, 'Surveyor type Setup', '<li><a href=\"admin_surveyor_type.php\" class=\"waves-effect\"><i class=\"fa fa-user fa-fw\" aria-hidden=\"true\"></i>Surveyor type Setup</a></li>', 'admin_surveyor_type.php', '1', '0000-00-00 00:00:00'),
(17, 'Contributions Setup', '<li><a href=\"admin_contributions.php\" class=\"waves-effect\"><i class=\"fa fa-money fa-fw\" aria-hidden=\"true\"></i>Contributions Setup</a></li>', 'admin_contributions.php', '1', '2018-11-21 14:05:32'),
(19, 'News', '<li><a href=\"news.php\" class=\"waves-effect\"><i class=\"fa fa-newspaper-o fa-fw\" aria-hidden=\"true\"></i>News</a></li>', 'news.php', '1', '2018-11-22 14:18:33'),
(20, 'Annual Subscription Setup', '<li><a href=\"admin_user_dues.php\" class=\"waves-effect\"><i class=\"fa fa-money fa-fw\" aria-hidden=\"true\"></i>Subscription Setup</a></li>', 'admin_user_dues.php', '1', '2018-11-22 15:55:28'),
(21, 'Users Payments', '<li><a href=\"payments.php\" class=\"waves-effect\"><i class=\"fa fa-money fa-fw\" aria-hidden=\"true\"></i>Payments</a></li>', 'payments.php', '1', '2018-11-27 09:01:56'),
(22, 'Event Setup', '<li><a href=\"admin_events.php\" class=\"waves-effect\"><i class=\"fa fa-calendar fa-fw\" aria-hidden=\"true\"></i>Event Setup</a></li>', 'admin_events.php', '1', '2018-11-28 00:16:01'),
(24, 'Sms Broadcast', '<li><a href=\"admin_broadcast_sms.php\" class=\"waves-effect\"><i class=\"fa fa-comment fa-fw\" aria-hidden=\"true\"></i>Broadcast Sms</a></li>', 'admin_broadcast_sms.php', '3', '2018-12-10 20:11:44'),
(25, 'New Registration', '<li><a href=\"applicant_registrationa.php\" class=\"waves-effect\"><i class=\"fa fa-check-square-o fa-fw\" aria-hidden=\"true\"></i>New Registration</a></li>', 'applicant_registrationa.php', '3', '2019-02-04 19:24:55'),
(26, 'Students Setup', '<li><a href=\"students_setup.php\" class=\"waves-effect\"><i class=\"fa fa-users fa-fw\" aria-hidden=\"true\"></i>Student Setup</a></li>', 'students_setup.php', '3', '2019-02-24 12:58:57'),
(27, 'Student Pages', '<li><a href=\"student_profile.php\" class=\"waves-effect\"><i class=\"fa fa-user fa-fw\" aria-hidden=\"true\"></i>Applicant Profile </a></li>                     <li><a href=\"student_register.php\" class=\"waves-effect\"><i class=\"fa fa-list fa-fw\" aria-hidden=\"true\"></i>Register </a></li>                    <li><a href=\"applicant_registrationa.php\" class=\"waves-effect\"><i class=\"fa fa-check-square-o fa-fw\" aria-hidden=\"true\"></i>New Registration</a></li>', 'applicant_registrationa.php', '1', '2019-02-24 21:22:59'),
(28, 'Center Register', '<li><a href=\"examcenter_register.php\" class=\"waves-effect\"><i class=\"fa fa-users fa-fw\" aria-hidden=\"true\"></i>Registered Students</a></li>', 'examcenter_register.php', '1', '2019-03-03 10:42:55'),
(31, 'Messages', '<li><a href=\"messages.php\" class=\"waves-effect\"><i class=\"fa fa-comments fa-fw\" aria-hidden=\"true\"></i>Messages</a></li>', 'messages.php', '3', '2019-03-23 23:50:52'),
(32, 'Live Stream Setup', '<li><a href=\"admin_live_stream.php\" class=\"waves-effect\"><i class=\"fa fa-cog fa-fw\" aria-hidden=\"true\"></i>Live Stream Setup </a></li>', 'admin_live_stream.php', '3', '2019-03-23 23:53:12'),
(33, 'Live Stream Dashboard', '<li><a href=\"videoStream_dashboard.php\" class=\"waves-effect\"><i class=\"fa fa-eye fa-fw\" aria-hidden=\"true\"></i>Live Stream</a></li>', 'videoStream_dashboard.php', '3', '2019-03-23 23:53:34'),
(34, 'Divisional Library Setup', '<li><a href=\"admin_library.php\" class=\"waves-effect\"><i class=\"fa fa-cog fa-fw\" aria-hidden=\"true\"></i>Library SetUp </a></li>', 'admin_library.php', '3', '2019-03-30 03:07:42'),
(35, 'Members Library View', '<li><a href=\"library_archive.php\" class=\"waves-effect\"><i class=\"fa fa-book fa-fw\" aria-hidden=\"true\"></i>Library Archive</a></li>', 'library_archive.php', '3', '2019-03-30 03:08:18'),
(36, 'Session Logs', '<li><a href=\"admin_session_logs.php\" class=\"waves-effect\"><i class=\"fa fa-cogs fa-fw\" aria-hidden=\"true\"></i>Session Logs</a></li>', 'admin_session_logs.php', '3', '2019-04-04 12:40:14'),
(37, 'Proposer Declaration', '<li><a href=\"applicant_registrationd.php\" class=\"waves-effect\"><i class=\"fa fa-users fa-fw\" aria-hidden=\"true\"></i>Proposer Declaration </a></li>', 'applicant_registrationd.php', '3', '2019-04-10 12:27:08'),
(38, 'New Applicants Administration', '<li><a href=\"admin_application_approval.php\" class=\"waves-effect\"><i class=\"fa fa-file fa-fw\" aria-hidden=\"true\"></i>New Applications</a></li>', 'admin_application_approval.php', '1', '2019-04-12 00:50:39'),
(39, 'Committee Setup', '<li><a href=\"admin_committiee.php\" class=\"waves-effect\"><i class=\"fa fa-cog fa-fw\" aria-hidden=\"true\"></i>Committee Setup </a></li>', 'admin_committiee.php', '3', '2019-06-04 23:08:17'),
(40, 'Exams Setup', '<li><a href=\"examcenter_setup.php\" class=\"waves-effect\"><i class=\"fa fa-globe fa-fw\" aria-hidden=\"true\"></i>Exam Center Setup</a></li>', 'examcenter_setup.php', '1', '2019-07-11 23:14:30'),
(41, 'Member Committee', '<li><a href=\"committee.php\" class=\"waves-effect\"><i class=\"fa fa-users fa-fw\" aria-hidden=\"true\"></i>Committee</a></li>', 'committee.php', '1', '2019-07-11 23:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `sms_id` int(11) NOT NULL,
  `sms_code` varchar(20) NOT NULL,
  `sms_description` varchar(50) NOT NULL,
  `sms_reference` varchar(20) NOT NULL,
  `sms_message` text NOT NULL,
  `sms_destination` int(11) NOT NULL,
  `sms_record_id` varchar(20) NOT NULL,
  `division` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`sms_id`, `sms_code`, `sms_description`, `sms_reference`, `sms_message`, `sms_destination`, `sms_record_id`, `division`, `user_id`, `date_done`) VALUES
(1, '', '', '', 'Array', 0, '', 0, 0, '2019-04-01 12:36:43'),
(2, '', '', '', '{\"code\":\"000\",\"desc\":\"Operation successful.\",\"data\":{\"new_record_id\":176347970}}', 0, '', 0, 0, '2019-04-01 12:38:10'),
(3, '', '', '', '{\"code\":\"000\",\"desc\":\"Operation successful.\",\"data\":{\"new_record_id\":176361468}}', 0, '', 0, 0, '2019-04-01 13:45:51'),
(4, '', '', '', '\'{\"code\":\"000\",\"desc\":\"Operation successful.\",\"data\":{\"new_record_id\":176361641}}\'', 0, '', 0, 0, '2019-04-01 13:46:47'),
(5, '', '', '', '{\"code\":\"000\",\"desc\":\"Operation successful.\",\"data\":{\"new_record_id\":176892418}}', 0, '', 0, 0, '2019-04-03 15:25:15'),
(6, '', '', '', '{\"code\":\"000\",\"desc\":\"Operation successful.\",\"data\":{\"new_record_id\":176892422}}', 0, '', 0, 0, '2019-04-03 15:25:16'),
(7, '', '', '', '{\"code\":\"000\",\"desc\":\"Operation successful.\",\"data\":{\"new_record_id\":176892445}}', 0, '', 0, 0, '2019-04-03 15:25:17'),
(8, '', '', '', '{\"code\":\"000\",\"desc\":\"Operation successful.\",\"data\":{\"new_record_id\":176892487}}', 0, '', 0, 0, '2019-04-03 15:25:18'),
(9, '', '', '', '{\"code\":\"000\",\"desc\":\"Operation successful.\",\"data\":{\"new_record_id\":183116313}}', 209969656, '', 0, 64, '2019-05-09 12:07:17'),
(10, '', '', '', '{\"code\":\"000\",\"desc\":\"Operation successful.\",\"data\":{\"new_record_id\":183116376}}', 209969656, '', 1, 64, '2019-05-09 12:09:24'),
(11, '', '', '', '{\"code\":\"000\",\"desc\":\"Operation successful.\",\"data\":{\"new_record_id\":207579964}}', 209969656, '', 1, 64, '2019-07-15 06:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_title` varchar(6) NOT NULL,
  `student_first_name` varchar(100) NOT NULL,
  `student_last_name` varchar(100) NOT NULL,
  `student_dob` varchar(10) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `student_tel` varchar(11) NOT NULL,
  `student_emergency_tel` varchar(15) NOT NULL,
  `student_post_address` varchar(200) NOT NULL,
  `student_house_num` varchar(100) NOT NULL,
  `student_house_location` varchar(200) NOT NULL,
  `exam_center_id` int(11) NOT NULL,
  `record_hide` varchar(5) NOT NULL,
  `division` varchar(20) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_title`, `student_first_name`, `student_last_name`, `student_dob`, `student_email`, `student_tel`, `student_emergency_tel`, `student_post_address`, `student_house_num`, `student_house_location`, `exam_center_id`, `record_hide`, `division`, `date_done`) VALUES
(1, 'Miss', 'aasdf', 'asdf', '', 'aa@gmail.com', '234234', '', '', '', '', 3, 'NO', '1', '2019-02-22 15:48:17'),
(2, 'Mr', 'sorce', 'kwarteng', '', 'aa@gmail.com', '0547905169', '', '', '', '', 3, 'NO', '1', '2019-02-22 15:49:45'),
(3, 'Mrs', 'asdf', 'asdf', '', 'asdfa@gamil.com', '23423', '', '', '', '', 3, 'NO', '1', '2019-02-22 15:50:09'),
(4, 'Prof', 'adasd', 'asdfa', '', 'asf@gmail.com', '23432', '', '', '', '', 3, 'NO', '1', '2019-02-22 15:51:56'),
(5, 'Mr', 'account', 'testing', '', 'account@gmail.com', '020996567', '', '', '', '', 3, 'NO', '1', '2019-02-22 15:58:04'),
(6, 'Miss', 'work', 'working', '', 'wordking@gmail.com', '234234', '', '', '', '', 3, 'NO', '1', '2019-02-22 16:00:12'),
(7, 'Mrs', 'esther', 'darko', '', 'esthd@gmail.co', '234234', '', '', '', '', 3, 'NO', '1', '2019-02-24 09:40:50'),
(8, 'Mr', 'pen', 'pencil', '12-04-1993', 'pen@gmail.com', '234234', '', 'asdf', 'adsf', 'asdfasd', 3, 'NO', '1', '2019-02-24 17:19:01'),
(9, 'Mrs', 'belinda', 'ama', '', 'ama@gmail.com', '24543565434', '', '', '', '', 3, 'NO', '1', '2019-02-26 15:18:14'),
(10, 'Mrs', 'trainees', 'trainees', '', 'trainees@gmail.com', '92349238948', '', '', '', '', 3, 'NO', '1', '2019-03-03 17:15:13'),
(11, 'Mr', 'herb', 'herd', '', 'herd@gmail.com', '0202002', '', '', '', '', 3, 'NO', '1', '2019-04-03 00:25:26'),
(12, 'Mr', 'jake', 'wobill', '', 'jk@gmail.com', '0249455121', '', '', '', '', 3, 'NO', '1', '2019-04-05 14:44:23'),
(13, 'Mr', 'Ferdinand', 'Kwarteng', '', 'sorce100@gmail.com', '0209969656', '', '', '', '', 3, 'NO', '1', '2019-04-07 12:33:12'),
(14, 'Mr', 'ferdinand', 'kwarteng', '', 'sorce100@gmail.com', '0209969656', '', '', '', '', 3, 'NO', '1', '2019-04-07 12:35:51'),
(16, 'Mr', 'HERBERT', 'ADJARE', '', 'ah@gmail.com', '0209969656', '', '', '', '', 3, 'NO', '1', '2019-04-12 00:11:06'),
(20, 'Mr', 'merlin', 'merlin', '', 'merlin@gmail.com', '0209969656', '', '', '', '', 3, 'NO', '1', '2019-07-09 22:36:09'),
(21, 'Mr', 'esther', 'darko', '', 'esther@gmail.com', '0209969656', '', '', '', '', 3, 'NO', '1', '2019-07-09 22:37:04'),
(22, 'Dr', 'merlinww', 'sorceww', '', 'merlinSorce@gmail.comas', '02099696565', '', '', '', '', 3, 'NO', '3', '2019-07-15 06:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `surveyor`
--

CREATE TABLE `surveyor` (
  `surveyor_id` int(11) NOT NULL,
  `surveyor_type` varchar(100) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveyor`
--

INSERT INTO `surveyor` (`surveyor_id`, `surveyor_type`, `date_done`) VALUES
(1, 'LICENSED', '2019-03-23 22:17:25'),
(2, 'PROFESSIONAL', '2019-03-23 22:17:37'),
(3, 'STUDENT', '2019-03-23 22:17:46'),
(4, 'PROBATIONER', '2019-03-23 22:17:53'),
(5, 'TECHNICIAN', '2019-03-23 22:18:10'),
(6, 'OTHER', '2019-03-23 22:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `account_stage` varchar(10) NOT NULL,
  `member_id` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `reset_password` varchar(10) NOT NULL,
  `group_id` varchar(10) NOT NULL,
  `school_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `division` varchar(50) NOT NULL,
  `user_login_status` varchar(20) NOT NULL,
  `record_hide` varchar(10) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `account_type`, `account_type_id`, `account_stage`, `member_id`, `user_password`, `reset_password`, `group_id`, `school_id`, `status`, `division`, `user_login_status`, `record_hide`, `date_done`) VALUES
(44, 'school', 0, '', 'sms', '$2y$10$qVyLjNBfSGoCH2O..GGX9uwTS8chG.veMl1qOtqT9F7POI.vJPeAC', 'NO', '17', 0, 'ACTIVE', '1', 'OFFLINE', 'NO', '2019-02-20 13:03:59'),
(54, 'member', 107, '', '1032', '$2y$10$.9ly/FdcAQPdsdkMm9qypOLy5sNPsW4SFRT94/pjOUPAec4X8GL/.', 'NO', '13', 0, 'ACTIVE', '1', '', 'NO', '2019-02-24 17:06:44'),
(56, 'student', 8, 'NEW', 'p.pencil', '$2y$10$TsxUBtv7c2x4LrnI0QV/peA9VOcJ1ojhN.6A7qIEkcvDytDTVgFOW', 'NO', '14', 7, 'ACTIVE', '1', 'ONLINE', 'NO', '2019-02-24 17:19:02'),
(64, 'administrator', 1, '', 'lsd', '$2y$10$Y0F6phqIvj7PQxXfneggMOE.cWIg1upOmMtFchxPVK.rdhTZ6BHRa', 'NO', '9', 0, 'ACTIVE', '1', 'OFFLINE', 'NO', '2019-03-20 10:00:30'),
(65, 'administrator', 4, '', 'ghis', '$2y$10$pdisgNSq0i6F2dbkk/azPeQdtUlHQ5lVhZUYIOfbdtSSPNAnYIXoi', 'NO', '13', 0, 'ACTIVE', '1', '', 'NO', '2019-03-20 11:47:52'),
(73, 'member', 19, '', '11', '$2y$10$lYuPMDj1sKIFoofB5u5DXOtHASvOMVz1/9T2G9zhrCdLJtGy6c3Dm', 'NO', '13', 0, 'ACTIVE', '1', 'OFFLINE', 'NO', '2019-04-01 12:28:05'),
(96, 'student', 16, 'OLD', 'H.ADJARE', '$2y$10$b3nPPMXcO0KvOuwtw4mVR.4zzvAIvOqOF.8QEbx3gtXapt/biOygG', 'NO', '14', 7, 'ACTIVE', '1', 'OFFLINE', 'NO', '2019-04-12 00:11:07'),
(97, 'member', 19, '', '11', '$2y$10$LCInqIBHMHmkSpmCKRzXrOcVAUb0UIDffbNDoGPAFRH39sBdKKTk.', 'NO', '13', 0, 'DISABLE', '1', '', 'NO', '2019-05-09 12:07:17'),
(98, 'member', 19, '', '11', '$2y$10$iuv25AZqnsqlQFJsXNvqEuHUJapzQpMSa/09JZJknxnPpCrqxp4su', 'NO', '13', 0, 'DISABLE', '1', '', 'NO', '2019-05-09 12:09:23'),
(100, 'student', 20, 'NEW', 'm.merlin', '$2y$10$/buqRcaYEfrjMZTAFH2LCOyRCy.BucT69/KrhSk38upiPEzR6Di4y', 'NO', '', 0, 'ACTIVE', '1', 'OFFLINE', 'NO', '2019-07-09 22:36:09'),
(101, 'student', 21, 'NEW', 'e.darko', '$2y$10$VSYEZEC849Lxi1N.DUISqOSBg12Uzn4j5wuUTd5uTwzltPyMYpdlO', 'NO', '', 0, 'ACTIVE', '1', 'OFFLINE', 'NO', '2019-07-09 22:37:04'),
(102, 'student', 22, 'NEW', 'm.sorce', '$2y$10$HdcsOol59Q1Q6Gs/LvtP4.TO9eDorOMV0oZo/GNuz3h64cyfRRQlK', 'NO', '', 0, 'ACTIVE', '1', '', 'NO', '2019-07-15 06:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `users_session_log`
--

CREATE TABLE `users_session_log` (
  `users_session_log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_start` varchar(100) NOT NULL,
  `session_end` varchar(100) NOT NULL,
  `division` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_session_log`
--

INSERT INTO `users_session_log` (`users_session_log_id`, `user_id`, `session_start`, `session_end`, `division`) VALUES
(1, 73, 'Wednesday 3rd of April 2019 10:27:25 PM', '', 1),
(2, 73, 'Wednesday 3rd of April 2019 10:31:56 PM', '', 1),
(3, 73, 'Wednesday 3rd of April 2019h:33:31 PM', '', 1),
(4, 73, 'Wednesday 3rd of April 2019 / 10:34:31 PM', 'Wednesday 3rd of April 2019 / 10:40:04 PM', 1),
(5, 73, 'Wednesday 3rd of April 2019 / 10:42:27 PM', 'Wednesday 3rd of April 2019 / 10:42:43 PM', 1),
(6, 73, 'Wednesday 3rd of April 2019 / 10:42:49 PM', 'Wednesday 3rd of April 2019 / 10:45:19 PM', 1),
(7, 73, 'Wednesday 3rd of April 2019 / 10:45:54 PM', 'Wednesday 3rd of April 2019 / 11:25:27 PM', 1),
(8, 73, 'Thursday 4th of April 2019 / 09:02:48 AM', 'Thursday 4th of April 2019 / 12:38:55 PM', 1),
(9, 73, 'Thursday 4th of April 2019 / 12:39:01 PM', 'Thursday 4th of April 2019 / 02:17:51 PM', 1),
(10, 56, 'Thursday 4th of April 2019 / 02:17:59 PM', 'Thursday 4th of April 2019 / 11:45:53 PM', 1),
(11, 56, 'Thursday 4th of April 2019 / 11:46:03 PM', 'Thursday 4th of April 2019 / 11:48:31 PM', 1),
(12, 56, 'Thursday 4th of April 2019 / 11:48:40 PM', 'Thursday 4th of April 2019 / 11:48:46 PM', 1),
(13, 73, 'Thursday 4th of April 2019 / 11:48:53 PM', 'Friday 5th of April 2019 / 10:52:54 AM', 1),
(14, 56, 'Friday 5th of April 2019 / 10:53:01 AM', 'Friday 5th of April 2019 / 11:14:13 AM', 1),
(15, 73, 'Friday 5th of April 2019 / 11:14:19 AM', 'Friday 5th of April 2019 / 11:15:58 AM', 1),
(16, 56, 'Friday 5th of April 2019 / 11:16:05 AM', 'Friday 5th of April 2019 / 11:53:50 AM', 1),
(17, 56, 'Friday 5th of April 2019 / 11:54:02 AM', 'Friday 5th of April 2019 / 12:46:31 PM', 1),
(18, 56, 'Friday 5th of April 2019 / 12:46:48 PM', 'Sunday 11th of August 2019 / 04:07:23 PM', 1),
(19, 73, 'Friday 5th of April 2019 / 01:06:58 PM', 'Friday 5th of April 2019 / 01:31:55 PM', 1),
(20, 73, 'Friday 5th of April 2019 / 01:32:10 PM', 'Friday 5th of April 2019 / 01:32:28 PM', 1),
(21, 56, 'Friday 5th of April 2019 / 01:32:37 PM', 'Friday 5th of April 2019 / 02:43:32 PM', 1),
(22, 44, 'Friday 5th of April 2019 / 02:44:57 PM', 'Friday 5th of April 2019 / 02:49:19 PM', 1),
(23, 56, 'Friday 5th of April 2019 / 02:49:27 PM', '', 1),
(24, 73, 'Friday 5th of April 2019 / 02:49:56 PM', 'Friday 5th of April 2019 / 02:50:37 PM', 1),
(25, 94, 'Friday 5th of April 2019 / 02:50:58 PM', 'Friday 5th of April 2019 / 02:52:02 PM', 1),
(26, 73, 'Friday 5th of April 2019 / 02:53:20 PM', 'Friday 5th of April 2019 / 03:05:44 PM', 1),
(27, 73, 'Sunday 7th of April 2019 / 12:32:38 AM', 'Sunday 7th of April 2019 / 12:32:44 AM', 1),
(28, 44, 'Sunday 7th of April 2019 / 12:32:49 AM', 'Sunday 7th of April 2019 / 12:28:13 PM', 1),
(29, 73, 'Sunday 7th of April 2019 / 12:33:25 PM', 'Sunday 7th of April 2019 / 12:35:19 PM', 1),
(30, 73, 'Sunday 7th of April 2019 / 12:36:11 PM', 'Sunday 7th of April 2019 / 12:36:59 PM', 1),
(31, 44, 'Sunday 7th of April 2019 / 12:37:04 PM', 'Sunday 7th of April 2019 / 01:00:25 PM', 1),
(32, 73, 'Sunday 7th of April 2019 / 02:35:32 PM', 'Sunday 7th of April 2019 / 02:36:43 PM', 1),
(33, 56, 'Sunday 7th of April 2019 / 02:36:51 PM', 'Sunday 7th of April 2019 / 03:16:05 PM', 1),
(34, 56, 'Sunday 7th of April 2019 / 03:16:13 PM', 'Sunday 7th of April 2019 / 04:06:41 PM', 1),
(35, 73, 'Sunday 7th of April 2019 / 04:06:46 PM', 'Sunday 7th of April 2019 / 04:07:02 PM', 1),
(36, 56, 'Sunday 7th of April 2019 / 04:07:13 PM', 'Sunday 7th of April 2019 / 04:09:45 PM', 1),
(37, 73, 'Sunday 7th of April 2019 / 04:09:50 PM', 'Sunday 7th of April 2019 / 04:13:05 PM', 1),
(38, 56, 'Sunday 7th of April 2019 / 04:13:12 PM', 'Sunday 7th of April 2019 / 04:13:24 PM', 1),
(39, 73, 'Sunday 7th of April 2019 / 04:13:30 PM', 'Sunday 7th of April 2019 / 04:14:08 PM', 1),
(40, 56, 'Sunday 7th of April 2019 / 04:14:16 PM', 'Sunday 7th of April 2019 / 05:45:09 PM', 1),
(41, 56, 'Sunday 7th of April 2019 / 05:45:37 PM', 'Sunday 7th of April 2019 / 08:16:46 PM', 1),
(42, 56, 'Sunday 7th of April 2019 / 08:16:58 PM', 'Sunday 7th of April 2019 / 09:44:30 PM', 1),
(43, 56, 'Sunday 7th of April 2019 / 10:05:11 PM', 'Sunday 7th of April 2019 / 10:57:44 PM', 1),
(44, 56, 'Sunday 7th of April 2019 / 10:57:53 PM', 'Monday 8th of April 2019 / 06:49:41 AM', 1),
(45, 56, 'Monday 8th of April 2019 / 10:45:25 AM', 'Monday 8th of April 2019 / 12:36:20 PM', 1),
(46, 56, 'Monday 8th of April 2019 / 12:36:43 PM', 'Monday 8th of April 2019 / 01:13:14 PM', 1),
(47, 56, 'Monday 8th of April 2019 / 01:13:23 PM', 'Monday 8th of April 2019 / 02:10:01 PM', 1),
(48, 56, 'Tuesday 9th of April 2019 / 01:35:57 PM', 'Tuesday 9th of April 2019 / 01:35:57 PM', 1),
(49, 56, 'Tuesday 9th of April 2019 / 01:36:13 PM', 'Tuesday 9th of April 2019 / 02:04:42 PM', 1),
(50, 56, 'Tuesday 9th of April 2019 / 02:04:53 PM', '', 1),
(51, 56, 'Tuesday 9th of April 2019 / 02:38:47 PM', 'Tuesday 9th of April 2019 / 03:27:22 PM', 1),
(52, 56, 'Tuesday 9th of April 2019 / 03:27:29 PM', 'Tuesday 9th of April 2019 / 04:22:52 PM', 1),
(53, 56, 'Tuesday 9th of April 2019 / 04:23:08 PM', 'Tuesday 9th of April 2019 / 04:23:21 PM', 1),
(54, 56, 'Tuesday 9th of April 2019 / 04:32:24 PM', '', 1),
(55, 56, 'Tuesday 9th of April 2019 / 09:43:43 PM', 'Tuesday 9th of April 2019 / 11:27:15 PM', 1),
(56, 73, 'Tuesday 9th of April 2019 / 11:27:20 PM', 'Wednesday 10th of April 2019 / 12:22:59 AM', 1),
(57, 73, 'Wednesday 10th of April 2019 / 10:45:39 AM', 'Wednesday 10th of April 2019 / 12:46:47 PM', 1),
(58, 56, 'Wednesday 10th of April 2019 / 12:46:54 PM', 'Wednesday 10th of April 2019 / 01:08:53 PM', 1),
(59, 56, 'Wednesday 10th of April 2019 / 01:09:02 PM', 'Wednesday 10th of April 2019 / 03:30:46 PM', 1),
(60, 73, 'Wednesday 10th of April 2019 / 03:30:52 PM', '', 1),
(61, 73, 'Wednesday 10th of April 2019 / 03:45:59 PM', 'Wednesday 10th of April 2019 / 03:47:31 PM', 1),
(62, 56, 'Wednesday 10th of April 2019 / 04:48:47 PM', 'Wednesday 10th of April 2019 / 05:50:42 PM', 1),
(63, 73, 'Wednesday 10th of April 2019 / 05:50:49 PM', 'Wednesday 10th of April 2019 / 06:47:21 PM', 1),
(64, 73, 'Thursday 11th of April 2019 / 07:00:53 AM', 'Thursday 11th of April 2019 / 09:16:35 AM', 1),
(65, 73, 'Thursday 11th of April 2019 / 09:16:40 AM', 'Thursday 11th of April 2019 / 09:46:29 AM', 1),
(66, 73, 'Thursday 11th of April 2019 / 09:46:36 AM', 'Thursday 11th of April 2019 / 12:11:32 PM', 1),
(67, 73, 'Thursday 11th of April 2019 / 12:11:37 PM', 'Thursday 11th of April 2019 / 10:01:08 PM', 1),
(68, 73, 'Thursday 11th of April 2019 / 10:01:16 PM', 'Friday 12th of April 2019 / 12:01:17 AM', 1),
(69, 73, 'Friday 12th of April 2019 / 12:02:05 AM', 'Friday 12th of April 2019 / 12:10:11 AM', 1),
(70, 73, 'Friday 12th of April 2019 / 12:11:43 AM', 'Friday 12th of April 2019 / 12:12:24 AM', 1),
(71, 96, 'Friday 12th of April 2019 / 12:12:33 AM', 'Friday 12th of April 2019 / 12:33:28 AM', 1),
(72, 73, 'Friday 12th of April 2019 / 12:33:33 AM', 'Friday 12th of April 2019 / 12:35:48 AM', 1),
(73, 96, 'Friday 12th of April 2019 / 12:35:57 AM', 'Friday 12th of April 2019 / 12:50:57 AM', 1),
(74, 73, 'Friday 12th of April 2019 / 12:52:25 AM', 'Friday 12th of April 2019 / 12:52:44 AM', 1),
(75, 73, 'Friday 12th of April 2019 / 08:17:02 AM', 'Friday 12th of April 2019 / 08:36:13 AM', 1),
(76, 73, 'Friday 12th of April 2019 / 08:36:20 AM', 'Wednesday 5th of June 2019 / 09:56:30 PM', 1),
(77, 96, 'Friday 12th of April 2019 / 08:47:27 AM', '', 1),
(78, 73, 'Friday 12th of April 2019 / 08:47:52 AM', 'Friday 12th of April 2019 / 08:48:38 AM', 1),
(79, 96, 'Friday 12th of April 2019 / 08:48:47 AM', 'Friday 12th of April 2019 / 08:49:44 AM', 1),
(80, 73, 'Friday 12th of April 2019 / 08:49:50 AM', 'Friday 12th of April 2019 / 08:50:19 AM', 1),
(81, 96, 'Friday 12th of April 2019 / 08:50:27 AM', 'Friday 12th of April 2019 / 08:51:03 AM', 1),
(82, 73, 'Wednesday 8th of May 2019 / 01:03:27 AM', 'Wednesday 8th of May 2019 / 01:45:44 AM', 1),
(83, 73, 'Wednesday 8th of May 2019 / 01:45:50 AM', 'Wednesday 8th of May 2019 / 02:37:46 AM', 1),
(84, 73, 'Wednesday 8th of May 2019 / 02:24:52 AM', 'Wednesday 8th of May 2019 / 03:22:27 AM', 1),
(85, 73, 'Wednesday 8th of May 2019 / 02:37:51 AM', 'Wednesday 8th of May 2019 / 02:43:07 AM', 1),
(86, 64, 'Wednesday 8th of May 2019 / 02:43:12 AM', 'Wednesday 8th of May 2019 / 03:01:25 AM', 1),
(87, 73, 'Wednesday 8th of May 2019 / 03:05:38 AM', 'Wednesday 8th of May 2019 / 06:53:53 AM', 1),
(88, 73, 'Wednesday 8th of May 2019 / 07:09:57 AM', 'Wednesday 8th of May 2019 / 07:31:14 AM', 1),
(89, 73, 'Wednesday 8th of May 2019 / 10:20:59 PM', 'Wednesday 8th of May 2019 / 10:44:19 PM', 1),
(90, 73, 'Wednesday 8th of May 2019 / 10:44:24 PM', 'Tuesday 11th of June 2019 / 11:36:59 PM', 1),
(91, 64, 'Wednesday 8th of May 2019 / 10:44:33 PM', 'Wednesday 8th of May 2019 / 11:14:14 PM', 1),
(92, 73, 'Wednesday 8th of May 2019 / 11:14:19 PM', 'Wednesday 8th of May 2019 / 11:34:11 PM', 1),
(93, 56, 'Wednesday 8th of May 2019 / 11:34:19 PM', 'Wednesday 8th of May 2019 / 11:52:07 PM', 1),
(94, 73, 'Wednesday 8th of May 2019 / 11:52:13 PM', 'Thursday 9th of May 2019 / 12:17:28 AM', 1),
(95, 64, 'Thursday 9th of May 2019 / 12:17:34 AM', '', 1),
(96, 73, 'Thursday 9th of May 2019 / 02:16:25 AM', '', 1),
(97, 64, 'Thursday 9th of May 2019 / 02:16:35 AM', '', 1),
(98, 73, 'Thursday 9th of May 2019 / 02:17:22 AM', 'Thursday 9th of May 2019 / 02:17:24 AM', 1),
(99, 64, 'Thursday 9th of May 2019 / 02:17:31 AM', 'Thursday 9th of May 2019 / 03:05:37 AM', 1),
(100, 73, 'Thursday 9th of May 2019 / 03:05:46 AM', 'Thursday 9th of May 2019 / 03:51:46 AM', 1),
(101, 64, 'Thursday 9th of May 2019 / 03:51:52 AM', 'Thursday 9th of May 2019 / 05:12:59 AM', 1),
(102, 73, 'Thursday 9th of May 2019 / 05:19:30 AM', 'Thursday 9th of May 2019 / 05:37:00 AM', 1),
(103, 64, 'Thursday 9th of May 2019 / 08:49:19 AM', '', 1),
(104, 73, 'Thursday 9th of May 2019 / 09:05:34 AM', 'Thursday 9th of May 2019 / 11:52:37 AM', 1),
(105, 73, 'Thursday 9th of May 2019 / 11:53:06 AM', 'Thursday 9th of May 2019 / 12:05:53 PM', 1),
(106, 64, 'Thursday 9th of May 2019 / 12:06:01 PM', 'Thursday 9th of May 2019 / 12:48:17 PM', 1),
(107, 73, 'Thursday 9th of May 2019 / 12:48:36 PM', '', 1),
(108, 73, 'Thursday 9th of May 2019 / 06:48:38 PM', 'Thursday 9th of May 2019 / 10:40:32 PM', 1),
(109, 73, 'Thursday 9th of May 2019 / 10:34:46 PM', '', 1),
(110, 73, 'Thursday 9th of May 2019 / 10:40:42 PM', '', 1),
(111, 73, 'Saturday 11th of May 2019 / 12:06:36 AM', '', 1),
(112, 73, 'Saturday 11th of May 2019 / 09:26:59 PM', '', 1),
(113, 73, 'Monday 13th of May 2019 / 07:04:19 AM', 'Monday 13th of May 2019 / 07:04:31 AM', 1),
(114, 64, 'Monday 13th of May 2019 / 09:37:06 PM', '', 1),
(115, 73, 'Saturday 18th of May 2019 / 09:16:24 PM', '', 1),
(116, 64, 'Saturday 18th of May 2019 / 09:16:36 PM', '', 1),
(117, 64, 'Sunday 19th of May 2019 / 11:13:52 AM', 'Sunday 19th of May 2019 / 11:13:52 AM', 1),
(118, 64, 'Sunday 19th of May 2019 / 11:13:57 AM', '', 1),
(119, 64, 'Tuesday 21st of May 2019 / 02:02:58 PM', 'Tuesday 21st of May 2019 / 02:02:58 PM', 1),
(120, 64, 'Tuesday 21st of May 2019 / 02:03:04 PM', '', 1),
(121, 64, 'Wednesday 22nd of May 2019 / 09:24:04 AM', '', 1),
(122, 64, 'Wednesday 22nd of May 2019 / 10:32:37 AM', 'Thursday 23rd of May 2019 / 08:16:27 AM', 1),
(123, 64, 'Wednesday 22nd of May 2019 / 08:45:57 PM', 'Wednesday 22nd of May 2019 / 08:45:57 PM', 1),
(124, 64, 'Wednesday 22nd of May 2019 / 08:46:06 PM', '', 1),
(125, 64, 'Wednesday 22nd of May 2019 / 10:02:06 PM', '', 1),
(126, 64, 'Thursday 23rd of May 2019 / 07:55:08 AM', 'Thursday 23rd of May 2019 / 07:55:08 AM', 1),
(127, 64, 'Thursday 23rd of May 2019 / 07:55:13 AM', 'Thursday 23rd of May 2019 / 04:40:11 PM', 1),
(128, 64, 'Sunday 26th of May 2019 / 12:59:38 PM', 'Sunday 26th of May 2019 / 01:00:21 PM', 1),
(129, 56, 'Sunday 26th of May 2019 / 01:00:27 PM', 'Sunday 26th of May 2019 / 01:01:09 PM', 1),
(130, 57, 'Sunday 26th of May 2019 / 01:01:36 PM', '', 1),
(131, 57, 'Sunday 26th of May 2019 / 05:26:17 PM', 'Sunday 26th of May 2019 / 05:26:40 PM', 1),
(132, 56, 'Sunday 26th of May 2019 / 05:26:47 PM', 'Sunday 26th of May 2019 / 05:32:59 PM', 1),
(133, 44, 'Sunday 26th of May 2019 / 05:33:05 PM', 'Sunday 26th of May 2019 / 05:53:22 PM', 1),
(134, 64, 'Saturday 1st of June 2019 / 09:44:17 AM', 'Saturday 1st of June 2019 / 10:42:32 AM', 1),
(135, 64, 'Saturday 1st of June 2019 / 09:52:52 PM', '', 1),
(136, 64, 'Tuesday 4th of June 2019 / 05:51:19 PM', 'Tuesday 4th of June 2019 / 10:57:16 PM', 1),
(137, 73, 'Tuesday 4th of June 2019 / 10:57:24 PM', 'Tuesday 4th of June 2019 / 10:57:43 PM', 1),
(138, 64, 'Tuesday 4th of June 2019 / 10:57:53 PM', 'Tuesday 4th of June 2019 / 11:49:19 PM', 1),
(139, 73, 'Tuesday 4th of June 2019 / 11:49:24 PM', '', 1),
(140, 73, 'Tuesday 4th of June 2019 / 11:50:04 PM', '', 1),
(141, 73, 'Tuesday 4th of June 2019 / 11:52:58 PM', 'Wednesday 5th of June 2019 / 12:40:31 AM', 1),
(142, 73, 'Wednesday 5th of June 2019 / 12:40:37 AM', 'Wednesday 5th of June 2019 / 09:24:37 AM', 1),
(143, 73, 'Wednesday 5th of June 2019 / 09:24:45 AM', '', 1),
(144, 73, 'Wednesday 5th of June 2019 / 09:56:44 PM', 'Wednesday 5th of June 2019 / 09:58:28 PM', 1),
(145, 64, 'Wednesday 5th of June 2019 / 09:58:35 PM', 'Wednesday 5th of June 2019 / 10:29:58 PM', 1),
(146, 73, 'Wednesday 5th of June 2019 / 10:30:04 PM', 'Wednesday 5th of June 2019 / 10:49:19 PM', 1),
(147, 73, 'Wednesday 5th of June 2019 / 10:50:30 PM', 'Wednesday 5th of June 2019 / 11:31:25 PM', 1),
(148, 73, 'Thursday 6th of June 2019 / 11:03:39 AM', '', 1),
(149, 73, 'Thursday 6th of June 2019 / 11:40:19 AM', 'Thursday 6th of June 2019 / 11:43:21 AM', 1),
(150, 73, 'Thursday 6th of June 2019 / 01:47:27 PM', '', 1),
(151, 73, 'Thursday 6th of June 2019 / 02:45:10 PM', 'Friday 7th of June 2019 / 11:45:11 AM', 1),
(152, 73, 'Friday 7th of June 2019 / 11:45:25 AM', '', 1),
(153, 73, 'Saturday 8th of June 2019 / 03:06:31 PM', 'Saturday 8th of June 2019 / 03:07:11 PM', 1),
(154, 73, 'Tuesday 11th of June 2019 / 04:36:58 PM', '', 1),
(155, 73, 'Tuesday 11th of June 2019 / 05:20:56 PM', '', 1),
(156, 73, 'Tuesday 11th of June 2019 / 11:37:08 PM', '', 1),
(157, 73, 'Thursday 13th of June 2019 / 04:52:07 PM', '', 1),
(158, 64, 'Thursday 13th of June 2019 / 05:07:56 PM', 'Saturday 10th of August 2019 / 04:59:00 PM', 1),
(159, 64, 'Thursday 20th of June 2019 / 04:48:39 PM', '', 1),
(160, 64, 'Friday 21st of June 2019 / 09:42:31 AM', 'Friday 21st of June 2019 / 09:43:11 AM', 1),
(161, 73, 'Friday 21st of June 2019 / 09:43:18 AM', '', 1),
(162, 73, 'Friday 21st of June 2019 / 10:49:24 AM', '', 1),
(163, 73, 'Wednesday 26th of June 2019 / 02:38:53 PM', 'Wednesday 26th of June 2019 / 02:39:06 PM', 1),
(164, 64, 'Wednesday 26th of June 2019 / 02:39:14 PM', '', 1),
(165, 73, 'Saturday 29th of June 2019 / 06:57:16 PM', '', 1),
(166, 73, 'Saturday 29th of June 2019 / 06:57:42 PM', '', 1),
(167, 73, 'Saturday 29th of June 2019 / 06:59:52 PM', '', 1),
(168, 73, 'Saturday 29th of June 2019 / 07:00:13 PM', '', 1),
(169, 64, 'Saturday 29th of June 2019 / 07:00:22 PM', '', 1),
(170, 73, 'Saturday 29th of June 2019 / 07:00:53 PM', '', 1),
(171, 73, 'Saturday 29th of June 2019 / 07:37:44 PM', '', 1),
(172, 73, 'Saturday 29th of June 2019 / 07:38:59 PM', 'Saturday 29th of June 2019 / 07:39:43 PM', 1),
(173, 64, 'Saturday 29th of June 2019 / 07:39:50 PM', 'Saturday 29th of June 2019 / 08:03:15 PM', 1),
(174, 44, 'Saturday 29th of June 2019 / 08:03:22 PM', 'Saturday 29th of June 2019 / 08:12:15 PM', 1),
(175, 64, 'Saturday 29th of June 2019 / 08:12:24 PM', 'Saturday 29th of June 2019 / 08:17:23 PM', 1),
(176, 73, 'Saturday 29th of June 2019 / 08:17:34 PM', 'Saturday 29th of June 2019 / 09:38:01 PM', 1),
(177, 64, 'Saturday 29th of June 2019 / 08:22:27 PM', '', 1),
(178, 64, 'Saturday 29th of June 2019 / 09:38:06 PM', 'Saturday 29th of June 2019 / 09:40:37 PM', 1),
(179, 73, 'Saturday 29th of June 2019 / 09:40:43 PM', 'Saturday 29th of June 2019 / 09:50:15 PM', 1),
(180, 73, 'Saturday 29th of June 2019 / 09:56:19 PM', 'Saturday 29th of June 2019 / 09:57:05 PM', 1),
(181, 64, 'Saturday 29th of June 2019 / 09:57:11 PM', 'Saturday 29th of June 2019 / 11:04:39 PM', 1),
(182, 73, 'Saturday 29th of June 2019 / 11:04:46 PM', 'Sunday 30th of June 2019 / 09:54:36 AM', 1),
(183, 73, 'Sunday 30th of June 2019 / 09:54:43 AM', 'Monday 1st of July 2019 / 08:04:56 AM', 1),
(184, 73, 'Monday 1st of July 2019 / 08:05:30 AM', 'Monday 1st of July 2019 / 08:39:04 AM', 1),
(185, 73, 'Monday 1st of July 2019 / 08:08:00 AM', 'Monday 1st of July 2019 / 08:08:07 AM', 1),
(186, 64, 'Monday 1st of July 2019 / 08:08:14 AM', '', 1),
(187, 56, 'Monday 1st of July 2019 / 08:43:14 AM', 'Monday 1st of July 2019 / 10:29:17 AM', 1),
(188, 73, 'Wednesday 3rd of July 2019 / 09:22:09 PM', 'Wednesday 3rd of July 2019 / 09:55:32 PM', 1),
(189, 64, 'Wednesday 3rd of July 2019 / 09:55:49 PM', 'Wednesday 3rd of July 2019 / 09:56:02 PM', 1),
(190, 56, 'Wednesday 3rd of July 2019 / 09:56:11 PM', 'Wednesday 3rd of July 2019 / 09:56:54 PM', 1),
(191, 73, 'Thursday 4th of July 2019 / 01:09:41 PM', 'Thursday 4th of July 2019 / 01:22:02 PM', 1),
(192, 56, 'Thursday 4th of July 2019 / 01:22:10 PM', '', 1),
(193, 73, 'Tuesday 9th of July 2019 / 08:50:24 AM', '', 1),
(194, 73, 'Tuesday 9th of July 2019 / 11:49:39 AM', 'Tuesday 9th of July 2019 / 03:32:22 PM', 1),
(195, 73, 'Tuesday 9th of July 2019 / 06:15:31 PM', 'Tuesday 9th of July 2019 / 08:35:22 PM', 1),
(196, 73, 'Tuesday 9th of July 2019 / 08:50:46 PM', 'Tuesday 9th of July 2019 / 08:51:03 PM', 1),
(197, 73, 'Tuesday 9th of July 2019 / 08:51:09 PM', 'Tuesday 9th of July 2019 / 08:51:12 PM', 1),
(198, 64, 'Tuesday 9th of July 2019 / 10:39:22 PM', 'Tuesday 9th of July 2019 / 10:40:52 PM', 1),
(199, 100, 'Tuesday 9th of July 2019 / 10:44:18 PM', '', 1),
(200, 100, 'Tuesday 9th of July 2019 / 10:46:41 PM', 'Tuesday 9th of July 2019 / 10:49:01 PM', 1),
(201, 101, 'Tuesday 9th of July 2019 / 10:50:02 PM', 'Tuesday 9th of July 2019 / 10:50:22 PM', 1),
(202, 64, 'Tuesday 9th of July 2019 / 10:50:38 PM', 'Wednesday 10th of July 2019 / 10:38:09 AM', 1),
(203, 73, 'Wednesday 10th of July 2019 / 03:45:08 PM', 'Wednesday 10th of July 2019 / 03:45:22 PM', 1),
(204, 64, 'Wednesday 10th of July 2019 / 03:45:29 PM', 'Wednesday 10th of July 2019 / 08:27:02 PM', 1),
(205, 64, 'Wednesday 10th of July 2019 / 09:06:46 PM', 'Wednesday 10th of July 2019 / 09:53:03 PM', 1),
(206, 64, 'Thursday 11th of July 2019 / 02:15:12 PM', 'Thursday 11th of July 2019 / 04:28:30 PM', 1),
(207, 73, 'Thursday 11th of July 2019 / 04:34:41 PM', 'Thursday 11th of July 2019 / 04:35:54 PM', 1),
(208, 56, 'Thursday 11th of July 2019 / 04:36:05 PM', 'Thursday 11th of July 2019 / 09:17:47 PM', 1),
(209, 56, 'Thursday 11th of July 2019 / 09:25:54 PM', 'Thursday 11th of July 2019 / 11:11:16 PM', 1),
(210, 64, 'Thursday 11th of July 2019 / 11:11:21 PM', 'Friday 12th of July 2019 / 12:00:19 AM', 1),
(211, 73, 'Friday 12th of July 2019 / 12:00:27 AM', '', 1),
(212, 73, 'Saturday 13th of July 2019 / 09:02:28 PM', '', 1),
(213, 73, 'Saturday 13th of July 2019 / 09:12:36 PM', 'Saturday 13th of July 2019 / 09:29:23 PM', 1),
(214, 73, 'Saturday 13th of July 2019 / 09:29:46 PM', '', 1),
(215, 73, 'Saturday 13th of July 2019 / 09:44:00 PM', '', 1),
(216, 73, 'Saturday 13th of July 2019 / 10:43:10 PM', 'Saturday 13th of July 2019 / 10:56:35 PM', 1),
(217, 73, 'Saturday 13th of July 2019 / 10:54:30 PM', '', 1),
(218, 73, 'Saturday 13th of July 2019 / 10:56:41 PM', 'Saturday 13th of July 2019 / 10:57:19 PM', 1),
(219, 73, 'Saturday 13th of July 2019 / 10:57:25 PM', '', 1),
(220, 73, 'Sunday 14th of July 2019 / 06:02:59 AM', 'Sunday 14th of July 2019 / 10:22:45 AM', 1),
(221, 73, 'Sunday 14th of July 2019 / 10:22:50 AM', 'Sunday 14th of July 2019 / 01:17:27 PM', 1),
(222, 73, 'Sunday 14th of July 2019 / 01:17:36 PM', 'Sunday 14th of July 2019 / 02:08:06 PM', 1),
(223, 73, 'Monday 15th of July 2019 / 05:35:13 AM', 'Monday 15th of July 2019 / 05:54:51 AM', 1),
(224, 64, 'Monday 15th of July 2019 / 05:54:56 AM', 'Monday 15th of July 2019 / 05:59:19 AM', 1),
(225, 56, 'Monday 15th of July 2019 / 05:59:29 AM', 'Monday 15th of July 2019 / 05:59:57 AM', 1),
(226, 73, 'Monday 15th of July 2019 / 06:00:13 AM', 'Monday 15th of July 2019 / 06:01:02 AM', 1),
(227, 64, 'Monday 15th of July 2019 / 06:01:08 AM', 'Tuesday 16th of July 2019 / 02:05:04 AM', 1),
(228, 73, 'Monday 15th of July 2019 / 06:02:27 AM', 'Monday 15th of July 2019 / 06:02:29 AM', 1),
(229, 56, 'Monday 15th of July 2019 / 06:02:37 AM', 'Monday 15th of July 2019 / 06:05:18 AM', 1),
(230, 64, 'Monday 15th of July 2019 / 06:05:24 AM', 'Monday 15th of July 2019 / 01:22:29 PM', 1),
(231, 56, 'Monday 15th of July 2019 / 01:22:35 PM', 'Monday 15th of July 2019 / 01:33:36 PM', 1),
(232, 56, 'Monday 15th of July 2019 / 01:33:44 PM', 'Monday 15th of July 2019 / 01:36:22 PM', 1),
(233, 56, 'Monday 15th of July 2019 / 01:36:33 PM', 'Monday 15th of July 2019 / 02:02:27 PM', 1),
(234, 64, 'Monday 15th of July 2019 / 02:02:32 PM', '', 1),
(235, 73, 'Monday 15th of July 2019 / 06:29:44 PM', 'Monday 15th of July 2019 / 06:29:44 PM', 1),
(236, 73, 'Monday 15th of July 2019 / 06:29:50 PM', 'Monday 15th of July 2019 / 06:37:38 PM', 1),
(237, 64, 'Monday 15th of July 2019 / 06:38:09 PM', '', 1),
(238, 64, 'Tuesday 16th of July 2019 / 02:05:15 AM', 'Tuesday 16th of July 2019 / 10:57:28 AM', 1),
(239, 64, 'Tuesday 16th of July 2019 / 10:57:34 AM', 'Tuesday 16th of July 2019 / 12:26:17 PM', 1),
(240, 56, 'Tuesday 16th of July 2019 / 10:43:47 PM', '', 1),
(241, 73, 'Friday 2nd of August 2019 / 08:22:13 PM', 'Friday 2nd of August 2019 / 08:22:13 PM', 1),
(242, 73, 'Friday 2nd of August 2019 / 08:22:21 PM', '', 1),
(243, 73, 'Saturday 3rd of August 2019 / 08:32:58 AM', 'Saturday 3rd of August 2019 / 08:32:58 AM', 1),
(244, 73, 'Saturday 3rd of August 2019 / 08:33:04 AM', '', 1),
(245, 73, 'Thursday 8th of August 2019 / 12:11:26 PM', '', 1),
(246, 73, 'Friday 9th of August 2019 / 02:14:56 PM', 'Friday 9th of August 2019 / 02:15:06 PM', 1),
(247, 64, 'Friday 9th of August 2019 / 02:15:11 PM', 'Friday 9th of August 2019 / 02:16:19 PM', 1),
(248, 73, 'Friday 9th of August 2019 / 02:16:25 PM', 'Friday 9th of August 2019 / 02:16:31 PM', 1),
(249, 73, 'Friday 9th of August 2019 / 02:17:01 PM', 'Friday 9th of August 2019 / 02:17:50 PM', 1),
(250, 64, 'Friday 9th of August 2019 / 02:17:58 PM', 'Friday 9th of August 2019 / 02:18:27 PM', 1),
(251, 73, 'Friday 9th of August 2019 / 02:18:33 PM', 'Friday 9th of August 2019 / 02:33:22 PM', 1),
(252, 56, 'Friday 9th of August 2019 / 02:34:49 PM', 'Wednesday 14th of August 2019 / 09:40:38 AM', 1),
(253, 56, 'Friday 9th of August 2019 / 02:44:05 PM', 'Friday 9th of August 2019 / 02:45:25 PM', 1),
(254, 56, 'Friday 9th of August 2019 / 02:46:31 PM', 'Friday 9th of August 2019 / 02:54:22 PM', 1),
(255, 73, 'Friday 9th of August 2019 / 02:54:29 PM', 'Friday 9th of August 2019 / 03:03:23 PM', 1),
(256, 64, 'Friday 9th of August 2019 / 03:05:31 PM', 'Friday 9th of August 2019 / 03:29:05 PM', 1),
(257, 73, 'Saturday 10th of August 2019 / 05:44:25 PM', 'Saturday 10th of August 2019 / 06:25:04 PM', 1),
(258, 73, 'Saturday 10th of August 2019 / 09:51:26 PM', '', 1),
(259, 73, 'Sunday 11th of August 2019 / 12:08:57 AM', 'Sunday 11th of August 2019 / 12:29:45 AM', 1),
(260, 73, 'Sunday 11th of August 2019 / 12:30:02 AM', '', 1),
(261, 64, 'Sunday 11th of August 2019 / 03:34:36 PM', '', 1),
(262, 64, 'Sunday 11th of August 2019 / 04:07:28 PM', '', 1),
(263, 73, 'Sunday 11th of August 2019 / 05:42:56 PM', 'Sunday 11th of August 2019 / 05:59:24 PM', 1),
(264, 64, 'Sunday 11th of August 2019 / 05:59:31 PM', '', 1),
(265, 64, 'Sunday 11th of August 2019 / 06:56:20 PM', 'Monday 12th of August 2019 / 01:26:26 AM', 1),
(266, 64, 'Monday 12th of August 2019 / 11:15:31 AM', 'Monday 12th of August 2019 / 11:50:41 AM', 1),
(267, 73, 'Monday 12th of August 2019 / 11:50:48 AM', 'Monday 12th of August 2019 / 04:23:08 PM', 1),
(268, 73, 'Monday 12th of August 2019 / 04:23:15 PM', 'Monday 12th of August 2019 / 10:53:32 PM', 1),
(269, 73, 'Monday 12th of August 2019 / 10:53:38 PM', 'Monday 12th of August 2019 / 11:12:46 PM', 1),
(270, 56, 'Monday 12th of August 2019 / 11:12:56 PM', 'Tuesday 13th of August 2019 / 12:48:29 AM', 1),
(271, 64, 'Tuesday 13th of August 2019 / 12:54:40 AM', '', 1),
(272, 64, 'Tuesday 13th of August 2019 / 07:17:31 AM', 'Tuesday 13th of August 2019 / 09:26:46 PM', 1),
(273, 73, 'Tuesday 13th of August 2019 / 09:26:52 PM', 'Tuesday 13th of August 2019 / 09:28:19 PM', 1),
(274, 64, 'Tuesday 13th of August 2019 / 09:28:27 PM', 'Wednesday 14th of August 2019 / 09:32:41 AM', 1),
(275, 64, 'Wednesday 14th of August 2019 / 09:32:46 AM', '', 1),
(276, 64, 'Wednesday 14th of August 2019 / 09:40:43 AM', 'Wednesday 14th of August 2019 / 03:40:40 PM', 1),
(277, 73, 'Wednesday 14th of August 2019 / 09:52:31 AM', '', 1),
(278, 73, 'Wednesday 14th of August 2019 / 03:40:50 PM', 'Wednesday 14th of August 2019 / 03:41:00 PM', 1),
(279, 64, 'Wednesday 14th of August 2019 / 03:52:58 PM', 'Wednesday 14th of August 2019 / 04:47:56 PM', 1),
(280, 73, 'Wednesday 14th of August 2019 / 04:48:05 PM', 'Thursday 15th of August 2019 / 09:21:49 AM', 1),
(281, 73, 'Thursday 15th of August 2019 / 09:26:18 AM', 'Thursday 15th of August 2019 / 10:12:55 AM', 1),
(282, 64, 'Thursday 15th of August 2019 / 10:13:55 AM', 'Thursday 15th of August 2019 / 10:15:11 AM', 1),
(283, 73, 'Thursday 15th of August 2019 / 10:15:21 AM', 'Thursday 15th of August 2019 / 06:56:21 PM', 1),
(284, 64, 'Thursday 15th of August 2019 / 06:56:28 PM', 'Friday 16th of August 2019 / 12:32:06 AM', 1),
(285, 56, 'Friday 16th of August 2019 / 12:32:16 AM', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_payment`
--

CREATE TABLE `user_payment` (
  `user_payment_id` int(11) NOT NULL,
  `surveyor_type` varchar(100) NOT NULL,
  `payment_purpose` varchar(100) NOT NULL,
  `payment_amount` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `division` varchar(20) NOT NULL,
  `record_hide` varchar(10) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_payment`
--

INSERT INTO `user_payment` (`user_payment_id`, `surveyor_type`, `payment_purpose`, `payment_amount`, `user_id`, `division`, `record_hide`, `date_done`) VALUES
(2, 'PROFESSIONAL', 'WELFARE', '200', 36, '1', 'YES', '2018-11-22 15:49:41'),
(3, 'TRAINEE', 'MONTHLY DUES', '100', 36, '1', 'NO', '2018-11-22 15:53:56'),
(4, 'OTHER', 'WELFARE', '50', 73, '1', 'NO', '2019-04-03 23:11:29'),
(5, 'OTHER', 'SORCE MONEY', '3005', 73, '1', 'NO', '2019-04-04 13:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_history`
--

CREATE TABLE `wallet_history` (
  `wallet_history_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `amount_payed` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `division` varchar(20) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet_history`
--

INSERT INTO `wallet_history` (`wallet_history_id`, `member_id`, `type`, `purpose`, `reason`, `amount_payed`, `balance`, `division`, `date_done`) VALUES
(1, 102, 'DEBIT', 'CONTRIBUTION', 'NAMING CEREMONY OF MRS AMOAKO', '20', '4800', '1', '2018-11-27 00:56:44'),
(2, 102, 'DEBIT', 'CONTRIBUTION', 'FUNERAL OF MR', '70', '4730', '1', '2018-11-27 01:20:01'),
(3, 102, 'DEBIT', 'CONTRIBUTION', 'NAMING CEREMONY OF MRS AMOAKO', '30', '4700', '1', '2018-11-27 01:20:08'),
(4, 102, 'DEBIT', 'CONTRIBUTION', 'GENERAL CONTRIBUTION', '500', '4200', '1', '2018-11-27 08:45:24'),
(5, 102, 'DEBIT', 'CONTRIBUTION', 'GENERAL CONTRIBUTION', '1', '4199', '1', '2018-11-27 09:18:48'),
(6, 102, 'DEBIT', 'CONTRIBUTION', 'FUNERAL OF MR', '8', '4191', '1', '2018-11-27 09:19:36'),
(7, 102, 'DEBIT', 'CONTRIBUTION', 'NAMING CEREMONY OF MRS AMOAKO', '10', '4181', '1', '2018-11-27 09:19:51'),
(8, 102, 'DEBIT', 'DUES', 'MONTHLY DUES', '81', '4100', '1', '2018-11-27 13:58:47'),
(9, 102, 'DEBIT', 'EVENT', 'LAND SURVEYING AND MAPPING: THE CRITICAL FOUNDATION TO NATIONAL INFRASTRUCTURAL DEVELOPMENT IN GHANA', '500', '3600', '1', '2018-11-29 10:46:12'),
(10, 102, 'DEBIT', 'CONTRIBUTION', 'GENERAL CONTRIBUTION', '50', '3550', '1', '2018-11-30 07:53:42'),
(11, 102, 'DEBIT', 'CONTRIBUTION', 'FUNERAL OF MR', '50', '3500', '1', '2018-12-02 15:04:42'),
(12, 102, 'DEBIT', 'CONTRIBUTION', 'FUNERAL OF MR', '50', '3450', '1', '2018-12-02 15:06:22'),
(13, 102, 'DEBIT', 'CONTRIBUTION', 'GENERAL CONTRIBUTION', '100', '3350', '1', '2018-12-02 15:07:16'),
(14, 102, 'DEBIT', 'CONTRIBUTION', 'FUNERAL OF MR', '600', '2750', '1', '2018-12-02 15:20:08'),
(15, 102, 'DEBIT', 'CONTRIBUTION', 'FUNERAL OF MR', '600', '2150', '1', '2018-12-02 15:20:21'),
(16, 102, 'DEBIT', 'CONTRIBUTION', 'NAMING CEREMONY OF MRS AMOAKO', '500', '1650', '1', '2018-12-02 15:20:27'),
(17, 11, 'DEBIT', 'YOUTUBE', 'YOUTUBE LIVE STREAMING PAYMENT', '500', '0', '1', '2019-04-01 21:13:52'),
(18, 11, 'DEBIT', 'DUES', 'WELFARE', '50', '450', '1', '2019-04-04 13:41:30'),
(19, 11, 'DEBIT', 'DUES', 'SORCE MONEY', '300', '150', '1', '2019-04-04 13:50:46'),
(20, 11, 'DEBIT', 'DUES', 'WELFARE', '50', '100', '1', '2019-04-04 13:54:02'),
(21, 11, 'DEBIT', 'DUES', 'WELFARE', '50', '50', '1', '2019-04-04 13:54:50'),
(22, 11, 'DEBIT', 'DEBIT', 'DEBIT', '300', '-250', '', '2019-06-27 01:09:14'),
(23, 11, 'CREDIT', 'CREDIT', 'CREDIT', '900', '650', '', '2019-06-27 01:11:05'),
(24, 11, 'CREDIT', 'CREDIT', 'CREDIT', '900', '1550', '', '2019-06-27 01:13:51'),
(25, 11, 'DEBIT', 'DEBIT', 'DEBIT', '900', '650', '', '2019-06-27 01:14:28'),
(26, 11, 'CREDIT', 'CREDIT', 'CREDIT', '500', '1150', '', '2019-06-27 12:38:52'),
(27, 11, 'CREDIT', 'CREDIT', 'CREDIT', '500', '1650', '', '2019-06-27 12:43:04'),
(28, 11, 'DEBIT', 'DEBIT', 'DEBIT', '500', '1150', '', '2019-06-27 12:43:45'),
(29, 11, 'DEBIT', 'DEBIT', 'DEBIT', '500', '650', '', '2019-06-27 12:44:27'),
(30, 11, 'DEBIT', 'DEBIT', 'DEBIT', '500', '150', '', '2019-06-27 12:46:01'),
(31, 11, 'DEBIT', 'DEBIT', 'DEBIT', '500', '-350', '', '2019-06-27 13:09:24'),
(32, 11, 'DEBIT', 'DEBIT', 'DEBIT', '500', '-850', '', '2019-06-27 13:09:34'),
(33, 11, 'DEBIT', 'DEBIT', 'DEBIT', '500', '-1350', '', '2019-06-27 13:10:50'),
(34, 11, 'DEBIT', 'DEBIT', 'DEBIT', '500', '-1850', '', '2019-06-27 13:11:54'),
(35, 11, 'DEBIT', 'DEBIT', 'DEBIT', '500', '-2350', '', '2019-06-27 13:17:43'),
(36, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '-1350', '', '2019-06-27 13:19:53'),
(37, 11, 'DEBIT', 'DEBIT', 'DEBIT', '1000', '-2350', '', '2019-06-27 13:21:53'),
(38, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '-1350', '', '2019-06-27 13:22:22'),
(39, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '-350', '', '2019-07-30 18:56:17'),
(40, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '650', '', '2019-07-30 18:58:05'),
(41, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '1650', '', '2019-07-30 18:58:09'),
(42, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '2650', '', '2019-07-30 18:59:20'),
(43, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '3650', '', '2019-07-30 19:02:04'),
(44, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '4650', '', '2019-07-30 19:02:37'),
(45, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '5650', '', '2019-07-30 19:02:38'),
(46, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '6650', '', '2019-07-30 19:02:39'),
(47, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '7650', '', '2019-07-30 19:02:40'),
(48, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '8650', '', '2019-07-30 19:02:55'),
(49, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '9650', '', '2019-07-30 19:02:56'),
(50, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '10650', '', '2019-07-30 19:02:57'),
(51, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '11650', '', '2019-07-30 19:02:58'),
(52, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '12650', '', '2019-07-30 19:10:33'),
(53, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '13650', '', '2019-07-30 19:10:35'),
(54, 11, 'CREDIT', 'CREDIT', 'CREDIT', '1000', '14650', '', '2019-07-30 19:15:23'),
(55, 11, 'DEBIT', 'DUES', 'SORCE MONEY', '3005', '11645', '1', '2019-08-12 18:21:20'),
(56, 11, 'DEBIT', 'DUES', 'WELFARE', '50', '11595', '1', '2019-08-12 18:21:31'),
(57, 11, 'DEBIT', 'CONTRIBUTION', 'FUNERAL OF MR', '500', '11095', '1', '2019-08-15 10:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_stream`
--

CREATE TABLE `youtube_stream` (
  `youtube_stream_id` int(11) NOT NULL,
  `youtube_event_name` varchar(100) NOT NULL,
  `youtube_start_date` varchar(20) NOT NULL,
  `youtube_startTime` varchar(50) NOT NULL,
  `youtube_endTime` varchar(50) NOT NULL,
  `youtube_rate` varchar(10) NOT NULL,
  `youtube_amount` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_hide` varchar(10) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `youtube_stream`
--

INSERT INTO `youtube_stream` (`youtube_stream_id`, `youtube_event_name`, `youtube_start_date`, `youtube_startTime`, `youtube_endTime`, `youtube_rate`, `youtube_amount`, `division`, `user_id`, `record_hide`, `date_done`) VALUES
(1, 'best video123', '29-03-2019', '', '', 'FREE', 0, 1, 66, 'NO', '2019-03-27 12:56:51'),
(2, 'The annual ghis meeting', '01-04-2019', '', '', 'PAID', 500, 1, 66, 'NO', '2019-03-31 10:36:48'),
(4, 'WATCH SORCE CODE', '02-04-2019', '', '', 'PAID', 200, 1, 73, 'YES', '2019-04-01 22:43:10'),
(5, 'WATCH MICHEAL CODE', '03-04-2019', '03:00', '08:00', 'FREE', 0, 1, 73, 'NO', '2019-04-01 22:43:30'),
(6, 'time test', '09-05-2019', '08:00', '13:30', 'FREE', 0, 1, 64, 'NO', '2019-05-09 02:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_stream_register`
--

CREATE TABLE `youtube_stream_register` (
  `youtube_stream_reg_id` int(11) NOT NULL,
  `youtube_stream_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `youtube_rate` varchar(10) NOT NULL,
  `youtube_price` int(11) NOT NULL,
  `youtube_payment_status` varchar(10) NOT NULL,
  `record_hide` varchar(10) NOT NULL,
  `date_done` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `youtube_stream_register`
--

INSERT INTO `youtube_stream_register` (`youtube_stream_reg_id`, `youtube_stream_id`, `user_id`, `youtube_rate`, `youtube_price`, `youtube_payment_status`, `record_hide`, `date_done`) VALUES
(5, 1, 73, '123', 0, 'asdf', 'NO', '2019-04-01 20:45:59'),
(6, 2, 2, 'aa', 2342, 'asdf', 'NO', '2019-04-01 20:46:40'),
(7, 2, 73, 'PAID', 500, 'PAID', 'NO', '2019-04-01 21:13:52'),
(8, 5, 73, 'FREE', 0, 'FREE', 'NO', '2019-04-01 22:44:25'),
(9, 5, 64, 'FREE', 0, 'FREE', 'NO', '2019-05-09 02:20:07'),
(10, 6, 73, 'FREE', 0, 'FREE', 'NO', '2019-06-05 22:30:13'),
(11, 6, 64, 'FREE', 0, 'FREE', 'NO', '2019-07-16 12:25:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advert_company`
--
ALTER TABLE `advert_company`
  ADD PRIMARY KEY (`advert_com_id`);

--
-- Indexes for table `api_request`
--
ALTER TABLE `api_request`
  ADD PRIMARY KEY (`api_request_id`);

--
-- Indexes for table `committee_library`
--
ALTER TABLE `committee_library`
  ADD PRIMARY KEY (`committee_library_id`);

--
-- Indexes for table `committee_notes`
--
ALTER TABLE `committee_notes`
  ADD PRIMARY KEY (`committee_note_id`);

--
-- Indexes for table `committee_setup`
--
ALTER TABLE `committee_setup`
  ADD PRIMARY KEY (`committee_id`);

--
-- Indexes for table `committee_task`
--
ALTER TABLE `committee_task`
  ADD PRIMARY KEY (`committee_task_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `contribution`
--
ALTER TABLE `contribution`
  ADD PRIMARY KEY (`contribution_id`);

--
-- Indexes for table `contribution_register`
--
ALTER TABLE `contribution_register`
  ADD PRIMARY KEY (`contributions_reg_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`division_id`);

--
-- Indexes for table `email_sent`
--
ALTER TABLE `email_sent`
  ADD PRIMARY KEY (`email_sent_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`events_id`);

--
-- Indexes for table `events_register`
--
ALTER TABLE `events_register`
  ADD PRIMARY KEY (`events_reg_id`);

--
-- Indexes for table `exam_center_setup`
--
ALTER TABLE `exam_center_setup`
  ADD PRIMARY KEY (`exam_center_id`);

--
-- Indexes for table `exam_center_subjects`
--
ALTER TABLE `exam_center_subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `exam_register`
--
ALTER TABLE `exam_register`
  ADD PRIMARY KEY (`exam_register_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`library_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`members_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `new_application`
--
ALTER TABLE `new_application`
  ADD PRIMARY KEY (`new_application_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pages_id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`sms_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `surveyor`
--
ALTER TABLE `surveyor`
  ADD PRIMARY KEY (`surveyor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_session_log`
--
ALTER TABLE `users_session_log`
  ADD PRIMARY KEY (`users_session_log_id`);

--
-- Indexes for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`user_payment_id`);

--
-- Indexes for table `wallet_history`
--
ALTER TABLE `wallet_history`
  ADD PRIMARY KEY (`wallet_history_id`);

--
-- Indexes for table `youtube_stream`
--
ALTER TABLE `youtube_stream`
  ADD PRIMARY KEY (`youtube_stream_id`);

--
-- Indexes for table `youtube_stream_register`
--
ALTER TABLE `youtube_stream_register`
  ADD PRIMARY KEY (`youtube_stream_reg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advert_company`
--
ALTER TABLE `advert_company`
  MODIFY `advert_com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `api_request`
--
ALTER TABLE `api_request`
  MODIFY `api_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `committee_library`
--
ALTER TABLE `committee_library`
  MODIFY `committee_library_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `committee_notes`
--
ALTER TABLE `committee_notes`
  MODIFY `committee_note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `committee_setup`
--
ALTER TABLE `committee_setup`
  MODIFY `committee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `committee_task`
--
ALTER TABLE `committee_task`
  MODIFY `committee_task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contribution`
--
ALTER TABLE `contribution`
  MODIFY `contribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contribution_register`
--
ALTER TABLE `contribution_register`
  MODIFY `contributions_reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `division_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_sent`
--
ALTER TABLE `email_sent`
  MODIFY `email_sent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `events_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events_register`
--
ALTER TABLE `events_register`
  MODIFY `events_reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_center_setup`
--
ALTER TABLE `exam_center_setup`
  MODIFY `exam_center_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exam_center_subjects`
--
ALTER TABLE `exam_center_subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_register`
--
ALTER TABLE `exam_register`
  MODIFY `exam_register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `library_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `members_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `new_application`
--
ALTER TABLE `new_application`
  MODIFY `new_application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `sms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `surveyor`
--
ALTER TABLE `surveyor`
  MODIFY `surveyor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users_session_log`
--
ALTER TABLE `users_session_log`
  MODIFY `users_session_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `user_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wallet_history`
--
ALTER TABLE `wallet_history`
  MODIFY `wallet_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `youtube_stream`
--
ALTER TABLE `youtube_stream`
  MODIFY `youtube_stream_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `youtube_stream_register`
--
ALTER TABLE `youtube_stream_register`
  MODIFY `youtube_stream_reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

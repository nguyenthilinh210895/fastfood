-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 12, 2020 lúc 03:39 PM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fastfood`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booktable`
--

CREATE TABLE `booktable` (
  `id` int(10) UNSIGNED NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `day` datetime NOT NULL,
  `id_customer` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0: Chưa Xóa; 1: đã xóa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `type`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'Món Ăn Từ Gà', 'Đồ Ăn', 0, '2020-04-04 08:51:09', '2020-04-04 08:51:09'),
(2, 'Nước Ngọt', 'Đồ Uống', 0, '2020-04-11 01:03:37', '2020-04-11 01:03:37'),
(3, 'Bia', 'Đồ Uống', 0, '2020-04-11 01:04:01', '2020-04-11 01:04:01'),
(4, 'Món ăn từ cá', 'Đồ Ăn', 0, '2020-04-11 01:04:19', '2020-04-11 01:04:19'),
(5, 'Món ăn từ thịt bò', 'Đồ Ăn', 0, '2020-04-11 01:04:32', '2020-04-11 01:04:32'),
(6, 'Đồ ăn vặt', 'Đồ Ăn', 0, '2020-04-11 01:04:45', '2020-04-11 01:04:45'),
(7, 'Món tráng miệng', 'Đồ Ăn', 0, '2020-04-11 01:04:51', '2020-04-11 01:04:51'),
(8, 'Sinh tố', 'Đồ Uống', 0, '2020-04-11 01:05:07', '2020-04-11 01:05:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0: Chưa Xóa; 1: đã xóa',
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `content`, `rate`, `delete_flag`, `id_user`, `id_product`, `created_at`, `updated_at`) VALUES
(1, 'Món này ngon quá.', 5, 0, 2, 1, '2020-04-07 08:18:17', '2020-04-07 08:18:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 2),
(13, '2020_03_25_153945_create_table_category_table', 2),
(14, '2020_03_25_154409_create_table_product_table', 2),
(15, '2020_03_25_155616_create_table_tables_table', 2),
(16, '2020_03_26_142712_create_table_comment_table', 2),
(17, '2020_03_26_143522_create_table_customer_table', 2),
(18, '2020_03_27_143106_create_table_order_table', 2),
(19, '2020_03_27_143939_create_table_orderdetails_table', 2),
(20, '2020_03_29_105914_create_table_booktable_table', 2),
(21, '2020_03_29_110704_create_table_receive_table', 2),
(22, '2020_04_05_084956_update_users_table', 3),
(23, '2020_04_05_091507_create_timekeeping_table', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `total_price` double(16,2) NOT NULL,
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `type_order` int(11) NOT NULL COMMENT '1: online; 2:offline ',
  `id_table` int(11) DEFAULT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0: Chưa Xóa; 1: đã xóa',
  `id_customer` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_price` double(16,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_order` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` double(16,2) NOT NULL,
  `promotion_price` double(16,2) DEFAULT NULL,
  `unit` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0: Chưa Xóa; 1: đã xóa',
  `id_category` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `product_name`, `image`, `unit_price`, `promotion_price`, `unit`, `description`, `delete_flag`, `id_category`, `created_at`, `updated_at`) VALUES
(1, 'Chân gà xả ớt', 'cxEnk_pngtree-gourmet-promotion-simple-hot-pot-banner-image_177619.jpg', 35000.00, 30000.00, 100, 'Sản phẩm thơm ngon, nhiều dinh dưỡng', 0, 1, '2020-04-04 09:00:09', '2020-04-04 09:02:05'),
(2, 'Coca cola', 'ahczH_coca.jpg', 10000.00, NULL, 500, 'Nước ngọt có gas.', 0, 2, '2020-04-11 01:06:45', '2020-04-11 01:06:45'),
(3, 'Nước Cam', '3Coom_nuoc-giai-khat-co-gas-fanta-cam-lon.jpeg', 10000.00, 9000.00, 1000, 'Nước cam fanta ko có gas', 0, 2, '2020-04-11 01:08:03', '2020-04-11 01:08:03'),
(4, '7 up', '75UKh_nuoc-ngot-7up-sleek-330ml-1_grande (1).jpg', 10000.00, NULL, 500, '7up ngon, có gas', 0, 2, '2020-04-11 01:32:31', '2020-04-11 01:32:31'),
(5, 'Mirinda', 'bDP89_169f3e3dd7cb294daa1cbe3725afa16f.jpg', 11000.00, NULL, 500, 'Mirinda ngon ngọt.', 0, 2, '2020-04-11 01:40:03', '2020-04-11 01:40:03'),
(6, 'Sinh tố xoài', 'ssYvs_cach-lam-sinh-to-xoai-sua-dac.jpg', 20000.00, NULL, 500, 'Sinh tố xoài, nhiều dưỡng chất ngon lành, thành khiết.', 0, 8, '2020-04-11 01:40:58', '2020-04-11 01:40:58'),
(7, 'Sinh tố dâu tây', '1NlkB_tải xuống.jpg', 35000.00, NULL, 500, 'Sinh tố nhiều dĩnh dưỡng', 0, 8, '2020-04-11 01:41:46', '2020-04-11 01:41:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `receive`
--

CREATE TABLE `receive` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(16,2) NOT NULL,
  `total_price` double(16,2) NOT NULL,
  `day` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tables`
--

CREATE TABLE `tables` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0: còn trống; 1: đã đặt',
  `delete_flag` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tables`
--

INSERT INTO `tables` (`id`, `table_name`, `code`, `status`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'Bàn A001', '1231231', 0, 0, '2020-04-11 04:03:34', '2020-04-12 06:36:20'),
(2, 'Bàn A02', 'abcaaa', 0, 1, '2020-04-11 04:05:42', '2020-04-11 04:10:16'),
(3, 'Bàn A02', 'abcaaa', 0, 0, '2020-04-11 04:10:23', '2020-04-11 04:10:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `timekeeping`
--

CREATE TABLE `timekeeping` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0: Chưa Xóa; 1: đã xóa',
  `id_staff_absent` int(10) UNSIGNED NOT NULL,
  `id_staff_replace` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '0' COMMENT '0:user; 1: Admin, 2: Nhân viên',
  `delete_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0: Chưa Xóa; 1: đã xóa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_in` time DEFAULT NULL,
  `start_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `email`, `password`, `avatar`, `salary`, `role`, `delete_flag`, `remember_token`, `created_at`, `updated_at`, `start_in`, `start_out`) VALUES
(1, 'Admin', '0908909890', 'Trần duy hưng 2', 'admin@gmail.com', '$2y$10$sP5MM/kg0wolexzeNZgDs.Da1XMJugCds57EstBGc272vFZayNyWG', 'avatar.png', '500000000', 1, 0, NULL, '2020-04-04 01:11:33', '2020-04-04 03:25:54', NULL, NULL),
(2, 'Phongbk', '0909090909', 'Hai Bà Tưng', 'phongbk@gmail.com', '$2y$10$tT0AdJug1f/.tujrIEMQAeA9bshzJ/33DT6JRAl9KtZZqpF96LYYm', 'avatar.png', NULL, 0, 0, NULL, '2020-04-05 07:41:49', '2020-04-05 07:41:49', NULL, NULL),
(3, 'Nhân Viên B', '090909009', 'Đại Cồ Việt', 'nhanvienb@gmail.com', '$2y$10$mgAAwkjpP.WiRAQH1/b8LOQW9jTke0Ninl6aQUmr6UNGuEokZUpd2', 'avatar.png', '6500000', 2, 0, NULL, '2020-04-11 07:42:13', '2020-04-11 07:49:25', '07:35:00', '17:35:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `booktable`
--
ALTER TABLE `booktable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booktable_id_customer_foreign` (`id_customer`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id_user_foreign` (`id_user`),
  ADD KEY `comment_id_product_foreign` (`id_product`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id_customer_foreign` (`id_customer`);

--
-- Chỉ mục cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderdetails_id_order_foreign` (`id_order`),
  ADD KEY `orderdetails_id_product_foreign` (`id_product`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id_category_foreign` (`id_category`);

--
-- Chỉ mục cho bảng `receive`
--
ALTER TABLE `receive`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `timekeeping`
--
ALTER TABLE `timekeeping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timekeeping_id_staff_absent_foreign` (`id_staff_absent`),
  ADD KEY `timekeeping_id_staff_replace_foreign` (`id_staff_replace`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `booktable`
--
ALTER TABLE `booktable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `receive`
--
ALTER TABLE `receive`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `timekeeping`
--
ALTER TABLE `timekeeping`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `booktable`
--
ALTER TABLE `booktable`
  ADD CONSTRAINT `booktable_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetails_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `timekeeping`
--
ALTER TABLE `timekeeping`
  ADD CONSTRAINT `timekeeping_id_staff_absent_foreign` FOREIGN KEY (`id_staff_absent`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `timekeeping_id_staff_replace_foreign` FOREIGN KEY (`id_staff_replace`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th10 15, 2023 lúc 09:36 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `suruchi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(9) NOT NULL,
  `mahd` varchar(50) NOT NULL,
  `nguoidat_ten` varchar(50) NOT NULL,
  `nguoidat_email` varchar(50) NOT NULL,
  `nguoidat_tel` varchar(20) NOT NULL,
  `nguoidat_diachi` varchar(100) NOT NULL,
  `nguoinhan_ten` varchar(50) DEFAULT NULL,
  `nguoinhan_diachi` varchar(100) DEFAULT NULL,
  `nguoinhan_tel` varchar(20) DEFAULT NULL,
  `note` varchar(500) NOT NULL,
  `total` int(9) NOT NULL,
  `ship` int(6) NOT NULL DEFAULT 0,
  `voucher` int(6) NOT NULL DEFAULT 0,
  `tongthanhtoan` int(10) NOT NULL,
  `pttt` tinyint(1) NOT NULL COMMENT '0: COD; 1: ck; 2: ví điện tử',
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(10) NOT NULL,
  `idsp` int(10) NOT NULL,
  `idbill` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog`
--

CREATE TABLE `blog` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `img` varchar(200) NOT NULL,
  `idloai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_category`
--

CREATE TABLE `blog_category` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(6) NOT NULL,
  `idpro` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  `soluong` int(3) NOT NULL,
  `thanhtien` int(6) NOT NULL,
  `idbill` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(250) NOT NULL,
  `stt` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `img`, `stt`) VALUES
(1, 'Áo kiểu ', 'pd1.jpg', 1),
(2, ' Áo thun', 'pd9.jpg', 2),
(3, 'Áo khoác', 'pd17.jpg', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `iduser` int(10) NOT NULL,
  `idsp` int(10) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(10) NOT NULL DEFAULT 0,
  `old_price` int(10) NOT NULL DEFAULT 0,
  `img` varchar(200) NOT NULL,
  `describe1` varchar(1000) NOT NULL,
  `describe2` varchar(1000) NOT NULL,
  `view` int(10) NOT NULL,
  `bestseller` tinyint(1) NOT NULL DEFAULT 0,
  `new` tinyint(1) NOT NULL DEFAULT 0,
  `hot` tinyint(1) NOT NULL DEFAULT 0,
  `iddm` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `old_price`, `img`, `describe1`, `describe2`, `view`, `bestseller`, `new`, `hot`, `iddm`) VALUES
(1, 'Áo Sơ Mi Voan Dài Tay Thắt Eo', 189000, 225000, 'pd1.jpg', 'Áo sơ mi voan dài tay thắt eo là một lựa chọn hoàn hảo cho bạn gái muốn thể hiện sự đẳng cấp, gợi cảm và cá tính của mình.', 'THÔNG TIN SẢN PHẨM<br>\nChất liệu: voan mềm mại, nhẹ nhàng, thoáng mát và có khả năng chống tia UV, kháng khuẩn và bảo vệ da.<br>\nKiểu dáng: dài tay.<br>\nDáng: thắt eo, tạo nên sự nữ tính, duyên dáng và tôn dáng cho người mặc.<br>\nMàu sắc: trắng, đen.<br>\nDịp: nhiều dịp khác nhau, như công sở, dạo phố, picnic, shopping, hẹn hò… và kết hợp được với nhiều loại quần, váy, giày dép khác.<br> Áo được làm từ chất liệu voan mềm mại, nhẹ nhàng, thoáng mát và có khả năng chống tia UV, kháng khuẩn và bảo vệ da.', 54, 0, 1, 1, 1),
(2, 'Áo sơ mi thắt nơ bên cách điệu', 179000, 215000, 'pd2.jpg', 'Chiếc áo sơ mi kiểu nữ, áo sơ mi thắt nơ bên cách điệu Ulzzang là một loại trang phục nữ mang phong cách Hàn Quốc, trẻ trung và năng động. ', 'THÔNG TIN SẢN PHẨM<br>\nChất liệu: cotton có độ co giãn và thấm hút tốt.<br>\nKiểu dáng: cổ vuông, tay dài.<br>\nĐiểm nhấn: nơ bên cạnh, thắt ở phần eo. Nơ được thiết kế với nhiều hình dạng.<br>\nHọa tiết: đơn sắc.<br>\nMàu sắc: be.<br>\nDịp: nhiều dịp khác nhau, như đi học, đi làm, đi chơi, hẹn hò… và kết hợp được với nhiều loại quần, váy, giày dép khác.<br>Áo được làm từ chất liệu cotton có độ co giãn và thấm hút tốt. ', 40, 0, 1, 0, 1),
(3, 'Áo kiểu BH chất chiffon tay dài ', 209000, 244000, 'pd3.jpg', 'Chiếc áo kiểu BH chất chiffon tay dài hoạ tiết hoa nữ tính là một loại trang phục nữ đẹp, thanh lịch và hiện đại. ', 'THÔNG TIN SẢN PHẨM<br>\nChất liệu: chiffon, một loại vải mỏng, nhẹ, mềm mại và thoáng mát. Chiffon có độ bền cao, không nhăn, không bai, không xù và có khả năng thấm hút tốt.<br>\nKiểu dáng: BH, tức là có phần ngực được cắt may riêng biệt, tạo nên sự ôm sát, nâng đỡ và tôn lên vòng một của người mặc.<br> \nHoạ tiết: hoa, mang lại sự tươi sáng, nữ tính và duyên dáng cho người mặc.<br>\nMàu sắc: hồng.<br>\nDịp: nhiều dịp khác nhau, như đi làm, đi chơi, hẹn hò… và kết hợp được với nhiều loại quần, váy, giày dép khác. <br>Áo được làm từ chất liệu chiffon, một loại vải mỏng, nhẹ, mềm mại và thoáng mát. Áo có kiểu dáng BH, tức là có phần ngực được cắt may riêng biệt, tạo nên sự ôm sát, nâng đỡ và tôn lên vòng một của người mặc.', 204, 1, 0, 0, 1),
(4, 'Áo Kiểu Tay Dài Cổ Vuông ', 160000, 185000, 'pd4.jpg', 'Chiếc áo kiểu tay dài cổ vuông họa tiết hoa xinh xắn phong cách Hàn Quốc là một loại trang phục nữ đẹp, nữ tính và hiện đại. ', 'THÔNG TIN SẢN PHẨM<br>\nChất liệu: polyester, một loại vải nhân tạo có độ bền cao, không nhăn, không bai, không xù và có khả năng chống thấm nước.<br>\nKiểu dáng: tay dài, cổ tim.<br>\nHoạ tiết: hoa, mang lại sự tươi sáng, duyên dáng và lãng mạn cho người mặc.<br>\nMàu sắc: trắng.<br>\nDịp: nhiều dịp khác nhau, như đi làm, đi chơi, hẹn hò… và kết hợp được với nhiều loại quần, váy, giày dép khác.<br>Áo được làm từ chất liệu polyester, một loại vải nhân tạo có độ bền cao, không nhăn, không bai, không xù và có khả năng chống thấm nước. Áo có họa tiết hoa, mang lại sự tươi sáng, duyên dáng và lãng mạn cho người mặc.', 62, 0, 0, 0, 1),
(5, 'Áo 2 dây babydoll cột nơ ', 145000, 159000, 'pd5.jpg', 'Chiếc áo 2 dây babydoll cột nơ vai phong cách tiểu thư công chúa là một loại trang phục nữ đáng yêu, nữ tính và lãng mạn.', 'THÔNG TIN SẢN PHẨM<br>\nChất liệu: cotton, mềm mại, thoáng mát và thấm hút tốt.<br>\nKiểu dáng: babydoll, tức là có phần ngực ôm sát, phần eo và hông rộng và xòe ra, tạo nên sự nhẹ nhàng, bay bổng và tôn lên vòng một của người mặc.<br>                                                   \nMàu sắc: xanh dương.<br>\nDịp: nhiều dịp khác nhau, như đi chơi, hẹn hò, dự tiệc… và kết hợp được với nhiều loại quần, váy, giày dép khác.<br> Áo được làm từ chất liệu vải cotton, mềm mại, thoáng mát và thấm hút tốt.<br> Áo có kiểu dáng babydoll, tức là có phần ngực ôm sát, phần eo và hông rộng và xòe ra, tạo nên sự nhẹ nhàng, bay bổng và tôn lên vòng một của người mặc.', 68, 0, 0, 0, 1),
(6, 'Áo Len Tăm Cổ Vuông', 182000, 199000, 'pd6.jpg', 'Chiếc áo len tăm cổ vuông là một loại trang phục nữ đẹp, sang trọng và hiện đại. Áo được làm từ chất liệu len tăm, một loại sợi len mỏng, nhẹ, mềm mại và ấm áp. Len tăm có độ bền cao, không nhăn, không bai, không xù và có khả năng thấm hút tốt.', 'THÔNG TIN SẢN PHẨM<br>\nChất liệu: len tăm, một loại sợi len mỏng, nhẹ, mềm mại và ấm áp.<br>\nKiểu dáng: cổ vuông. Áo có tay dài, phối nút hoặc khuy ở phía trước.<br>\nMàu sắc: trắng.<br>\nDịp: nhiều dịp khác nhau, như đi làm, đi chơi, hẹn hò… và kết hợp được với nhiều loại quần, váy, giày dép khác.', 122, 0, 1, 0, 1),
(7, 'Áo kiểu trễ vai xanh', 177000, 184000, 'pd7.jpg', 'Chiếc áo kiểu trễ vai xanh là một loại trang phục nữ đẹp, gợi cảm và thời trang. Áo có thiết kế cổ áo hở vai, tạo ra sự nữ tính và quyến rũ cho người mặc. ', 'THÔNG TIN SẢN PHẨM<br>\nChất liệu: sợi nhân tạo…<br>\nKiểu dáng: cổ áo hở vai, tạo ra sự nữ tính và quyến rũ<br>cho người mặc. Áo có kiểu tay phồng, cột nơ.<br>\nMàu sắc: xanh, mang lại sự tươi sáng, thanh lịch và<br>hiện đại cho người mặc.<br>\nDịp: nhiều dịp khác nhau, như đi làm, đi chơi, hẹn hò,<br>dự tiệc… và kết hợp được với nhiều loại quần, váy, giày dép khác', 165, 1, 0, 0, 1),
(8, 'Áo sơ mi mỏng thời trang', 158000, 169000, 'pd8.jpg', 'Chiếc áo sơ mi mỏng thời trang là một loại trang phục nữ đẹp, thanh lịch và hiện đại. ', 'THÔNG TIN SẢN PHẨM<br>\nChất liệu: voan.<br>\nKiểu dáng: cổ áo, tay áo và thân áo bằng vải mỏng, nhẹ, mềm mại và thoáng mát.<br>\nHoạ tiết: kẻ sọc, chấm bi, hoa văn…<br>\nMàu sắc: nhiều màu sắc.<br>\nDịp: nhiều dịp khác nhau, như đi làm, đi chơi, hẹn hò, dự tiệc… và kết hợp được với nhiều loại quần, váy, giày dép khác.<br>Áo có thiết kế cổ áo, tay áo và thân áo bằng vải mỏng, nhẹ, mềm mại và thoáng mát. Áo được làm từ loại vải voan. ', 95, 0, 0, 0, 1),
(9, 'Áo phông trắng freesize ', 135000, 164000, 'pd9.jpg', 'Chiếc áo phông trắng freesize phong cách trẻ trung năng động là một loại áo thun đơn giản nhưng có thể tạo ra nhiều phong cách thời trang khác nhau.', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm: Áo phông trắng freesize phong cách trẻ trung năng động.<br>\nChất liệu: Cotton 100%.<br> \nMàu sắc: Trắng.<br>\nKích thước: Freesize.<br> \nHình in: 3D, ngộ nghĩnh, cá tính.<br> \nThiết kế: Cổ tròn, tay ngắn, dáng rộng Phong cách: Trẻ trung, năng động, cá tính.<br>  Bạn có thể kết hợp chiếc áo này với nhiều loại quần, chân váy, áo khoác hay phụ kiện để thể hiện cá tính và sự năng động của mình.<br>\nCách bảo quản: Giặt tay hoặc giặt máy ở chế độ nhẹ nhàng, không sử dụng chất tẩy, phơi trong bóng râm, ủi ở nhiệt độ thấp.', 115, 0, 1, 0, 2),
(10, 'Áo Thun Meow Tee ', 139000, 168000, 'pd10.jpg', 'Chiếc áo thun Meow Tee Nomography Unisex Form Rộng là một sản phẩm thời trang dành cho cả nam và nữ, mang phong cách năng động, cá tính và sáng tạo.', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm: Áo Thun Meow Tee Nomography Unisex Form Rộng.<br>\nChất liệu: Cotton 100%.<br> \nMàu sắc: Trắng.<br>\nKích thước: Freesize.<br> \nHình in: 3D, hiệu ứng trame nên các bạn sẽ không bị bung tróc.<br>\nThiết kế: Cổ tròn, tay ngắn, dáng rộng.<br>\nPhong cách: Trẻ trung, năng động, cá tính.<br>\nCách bảo quản: Giặt tay hoặc giặt máy ở chế độ nhẹ nhàng, không sử dụng chất tẩy, phơi trong bóng râm, ủi ở nhiệt độ thấp.', 165, 0, 0, 1, 2),
(11, 'Áo Thun Tay Lỡ Unisex ', 135000, 168000, 'pd11.jpg', 'Áo Thun Tay Lỡ Unisex ANGEL FALLING TEE 100% COTTON là một sản phẩm của HADES Brand, một thương hiệu thời trang đường phố nổi tiếng tại Việt Nam. ', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm: Áo Thun Tay Lỡ Unisex ANGEL FALLING TEE 100% COTTON<br>.\nChất liệu: Cotton 100%.<br>\nMàu sắc: Trắng.<br>\nHình in: Thiên thần đang rơi xuống.<br>\nKiểu dáng: Tay lỡ, cổ tròn.<br>\nĐặc điểm: Co giãn 4 chiều, mềm mại, thoáng mát.<br>\nPhù hợp: Cả nam và nữ, mặc đi chơi, đi làm, hay thể hiện cá tính và phong cách riêng.<br>\nKích thước: Freesize.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.<br>Áo có thiết kế đơn giản nhưng độc đáo, với hình in một thiên thần đang rơi xuống trước nền đen.<br> Áo được làm từ chất liệu cotton 100%, co giãn 4 chiều, mềm mại và thoáng mát.', 124, 0, 0, 0, 2),
(12, 'Áo Thun Levents 2Lip/ Cream', 130000, 165000, 'pd12.jpg', 'Áo Thun Levents 2Lip/ Cream là một sản phẩm áo thun thời trang. Áo có màu kem, với hình in hai đôi môi đỏ chót trên ngực trái.', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm: Áo Thun Levents 2Lip/ Cream.<br>\nChất liệu: Cotton 100%.<br>\nMàu sắc: Kem.<br>\nHình in: Hai bông hoa đỏ chót.<br>\nKiểu dáng: Tay lỡ, cổ tròn.<br>\nĐặc điểm: Dày dặn, thoáng mát, mềm mịn, không nhăn hay xù.<br>\nPhù hợp: Cả nam và nữ, mặc đi chơi, đi làm, hay thể hiện cá tính và phong cách riêng.<br>\nKích thước: Freesize.<br> Áo được làm từ chất liệu lì ven compact, một loại vải dày dặn, thoáng mát, mềm mịn và không bị nhăn hay xù.<br> Áo có kiểu dáng tay ngắn, cổ tròn, phù hợp cho cả nam và nữ.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.', 104, 0, 0, 0, 2),
(13, 'Áo Thun Nam Cổ Tròn ', 112000, 140000, 'pd13.jpg', 'Áo Thun Nam Cổ Tròn Màu Da Vải Cotton Co Giãn Trơn Basic Tay Ngắn Form Rộng là một loại áo thun nam đơn giản nhưng không kém phần thời trang. ', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm: Áo Thun Nam Cổ Tròn Màu Da Vải Cotton Co Giãn Trơn Basic Tay Ngắn Form Rộng.<br>\nChất liệu: Cotton 100%.<br>\nMàu sắc: Da.<br>\nHình in: Trơn.<br>\nKiểu dáng:  Cổ tròn, tay ngắn, form rộng (oversize).<br>\nĐặc điểm: Mềm mại, thoáng mát, co giãn 2 chiều, thấm hút mồ hôi tốt.<br>\nPhù hợp: Cả nam và nữ, mặc đi chơi, đi làm, hay thể hiện cá tính và phong cách riêng.<br>\nKích thước: Freesize.<br>Áo có màu da, với chất liệu vải cotton 100% mềm mại, thoáng mát, co giãn 2 chiều và thấm hút mồ hôi tốt. Áo có kiểu dáng cổ tròn, tay ngắn, form rộng (oversize), phù hợp cho cả nam và nữ, dễ dàng kết hợp với nhiều loại quần áo khác nhau.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.', 89, 0, 0, 0, 2),
(14, 'Áo Thun Unisex Tay Lỡ ', 130000, 145000, 'pd14.jpg', 'Áo Thun Unisex Tay Lỡ Form Rộng Nam Nữ là một loại áo thun thời trang phù hợp cho cả nam và nữ, có kiểu dáng tay lỡ, cổ tròn, form rộng (oversize), mang đến một phong cách cá tính, năng động và dễ phối đồ.', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm:  Áo Thun Unisex Tay Lỡ Form Rộng Nam Nữ.<br>\nChất liệu: Cotton 100%.<br>\nMàu sắc: Da.<br>\nHình in: Trơn.<br>\nKiểu dáng:  Cổ tròn, tay ngắn, form rộng (oversize).<br>\nĐặc điểm: Mềm mại, thoáng mát, co giãn 2 chiều, thấm hút mồ hôi tốt.<br>\nPhù hợp:  Áo thun tay lỡ unisex phù hợp cho cả nam và nữ, có thể mặc đi chơi, đi làm, hay thể hiện cá tính và phong cách riêng.<br>\nKích thước: Freesize.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.', 144, 0, 0, 0, 2),
(15, 'Áo thun nam nữ Unisex', 145000, 165000, 'pd16.jpg', 'Áo thun nam unisex màu da là một loại áo thun dành cho cả nam và nữ, có chất liệu vải nan, một loại vải có khả năng kháng khuẩn, chống nắng và thấm hút mồ hôi tốt.', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm:  Áo thun nam nữ Unisex.<br>\nChất liệu: Cotton 100%.<br>\nMàu sắc: Da.<br>\nHình in: Hình thành phố.<br>\nKiểu dáng:  Tay ngắn, cổ tròn, form rộng.<br>\nĐặc điểm: Mềm mại, thoáng mát, co giãn 2 chiều,thấm hút mồ hôi tốt.<br>\nPhù hợp:  Áo thun tay lỡ unisex phù hợp cho cả nam và nữ, có thể mặc đi chơi, đi làm, hay thể hiện cá tính và phong cách riêng.<br>\nKích thước: Freesize.<br>\nÁo thun nan unisex màu da là một item thời trang phù hợp cho mọi mùa, mọi dịp, mang đến cho bạn một phong cách trẻ trung, năng động và thoải mái.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.', 65, 1, 0, 0, 2),
(16, 'Áo Khoác Cadigan Nữ Hồng ', 265000, 286000, 'pd17.jpg', 'Áo Khoác Cadigan Nữ Hoạ Tiết Quả Trám To Màu Hồng Chất Len Dài Tay Style Hàn Quốc là một loại áo khoác len dành cho nữ, có họa tiết quả trám to màu hồng trên nền trắng. ', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm:  Áo Khoác Cadigan Nữ Màu Hồng Chất Len Dài Tay Style Hàn Quốc<br>\nChất liệu: Len 100% <br>\nMàu sắc: Hồng<br>\nHình in: Quả trám to trên nền trắng<br>\nKiểu dáng:  Tay ngắn, cổ tròn, form rộng<br>\nĐặc điểm: Dày dặn, ấm áp, mềm mại<br>\nKích thước: Freesize<br>Áo khoác len này có chất liệu len dày dặn, ấm áp và mềm mại.<br>\nÁo khoác len này có kiểu dáng cardigan, cài nút trước ngực, tay dài, cổ tròn, form rộng, phù hợp cho cả nam và nữ. Áo khoác len này có phong cách Hàn Quốc, mang đến cho bạn một vẻ ngoài trẻ trung, đáng yêu và thời trang.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm', 194, 1, 0, 0, 3),
(17, 'Áo len dài tay cún nhỏ ', 220000, 234000, 'pd18.jpg', 'Áo len dài tay cún nhỏ dễ thương là một loại áo len dành cho nữ, có hình in một chú cún nhỏ đáng yêu trên ngực. ', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm:  Áo len dài tay cún nhỏ dễ thương<br>\nChất liệu: Len 100% <br>\nMàu sắc: Trắng<br>\nHình in: Nhiều chú cún nhỏ<br>\nKiểu dáng:  Tay ngắn, cổ tròn, form rộng<br>\nĐặc điểm: Dày dặn, ấm áp, mềm mại<br>\nKích thước: Freesize<br>Áo len này có chất liệu len mềm mại, ấm áp và co giãn tốt.<br>\nÁo len này có phong cách dễ thương, nữ tính và thời trang.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm', 168, 0, 0, 1, 3),
(18, 'Áo Khoác nỉ in chữ EVERYTIME', 225000, 240000, 'pd19.jpg', 'Áo Khoác nỉ khoác kéo in chữ EVERYTIME màu xám form rộng unisex nam nữ là một loại áo khoác nỉ dành cho cả nam và nữ, có chất liệu nỉ mềm mại, ấm áp và co giãn tốt. Áo khoác nỉ này có màu xám, với hình in chữ EVERYTIME trên ngực trái.', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm:  Áo Khoác nỉ khoác kéo in chữ EVERYTIME.<br>\nChất liệu: Nỉ 100%.<br>\nMàu sắc: Xám.<br>\nHình in: Chữ EVERYTIME.<br>\nKiểu dáng: Khoác kéo, tay dài, cổ tròn, form rộng, có mũ trùm đầu.<br>\nĐặc điểm: Mềm mại, ấm áp, co giãn tốt.<br>\nKích thước: Freesize.<br>\nÁo khoác nỉ này có kiểu dáng khoác kéo, cài khóa trước ngực, tay dài, cổ tròn, form rộng, phù hợp cho cả nam và nữ.<br> Áo khoác nỉ này có phong cách thời trang, năng động và cá tính.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.', 177, 0, 0, 0, 3),
(19, 'Kẻ sọc Tweed Áo khoác', 275000, 298000, 'pd20.jpg', 'Kẻ sọc Tweed Áo khoác là một loại áo khoác thời trang quần áo cao cấp, chính hãng đến từ Việt Nam. ', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm: Kẻ sọc Tweed Áo khoác.<br>\nChất liệu: Vải tweed.<br>\nMàu sắc: Hồng.<br>\nHình in: Chữ EVERYTIME<br>\nKiểu dáng: Áo khoác dài, cài nút trước ngực, tay dài, cổ tròn, form rộng.<br>\nĐặc điểm: Dày dặn, ấm áp, chống chịu thời tiết tốt, cổ điển nhưng vẫn sang trọng và thanh lịch.<br>Áo khoác này có chất liệu vải tweed, một loại vải được dệt từ sợi len lông cừu thô, dày dặn, ấm áp và chống chịu thời tiết tốt.<br>\nÁo khoác này có họa tiết kẻ sọc xước màu hồng và trắng, mang đến một nét cổ điển nhưng vẫn sang trọng và thanh lịch.<br> Áo khoác này có kiểu dáng áo khoác dài, cài nút trước ngực, tay dài, cổ tròn, form rộng, phù hợp cho cả nam và nữ. <br>Áo khoác này có phong cách thời trang Hàn Quốc, mang đến cho bạn một vẻ ngoài trẻ trung, năng động và cá tính<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.', 212, 1, 0, 0, 3),
(20, 'ÁO KHOÁC DENIM NHẬT BẢN', 256000, 273000, 'pd21.jpg', 'ÁO KHOÁC DENIM NHẬT BẢN là một loại áo khoác được làm từ vải denim, một loại vải bền, chắc và có khả năng chống chịu thời tiết tốt. ', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm: ÁO KHOÁC DENIM NHẬT BẢN.<br>\nChất liệu: Vải denim.<br>\nMàu sắc: Trắng.<br>\nHình in: Trơn.<br>\nKiểu dáng: cổ điển, cài nút trước ngực, tay dài, cổ tròn, form rộng, phù hợp cho cả nam và nữ<br>\nĐặc điểm: Dày dặn, ấm áp, chống chịu thời tiết tốt, cổ điển nhưng vẫn sang trọng và thanh lịch.<br>\nÁo khoác denim Nhật Bản có phong cách thời trang Hàn Quốc, mang đến cho bạn một vẻ ngoài trẻ trung, năng động và cá tính.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.', 185, 1, 0, 0, 3),
(21, 'Áo Jean Nam Nữ form rộng', 265000, 279000, 'pd22.jpg', 'Áo Jean Nam Nữ form rộng là một loại áo khoác được làm từ vải jean, một loại vải bền, chắc và có khả năng chống chịu thời tiết tốt.', 'THÔNG TIN SẢN PHẨM<br>\r\nTên sản phẩm: Áo Jean Nam Nữ form rộng<br>\r\nChất liệu: Vải jean 100% cotton<br>\r\nMàu sắc: Xanh<br>\r\nKiểu dáng:Áo khoác dài, cài nút trước ngực, tay dài, cổ tròn, form rộng<br>\r\nĐặc điểm: Bền, chắc, chống chịu thời tiết tốt, phong cách Hàn Quốc<br>\r\nÁo jean nam nữ form rộng có phong cách thời trang Hàn Quốc, mang đến cho bạn một vẻ ngoài trẻ trung, năng động và cá tính.<br>\r\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.', 128, 0, 1, 0, 3),
(22, 'Áo hoodie Nỉ in chữ New York', 215000, 235000, 'pd23.jpg', 'Áo hoodie nỉ ngoại in chữ New York là một loại áo khoác nỉ có mũ trùm đầu, cài khóa trước ngực, tay dài, form rộng, phù hợp cho cả nam và nữ.', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm: Áo hoodie Nỉ ngoại in chữ New York.<br>\nChất liệu: Nỉ ngoại 100% cotton.<br>\nMàu sắc: Xám.<br>\nKiểu dáng: Khoác kéo, tay dài, cổ tròn, form rộng, có mũ trùm đầu.<br>\nĐặc điểm:  Mềm mại, ấm áp, co giãn tốt\nÁo hoodie nỉ ngoại in chữ New York có chất liệu nỉ ngoại, một loại nỉ được nhập khẩu từ nước ngoài, có độ mềm mại, ấm áp và co giãn tốt.<br> Áo hoodie nỉ ngoại in chữ New York có màu sắc đa dạng.<br> Áo hoodie nỉ ngoại in chữ New York có hình in chữ New York trên ngực, mang đến một nét thời trang, năng động và cá tính.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm', 105, 0, 0, 0, 3),
(23, 'Áo khoác da dáng Bomber', 259000, 278000, 'pd24.jpg', 'Áo khoác da dáng Bomber lót lông cừu siêu ấm dáng Over phong cách Ulzang là một loại áo khoác nam được thiết kế theo phong cách Hàn Quốc.', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm: Áo khoác da dáng Bomber.<br>\nChất liệu: Da lộn hoặc da trơn bên ngoài, lông cừu bên trong.<br>\nMàu sắc: Đen.<br>\nKiểu dáng: Bomber, cổ cao, tay dài, khóa kéo, hai túi hông, bo dệt RIB 4X4, dáng over, phong cách ulzzang.<br>\nĐặc điểm: có khả năng chống nhăn nhàu, bong tróc và cản gió. Lớp lót bên trong là lông cừu mềm mại, giữ nhiệt tốt và sinh nhiệt giúp bảo vệ cơ thể khỏi thời tiết lạnh sâu.<br>\nÁo khoác có dáng over, rộng rãi và thoải mái, tạo nên phong cách ulzzang thể hiện sự trẻ trung, năng động và cá tính.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.', 199, 0, 0, 1, 3),
(24, 'Áo thun nam ngắn hình Routine', 125000, 136000, 'pd15.jpg', 'Áo thun tay nam ngắn in hình Routine là một thương hiệu quần áo cao cấp, chính hãng đến từ Việt Nam', 'THÔNG TIN SẢN PHẨM<br>\nTên sản phẩm:  Áo thun tay nam ngắn in hình Routine.<br>\nChất liệu: Cotton 100%.<br>\nMàu sắc: Đen.<br>\nHình in: Hình thành phố.<br>\nKiểu dáng:  Tay ngắn, cổ tròn, form regular<br>\nĐặc điểm: Mềm mại, thoáng mát, co giãn 2 chiều, thấm hút mồ hôi tốt.<br>\nPhù hợp:  Áo thun tay lỡ unisex phù hợp cho cả nam và nữ, có thể mặc đi chơi, đi làm, hay thể hiện cá tính và phong cách riêng.<br>\nKích thước: Freesize.<br>\nCách bảo quản: Giặt tay hoặc máy ở nhiệt độ thấp, không sử dụng chất tẩy, phơi trong bóng râm.', 123, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `address`, `email`, `sdt`, `role`) VALUES
(1, 'nghia', '123', '', NULL, 'nghianhps27599@fpt.edu.vn', NULL, 1),
(4, 'duong', '123', '', NULL, 'duongtran12a5@gmail.com', NULL, 0),
(5, '', '', '', NULL, '', NULL, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kh_hd` (`iduser`);

--
-- Chỉ mục cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hd_hdct` (`idbill`),
  ADD KEY `fk_sp_hdct` (`idsp`);

--
-- Chỉ mục cho bảng `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dmtt_tt` (`idloai`);

--
-- Chỉ mục cho bảng `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD KEY `fk_sp_cart` (`idpro`),
  ADD KEY `fk_hd_cart` (`idbill`);

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
  ADD KEY `fk_kh_bl` (`iduser`),
  ADD KEY `fk_sp_bl` (`idsp`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dm_sp` (`iddm`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_kh_hd` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `fk_hd_hdct` FOREIGN KEY (`idbill`) REFERENCES `bill` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sp_hdct` FOREIGN KEY (`idsp`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `fk_dmtt_tt` FOREIGN KEY (`idloai`) REFERENCES `blog_category` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_hd_cart` FOREIGN KEY (`idbill`) REFERENCES `bill` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sp_cart` FOREIGN KEY (`idpro`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_kh_bl` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sp_bl` FOREIGN KEY (`idsp`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_dm_sp` FOREIGN KEY (`iddm`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

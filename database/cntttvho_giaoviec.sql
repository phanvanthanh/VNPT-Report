-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.30-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cntttvho_giaoviec
CREATE DATABASE IF NOT EXISTS `cntttvho_giaoviec` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cntttvho_giaoviec`;

-- Dumping structure for table cntttvho_giaoviec.admin_resource
CREATE TABLE IF NOT EXISTS `admin_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ten_hien_thi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameter_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uri` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_menu` int(11) DEFAULT NULL,
  `use_when_login` int(11) DEFAULT '1',
  `only_show_admin` int(11) DEFAULT '0',
  `icon` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '<i class="fi-briefcase"></i>',
  `order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `admin_resource_parent_foreign` (`parent_id`),
  CONSTRAINT `admin_resource_parent_foreign` FOREIGN KEY (`parent_id`) REFERENCES `admin_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=395 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.admin_resource: ~186 rows (approximately)
/*!40000 ALTER TABLE `admin_resource` DISABLE KEYS */;
INSERT INTO `admin_resource` (`id`, `ten_hien_thi`, `resource`, `method`, `action`, `parameter`, `parameter_value`, `status`, `parent_id`, `created_at`, `updated_at`, `uri`, `show_menu`, `use_when_login`, `only_show_admin`, `icon`, `order`) VALUES
	(1, '#', '#', '#', '#', '', '', 1, NULL, NULL, NULL, '#', 0, 1, 1, '<i class="fi-briefcase"></i>', 2),
	(3, 'Quyền', '#', '#', '#', '', '', 1, 1, NULL, NULL, '#', 1, 1, 1, '<i class="mdi mdi-account-settings-variant"></i>', 3),
	(133, 'login', 'GET | App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', 'GET', 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', '', '', 1, 1, NULL, NULL, 'login', 0, 1, 1, '<i class="fi-briefcase"></i>', 1),
	(134, 'login', 'POST | App\\Http\\Controllers\\Auth\\LoginController@login', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@login', '', '', 1, 1, NULL, NULL, 'login', 0, 1, 1, '<i class="fi-briefcase"></i>', 2),
	(135, 'logout', 'POST | App\\Http\\Controllers\\Auth\\LoginController@logout', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@logout', '', '', 1, 1, NULL, NULL, 'logout', 0, 1, 1, '<i class="fi-briefcase"></i>', 3),
	(136, 'register', 'GET | App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', 'GET', 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', '', '', 1, 1, NULL, NULL, 'register', 0, 1, 1, '<i class="fi-briefcase"></i>', 4),
	(137, 'register', 'POST | App\\Http\\Controllers\\Auth\\RegisterController@register', 'POST', 'App\\Http\\Controllers\\Auth\\RegisterController@register', '', '', 1, 1, NULL, NULL, 'register', 0, 1, 1, '<i class="fi-briefcase"></i>', 5),
	(138, 'password/reset', 'GET | App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', 'GET', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', '', '', 1, 1, NULL, NULL, 'password/reset', 0, 1, 1, '<i class="fi-briefcase"></i>', 6),
	(139, 'password/email', 'POST | App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', 'POST', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', '', '', 1, 1, NULL, NULL, 'password/email', 0, 1, 1, '<i class="fi-briefcase"></i>', 7),
	(140, 'password/reset/{token}', 'GET | App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', 'GET', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', '', '', 1, 1, NULL, NULL, 'password/reset/{token}', 0, 1, 1, '<i class="fi-briefcase"></i>', 8),
	(141, 'password/reset', 'POST | App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', 'POST', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', '', '', 1, 1, NULL, NULL, 'password/reset', 0, 1, 1, '<i class="fi-briefcase"></i>', 9),
	(142, 'DM Resource', 'GET | App\\Http\\Controllers\\AdminResourceRefullController@index', 'GET', 'App\\Http\\Controllers\\AdminResourceRefullController@index', '', '', 1, 1, NULL, NULL, 'admin/resource', 1, 1, 1, '<i class="mdi mdi-apps"></i>', 4),
	(143, 'admin/resource/create', 'GET | App\\Http\\Controllers\\AdminResourceRefullController@create', 'GET', 'App\\Http\\Controllers\\AdminResourceRefullController@create', '', '', 1, 1, NULL, NULL, 'admin/resource/create', 0, 1, 1, '<i class="fi-briefcase"></i>', 11),
	(144, 'admin/resource', 'POST | App\\Http\\Controllers\\AdminResourceRefullController@store', 'POST', 'App\\Http\\Controllers\\AdminResourceRefullController@store', '', '', 1, 1, NULL, NULL, 'admin/resource', 0, 1, 1, '<i class="fi-briefcase"></i>', 12),
	(145, 'admin/resource/{resource}', 'GET | App\\Http\\Controllers\\AdminResourceRefullController@show', 'GET', 'App\\Http\\Controllers\\AdminResourceRefullController@show', '', '', 1, 1, NULL, NULL, 'admin/resource/{resource}', 0, 1, 1, '<i class="fi-briefcase"></i>', 13),
	(146, 'admin/resource/{resource}/edit', 'GET | App\\Http\\Controllers\\AdminResourceRefullController@edit', 'GET', 'App\\Http\\Controllers\\AdminResourceRefullController@edit', '', '', 1, 1, NULL, NULL, 'admin/resource/{resource}/edit', 0, 1, 1, '<i class="fi-briefcase"></i>', 14),
	(147, 'admin/resource/{resource}', 'PUT | App\\Http\\Controllers\\AdminResourceRefullController@update', 'PUT', 'App\\Http\\Controllers\\AdminResourceRefullController@update', '', '', 1, 1, NULL, NULL, 'admin/resource/{resource}', 0, 1, 1, '<i class="fi-briefcase"></i>', 15),
	(148, 'admin/resource/{resource}', 'DELETE | App\\Http\\Controllers\\AdminResourceRefullController@destroy', 'DELETE', 'App\\Http\\Controllers\\AdminResourceRefullController@destroy', '', '', 1, 1, NULL, NULL, 'admin/resource/{resource}', 0, 1, 1, '<i class="fi-briefcase"></i>', 16),
	(149, 'Nhóm quyền', 'GET | App\\Http\\Controllers\\AdminRoleController@taoNhomQuyenView', 'GET', 'App\\Http\\Controllers\\AdminRoleController@taoNhomQuyenView', '', '', 1, 3, NULL, NULL, 'admin/tao-nhom-quyen', 1, 1, 1, '<i class="fi-briefcase"></i>', 17),
	(150, 'admin/tao-nhom-quyen', 'POST | App\\Http\\Controllers\\AdminRoleController@taoNhomQuyenPost', 'POST', 'App\\Http\\Controllers\\AdminRoleController@taoNhomQuyenPost', '', '', 1, 1, NULL, NULL, 'admin/tao-nhom-quyen', 0, 1, 1, '<i class="fi-briefcase"></i>', 18),
	(151, 'Phân quyền', 'GET | App\\Http\\Controllers\\AdminRuleController@phanQuyenGet', 'GET', 'App\\Http\\Controllers\\AdminRuleController@phanQuyenGet', '', '', 1, 3, NULL, NULL, 'admin/phan-quyen', 1, 1, 1, '<i class="fi-briefcase"></i>', 19),
	(152, 'admin/phan-quyen', 'POST | App\\Http\\Controllers\\AdminRuleController@phanQuyenPost', 'POST', 'App\\Http\\Controllers\\AdminRuleController@phanQuyenPost', '', '', 1, 1, NULL, NULL, 'admin/phan-quyen', 0, 1, 1, '<i class="fi-briefcase"></i>', 20),
	(153, 'admin/danh-sach-quyen', 'POST | App\\Http\\Controllers\\AdminRuleController@danhSachQuyenPost', 'POST', 'App\\Http\\Controllers\\AdminRuleController@danhSachQuyenPost', '', '', 1, 1, NULL, NULL, 'admin/danh-sach-quyen', 0, 1, 1, '<i class="fi-briefcase"></i>', 21),
	(154, 'Nhân viên', 'GET | App\\Http\\Controllers\\NhanVienController@NhanVien', 'GET', 'App\\Http\\Controllers\\NhanVienController@NhanVien', '', '', 1, 237, NULL, NULL, 'admin/nhan-vien', 1, 1, 1, '<i class="mdi mdi-account-multiple"></i>', 2),
	(155, 'admin/tao-nhan-vien', 'POST | App\\Http\\Controllers\\NhanVienController@TaoNhanVien', 'POST', 'App\\Http\\Controllers\\NhanVienController@TaoNhanVien', '', '', 1, 1, NULL, NULL, 'admin/tao-nhan-vien', 0, 1, 1, '<i class="fi-briefcase"></i>', 23),
	(157, 'admin/xoa-nhan-vien/{id}', 'DELETE | App\\Http\\Controllers\\NhanVienController@XoaNhanVien', 'DELETE', 'App\\Http\\Controllers\\NhanVienController@XoaNhanVien', '', '', 1, 1, NULL, NULL, 'admin/xoa-nhan-vien/{id}', 0, 1, 1, '<i class="fi-briefcase"></i>', 25),
	(218, '/', 'GET | App\\Http\\Controllers\\HomeController@home', 'GET', 'App\\Http\\Controllers\\HomeController@home', '', '', 1, 1, NULL, NULL, '/', 0, 1, 1, '<i class="fi-briefcase"></i>', 1),
	(219, 'admin/xoa-nhom-quyen/{id}', 'DELETE | App\\Http\\Controllers\\AdminRoleController@xoaNhomQuyen', 'DELETE', 'App\\Http\\Controllers\\AdminRoleController@xoaNhomQuyen', '', '', 1, 1, NULL, NULL, 'admin/xoa-nhom-quyen/{id}', 0, 1, 1, '<i class="fi-briefcase"></i>', 20),
	(220, 'admin/sua-nhom-quyen', 'POST | App\\Http\\Controllers\\AdminRoleController@suaNhomQuyen', 'POST', 'App\\Http\\Controllers\\AdminRoleController@suaNhomQuyen', '', '', 1, 1, NULL, NULL, 'admin/sua-nhom-quyen', 0, 1, 1, '<i class="fi-briefcase"></i>', 21),
	(222, 'admin/get-thong-tin-nhan-vien', 'POST | App\\Http\\Controllers\\NhanVienController@getThongTinNhanVien', 'POST', 'App\\Http\\Controllers\\NhanVienController@getThongTinNhanVien', '', '', 1, 1, NULL, NULL, 'admin/get-thong-tin-nhan-vien', 0, 1, 1, '<i class="fi-briefcase"></i>', 29),
	(223, 'admin/sua-nhan-vien', 'POST | App\\Http\\Controllers\\DonViController@suaDonVi', 'POST', 'App\\Http\\Controllers\\DonViController@suaDonVi', '', '', 1, 1, NULL, NULL, 'admin/sua-don-vi', 0, 1, 1, '<i class="fi-briefcase"></i>', 27),
	(224, 'Đơn vị', 'GET | App\\Http\\Controllers\\DonViController@donVi', 'GET', 'App\\Http\\Controllers\\DonViController@donVi', '', '', 1, 1, NULL, NULL, 'admin/don-vi', 1, 1, 1, '<i class="mdi mdi-bank"></i>', 1),
	(225, 'admin/them-don-vi', 'POST | App\\Http\\Controllers\\DonViController@themDonVi', 'POST', 'App\\Http\\Controllers\\DonViController@themDonVi', '', '', 1, 1, NULL, NULL, 'admin/them-don-vi', 0, 1, 1, '<i class="fi-briefcase"></i>', 31),
	(226, 'admin/xoa-don-vi/{id}', 'DELETE | App\\Http\\Controllers\\DonViController@xoaDonVi', 'DELETE', 'App\\Http\\Controllers\\DonViController@xoaDonVi', '', '', 1, 1, NULL, NULL, 'admin/xoa-don-vi/{id}', 0, 1, 1, '<i class="fi-briefcase"></i>', 32),
	(228, 'admin/sua-nhan-vien', 'POST | App\\Http\\Controllers\\NhanVienController@suaNhanVien', 'POST', 'App\\Http\\Controllers\\NhanVienController@suaNhanVien', '', '', 1, 1, NULL, NULL, 'admin/sua-nhan-vien', 0, 1, 1, '<i class="fi-briefcase"></i>', 27),
	(229, 'admin/get-thong-tin-don-vi', 'POST | App\\Http\\Controllers\\DonViController@getThongTinDonVi', 'POST', 'App\\Http\\Controllers\\DonViController@getThongTinDonVi', '', '', 1, 1, NULL, NULL, 'admin/get-thong-tin-don-vi', 0, 1, 1, '<i class="fi-briefcase"></i>', 34),
	(230, 'DM Lỗi', 'GET | App\\Http\\Controllers\\DanhMucLoiController@danhMucLoi', 'GET', 'App\\Http\\Controllers\\DanhMucLoiController@danhMucLoi', '', '', 1, 1, NULL, NULL, 'admin/danh-muc-loi', 1, 1, 1, '<i class="mdi mdi-alert-outline"></i>', 5),
	(231, 'admin/them-danh-muc-loi', 'POST | App\\Http\\Controllers\\DanhMucLoiController@themDanhMucLoi', 'POST', 'App\\Http\\Controllers\\DanhMucLoiController@themDanhMucLoi', '', '', 1, 1, NULL, NULL, 'admin/them-danh-muc-loi', 0, 1, 1, '<i class="fi-briefcase"></i>', 36),
	(232, 'admin/sua-danh-muc-loi', 'POST | App\\Http\\Controllers\\DanhMucLoiController@suaDanhMucLoi', 'POST', 'App\\Http\\Controllers\\DanhMucLoiController@suaDanhMucLoi', '', '', 1, 1, NULL, NULL, 'admin/sua-danh-muc-loi', 0, 1, 1, '<i class="fi-briefcase"></i>', 37),
	(233, 'admin/xoa-danh-muc-loi/{id}', 'DELETE | App\\Http\\Controllers\\DanhMucLoiController@xoaDanhMucLoi', 'DELETE', 'App\\Http\\Controllers\\DanhMucLoiController@xoaDanhMucLoi', '', '', 1, 1, NULL, NULL, 'admin/xoa-danh-muc-loi/{id}', 0, 1, 1, '<i class="fi-briefcase"></i>', 38),
	(234, 'admin/get-thong-tin-danh-muc-loi', 'POST | App\\Http\\Controllers\\DanhMucLoiController@getThongTinDanhMucLoi', 'POST', 'App\\Http\\Controllers\\DanhMucLoiController@getThongTinDanhMucLoi', '', '', 1, 1, NULL, NULL, 'admin/get-thong-tin-danh-muc-loi', 0, 1, 1, '<i class="fi-briefcase"></i>', 39),
	(235, 'admin/get-thong-tin-nhom-quyen', 'POST | App\\Http\\Controllers\\AdminRoleController@getThongTinNhomQuyen', 'POST', 'App\\Http\\Controllers\\AdminRoleController@getThongTinNhomQuyen', '', '', 1, 1, NULL, NULL, 'admin/get-thong-tin-nhom-quyen', 0, 1, 1, '<i class="fi-briefcase"></i>', 22),
	(236, 'admin/urd-danh-muc-loi-word/{id}', 'GET | App\\Http\\Controllers\\DanhMucLoiController@urdDanhMucLoiWord', 'GET', 'App\\Http\\Controllers\\DanhMucLoiController@urdDanhMucLoiWord', '', '', 1, 1, NULL, NULL, 'admin/urd-danh-muc-loi-word/{id}', 0, 1, 1, '<i class="fi-briefcase"></i>', 41),
	(237, 'Nhân viên', '#', '#', '#', '', '', 1, 1, NULL, NULL, '#', 1, 1, 1, '<i class="mdi mdi-account-multiple"></i>', 2),
	(238, 'Công tác hỗ trợ tuần', 'GET | App\\Http\\Controllers\\HoTroController@congTacHoTro', 'GET', 'App\\Http\\Controllers\\HoTroController@congTacHoTro', '', '', 1, 1, NULL, NULL, 'admin/cong-tac-ho-tro', 1, 1, 1, '<i class="mdi mdi-help-network"></i>', 60),
	(239, 'admin/get-danh-muc-loi-theo-loai-danh-muc', 'POST | App\\Http\\Controllers\\HoTroController@getDanhMucLoiTheoLoaiDanhMuc', 'POST', 'App\\Http\\Controllers\\HoTroController@getDanhMucLoiTheoLoaiDanhMuc', '', '', 1, 1, NULL, NULL, 'admin/get-danh-muc-loi-theo-loai-danh-muc', 0, 1, 1, '<i class="fi-briefcase"></i>', 43),
	(240, 'admin/get-danh-cong-tac-ho-tro', 'POST | App\\Http\\Controllers\\HoTroController@getCongTacHoTro', 'POST', 'App\\Http\\Controllers\\HoTroController@getCongTacHoTro', '', '', 1, 1, NULL, NULL, 'admin/get-danh-cong-tac-ho-tro', 0, 1, 1, '<i class="fi-briefcase"></i>', 44),
	(241, 'admin/them-thong-tin-ho-tro', 'POST | App\\Http\\Controllers\\HoTroController@themThongTinHoTro', 'POST', 'App\\Http\\Controllers\\HoTroController@themThongTinHoTro', '', '', 1, 1, NULL, NULL, 'admin/them-thong-tin-ho-tro', 0, 1, 1, '<i class="fi-briefcase"></i>', 45),
	(243, 'Lịch upcode', 'GET | App\\Http\\Controllers\\LichUpcodeController@lichUpcode', 'GET', 'App\\Http\\Controllers\\LichUpcodeController@lichUpcode', '', '', 1, 1, NULL, NULL, 'admin/lich-upcode', 1, 1, 1, '<i class="mdi mdi-calendar-range"></i>', 10),
	(244, 'admin/tao-lich-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@taoLichUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@taoLichUpcode', '', '', 1, 1, NULL, NULL, 'admin/tao-lich-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 48),
	(245, 'admin/sua-lich-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@suaLichUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@suaLichUpcode', '', '', 1, 1, NULL, NULL, 'admin/sua-lich-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 49),
	(246, 'admin/xoa-lich-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@xoaLichUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@xoaLichUpcode', '', '', 1, 1, NULL, NULL, 'admin/xoa-lich-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 50),
	(247, 'admin/load-ds-nhan-su-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@loadDsNhanSuUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@loadDsNhanSuUpcode', '', '', 1, 1, NULL, NULL, 'admin/load-ds-nhan-su-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 51),
	(248, 'admin/them-nhan-su-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@themNhanSuUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@themNhanSuUpcode', '', '', 1, 1, NULL, NULL, 'admin/them-nhan-su-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 52),
	(249, 'admin/xoa-nhan-su-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@xoaNhanSuUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@xoaNhanSuUpcode', '', '', 1, 1, NULL, NULL, 'admin/xoa-nhan-su-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 53),
	(250, 'admin/load-chi-tiet-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@loadChiTietUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@loadChiTietUpcode', '', '', 1, 1, NULL, NULL, 'admin/load-chi-tiet-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 54),
	(251, 'admin/them-chi-tiet-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@themChiTietUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@themChiTietUpcode', '', '', 1, 1, NULL, NULL, 'admin/them-chi-tiet-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 55),
	(253, 'admin/xoa-chi-tiet-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@xoaChiTietUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@xoaChiTietUpcode', '', '', 1, 1, NULL, NULL, 'admin/xoa-chi-tiet-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 57),
	(254, 'admin/load-lich-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@loadLichUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@loadLichUpcode', '', '', 1, 1, NULL, NULL, 'admin/load-lich-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 51),
	(255, 'admin/get-lich-upcode-by-id', 'POST | App\\Http\\Controllers\\LichUpcodeController@getLichUpcodeById', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@getLichUpcodeById', '', '', 1, 1, NULL, NULL, 'admin/get-lich-upcode-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 52),
	(256, 'Bảng phân công', 'GET | App\\Http\\Controllers\\PhanCongController@bangPhanCong', 'GET', 'App\\Http\\Controllers\\PhanCongController@bangPhanCong', '', '', 1, 1, NULL, NULL, 'admin/bang-phan-cong', 1, 1, 1, '<i class="dripicons-document-edit"></i>', 11),
	(257, 'admin/tao-bang-phan-cong', 'POST | App\\Http\\Controllers\\PhanCongController@taoBangPhanCong', 'POST', 'App\\Http\\Controllers\\PhanCongController@taoBangPhanCong', '', '', 1, 1, NULL, NULL, 'admin/tao-bang-phan-cong', 0, 1, 1, '<i class="fi-briefcase"></i>', 60),
	(258, 'admin/sua-bang-phan-cong', 'POST | App\\Http\\Controllers\\PhanCongController@suaBangPhanCong', 'POST', 'App\\Http\\Controllers\\PhanCongController@suaBangPhanCong', '', '', 1, 1, NULL, NULL, 'admin/sua-bang-phan-cong', 0, 1, 1, '<i class="fi-briefcase"></i>', 61),
	(259, 'admin/xoa-bang-phan-cong', 'POST | App\\Http\\Controllers\\PhanCongController@xoaBangPhanCong', 'POST', 'App\\Http\\Controllers\\PhanCongController@xoaBangPhanCong', '', '', 1, 1, NULL, NULL, 'admin/xoa-bang-phan-cong', 0, 1, 1, '<i class="fi-briefcase"></i>', 62),
	(261, 'admin/them-chi-tiet-bang-phan-cong', 'POST | App\\Http\\Controllers\\PhanCongController@themChiTietBangPhanCong', 'POST', 'App\\Http\\Controllers\\PhanCongController@themChiTietBangPhanCong', '', '', 1, 1, NULL, NULL, 'admin/them-chi-tiet-bang-phan-cong', 0, 1, 1, '<i class="fi-briefcase"></i>', 64),
	(262, 'admin/xoa-chi-tiet-bang-phan-cong', 'POST | App\\Http\\Controllers\\PhanCongController@xoaChiTietBangPhanCong', 'POST', 'App\\Http\\Controllers\\PhanCongController@xoaChiTietBangPhanCong', '', '', 1, 1, NULL, NULL, 'admin/xoa-chi-tiet-bang-phan-cong', 0, 1, 1, '<i class="fi-briefcase"></i>', 65),
	(263, 'admin/load-bang-phan-cong', 'POST | App\\Http\\Controllers\\PhanCongController@loadBangPhanCong', 'POST', 'App\\Http\\Controllers\\PhanCongController@loadBangPhanCong', '', '', 1, 1, NULL, NULL, 'admin/load-bang-phan-cong', 0, 1, 1, '<i class="fi-briefcase"></i>', 61),
	(264, 'admin/get-bang-phan-cong-by-id', 'POST | App\\Http\\Controllers\\PhanCongController@getBangPhanCongById', 'POST', 'App\\Http\\Controllers\\PhanCongController@getBangPhanCongById', '', '', 1, 1, NULL, NULL, 'admin/get-bang-phan-cong-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 62),
	(265, 'admin/load-chi-tiet-bang-phan-cong', 'POST | App\\Http\\Controllers\\PhanCongController@loadChiTietBangPhanCong', 'POST', 'App\\Http\\Controllers\\PhanCongController@loadChiTietBangPhanCong', '', '', 1, 1, NULL, NULL, 'admin/load-chi-tiet-bang-phan-cong', 0, 1, 1, '<i class="fi-briefcase"></i>', 65),
	(266, 'DM khách hàng', 'GET | App\\Http\\Controllers\\CanBoController@canBo', 'GET', 'App\\Http\\Controllers\\CanBoController@canBo', '', '', 1, 1, NULL, NULL, 'admin/can-bo', 1, 1, 1, '<i class="dripicons-user-group"></i>', 7),
	(267, 'admin/load-can-bo', 'POST | App\\Http\\Controllers\\CanBoController@loadCanBo', 'POST', 'App\\Http\\Controllers\\CanBoController@loadCanBo', '', '', 1, 1, NULL, NULL, 'admin/load-can-bo', 0, 1, 1, '<i class="fi-briefcase"></i>', 69),
	(268, 'admin/them-can-bo', 'POST | App\\Http\\Controllers\\CanBoController@themCanBo', 'POST', 'App\\Http\\Controllers\\CanBoController@themCanBo', '', '', 1, 1, NULL, NULL, 'admin/them-can-bo', 0, 1, 1, '<i class="fi-briefcase"></i>', 70),
	(269, 'admin/xoa-can-bo', 'POST | App\\Http\\Controllers\\CanBoController@xoaCanBo', 'POST', 'App\\Http\\Controllers\\CanBoController@xoaCanBo', '', '', 1, 1, NULL, NULL, 'admin/xoa-can-bo', 0, 1, 1, '<i class="fi-briefcase"></i>', 71),
	(270, 'admin/sua-can-bo', 'POST | App\\Http\\Controllers\\CanBoController@suaCanBo', 'POST', 'App\\Http\\Controllers\\CanBoController@suaCanBo', '', '', 1, 1, NULL, NULL, 'admin/sua-can-bo', 0, 1, 1, '<i class="fi-briefcase"></i>', 72),
	(271, 'DM đơn vị khách hàng', 'GET | App\\Http\\Controllers\\DmDonViYeuCauController@dmDonViYeuCau', 'GET', 'App\\Http\\Controllers\\DmDonViYeuCauController@dmDonViYeuCau', '', '', 1, 1, NULL, NULL, 'admin/dm-don-vi-yeu-cau', 1, 1, 1, '<i class="dripicons-store"></i>', 6),
	(272, 'admin/load-dm-don-vi-yeu-cau', 'POST | App\\Http\\Controllers\\DmDonViYeuCauController@loadDmDonViYeuCau', 'POST', 'App\\Http\\Controllers\\DmDonViYeuCauController@loadDmDonViYeuCau', '', '', 1, 1, NULL, NULL, 'admin/load-dm-don-vi-yeu-cau', 0, 1, 1, '<i class="fi-briefcase"></i>', 74),
	(273, 'admin/them-dm-don-vi-yeu-cau', 'POST | App\\Http\\Controllers\\DmDonViYeuCauController@themDmDonViYeuCau', 'POST', 'App\\Http\\Controllers\\DmDonViYeuCauController@themDmDonViYeuCau', '', '', 1, 1, NULL, NULL, 'admin/them-dm-don-vi-yeu-cau', 0, 1, 1, '<i class="fi-briefcase"></i>', 75),
	(274, 'admin/xoa-dm-don-vi-yeu-cau', 'POST | App\\Http\\Controllers\\DmDonViYeuCauController@xoaDmDonViYeuCau', 'POST', 'App\\Http\\Controllers\\DmDonViYeuCauController@xoaDmDonViYeuCau', '', '', 1, 1, NULL, NULL, 'admin/xoa-dm-don-vi-yeu-cau', 0, 1, 1, '<i class="fi-briefcase"></i>', 76),
	(275, 'admin/sua-dm-don-vi-yeu-cau', 'POST | App\\Http\\Controllers\\DmDonViYeuCauController@suaDmDonViYeuCau', 'POST', 'App\\Http\\Controllers\\DmDonViYeuCauController@suaDmDonViYeuCau', '', '', 1, 1, NULL, NULL, 'admin/sua-dm-don-vi-yeu-cau', 0, 1, 1, '<i class="fi-briefcase"></i>', 77),
	(276, 'DM loại dịch vụ', 'GET | App\\Http\\Controllers\\LoaiDanhMucController@loaiDanhMuc', 'GET', 'App\\Http\\Controllers\\LoaiDanhMucController@loaiDanhMuc', '', '', 1, 1, NULL, NULL, 'admin/loai-danh-muc', 1, 1, 1, '<i class="dripicons-cart"></i>', 8),
	(277, 'admin/load-loai-danh-muc', 'POST | App\\Http\\Controllers\\LoaiDanhMucController@loadLoaiDanhMuc', 'POST', 'App\\Http\\Controllers\\LoaiDanhMucController@loadLoaiDanhMuc', '', '', 1, 1, NULL, NULL, 'admin/load-loai-danh-muc', 0, 1, 1, '<i class="fi-briefcase"></i>', 79),
	(278, 'admin/them-loai-danh-muc', 'POST | App\\Http\\Controllers\\LoaiDanhMucController@themLoaiDanhMuc', 'POST', 'App\\Http\\Controllers\\LoaiDanhMucController@themLoaiDanhMuc', '', '', 1, 1, NULL, NULL, 'admin/them-loai-danh-muc', 0, 1, 1, '<i class="fi-briefcase"></i>', 80),
	(279, 'admin/xoa-loai-danh-muc', 'POST | App\\Http\\Controllers\\LoaiDanhMucController@xoaLoaiDanhMuc', 'POST', 'App\\Http\\Controllers\\LoaiDanhMucController@xoaLoaiDanhMuc', '', '', 1, 1, NULL, NULL, 'admin/xoa-loai-danh-muc', 0, 1, 1, '<i class="fi-briefcase"></i>', 81),
	(280, 'admin/sua-loai-danh-muc', 'POST | App\\Http\\Controllers\\LoaiDanhMucController@suaLoaiDanhMuc', 'POST', 'App\\Http\\Controllers\\LoaiDanhMucController@suaLoaiDanhMuc', '', '', 1, 1, NULL, NULL, 'admin/sua-loai-danh-muc', 0, 1, 1, '<i class="fi-briefcase"></i>', 82),
	(281, 'Phân đơn vị cho nhân viên', 'GET | App\\Http\\Controllers\\PhanCongCanBoController@phanDonViChoCanBo', 'GET', 'App\\Http\\Controllers\\PhanCongCanBoController@phanDonViChoCanBo', '', '', 1, 237, NULL, NULL, 'admin/phan-don-vi-cho-can-bo', 1, 1, 1, '<i class="fi-briefcase"></i>', 83),
	(282, 'admin/load-user-chua-phan-don-vi', 'POST | App\\Http\\Controllers\\PhanCongCanBoController@loadUserChuaPhanDonVi', 'POST', 'App\\Http\\Controllers\\PhanCongCanBoController@loadUserChuaPhanDonVi', '', '', 1, 1, NULL, NULL, 'admin/load-user-chua-phan-don-vi', 0, 1, 1, '<i class="fi-briefcase"></i>', 84),
	(283, 'admin/load-dm-don-vi-can-phan', 'POST | App\\Http\\Controllers\\PhanCongCanBoController@loadDmDonViCanPhan', 'POST', 'App\\Http\\Controllers\\PhanCongCanBoController@loadDmDonViCanPhan', '', '', 1, 1, NULL, NULL, 'admin/load-dm-don-vi-can-phan', 0, 1, 1, '<i class="fi-briefcase"></i>', 85),
	(284, 'admin/cap-nhat-phan-don-vi-cho-can-bo', 'POST | App\\Http\\Controllers\\PhanCongCanBoController@capNhatPhanDonViChoCanBo', 'POST', 'App\\Http\\Controllers\\PhanCongCanBoController@capNhatPhanDonViChoCanBo', '', '', 1, 1, NULL, NULL, 'admin/cap-nhat-phan-don-vi-cho-can-bo', 0, 1, 1, '<i class="fi-briefcase"></i>', 86),
	(285, 'load-dm-loi-public', 'POST | App\\Http\\Controllers\\HomeController@loadDmLoiPublic', 'POST', 'App\\Http\\Controllers\\HomeController@loadDmLoiPublic', '', '', 1, 1, NULL, NULL, 'load-dm-loi-public', 0, 1, 1, '<i class="fi-briefcase"></i>', 11),
	(287, 'admin/xoa-thong-tin-ho-tro', 'POST | App\\Http\\Controllers\\HoTroController@xoaThongTinHoTro', 'POST', 'App\\Http\\Controllers\\HoTroController@xoaThongTinHoTro', '', '', 1, 1, NULL, NULL, 'admin/xoa-thong-tin-ho-tro', 0, 1, 1, '<i class="fi-briefcase"></i>', 48),
	(288, 'admin/get-danh-muc-loi-by-id', 'POST | App\\Http\\Controllers\\DanhMucLoiController@getDanhMucLoiById', 'POST', 'App\\Http\\Controllers\\DanhMucLoiController@getDanhMucLoiById', '', '', 1, 1, NULL, NULL, 'admin/get-danh-muc-loi-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 43),
	(289, 'admin/sua-trang-thai-chi-tiet-upcode', 'POST | App\\Http\\Controllers\\LichUpcodeController@suaTrangThaiChiTietUpcode', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@suaTrangThaiChiTietUpcode', '', '', 1, 1, NULL, NULL, 'admin/sua-trang-thai-chi-tiet-upcode', 0, 1, 1, '<i class="fi-briefcase"></i>', 62),
	(290, 'Đăng ký nghỉ bù', 'GET | App\\Http\\Controllers\\BaoBuController@baoCaoNghiBu', 'GET', 'App\\Http\\Controllers\\BaoBuController@baoCaoNghiBu', '', '', 1, 1, NULL, NULL, 'admin/bao-cao-nghi-bu', 1, 1, 1, '<i class="mdi mdi-calendar-clock"></i>', 12),
	(291, 'admin/load-bao-cao-nghi-bu', 'POST | App\\Http\\Controllers\\BaoBuController@loadBaoCaoNghiBu', 'POST', 'App\\Http\\Controllers\\BaoBuController@loadBaoCaoNghiBu', '', '', 1, 1, NULL, NULL, 'admin/load-bao-cao-nghi-bu', 0, 1, 1, '<i class="fi-briefcase"></i>', 92),
	(292, 'admin/them-bao-cao-nghi-bu', 'POST | App\\Http\\Controllers\\BaoBuController@themBaoCaoNghiBu', 'POST', 'App\\Http\\Controllers\\BaoBuController@themBaoCaoNghiBu', '', '', 1, 1, NULL, NULL, 'admin/them-bao-cao-nghi-bu', 0, 1, 1, '<i class="fi-briefcase"></i>', 93),
	(293, 'admin/sua-bao-cao-nghi-bu', 'POST | App\\Http\\Controllers\\BaoBuController@suaBaoCaoNghiBu', 'POST', 'App\\Http\\Controllers\\BaoBuController@suaBaoCaoNghiBu', '', '', 1, 1, NULL, NULL, 'admin/sua-bao-cao-nghi-bu', 0, 1, 1, '<i class="fi-briefcase"></i>', 94),
	(294, 'admin/xoa-bao-cao-nghi-bu', 'POST | App\\Http\\Controllers\\BaoBuController@xoaBaoCaoNghiBu', 'POST', 'App\\Http\\Controllers\\BaoBuController@xoaBaoCaoNghiBu', '', '', 1, 1, NULL, NULL, 'admin/xoa-bao-cao-nghi-bu', 0, 1, 1, '<i class="fi-briefcase"></i>', 95),
	(296, 'admin/get-bao-cao-nghi-bu-by-id', 'POST | App\\Http\\Controllers\\BaoBuController@getBaoCaoNghiBuById', 'POST', 'App\\Http\\Controllers\\BaoBuController@getBaoCaoNghiBuById', '', '', 1, 1, NULL, NULL, 'admin/get-bao-cao-nghi-bu-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 97),
	(297, 'DM Link quản trị', 'GET | App\\Http\\Controllers\\DmLinkQuanTriController@dmLinkQuanTri', 'GET', 'App\\Http\\Controllers\\DmLinkQuanTriController@dmLinkQuanTri', '', '', 1, 1, NULL, NULL, 'admin/dm-link-quan-tri', 1, 1, 1, '<i class="dripicons-link"></i>', 9),
	(298, 'admin/load-dm-link-quan-tri', 'POST | App\\Http\\Controllers\\DmLinkQuanTriController@loadDmLinkQuanTri', 'POST', 'App\\Http\\Controllers\\DmLinkQuanTriController@loadDmLinkQuanTri', '', '', 1, 1, NULL, NULL, 'admin/load-dm-link-quan-tri', 0, 1, 1, '<i class="fi-briefcase"></i>', 99),
	(299, 'admin/them-dm-link-quan-tri', 'POST | App\\Http\\Controllers\\DmLinkQuanTriController@themDmLinkQuanTri', 'POST', 'App\\Http\\Controllers\\DmLinkQuanTriController@themDmLinkQuanTri', '', '', 1, 1, NULL, NULL, 'admin/them-dm-link-quan-tri', 0, 1, 1, '<i class="fi-briefcase"></i>', 100),
	(300, 'admin/sua-dm-link-quan-tri', 'POST | App\\Http\\Controllers\\DmLinkQuanTriController@suaDmLinkQuanTri', 'POST', 'App\\Http\\Controllers\\DmLinkQuanTriController@suaDmLinkQuanTri', '', '', 1, 1, NULL, NULL, 'admin/sua-dm-link-quan-tri', 0, 1, 1, '<i class="fi-briefcase"></i>', 101),
	(301, 'admin/xoa-dm-link-quan-tri', 'POST | App\\Http\\Controllers\\DmLinkQuanTriController@xoaDmLinkQuanTri', 'POST', 'App\\Http\\Controllers\\DmLinkQuanTriController@xoaDmLinkQuanTri', '', '', 1, 1, NULL, NULL, 'admin/xoa-dm-link-quan-tri', 0, 1, 1, '<i class="fi-briefcase"></i>', 102),
	(302, 'admin/get-dm-link-quan-tri-by-id', 'POST | App\\Http\\Controllers\\DmLinkQuanTriController@getDmLinkQuanTriById', 'POST', 'App\\Http\\Controllers\\DmLinkQuanTriController@getDmLinkQuanTriById', '', '', 1, 1, NULL, NULL, 'admin/get-dm-link-quan-tri-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 103),
	(303, 'admin/get-can-bo-by-id', 'POST | App\\Http\\Controllers\\CanBoController@getCanBoById', 'POST', 'App\\Http\\Controllers\\CanBoController@getCanBoById', '', '', 1, 1, NULL, NULL, 'admin/get-can-bo-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 77),
	(304, 'admin/get-dm-don-vi-yeu-cau-by-id', 'POST | App\\Http\\Controllers\\DmDonViYeuCauController@getDmDonViYeuCauById', 'POST', 'App\\Http\\Controllers\\DmDonViYeuCauController@getDmDonViYeuCauById', '', '', 1, 1, NULL, NULL, 'admin/get-dm-don-vi-yeu-cau-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 83),
	(305, 'admin/get-loai-danh-muc-by-id', 'POST | App\\Http\\Controllers\\LoaiDanhMucController@getLoaiDanhMucById', 'POST', 'App\\Http\\Controllers\\LoaiDanhMucController@getLoaiDanhMucById', '', '', 1, 1, NULL, NULL, 'admin/get-loai-danh-muc-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 89),
	(306, 'chi-tiet-dm-loi/{id}', 'GET | App\\Http\\Controllers\\HomeController@chiTietDmLoi', 'GET', 'App\\Http\\Controllers\\HomeController@chiTietDmLoi', '', '', 1, 1, NULL, NULL, 'chi-tiet-dm-loi/{id}', 0, 1, 1, '<i class="fi-briefcase"></i>', 12),
	(307, 'DM Chức năng/Module', 'GET | App\\Http\\Controllers\\DanhMucLoiController@danhMucModuleChucNang', 'GET', 'App\\Http\\Controllers\\DanhMucLoiController@danhMucModuleChucNang', '', '', 1, 1, NULL, NULL, 'admin/danh-muc-module-chuc-nang', 1, 1, 1, '<i class="dripicons-checklist"></i>', 5),
	(308, 'admin/them-danh-muc-module-chuc-nang', 'POST | App\\Http\\Controllers\\DanhMucLoiController@themDanhMucModuleChucNang', 'POST', 'App\\Http\\Controllers\\DanhMucLoiController@themDanhMucModuleChucNang', '', '', 1, 1, NULL, NULL, 'admin/them-danh-muc-module-chuc-nang', 0, 1, 1, '<i class="fi-briefcase"></i>', 46),
	(309, 'admin/sua-danh-muc-module-chuc-nang', 'POST | App\\Http\\Controllers\\DanhMucLoiController@suaDanhMucModuleChucNang', 'POST', 'App\\Http\\Controllers\\DanhMucLoiController@suaDanhMucModuleChucNang', '', '', 1, 1, NULL, NULL, 'admin/sua-danh-muc-module-chuc-nang', 0, 1, 1, '<i class="fi-briefcase"></i>', 47),
	(310, 'admin/xoa-danh-muc-module-chuc-nang', 'POST | App\\Http\\Controllers\\DanhMucLoiController@xoaDanhMucModuleChucNang', 'POST', 'App\\Http\\Controllers\\DanhMucLoiController@xoaDanhMucModuleChucNang', '', '', 1, 1, NULL, NULL, 'admin/xoa-danh-muc-module-chuc-nang', 0, 1, 1, '<i class="fi-briefcase"></i>', 48),
	(311, 'admin/get-danh-muc-module-chuc-nang-by-id', 'POST | App\\Http\\Controllers\\DanhMucLoiController@getDanhMucModuleChucNangById', 'POST', 'App\\Http\\Controllers\\DanhMucLoiController@getDanhMucModuleChucNangById', '', '', 1, 1, NULL, NULL, 'admin/get-danh-muc-module-chuc-nang-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 49),
	(312, 'admin/load-danh-muc-module-chuc-nang', 'POST | App\\Http\\Controllers\\DanhMucLoiController@loadDanhMucModuleChucNang', 'POST', 'App\\Http\\Controllers\\DanhMucLoiController@loadDanhMucModuleChucNang', '', '', 1, 1, NULL, NULL, 'admin/load-danh-muc-module-chuc-nang', 0, 1, 1, '<i class="fi-briefcase"></i>', 50),
	(314, 'admin/load-duyet-bao-cao-nghi-bu', 'POST | App\\Http\\Controllers\\BaoBuController@loadDuyetBaoCaoNghiBu', 'POST', 'App\\Http\\Controllers\\BaoBuController@loadDuyetBaoCaoNghiBu', '', '', 1, 1, NULL, NULL, 'admin/load-duyet-bao-cao-nghi-bu', 0, 1, 1, '<i class="fi-briefcase"></i>', 109),
	(315, 'Duyệt nghỉ bù', 'GET | App\\Http\\Controllers\\BaoBuController@duyetBaoCaoNghiBu', 'GET', 'App\\Http\\Controllers\\BaoBuController@duyetBaoCaoNghiBu', '', '', 1, 1, NULL, NULL, 'admin/duyet-bao-cao-nghi-bu', 1, 1, 1, '<i class="mdi mdi-calendar-check"></i>', 12),
	(316, 'admin/duyet-bao-cao-nghi-bu-by-id', 'POST | App\\Http\\Controllers\\BaoBuController@duyetBaoCaoNghiBuById', 'POST', 'App\\Http\\Controllers\\BaoBuController@duyetBaoCaoNghiBuById', '', '', 1, 1, NULL, NULL, 'admin/duyet-bao-cao-nghi-bu-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 108),
	(317, 'Lịch cá nhân', 'GET | App\\Http\\Controllers\\LichUpcodeController@lichUpcodeCaNhan', 'GET', 'App\\Http\\Controllers\\LichUpcodeController@lichUpcodeCaNhan', '', '', 1, 1, NULL, NULL, 'admin/lich-upcode-ca-nhan', 1, 1, 1, '<i class="mdi mdi-calendar-today"></i>', 10),
	(319, 'admin/load-lich-upcode-ca-nhan', 'POST | App\\Http\\Controllers\\LichUpcodeController@loadLichUpcodeCaNhan', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@loadLichUpcodeCaNhan', '', '', 1, 1, NULL, NULL, 'admin/load-lich-upcode-ca-nhan', 0, 1, 1, '<i class="fi-briefcase"></i>', 71),
	(321, 'admin/load-chi-tiet-upcode-ca-nhan', 'POST | App\\Http\\Controllers\\LichUpcodeController@loadChiTietUpcodeCaNhan', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@loadChiTietUpcodeCaNhan', '', '', 1, 1, NULL, NULL, 'admin/load-chi-tiet-upcode-ca-nhan', 0, 1, 1, '<i class="fi-briefcase"></i>', 72),
	(322, 'admin/them-chi-tiet-upcode-ca-nhan', 'POST | App\\Http\\Controllers\\LichUpcodeController@themChiTietUpcodeCaNhan', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@themChiTietUpcodeCaNhan', '', '', 1, 1, NULL, NULL, 'admin/them-chi-tiet-upcode-ca-nhan', 0, 1, 1, '<i class="fi-briefcase"></i>', 73),
	(323, 'admin/load-chi-tiet-upcode-ca-nhan-by-id', 'POST | App\\Http\\Controllers\\LichUpcodeController@loadChiTietUpcodeCaNhanById', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@loadChiTietUpcodeCaNhanById', '', '', 1, 1, NULL, NULL, 'admin/load-chi-tiet-upcode-ca-nhan-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 74),
	(324, 'admin/sua-chi-tiet-upcode-ca-nhan-by-id', 'POST | App\\Http\\Controllers\\LichUpcodeController@suaChiTietUpcodeCaNhanById', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@suaChiTietUpcodeCaNhanById', '', '', 1, 1, NULL, NULL, 'admin/sua-chi-tiet-upcode-ca-nhan-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 75),
	(325, 'admin/load-danh-muc-loi', 'POST | App\\Http\\Controllers\\LichUpcodeController@loadDanhMucLoi', 'POST', 'App\\Http\\Controllers\\LichUpcodeController@loadDanhMucLoi', '', '', 1, 1, NULL, NULL, 'admin/load-danh-muc-loi', 0, 1, 1, '<i class="fi-briefcase"></i>', 63),
	(326, 'admin/get-tuan', 'POST | App\\Http\\Controllers\\HoTroController@getTuan', 'POST', 'App\\Http\\Controllers\\HoTroController@getTuan', '', '', 1, 1, NULL, NULL, 'admin/get-tuan', 0, 1, 1, '<i class="fi-briefcase"></i>', 57),
	(327, 'admin/bao-cao-cong-tac-ho-tro-tuan-word&nam={nam}&tuan={tuan}&dv={dv}', 'GET | App\\Http\\Controllers\\HoTroController@baoCaoCongTacHoTroTuanWord', 'GET', 'App\\Http\\Controllers\\HoTroController@baoCaoCongTacHoTroTuanWord', '', '', 1, 1, NULL, NULL, 'admin/bao-cao-cong-tac-ho-tro-tuan-word&nam={nam}&tuan={tuan}&dv={dv}', 0, 1, 1, '<i class="fi-briefcase"></i>', 55),
	(328, 'export-loai-danh-muc-to-excel/{tungay}/{denngay}', 'GET | App\\Http\\Controllers\\HomeController@exportLoaiDanhMucToExcel', 'GET', 'App\\Http\\Controllers\\HomeController@exportLoaiDanhMucToExcel', '', '', 1, 1, NULL, NULL, 'export-loai-danh-muc-to-excel/{tungay}/{denngay}', 0, 1, 1, '<i class="fi-briefcase"></i>', 13),
	(331, 'Quản lý công việc (nhân viên)', 'GET | App\\Http\\Controllers\\GiaoViecController@congViecNhanVien', 'GET', 'App\\Http\\Controllers\\GiaoViecController@congViecNhanVien', '', '', 1, 1, NULL, NULL, 'admin/cong-viec-nhan-vien', 0, 1, 1, '<i class="fi-briefcase"></i>', 127),
	(332, 'Công việc admin/load-cong-viec-nhan-vien', 'POST | App\\Http\\Controllers\\GiaoViecController@loadCongViecNhanVien', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadCongViecNhanVien', '', '', 1, 1, NULL, NULL, 'admin/load-cong-viec-nhan-vien', 0, 1, 1, '<i class="fi-briefcase"></i>', 128),
	(333, 'Công việc admin/tao-cong-viec', 'POST | App\\Http\\Controllers\\GiaoViecController@taoCongViec', 'POST', 'App\\Http\\Controllers\\GiaoViecController@taoCongViec', '', '', 1, 1, NULL, NULL, 'admin/tao-cong-viec', 0, 1, 1, '<i class="fi-briefcase"></i>', 129),
	(334, 'Công việc admin/sua-cong-viec', 'POST | App\\Http\\Controllers\\GiaoViecController@suaCongViec', 'POST', 'App\\Http\\Controllers\\GiaoViecController@suaCongViec', '', '', 1, 1, NULL, NULL, 'admin/sua-cong-viec', 0, 1, 1, '<i class="fi-briefcase"></i>', 130),
	(335, 'Công việc admin/get-cong-viec-by-id', 'POST | App\\Http\\Controllers\\GiaoViecController@getCongViecById', 'POST', 'App\\Http\\Controllers\\GiaoViecController@getCongViecById', '', '', 1, 1, NULL, NULL, 'admin/get-cong-viec-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 131),
	(336, 'Công việc admin/xoa-cong-viec', 'POST | App\\Http\\Controllers\\GiaoViecController@xoaCongViec', 'POST', 'App\\Http\\Controllers\\GiaoViecController@xoaCongViec', '', '', 1, 1, NULL, NULL, 'admin/xoa-cong-viec', 0, 1, 1, '<i class="fi-briefcase"></i>', 131),
	(337, 'admin/tao-xu-ly', 'POST | App\\Http\\Controllers\\GiaoViecController@taoXuLy', 'POST', 'App\\Http\\Controllers\\GiaoViecController@taoXuLy', '', '', 1, 1, NULL, NULL, 'admin/tao-xu-ly', 0, 1, 1, '<i class="fi-briefcase"></i>', 133),
	(338, 'admin/load-ds-can-bo-xu-ly', 'POST | App\\Http\\Controllers\\GiaoViecController@loadDsCanBoXuLy', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadDsCanBoXuLy', '', '', 1, 1, NULL, NULL, 'admin/load-ds-can-bo-xu-ly', 0, 1, 1, '<i class="fi-briefcase"></i>', 134),
	(339, 'admin/load-ds-noi-dung-xu-ly', 'POST | App\\Http\\Controllers\\GiaoViecController@loadDsNoiDungXuLy', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadDsNoiDungXuLy', '', '', 1, 1, NULL, NULL, 'admin/load-ds-noi-dung-xu-ly', 0, 1, 1, '<i class="fi-briefcase"></i>', 135),
	(341, 'admin/get-noi-dung-xu-ly-by-id', 'POST | App\\Http\\Controllers\\GiaoViecController@getNoiDungXuLyById', 'POST', 'App\\Http\\Controllers\\GiaoViecController@getNoiDungXuLyById', '', '', 1, 1, NULL, NULL, 'admin/get-noi-dung-xu-ly-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 137),
	(343, 'admin/sua-xu-ly', 'POST | App\\Http\\Controllers\\GiaoViecController@suaXuLy', 'POST', 'App\\Http\\Controllers\\GiaoViecController@suaXuLy', '', '', 1, 1, NULL, NULL, 'admin/sua-xu-ly', 0, 1, 1, '<i class="fi-briefcase"></i>', 136),
	(344, 'admin/xoa-xu-ly', 'POST | App\\Http\\Controllers\\GiaoViecController@xoaXuLy', 'POST', 'App\\Http\\Controllers\\GiaoViecController@xoaXuLy', '', '', 1, 1, NULL, NULL, 'admin/xoa-xu-ly', 0, 1, 1, '<i class="fi-briefcase"></i>', 138),
	(345, 'admin/them-can-bo-xu-ly', 'POST | App\\Http\\Controllers\\GiaoViecController@themCanBoXuLy', 'POST', 'App\\Http\\Controllers\\GiaoViecController@themCanBoXuLy', '', '', 1, 1, NULL, NULL, 'admin/them-can-bo-xu-ly', 0, 1, 1, '<i class="fi-briefcase"></i>', 135),
	(346, 'admin/xoa-can-bo-xu-ly', 'POST | App\\Http\\Controllers\\GiaoViecController@xoaCanBoXuLy', 'POST', 'App\\Http\\Controllers\\GiaoViecController@xoaCanBoXuLy', '', '', 1, 1, NULL, NULL, 'admin/xoa-can-bo-xu-ly', 0, 1, 1, '<i class="fi-briefcase"></i>', 136),
	(348, 'Thêm công việc xử lý', 'GET | App\\Http\\Controllers\\GiaoViecController@lanhDaoTaoCongViecV2', 'GET', 'App\\Http\\Controllers\\GiaoViecController@lanhDaoTaoCongViecV2', '', '', 1, 379, NULL, NULL, 'admin/lanh-dao-tao-cong-viec-v2', 1, 1, 1, '<i class="fi-briefcase"></i>', 141),
	(349, 'admin/tao-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@taoCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@taoCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/tao-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 142),
	(350, 'Đăng ký công việc', 'GET | App\\Http\\Controllers\\GiaoViecController@nhanVienTaoCongViecV2', 'GET', 'App\\Http\\Controllers\\GiaoViecController@nhanVienTaoCongViecV2', '', '', 1, 379, NULL, NULL, 'admin/nhan-vien-tao-cong-viec-v2', 1, 1, 1, '<i class="fi-briefcase"></i>', 142),
	(351, 'Giao việc', 'GET | App\\Http\\Controllers\\GiaoViecController@lanhDaoGiaoCongViecV2', 'GET', 'App\\Http\\Controllers\\GiaoViecController@lanhDaoGiaoCongViecV2', '', '', 1, 379, NULL, NULL, 'admin/lanh-dao-giao-cong-viec-v2', 1, 1, 1, '<i class="fi-briefcase"></i>', 144),
	(353, 'admin/load-cay-xu-ly-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@loadCayXuLyCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadCayXuLyCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/load-cay-xu-ly-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 146),
	(354, 'admin/xoa-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@xoaCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@xoaCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/xoa-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 147),
	(355, 'admin/get-chi-tiet-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@getChiTietCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@getChiTietCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/get-chi-tiet-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 148),
	(356, 'admin/load-ds-user-xu-ly-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@loadDsUserXuLyCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadDsUserXuLyCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/load-ds-user-xu-ly-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 149),
	(357, 'admin/them-user-xu-ly-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@themUserXuLyV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@themUserXuLyV2', '', '', 1, 1, NULL, NULL, 'admin/them-user-xu-ly-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 150),
	(358, 'admin/xoa-user-xu-ly-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@xoaUserXuLyCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@xoaUserXuLyCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/xoa-user-xu-ly-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 151),
	(359, 'admin/them-giao-viec-xu-ly-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@themGiaoViecXuLyV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@themGiaoViecXuLyV2', '', '', 1, 1, NULL, NULL, 'admin/them-giao-viec-xu-ly-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 152),
	(360, 'Xử lý công việc', 'GET | App\\Http\\Controllers\\GiaoViecController@xuLyCongViecV2', 'GET', 'App\\Http\\Controllers\\GiaoViecController@xuLyCongViecV2', '', '', 1, 379, NULL, NULL, 'admin/xu-ly-cong-viec-v2', 1, 1, 1, '<i class="fi-briefcase"></i>', 153),
	(363, 'admin/load-ds-cong-viec-can-giao-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@loadDsCongViecCanGiaoV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadDsCongViecCanGiaoV2', '', '', 1, 1, NULL, NULL, 'admin/load-ds-cong-viec-can-giao-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 145),
	(364, 'admin/load-ds-cong-viec-can-xu-ly-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@loadDsCongViecCanXuLyV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadDsCongViecCanXuLyV2', '', '', 1, 1, NULL, NULL, 'admin/load-ds-cong-viec-can-xu-ly-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 154),
	(365, 'admin/chuyen-lanh-dao-duyet-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@chuyenLanhDaoDuyetCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@chuyenLanhDaoDuyetCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/chuyen-lanh-dao-duyet-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 155),
	(366, 'admin/chuyen-lanh-dao-ho-tro-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@chuyenLanhDaoHoTroCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@chuyenLanhDaoHoTroCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/chuyen-lanh-dao-ho-tro-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 156),
	(367, 'Công việc LĐ xử lý', 'GET | App\\Http\\Controllers\\GiaoViecController@lanhDaoHoTroXuLy', 'GET', 'App\\Http\\Controllers\\GiaoViecController@lanhDaoHoTroXuLy', '', '', 1, 379, NULL, NULL, 'admin/lanh-dao-ho-tro-xu-ly-v2', 1, 1, 1, '<i class="fi-briefcase"></i>', 157),
	(368, 'admin/load-ds-cong-viec-can-lanh-dao-ho-tro-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@loadDsCongViecCanLanhDaoHoTroV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadDsCongViecCanLanhDaoHoTroV2', '', '', 1, 1, NULL, NULL, 'admin/load-ds-cong-viec-can-lanh-dao-ho-tro-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 158),
	(369, 'admin/phan-hoi-yeu-cau-ho-tro-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@phanHoiYeuCauHoTroV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@phanHoiYeuCauHoTroV2', '', '', 1, 1, NULL, NULL, 'admin/phan-hoi-yeu-cau-ho-tro-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 159),
	(370, 'admin/duyet-hoan-tat-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@duyetHoanTatCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@duyetHoanTatCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/duyet-hoan-tat-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 160),
	(371, 'Duyệt công việc', 'GET | App\\Http\\Controllers\\GiaoViecController@lanhDaoDuyetCongViec', 'GET', 'App\\Http\\Controllers\\GiaoViecController@lanhDaoDuyetCongViec', '', '', 1, 379, NULL, NULL, 'admin/lanh-dao-duyet-cong-viec-v2', 1, 1, 1, '<i class="fi-briefcase"></i>', 161),
	(372, 'admin/load-ds-cong-viec-can-lanh-dao-duyet-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@loadDsCongViecCanLanhDaoDuyetV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadDsCongViecCanLanhDaoDuyetV2', '', '', 1, 1, NULL, NULL, 'admin/load-ds-cong-viec-can-lanh-dao-duyet-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 162),
	(373, 'admin/phan-hoi-yeu-cau-duyet-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@phanHoiYeuCauDuyetV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@phanHoiYeuCauDuyetV2', '', '', 1, 1, NULL, NULL, 'admin/phan-hoi-yeu-cau-duyet-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 163),
	(374, 'admin/dong-y-duyet-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@dongYDuyetCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@dongYDuyetCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/dong-y-duyet-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 164),
	(375, 'Danh sách công việc đã duyệt', 'GET | App\\Http\\Controllers\\GiaoViecController@danhSachCongViecDaDuyetV2', 'GET', 'App\\Http\\Controllers\\GiaoViecController@danhSachCongViecDaDuyetV2', '', '', 1, 379, NULL, NULL, 'admin/danh-sach-cong-viec-da-duyet-v2', 1, 1, 1, '<i class="fi-briefcase"></i>', 165),
	(376, 'admin/load-danh-sach-cong-viec-da-duyet-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@loadDanhSachCongViecDaDuyetV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadDanhSachCongViecDaDuyetV2', '', '', 1, 1, NULL, NULL, 'admin/load-danh-sach-cong-viec-da-duyet-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 166),
	(377, 'Tất cả công việc', 'GET | App\\Http\\Controllers\\GiaoViecController@tatCaCongViecV2', 'GET', 'App\\Http\\Controllers\\GiaoViecController@tatCaCongViecV2', '', '', 1, 379, NULL, NULL, 'admin/tat-ca-cong-viec-v2', 1, 1, 1, '<i class="fi-briefcase"></i>', 167),
	(378, 'admin/load-tat-ca-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@loadTatCaCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadTatCaCongViecV2', '', '', 1, 1, NULL, NULL, 'admin/load-tat-ca-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 168),
	(379, 'Giao việc V2', '#', '#', '#', '', '', 1, 1, NULL, NULL, '#', 1, 1, 1, '<i class="dripicons-alarm"></i>', 3),
	(380, 'admin/dowload-tai-lieu-cong-viec-v2/{tenFile}', 'GET | App\\Http\\Controllers\\GiaoViecController@downloadTaiLieuCongViecV2', 'GET', 'App\\Http\\Controllers\\GiaoViecController@downloadTaiLieuCongViecV2', '', '', 1, 379, NULL, NULL, 'admin/dowload-tai-lieu-cong-viec-v2/{id}/{stt}', 0, 1, 1, '<i class="fi-briefcase"></i>', 169),
	(381, 'admin/load-ds-user-xu-ly-cong-viec2-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@loadDsUserXuLyCongViec2V2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadDsUserXuLyCongViec2V2', '', '', 1, 379, NULL, NULL, 'admin/load-ds-user-xu-ly-cong-viec2-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 150),
	(382, 'admin/xoa-user-xu-ly-cong-viec2-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@xoaUserXuLyCongViec2V2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@xoaUserXuLyCongViec2V2', '', '', 1, 379, NULL, NULL, 'admin/xoa-user-xu-ly-cong-viec2-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 148),
	(383, 'admin/bao-cao-hoan-tat-cong-viec-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@baoCaoHoanTatCongViecV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@baoCaoHoanTatCongViecV2', '', '', 1, 379, NULL, NULL, 'admin/bao-cao-hoan-tat-cong-viec-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 172),
	(384, 'admin/cap-nhat-giao-viec-xu-ly-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@capNhatGiaoViecXuLyV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@capNhatGiaoViecXuLyV2', '', '', 1, 379, NULL, NULL, 'admin/cap-nhat-giao-viec-xu-ly-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 155),
	(385, 'Công việc đã giao', 'GET | App\\Http\\Controllers\\GiaoViecController@danhSachCongViecDaGiaoV2', 'GET', 'App\\Http\\Controllers\\GiaoViecController@danhSachCongViecDaGiaoV2', '', '', 1, 379, NULL, NULL, 'admin/danh-sach-cong-viec-da-giao-v2', 1, 1, 1, '<i class="fi-briefcase"></i>', 174),
	(386, 'admin/load-ds-cong-viec-da-giao-v2', 'POST | App\\Http\\Controllers\\GiaoViecController@loadDsCongViecDaGiaoV2', 'POST', 'App\\Http\\Controllers\\GiaoViecController@loadDsCongViecDaGiaoV2', '', '', 1, 379, NULL, NULL, 'admin/load-ds-cong-viec-da-giao-v2', 0, 1, 1, '<i class="fi-briefcase"></i>', 175),
	(387, 'To do', 'GET | App\\Http\\Controllers\\ToDoController@toDo', 'GET', 'App\\Http\\Controllers\\ToDoController@toDo', '', '', 1, 1, NULL, NULL, 'admin/to-do', 1, 1, 1, '<i class="dripicons-network-3"></i>', 3),
	(388, 'admin/them-to-do', 'POST | App\\Http\\Controllers\\ToDoController@themToDo', 'POST', 'App\\Http\\Controllers\\ToDoController@themToDo', '', '', 1, 387, NULL, NULL, 'admin/them-to-do', 0, 1, 1, '<i class="fi-briefcase"></i>', 177),
	(389, 'admin/load-ds-my-to-do', 'POST | App\\Http\\Controllers\\ToDoController@loadDsMyToDo', 'POST', 'App\\Http\\Controllers\\ToDoController@loadDsMyToDo', '', '', 1, 387, NULL, NULL, 'admin/load-ds-my-to-do', 0, 1, 1, '<i class="fi-briefcase"></i>', 178),
	(390, 'admin/get-to-do-by-id', 'POST | App\\Http\\Controllers\\ToDoController@getToDoById', 'POST', 'App\\Http\\Controllers\\ToDoController@getToDoById', '', '', 1, 387, NULL, NULL, 'admin/get-to-do-by-id', 0, 1, 1, '<i class="fi-briefcase"></i>', 179),
	(391, 'admin/update-to-do', 'POST | App\\Http\\Controllers\\ToDoController@updateToDo', 'POST', 'App\\Http\\Controllers\\ToDoController@updateToDo', '', '', 1, 387, NULL, NULL, 'admin/update-to-do', 0, 1, 1, '<i class="fi-briefcase"></i>', 180),
	(392, 'admin/delete-to-do', 'POST | App\\Http\\Controllers\\ToDoController@deleteToDo', 'POST', 'App\\Http\\Controllers\\ToDoController@deleteToDo', '', '', 1, 387, NULL, NULL, 'admin/delete-to-do', 0, 1, 1, '<i class="fi-briefcase"></i>', 181),
	(393, 'admin/cap-nhat-trang-thai-to-do', 'POST | App\\Http\\Controllers\\ToDoController@capNhatTrangThaiToDo', 'POST', 'App\\Http\\Controllers\\ToDoController@capNhatTrangThaiToDo', '', '', 1, 387, NULL, NULL, 'admin/cap-nhat-trang-thai-to-do', 0, 1, 1, '<i class="fi-briefcase"></i>', 182),
	(394, 'admin/cap-nhat-thu-tu-to-do', 'POST | App\\Http\\Controllers\\ToDoController@capNhatThuTuToDo', 'POST', 'App\\Http\\Controllers\\ToDoController@capNhatThuTuToDo', '', '', 1, 387, NULL, NULL, 'admin/cap-nhat-thu-tu-to-do', 0, 1, 1, '<i class="fi-briefcase"></i>', 183);
/*!40000 ALTER TABLE `admin_resource` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.admin_role
CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_don_vi` int(11) unsigned NOT NULL COMMENT 'id đơn vị cha có level = 0',
  `state` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '0: ngừng hoạt động; 1: hoạt động',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_admin_role_don_vi` (`id_don_vi`),
  CONSTRAINT `FK_admin_role_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.admin_role: ~7 rows (approximately)
/*!40000 ALTER TABLE `admin_role` DISABLE KEYS */;
INSERT INTO `admin_role` (`id`, `role_name`, `id_don_vi`, `state`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 1, 1, NULL, NULL),
	(2, 'Admin - TTCNTT', 1, 1, NULL, NULL),
	(3, 'Nhân viên - TTCNTT', 1, 1, NULL, NULL),
	(4, 'Lãnh đạo Phòng - TTCNTT', 1, 1, NULL, NULL),
	(5, 'Chuyên Viên', 1, 1, NULL, NULL),
	(6, 'Lãnh đạo Phòng', 1, 1, NULL, NULL),
	(7, 'Lãnh đạo TT', 1, 1, NULL, NULL),
	(8, 'test', 1, 1, NULL, NULL);
/*!40000 ALTER TABLE `admin_role` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.admin_rule
CREATE TABLE IF NOT EXISTS `admin_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_rule_role_id_foreign` (`role_id`),
  KEY `admin_rule_resource_id_foreign` (`resource_id`),
  CONSTRAINT `admin_rule_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `admin_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `admin_rule_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24069 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.admin_rule: ~622 rows (approximately)
/*!40000 ALTER TABLE `admin_rule` DISABLE KEYS */;
INSERT INTO `admin_rule` (`id`, `role_id`, `resource_id`, `created_at`, `updated_at`) VALUES
	(23227, 1, 1, NULL, NULL),
	(23228, 1, 3, NULL, NULL),
	(23229, 1, 133, NULL, NULL),
	(23230, 1, 134, NULL, NULL),
	(23231, 1, 135, NULL, NULL),
	(23232, 1, 136, NULL, NULL),
	(23233, 1, 137, NULL, NULL),
	(23234, 1, 138, NULL, NULL),
	(23235, 1, 139, NULL, NULL),
	(23236, 1, 140, NULL, NULL),
	(23237, 1, 141, NULL, NULL),
	(23238, 1, 142, NULL, NULL),
	(23239, 1, 143, NULL, NULL),
	(23240, 1, 144, NULL, NULL),
	(23241, 1, 145, NULL, NULL),
	(23242, 1, 146, NULL, NULL),
	(23243, 1, 147, NULL, NULL),
	(23244, 1, 148, NULL, NULL),
	(23245, 1, 149, NULL, NULL),
	(23246, 1, 150, NULL, NULL),
	(23247, 1, 151, NULL, NULL),
	(23248, 1, 152, NULL, NULL),
	(23249, 1, 153, NULL, NULL),
	(23250, 1, 154, NULL, NULL),
	(23251, 1, 155, NULL, NULL),
	(23252, 1, 157, NULL, NULL),
	(23253, 1, 218, NULL, NULL),
	(23254, 1, 219, NULL, NULL),
	(23255, 1, 220, NULL, NULL),
	(23256, 1, 222, NULL, NULL),
	(23257, 1, 223, NULL, NULL),
	(23258, 1, 224, NULL, NULL),
	(23259, 1, 225, NULL, NULL),
	(23260, 1, 226, NULL, NULL),
	(23261, 1, 228, NULL, NULL),
	(23262, 1, 229, NULL, NULL),
	(23263, 1, 230, NULL, NULL),
	(23264, 1, 231, NULL, NULL),
	(23265, 1, 232, NULL, NULL),
	(23266, 1, 233, NULL, NULL),
	(23267, 1, 234, NULL, NULL),
	(23268, 1, 235, NULL, NULL),
	(23269, 1, 236, NULL, NULL),
	(23270, 1, 237, NULL, NULL),
	(23271, 1, 238, NULL, NULL),
	(23272, 1, 239, NULL, NULL),
	(23273, 1, 240, NULL, NULL),
	(23274, 1, 241, NULL, NULL),
	(23275, 1, 243, NULL, NULL),
	(23276, 1, 244, NULL, NULL),
	(23277, 1, 245, NULL, NULL),
	(23278, 1, 246, NULL, NULL),
	(23279, 1, 247, NULL, NULL),
	(23280, 1, 248, NULL, NULL),
	(23281, 1, 249, NULL, NULL),
	(23282, 1, 250, NULL, NULL),
	(23283, 1, 251, NULL, NULL),
	(23284, 1, 253, NULL, NULL),
	(23285, 1, 254, NULL, NULL),
	(23286, 1, 255, NULL, NULL),
	(23287, 1, 256, NULL, NULL),
	(23288, 1, 257, NULL, NULL),
	(23289, 1, 258, NULL, NULL),
	(23290, 1, 259, NULL, NULL),
	(23291, 1, 261, NULL, NULL),
	(23292, 1, 262, NULL, NULL),
	(23293, 1, 263, NULL, NULL),
	(23294, 1, 264, NULL, NULL),
	(23295, 1, 265, NULL, NULL),
	(23296, 1, 266, NULL, NULL),
	(23297, 1, 267, NULL, NULL),
	(23298, 1, 268, NULL, NULL),
	(23299, 1, 269, NULL, NULL),
	(23300, 1, 270, NULL, NULL),
	(23301, 1, 271, NULL, NULL),
	(23302, 1, 272, NULL, NULL),
	(23303, 1, 273, NULL, NULL),
	(23304, 1, 274, NULL, NULL),
	(23305, 1, 275, NULL, NULL),
	(23306, 1, 276, NULL, NULL),
	(23307, 1, 277, NULL, NULL),
	(23308, 1, 278, NULL, NULL),
	(23309, 1, 279, NULL, NULL),
	(23310, 1, 280, NULL, NULL),
	(23311, 1, 281, NULL, NULL),
	(23312, 1, 282, NULL, NULL),
	(23313, 1, 283, NULL, NULL),
	(23314, 1, 284, NULL, NULL),
	(23315, 1, 285, NULL, NULL),
	(23316, 1, 287, NULL, NULL),
	(23317, 1, 288, NULL, NULL),
	(23318, 1, 289, NULL, NULL),
	(23319, 1, 290, NULL, NULL),
	(23320, 1, 291, NULL, NULL),
	(23321, 1, 292, NULL, NULL),
	(23322, 1, 293, NULL, NULL),
	(23323, 1, 294, NULL, NULL),
	(23324, 1, 296, NULL, NULL),
	(23325, 1, 297, NULL, NULL),
	(23326, 1, 298, NULL, NULL),
	(23327, 1, 299, NULL, NULL),
	(23328, 1, 300, NULL, NULL),
	(23329, 1, 301, NULL, NULL),
	(23330, 1, 302, NULL, NULL),
	(23331, 1, 303, NULL, NULL),
	(23332, 1, 304, NULL, NULL),
	(23333, 1, 305, NULL, NULL),
	(23334, 1, 306, NULL, NULL),
	(23335, 1, 307, NULL, NULL),
	(23336, 1, 308, NULL, NULL),
	(23337, 1, 309, NULL, NULL),
	(23338, 1, 310, NULL, NULL),
	(23339, 1, 311, NULL, NULL),
	(23340, 1, 312, NULL, NULL),
	(23341, 1, 314, NULL, NULL),
	(23342, 1, 315, NULL, NULL),
	(23343, 1, 316, NULL, NULL),
	(23344, 1, 317, NULL, NULL),
	(23345, 1, 319, NULL, NULL),
	(23346, 1, 321, NULL, NULL),
	(23347, 1, 322, NULL, NULL),
	(23348, 1, 323, NULL, NULL),
	(23349, 1, 324, NULL, NULL),
	(23350, 1, 325, NULL, NULL),
	(23351, 1, 326, NULL, NULL),
	(23352, 1, 327, NULL, NULL),
	(23353, 1, 328, NULL, NULL),
	(23356, 1, 331, NULL, NULL),
	(23357, 1, 332, NULL, NULL),
	(23358, 1, 333, NULL, NULL),
	(23359, 1, 334, NULL, NULL),
	(23360, 1, 335, NULL, NULL),
	(23361, 1, 336, NULL, NULL),
	(23362, 1, 337, NULL, NULL),
	(23363, 1, 338, NULL, NULL),
	(23364, 1, 339, NULL, NULL),
	(23365, 1, 341, NULL, NULL),
	(23366, 1, 343, NULL, NULL),
	(23367, 1, 344, NULL, NULL),
	(23368, 1, 345, NULL, NULL),
	(23369, 1, 346, NULL, NULL),
	(23370, 1, 348, NULL, NULL),
	(23371, 1, 349, NULL, NULL),
	(23372, 1, 350, NULL, NULL),
	(23373, 1, 351, NULL, NULL),
	(23374, 1, 353, NULL, NULL),
	(23375, 1, 354, NULL, NULL),
	(23376, 1, 355, NULL, NULL),
	(23377, 1, 356, NULL, NULL),
	(23378, 1, 357, NULL, NULL),
	(23379, 1, 358, NULL, NULL),
	(23380, 1, 359, NULL, NULL),
	(23381, 1, 360, NULL, NULL),
	(23382, 1, 363, NULL, NULL),
	(23383, 1, 364, NULL, NULL),
	(23384, 1, 365, NULL, NULL),
	(23385, 1, 366, NULL, NULL),
	(23386, 1, 367, NULL, NULL),
	(23387, 1, 368, NULL, NULL),
	(23388, 1, 369, NULL, NULL),
	(23389, 1, 370, NULL, NULL),
	(23390, 1, 371, NULL, NULL),
	(23391, 1, 372, NULL, NULL),
	(23392, 1, 373, NULL, NULL),
	(23393, 1, 374, NULL, NULL),
	(23394, 1, 375, NULL, NULL),
	(23395, 1, 376, NULL, NULL),
	(23396, 1, 377, NULL, NULL),
	(23397, 1, 378, NULL, NULL),
	(23398, 1, 379, NULL, NULL),
	(23399, 1, 380, NULL, NULL),
	(23400, 1, 381, NULL, NULL),
	(23401, 1, 382, NULL, NULL),
	(23402, 1, 383, NULL, NULL),
	(23403, 1, 384, NULL, NULL),
	(23404, 1, 385, NULL, NULL),
	(23405, 1, 386, NULL, NULL),
	(23406, 1, 387, NULL, NULL),
	(23407, 1, 388, NULL, NULL),
	(23408, 1, 389, NULL, NULL),
	(23409, 1, 390, NULL, NULL),
	(23410, 1, 391, NULL, NULL),
	(23411, 1, 392, NULL, NULL),
	(23412, 1, 393, NULL, NULL),
	(23413, 1, 394, NULL, NULL),
	(23536, 2, 1, NULL, NULL),
	(23537, 2, 3, NULL, NULL),
	(23538, 2, 133, NULL, NULL),
	(23539, 2, 134, NULL, NULL),
	(23540, 2, 135, NULL, NULL),
	(23541, 2, 136, NULL, NULL),
	(23542, 2, 137, NULL, NULL),
	(23543, 2, 138, NULL, NULL),
	(23544, 2, 139, NULL, NULL),
	(23545, 2, 140, NULL, NULL),
	(23546, 2, 141, NULL, NULL),
	(23547, 2, 149, NULL, NULL),
	(23548, 2, 150, NULL, NULL),
	(23549, 2, 151, NULL, NULL),
	(23550, 2, 152, NULL, NULL),
	(23551, 2, 153, NULL, NULL),
	(23552, 2, 154, NULL, NULL),
	(23553, 2, 155, NULL, NULL),
	(23554, 2, 157, NULL, NULL),
	(23555, 2, 218, NULL, NULL),
	(23556, 2, 219, NULL, NULL),
	(23557, 2, 220, NULL, NULL),
	(23558, 2, 222, NULL, NULL),
	(23559, 2, 223, NULL, NULL),
	(23560, 2, 224, NULL, NULL),
	(23561, 2, 225, NULL, NULL),
	(23562, 2, 226, NULL, NULL),
	(23563, 2, 228, NULL, NULL),
	(23564, 2, 229, NULL, NULL),
	(23565, 2, 235, NULL, NULL),
	(23566, 2, 237, NULL, NULL),
	(23567, 2, 256, NULL, NULL),
	(23568, 2, 257, NULL, NULL),
	(23569, 2, 258, NULL, NULL),
	(23570, 2, 259, NULL, NULL),
	(23571, 2, 261, NULL, NULL),
	(23572, 2, 262, NULL, NULL),
	(23573, 2, 263, NULL, NULL),
	(23574, 2, 264, NULL, NULL),
	(23575, 2, 265, NULL, NULL),
	(23576, 2, 276, NULL, NULL),
	(23577, 2, 277, NULL, NULL),
	(23578, 2, 278, NULL, NULL),
	(23579, 2, 279, NULL, NULL),
	(23580, 2, 280, NULL, NULL),
	(23581, 2, 281, NULL, NULL),
	(23582, 2, 282, NULL, NULL),
	(23583, 2, 283, NULL, NULL),
	(23584, 2, 284, NULL, NULL),
	(23585, 2, 305, NULL, NULL),
	(23586, 2, 348, NULL, NULL),
	(23587, 2, 349, NULL, NULL),
	(23588, 2, 350, NULL, NULL),
	(23589, 2, 351, NULL, NULL),
	(23590, 2, 353, NULL, NULL),
	(23591, 2, 354, NULL, NULL),
	(23592, 2, 355, NULL, NULL),
	(23593, 2, 356, NULL, NULL),
	(23594, 2, 357, NULL, NULL),
	(23595, 2, 358, NULL, NULL),
	(23596, 2, 359, NULL, NULL),
	(23597, 2, 360, NULL, NULL),
	(23598, 2, 363, NULL, NULL),
	(23599, 2, 364, NULL, NULL),
	(23600, 2, 365, NULL, NULL),
	(23601, 2, 366, NULL, NULL),
	(23602, 2, 367, NULL, NULL),
	(23603, 2, 368, NULL, NULL),
	(23604, 2, 369, NULL, NULL),
	(23605, 2, 370, NULL, NULL),
	(23606, 2, 371, NULL, NULL),
	(23607, 2, 372, NULL, NULL),
	(23608, 2, 373, NULL, NULL),
	(23609, 2, 374, NULL, NULL),
	(23610, 2, 375, NULL, NULL),
	(23611, 2, 376, NULL, NULL),
	(23612, 2, 377, NULL, NULL),
	(23613, 2, 378, NULL, NULL),
	(23614, 2, 379, NULL, NULL),
	(23615, 2, 380, NULL, NULL),
	(23616, 2, 381, NULL, NULL),
	(23617, 2, 382, NULL, NULL),
	(23618, 2, 383, NULL, NULL),
	(23619, 2, 387, NULL, NULL),
	(23620, 2, 388, NULL, NULL),
	(23621, 2, 389, NULL, NULL),
	(23622, 2, 390, NULL, NULL),
	(23623, 2, 391, NULL, NULL),
	(23624, 2, 392, NULL, NULL),
	(23625, 2, 393, NULL, NULL),
	(23626, 2, 394, NULL, NULL),
	(23690, 5, 1, NULL, NULL),
	(23691, 5, 133, NULL, NULL),
	(23692, 5, 134, NULL, NULL),
	(23693, 5, 135, NULL, NULL),
	(23694, 5, 136, NULL, NULL),
	(23695, 5, 137, NULL, NULL),
	(23696, 5, 138, NULL, NULL),
	(23697, 5, 139, NULL, NULL),
	(23698, 5, 140, NULL, NULL),
	(23699, 5, 141, NULL, NULL),
	(23700, 5, 238, NULL, NULL),
	(23701, 5, 239, NULL, NULL),
	(23702, 5, 240, NULL, NULL),
	(23703, 5, 241, NULL, NULL),
	(23704, 5, 332, NULL, NULL),
	(23705, 5, 333, NULL, NULL),
	(23706, 5, 334, NULL, NULL),
	(23707, 5, 335, NULL, NULL),
	(23708, 5, 336, NULL, NULL),
	(23709, 5, 337, NULL, NULL),
	(23710, 5, 349, NULL, NULL),
	(23711, 5, 350, NULL, NULL),
	(23712, 5, 353, NULL, NULL),
	(23713, 5, 354, NULL, NULL),
	(23714, 5, 355, NULL, NULL),
	(23715, 5, 356, NULL, NULL),
	(23716, 5, 357, NULL, NULL),
	(23717, 5, 358, NULL, NULL),
	(23718, 5, 359, NULL, NULL),
	(23719, 5, 360, NULL, NULL),
	(23720, 5, 363, NULL, NULL),
	(23721, 5, 364, NULL, NULL),
	(23722, 5, 365, NULL, NULL),
	(23723, 5, 366, NULL, NULL),
	(23724, 5, 377, NULL, NULL),
	(23725, 5, 378, NULL, NULL),
	(23726, 5, 379, NULL, NULL),
	(23727, 5, 380, NULL, NULL),
	(23728, 5, 383, NULL, NULL),
	(23729, 5, 387, NULL, NULL),
	(23730, 5, 388, NULL, NULL),
	(23731, 5, 389, NULL, NULL),
	(23732, 5, 390, NULL, NULL),
	(23733, 5, 391, NULL, NULL),
	(23734, 5, 392, NULL, NULL),
	(23735, 5, 393, NULL, NULL),
	(23736, 5, 394, NULL, NULL),
	(23737, 6, 1, NULL, NULL),
	(23738, 6, 133, NULL, NULL),
	(23739, 6, 134, NULL, NULL),
	(23740, 6, 135, NULL, NULL),
	(23741, 6, 136, NULL, NULL),
	(23742, 6, 137, NULL, NULL),
	(23743, 6, 138, NULL, NULL),
	(23744, 6, 139, NULL, NULL),
	(23745, 6, 140, NULL, NULL),
	(23746, 6, 141, NULL, NULL),
	(23747, 6, 154, NULL, NULL),
	(23748, 6, 155, NULL, NULL),
	(23749, 6, 157, NULL, NULL),
	(23750, 6, 218, NULL, NULL),
	(23751, 6, 222, NULL, NULL),
	(23752, 6, 223, NULL, NULL),
	(23753, 6, 237, NULL, NULL),
	(23754, 6, 317, NULL, NULL),
	(23755, 6, 319, NULL, NULL),
	(23756, 6, 321, NULL, NULL),
	(23757, 6, 322, NULL, NULL),
	(23758, 6, 323, NULL, NULL),
	(23759, 6, 324, NULL, NULL),
	(23760, 6, 325, NULL, NULL),
	(23761, 6, 326, NULL, NULL),
	(23762, 6, 327, NULL, NULL),
	(23763, 6, 328, NULL, NULL),
	(23764, 6, 348, NULL, NULL),
	(23765, 6, 349, NULL, NULL),
	(23766, 6, 351, NULL, NULL),
	(23767, 6, 353, NULL, NULL),
	(23768, 6, 354, NULL, NULL),
	(23769, 6, 355, NULL, NULL),
	(23770, 6, 356, NULL, NULL),
	(23771, 6, 357, NULL, NULL),
	(23772, 6, 358, NULL, NULL),
	(23773, 6, 359, NULL, NULL),
	(23774, 6, 360, NULL, NULL),
	(23775, 6, 363, NULL, NULL),
	(23776, 6, 364, NULL, NULL),
	(23777, 6, 365, NULL, NULL),
	(23778, 6, 366, NULL, NULL),
	(23779, 6, 367, NULL, NULL),
	(23780, 6, 368, NULL, NULL),
	(23781, 6, 369, NULL, NULL),
	(23782, 6, 370, NULL, NULL),
	(23783, 6, 371, NULL, NULL),
	(23784, 6, 372, NULL, NULL),
	(23785, 6, 373, NULL, NULL),
	(23786, 6, 374, NULL, NULL),
	(23787, 6, 375, NULL, NULL),
	(23788, 6, 376, NULL, NULL),
	(23789, 6, 377, NULL, NULL),
	(23790, 6, 378, NULL, NULL),
	(23791, 6, 379, NULL, NULL),
	(23792, 6, 380, NULL, NULL),
	(23793, 6, 381, NULL, NULL),
	(23794, 6, 382, NULL, NULL),
	(23795, 6, 387, NULL, NULL),
	(23796, 6, 388, NULL, NULL),
	(23797, 6, 389, NULL, NULL),
	(23798, 6, 390, NULL, NULL),
	(23799, 6, 391, NULL, NULL),
	(23800, 6, 392, NULL, NULL),
	(23801, 6, 393, NULL, NULL),
	(23802, 6, 394, NULL, NULL),
	(23803, 7, 1, NULL, NULL),
	(23804, 7, 133, NULL, NULL),
	(23805, 7, 134, NULL, NULL),
	(23806, 7, 135, NULL, NULL),
	(23807, 7, 136, NULL, NULL),
	(23808, 7, 137, NULL, NULL),
	(23809, 7, 138, NULL, NULL),
	(23810, 7, 139, NULL, NULL),
	(23811, 7, 140, NULL, NULL),
	(23812, 7, 141, NULL, NULL),
	(23813, 7, 348, NULL, NULL),
	(23814, 7, 349, NULL, NULL),
	(23815, 7, 351, NULL, NULL),
	(23816, 7, 353, NULL, NULL),
	(23817, 7, 354, NULL, NULL),
	(23818, 7, 355, NULL, NULL),
	(23819, 7, 356, NULL, NULL),
	(23820, 7, 357, NULL, NULL),
	(23821, 7, 358, NULL, NULL),
	(23822, 7, 359, NULL, NULL),
	(23823, 7, 367, NULL, NULL),
	(23824, 7, 368, NULL, NULL),
	(23825, 7, 369, NULL, NULL),
	(23826, 7, 370, NULL, NULL),
	(23827, 7, 371, NULL, NULL),
	(23828, 7, 372, NULL, NULL),
	(23829, 7, 373, NULL, NULL),
	(23830, 7, 374, NULL, NULL),
	(23831, 7, 375, NULL, NULL),
	(23832, 7, 376, NULL, NULL),
	(23833, 7, 377, NULL, NULL),
	(23834, 7, 378, NULL, NULL),
	(23835, 7, 379, NULL, NULL),
	(23836, 7, 380, NULL, NULL),
	(23837, 7, 381, NULL, NULL),
	(23838, 7, 382, NULL, NULL),
	(23839, 7, 387, NULL, NULL),
	(23840, 7, 388, NULL, NULL),
	(23841, 7, 389, NULL, NULL),
	(23842, 7, 390, NULL, NULL),
	(23843, 7, 391, NULL, NULL),
	(23844, 7, 392, NULL, NULL),
	(23845, 7, 393, NULL, NULL),
	(23846, 7, 394, NULL, NULL),
	(23847, 4, 1, NULL, NULL),
	(23848, 4, 133, NULL, NULL),
	(23849, 4, 134, NULL, NULL),
	(23850, 4, 135, NULL, NULL),
	(23851, 4, 136, NULL, NULL),
	(23852, 4, 137, NULL, NULL),
	(23853, 4, 138, NULL, NULL),
	(23854, 4, 139, NULL, NULL),
	(23855, 4, 140, NULL, NULL),
	(23856, 4, 141, NULL, NULL),
	(23857, 4, 154, NULL, NULL),
	(23858, 4, 155, NULL, NULL),
	(23859, 4, 157, NULL, NULL),
	(23860, 4, 218, NULL, NULL),
	(23861, 4, 219, NULL, NULL),
	(23862, 4, 220, NULL, NULL),
	(23863, 4, 222, NULL, NULL),
	(23864, 4, 223, NULL, NULL),
	(23865, 4, 224, NULL, NULL),
	(23866, 4, 225, NULL, NULL),
	(23867, 4, 226, NULL, NULL),
	(23868, 4, 228, NULL, NULL),
	(23869, 4, 229, NULL, NULL),
	(23870, 4, 230, NULL, NULL),
	(23871, 4, 231, NULL, NULL),
	(23872, 4, 232, NULL, NULL),
	(23873, 4, 233, NULL, NULL),
	(23874, 4, 234, NULL, NULL),
	(23875, 4, 235, NULL, NULL),
	(23876, 4, 236, NULL, NULL),
	(23877, 4, 237, NULL, NULL),
	(23878, 4, 238, NULL, NULL),
	(23879, 4, 239, NULL, NULL),
	(23880, 4, 240, NULL, NULL),
	(23881, 4, 241, NULL, NULL),
	(23882, 4, 243, NULL, NULL),
	(23883, 4, 244, NULL, NULL),
	(23884, 4, 245, NULL, NULL),
	(23885, 4, 246, NULL, NULL),
	(23886, 4, 247, NULL, NULL),
	(23887, 4, 248, NULL, NULL),
	(23888, 4, 249, NULL, NULL),
	(23889, 4, 250, NULL, NULL),
	(23890, 4, 251, NULL, NULL),
	(23891, 4, 253, NULL, NULL),
	(23892, 4, 254, NULL, NULL),
	(23893, 4, 255, NULL, NULL),
	(23894, 4, 256, NULL, NULL),
	(23895, 4, 257, NULL, NULL),
	(23896, 4, 258, NULL, NULL),
	(23897, 4, 259, NULL, NULL),
	(23898, 4, 261, NULL, NULL),
	(23899, 4, 262, NULL, NULL),
	(23900, 4, 263, NULL, NULL),
	(23901, 4, 264, NULL, NULL),
	(23902, 4, 265, NULL, NULL),
	(23903, 4, 266, NULL, NULL),
	(23904, 4, 267, NULL, NULL),
	(23905, 4, 268, NULL, NULL),
	(23906, 4, 269, NULL, NULL),
	(23907, 4, 270, NULL, NULL),
	(23908, 4, 271, NULL, NULL),
	(23909, 4, 272, NULL, NULL),
	(23910, 4, 273, NULL, NULL),
	(23911, 4, 274, NULL, NULL),
	(23912, 4, 275, NULL, NULL),
	(23913, 4, 276, NULL, NULL),
	(23914, 4, 277, NULL, NULL),
	(23915, 4, 278, NULL, NULL),
	(23916, 4, 279, NULL, NULL),
	(23917, 4, 280, NULL, NULL),
	(23918, 4, 281, NULL, NULL),
	(23919, 4, 282, NULL, NULL),
	(23920, 4, 283, NULL, NULL),
	(23921, 4, 284, NULL, NULL),
	(23922, 4, 285, NULL, NULL),
	(23923, 4, 287, NULL, NULL),
	(23924, 4, 288, NULL, NULL),
	(23925, 4, 289, NULL, NULL),
	(23926, 4, 305, NULL, NULL),
	(23927, 4, 306, NULL, NULL),
	(23928, 4, 315, NULL, NULL),
	(23929, 4, 316, NULL, NULL),
	(23930, 4, 325, NULL, NULL),
	(23931, 4, 348, NULL, NULL),
	(23932, 4, 349, NULL, NULL),
	(23933, 4, 351, NULL, NULL),
	(23934, 4, 353, NULL, NULL),
	(23935, 4, 354, NULL, NULL),
	(23936, 4, 355, NULL, NULL),
	(23937, 4, 356, NULL, NULL),
	(23938, 4, 357, NULL, NULL),
	(23939, 4, 358, NULL, NULL),
	(23940, 4, 359, NULL, NULL),
	(23941, 4, 363, NULL, NULL),
	(23942, 4, 367, NULL, NULL),
	(23943, 4, 368, NULL, NULL),
	(23944, 4, 369, NULL, NULL),
	(23945, 4, 370, NULL, NULL),
	(23946, 4, 371, NULL, NULL),
	(23947, 4, 372, NULL, NULL),
	(23948, 4, 373, NULL, NULL),
	(23949, 4, 374, NULL, NULL),
	(23950, 4, 375, NULL, NULL),
	(23951, 4, 376, NULL, NULL),
	(23952, 4, 377, NULL, NULL),
	(23953, 4, 378, NULL, NULL),
	(23954, 4, 379, NULL, NULL),
	(23955, 4, 380, NULL, NULL),
	(23956, 4, 381, NULL, NULL),
	(23957, 4, 382, NULL, NULL),
	(23958, 4, 383, NULL, NULL),
	(23959, 4, 384, NULL, NULL),
	(23960, 4, 385, NULL, NULL),
	(23961, 4, 386, NULL, NULL),
	(23962, 4, 387, NULL, NULL),
	(23963, 4, 388, NULL, NULL),
	(23964, 4, 389, NULL, NULL),
	(23965, 4, 390, NULL, NULL),
	(23966, 4, 391, NULL, NULL),
	(23967, 4, 392, NULL, NULL),
	(23968, 4, 393, NULL, NULL),
	(23969, 4, 394, NULL, NULL),
	(23970, 3, 1, NULL, NULL),
	(23971, 3, 133, NULL, NULL),
	(23972, 3, 134, NULL, NULL),
	(23973, 3, 135, NULL, NULL),
	(23974, 3, 136, NULL, NULL),
	(23975, 3, 137, NULL, NULL),
	(23976, 3, 138, NULL, NULL),
	(23977, 3, 139, NULL, NULL),
	(23978, 3, 140, NULL, NULL),
	(23979, 3, 141, NULL, NULL),
	(23980, 3, 218, NULL, NULL),
	(23981, 3, 290, NULL, NULL),
	(23982, 3, 291, NULL, NULL),
	(23983, 3, 292, NULL, NULL),
	(23984, 3, 293, NULL, NULL),
	(23985, 3, 294, NULL, NULL),
	(23986, 3, 296, NULL, NULL),
	(23987, 3, 317, NULL, NULL),
	(23988, 3, 319, NULL, NULL),
	(23989, 3, 321, NULL, NULL),
	(23990, 3, 322, NULL, NULL),
	(23991, 3, 323, NULL, NULL),
	(23992, 3, 324, NULL, NULL),
	(23993, 3, 325, NULL, NULL),
	(23994, 3, 326, NULL, NULL),
	(23995, 3, 327, NULL, NULL),
	(23996, 3, 328, NULL, NULL),
	(23997, 3, 331, NULL, NULL),
	(23998, 3, 332, NULL, NULL),
	(23999, 3, 333, NULL, NULL),
	(24000, 3, 334, NULL, NULL),
	(24001, 3, 335, NULL, NULL),
	(24002, 3, 336, NULL, NULL),
	(24003, 3, 337, NULL, NULL),
	(24004, 3, 338, NULL, NULL),
	(24005, 3, 339, NULL, NULL),
	(24006, 3, 341, NULL, NULL),
	(24007, 3, 343, NULL, NULL),
	(24008, 3, 344, NULL, NULL),
	(24009, 3, 345, NULL, NULL),
	(24010, 3, 346, NULL, NULL),
	(24011, 3, 349, NULL, NULL),
	(24012, 3, 350, NULL, NULL),
	(24013, 3, 353, NULL, NULL),
	(24014, 3, 355, NULL, NULL),
	(24015, 3, 356, NULL, NULL),
	(24016, 3, 360, NULL, NULL),
	(24017, 3, 363, NULL, NULL),
	(24018, 3, 364, NULL, NULL),
	(24019, 3, 365, NULL, NULL),
	(24020, 3, 366, NULL, NULL),
	(24021, 3, 377, NULL, NULL),
	(24022, 3, 378, NULL, NULL),
	(24023, 3, 379, NULL, NULL),
	(24024, 3, 380, NULL, NULL),
	(24025, 3, 383, NULL, NULL),
	(24026, 3, 387, NULL, NULL),
	(24027, 3, 388, NULL, NULL),
	(24028, 3, 389, NULL, NULL),
	(24029, 3, 390, NULL, NULL),
	(24030, 3, 391, NULL, NULL),
	(24031, 3, 392, NULL, NULL),
	(24032, 3, 393, NULL, NULL),
	(24033, 3, 394, NULL, NULL),
	(24038, 8, 224, NULL, NULL),
	(24039, 8, 237, NULL, NULL),
	(24040, 8, 154, NULL, NULL),
	(24041, 8, 281, NULL, NULL),
	(24042, 8, 387, NULL, NULL),
	(24043, 8, 379, NULL, NULL),
	(24044, 8, 348, NULL, NULL),
	(24045, 8, 350, NULL, NULL),
	(24046, 8, 351, NULL, NULL),
	(24047, 8, 360, NULL, NULL),
	(24048, 8, 367, NULL, NULL),
	(24049, 8, 371, NULL, NULL),
	(24050, 8, 375, NULL, NULL),
	(24051, 8, 377, NULL, NULL),
	(24052, 8, 385, NULL, NULL),
	(24053, 8, 3, NULL, NULL),
	(24054, 8, 149, NULL, NULL),
	(24055, 8, 151, NULL, NULL),
	(24056, 8, 142, NULL, NULL),
	(24057, 8, 307, NULL, NULL),
	(24058, 8, 230, NULL, NULL),
	(24059, 8, 271, NULL, NULL),
	(24060, 8, 266, NULL, NULL),
	(24061, 8, 276, NULL, NULL),
	(24062, 8, 297, NULL, NULL),
	(24063, 8, 317, NULL, NULL),
	(24064, 8, 243, NULL, NULL),
	(24065, 8, 256, NULL, NULL),
	(24066, 8, 315, NULL, NULL),
	(24067, 8, 290, NULL, NULL),
	(24068, 8, 238, NULL, NULL);
/*!40000 ALTER TABLE `admin_rule` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.bao_cao_nghi_bu
CREATE TABLE IF NOT EXISTS `bao_cao_nghi_bu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(11) unsigned DEFAULT NULL COMMENT 'id user xin được nghỉ bù',
  `id_users_duyet` int(11) unsigned DEFAULT NULL COMMENT 'id user duyệt cho phép nghỉ bù',
  `id_lich_upcode` int(11) unsigned DEFAULT NULL,
  `noi_dung_nghi_bu` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_tai_khoan_duoc_chia_se` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_don_vi_duoc_chia_se` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thoi_gian_yeu_cau_nghi_bu` float DEFAULT NULL,
  `thoi_gian_duoc_duyet_nghi_bu` float DEFAULT NULL,
  `ngay_gui_yeu_cau` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_duyet` datetime DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '0' COMMENT '0 không được duyệt; 1 được duyệt; 2 đã nghỉ',
  PRIMARY KEY (`id`),
  KEY `FK_bao_cao_nghi_bu_users` (`id_users`),
  KEY `FK_bao_cao_nghi_bu_lich_upcode` (`id_lich_upcode`),
  KEY `FK_bao_cao_nghi_bu_users_2` (`id_users_duyet`),
  CONSTRAINT `FK_bao_cao_nghi_bu_lich_upcode` FOREIGN KEY (`id_lich_upcode`) REFERENCES `lich_upcode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bao_cao_nghi_bu_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bao_cao_nghi_bu_users_2` FOREIGN KEY (`id_users_duyet`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.bao_cao_nghi_bu: ~0 rows (approximately)
/*!40000 ALTER TABLE `bao_cao_nghi_bu` DISABLE KEYS */;
/*!40000 ALTER TABLE `bao_cao_nghi_bu` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.can_bo
CREATE TABLE IF NOT EXISTS `can_bo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned DEFAULT '1' COMMENT 'id user tạo, để sau này đổi thành id user để cho cán bộ đăng nhập được luôn',
  `ten_can_bo` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_dm_don_vi_yeu_cau` int(11) unsigned DEFAULT NULL,
  `di_dong` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_chuc_vu` int(11) unsigned NOT NULL,
  `dia_chi` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT '1' COMMENT '1 còn làm; 0 nghỉ làm',
  PRIMARY KEY (`id`),
  KEY `FK_can_bo_Users` (`id_user`),
  KEY `FK_can_bo_dm_don_vi_yeu_cau` (`id_dm_don_vi_yeu_cau`),
  KEY `FK_can_bo_dm_chuc_vu` (`id_chuc_vu`),
  CONSTRAINT `FK_can_bo_Users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_can_bo_dm_chuc_vu` FOREIGN KEY (`id_chuc_vu`) REFERENCES `dm_chuc_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_can_bo_dm_don_vi_yeu_cau` FOREIGN KEY (`id_dm_don_vi_yeu_cau`) REFERENCES `dm_don_vi_yeu_cau` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.can_bo: ~0 rows (approximately)
/*!40000 ALTER TABLE `can_bo` DISABLE KEYS */;
/*!40000 ALTER TABLE `can_bo` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.chi_tiet_phan_cong
CREATE TABLE IF NOT EXISTS `chi_tiet_phan_cong` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_phan_cong` int(11) unsigned NOT NULL DEFAULT '1',
  `id_dm_don_vi_yeu_cau` int(11) unsigned NOT NULL DEFAULT '1',
  `tu_ngay` date DEFAULT NULL,
  `den_ngay` date DEFAULT NULL,
  `ghi_chu` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_chi_tiet_phan_cong_phan_cong` (`id_phan_cong`),
  KEY `FK_chi_tiet_phan_cong_dm_don_vi_yeu_cau` (`id_dm_don_vi_yeu_cau`),
  CONSTRAINT `FK_chi_tiet_phan_cong_dm_don_vi_yeu_cau` FOREIGN KEY (`id_dm_don_vi_yeu_cau`) REFERENCES `dm_don_vi_yeu_cau` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_chi_tiet_phan_cong_phan_cong` FOREIGN KEY (`id_phan_cong`) REFERENCES `phan_cong` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.chi_tiet_phan_cong: ~0 rows (approximately)
/*!40000 ALTER TABLE `chi_tiet_phan_cong` DISABLE KEYS */;
/*!40000 ALTER TABLE `chi_tiet_phan_cong` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.chi_tiet_upcode
CREATE TABLE IF NOT EXISTS `chi_tiet_upcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lich_upcode` int(11) unsigned NOT NULL,
  `id_users` int(11) unsigned NOT NULL COMMENT 'id user tham gia upcode',
  `id_dm_loi` int(11) unsigned NOT NULL,
  `tinh_trang` int(11) NOT NULL DEFAULT '1' COMMENT '0: không hoàn thành; 1: hoàn thành; 2 lỗi cũ; 3 lỗi mới',
  `bat_dau` datetime DEFAULT NULL,
  `ket_thuc` datetime DEFAULT NULL,
  `ghi_chu` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_chi_tiet_upcode_lich_upcode` (`id_lich_upcode`),
  KEY `FK_chi_tiet_upcode_users` (`id_users`),
  KEY `FK_chi_tiet_upcode_dm_loi` (`id_dm_loi`),
  CONSTRAINT `FK_chi_tiet_upcode_dm_loi` FOREIGN KEY (`id_dm_loi`) REFERENCES `dm_loi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_chi_tiet_upcode_lich_upcode` FOREIGN KEY (`id_lich_upcode`) REFERENCES `lich_upcode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_chi_tiet_upcode_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.chi_tiet_upcode: ~4 rows (approximately)
/*!40000 ALTER TABLE `chi_tiet_upcode` DISABLE KEYS */;
INSERT INTO `chi_tiet_upcode` (`id`, `id_lich_upcode`, `id_users`, `id_dm_loi`, `tinh_trang`, `bat_dau`, `ket_thuc`, `ghi_chu`) VALUES
	(1, 2, 11, 36, 1, NULL, NULL, NULL),
	(2, 2, 19, 36, 1, NULL, NULL, NULL),
	(3, 2, 20, 37, 1, NULL, NULL, NULL),
	(4, 2, 10, 37, 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `chi_tiet_upcode` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.chi_tiet_users_tham_gia_upcode
CREATE TABLE IF NOT EXISTS `chi_tiet_users_tham_gia_upcode` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(11) unsigned NOT NULL COMMENT 'user tham gia upcode',
  `id_lich_upcode` int(11) unsigned NOT NULL,
  `ghi_chu` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_chi_tiet_users_tham_gia_upcode_users` (`id_users`),
  KEY `FK_chi_tiet_users_tham_gia_upcode_lich_upcode` (`id_lich_upcode`),
  CONSTRAINT `FK_chi_tiet_users_tham_gia_upcode_lich_upcode` FOREIGN KEY (`id_lich_upcode`) REFERENCES `lich_upcode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_chi_tiet_users_tham_gia_upcode_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.chi_tiet_users_tham_gia_upcode: ~0 rows (approximately)
/*!40000 ALTER TABLE `chi_tiet_users_tham_gia_upcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `chi_tiet_users_tham_gia_upcode` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.dm_chuc_vu
CREATE TABLE IF NOT EXISTS `dm_chuc_vu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_chuc_vu` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT '1' COMMENT '0 nghỉ sử dụng; 1 còn sử dụng',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.dm_chuc_vu: ~11 rows (approximately)
/*!40000 ALTER TABLE `dm_chuc_vu` DISABLE KEYS */;
INSERT INTO `dm_chuc_vu` (`id`, `ten_chuc_vu`, `state`) VALUES
	(1, 'Chuyên viên IT', 1),
	(2, 'Chuyên viên', 1),
	(3, 'Giám đốc', 1),
	(4, 'Phó Giám đốc', 1),
	(5, 'Trưởng phòng', 1),
	(6, 'Phó Trưởng phòng', 1),
	(7, 'Lãnh đạo', 1),
	(8, 'Nhân viên', 1),
	(9, 'Chủ tịch', 1),
	(10, 'Phó Chủ tịch', 1),
	(11, 'Cán bộ', 1);
/*!40000 ALTER TABLE `dm_chuc_vu` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.dm_don_vi_yeu_cau
CREATE TABLE IF NOT EXISTS `dm_don_vi_yeu_cau` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'id user tạo',
  `ten_don_vi` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` int(11) unsigned DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_dm_don_vi_yeu_cau_users` (`id_users`),
  KEY `FK_dm_don_vi_yeu_cau_dm_don_vi_yeu_cau` (`parent`),
  CONSTRAINT `FK_dm_don_vi_yeu_cau_dm_don_vi_yeu_cau` FOREIGN KEY (`parent`) REFERENCES `dm_don_vi_yeu_cau` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dm_don_vi_yeu_cau_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.dm_don_vi_yeu_cau: ~0 rows (approximately)
/*!40000 ALTER TABLE `dm_don_vi_yeu_cau` DISABLE KEYS */;
INSERT INTO `dm_don_vi_yeu_cau` (`id`, `id_users`, `ten_don_vi`, `parent`, `state`) VALUES
	(1, 8, 'Sở Thông tin Truyền thông', NULL, 1);
/*!40000 ALTER TABLE `dm_don_vi_yeu_cau` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.dm_link_quan_tri
CREATE TABLE IF NOT EXISTS `dm_link_quan_tri` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(11) unsigned DEFAULT NULL,
  `id_loai_danh_muc` int(11) unsigned DEFAULT NULL,
  `link` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_link` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8_unicode_ci,
  `ds_tai_khoan_duoc_chia_se` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_don_vi_duoc_chia_se` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_dm_link_admin_users` (`id_users`),
  KEY `FK_dm_link_quan_tri_loai_danh_muc` (`id_loai_danh_muc`),
  CONSTRAINT `FK_dm_link_admin_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dm_link_quan_tri_loai_danh_muc` FOREIGN KEY (`id_loai_danh_muc`) REFERENCES `loai_danh_muc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.dm_link_quan_tri: ~3 rows (approximately)
/*!40000 ALTER TABLE `dm_link_quan_tri` DISABLE KEYS */;
INSERT INTO `dm_link_quan_tri` (`id`, `id_users`, `id_loai_danh_muc`, `link`, `ten_link`, `mo_ta`, `ds_tai_khoan_duoc_chia_se`, `ds_don_vi_duoc_chia_se`, `state`) VALUES
	(4, 1, 1, '12', 'Thanh 12', 'Thanh 1112', NULL, '1;5;', 1),
	(5, 1, 14, '1', 'Thanh 1', 'Thanh 111', NULL, '1;5;', 1),
	(6, 1, 15, '1', 'Thanh 1', 'Thanh 111', NULL, '1;5;', 1);
/*!40000 ALTER TABLE `dm_link_quan_tri` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.dm_loi
CREATE TABLE IF NOT EXISTS `dm_loi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'user tạo',
  `ds_don_vi_duoc_chia_se` varchar(250) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '-1: public và toan đơn vị; 0: không chia sẽ với ai; còn lại là id_don_vi được chia sẽ',
  `ds_tai_khoan_duoc_chia_se` varchar(250) COLLATE utf8_unicode_ci DEFAULT '0',
  `ten_dm_loi` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `link_video_loi` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'module hoặc chức năng thì link video lỗi sẽ là link chức năng',
  `mo_ta` longtext COLLATE utf8_unicode_ci,
  `ma_yeu_cau` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `yeu_cau` longtext COLLATE utf8_unicode_ci,
  `hinh_anh` longtext COLLATE utf8_unicode_ci,
  `file` longtext COLLATE utf8_unicode_ci,
  `cach_khac_phuc` longtext COLLATE utf8_unicode_ci COMMENT 'Nhập vào để ae khác xem',
  `link_video_cach_khac_phuc` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_huong_xu_ly` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '1 đơn vị tự xử lý; 2...; Module hoặc chức năng thì giá trị bằng 2',
  `id_loai_danh_muc` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'là loại dịch vụ như his, igate...',
  `loai` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'LỖI' COMMENT '1: là loại lỗi hoặc 2: module để test hoặc 3: chức năng để test;',
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_dm_loi_users` (`id_user`),
  KEY `FK_dm_loi_phan_mem` (`id_loai_danh_muc`),
  KEY `FK_dm_loi_huong_xu_ly` (`id_huong_xu_ly`),
  CONSTRAINT `FK_dm_loi_huong_xu_ly` FOREIGN KEY (`id_huong_xu_ly`) REFERENCES `huong_xu_ly` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dm_loi_phan_mem` FOREIGN KEY (`id_loai_danh_muc`) REFERENCES `loai_danh_muc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dm_loi_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.dm_loi: ~2 rows (approximately)
/*!40000 ALTER TABLE `dm_loi` DISABLE KEYS */;
INSERT INTO `dm_loi` (`id`, `id_user`, `ds_don_vi_duoc_chia_se`, `ds_tai_khoan_duoc_chia_se`, `ten_dm_loi`, `link_video_loi`, `mo_ta`, `ma_yeu_cau`, `yeu_cau`, `hinh_anh`, `file`, `cach_khac_phuc`, `link_video_cach_khac_phuc`, `id_huong_xu_ly`, `id_loai_danh_muc`, `loai`, `state`) VALUES
	(36, 8, '6;', NULL, 'Thực hiện upcode', NULL, '<h1 style="text-indent: -6px; text-align: center;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>LỊCH SỬ THAY ĐỔI</b></font></span>&nbsp;</h1>\r\n\r\n\r\n                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" width="700" style="border: none;">\r\n                               <tbody><tr>\r\n                                <td width="43" style="width:32.05pt;border:solid windowtext 1.0pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><b><font face="Times New Roman">ID<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="90" style="width:67.85pt;border:solid windowtext 1.0pt;border-left:\r\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><b><font face="Times New Roman">Phiên bản<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="138" style="width:103.5pt;border:solid windowtext 1.0pt;border-left:\r\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><b><font face="Times New Roman">Người thực hiện<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="150" style="width:112.5pt;border:solid windowtext 1.0pt;border-left:\r\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><b><font face="Times New Roman">Người phê duyệt<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="126" style="width:94.5pt;border:solid windowtext 1.0pt;border-left:\r\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><b><font face="Times New Roman">Ngày hiệu lực<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="176" style="width:131.7pt;border:solid windowtext 1.0pt;border-left:\r\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><b><font face="Times New Roman">Nội dung thay đổi<o:p></o:p></font></b></p>\r\n                                </td>\r\n                               </tr>\r\n                               <tr style="mso-yfti-irow:1;mso-yfti-lastrow:yes;height:23.35pt">\r\n                                <td width="43" style="width:32.05pt;border:solid windowtext 1.0pt;border-top:\r\n                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><font face="Times New Roman">1<o:p></o:p></font></span></p>\r\n                                </td>\r\n                                <td width="90" style="width:67.85pt;border-top:none;border-left:none;\r\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><font face="Times New Roman">V1.0<o:p></o:p></font></span></p>\r\n                                </td>\r\n                                <td width="138" style="width:103.5pt;border-top:none;border-left:none;\r\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>\r\n                                </td>\r\n                                <td width="150" style="width:112.5pt;border-top:none;border-left:none;\r\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>\r\n                                </td>\r\n                                <td width="126" style="width:94.5pt;border-top:none;border-left:none;\r\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\r\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\r\n                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>\r\n                                </td>\r\n                                <td width="176" style="width:131.7pt;border-top:none;border-left:none;\r\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\r\n                                <p class="MsoNormal"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><font face="Times New Roman">&nbsp;Chỉnh sửa chức năng<o:p></o:p></font></span></p>\r\n                                <p class="MsoNormal"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>\r\n                                </td>\r\n                               </tr>\r\n                              </tbody></table>\r\n\r\n                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>1. Chức năng cụ thể</b></font></span>&nbsp;</h1>\r\n                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" style="border: none;" width="700">\r\n                               <tbody><tr>\r\n                                <td width="51" valign="top" style="width:38.0pt;border:solid windowtext 1.0pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">STT<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="117" valign="top" style="width:87.75pt;border:solid windowtext 1.0pt;\r\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Mã chức năng<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="273" valign="top" style="width:204.65pt;border:solid windowtext 1.0pt;\r\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Tên chức năng<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="153" valign="top" style="width:114.5pt;border:solid windowtext 1.0pt;\r\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Đối tượng liên quan<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="74" valign="top" style="width:55.75pt;border:solid windowtext 1.0pt;\r\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Mức độ ưu tiên<o:p></o:p></font></b></p>\r\n                                </td>\r\n                               </tr>\r\n                               <tr>\r\n                                <td width="51" valign="top" style="width:38.0pt;border:solid windowtext 1.0pt;\r\n                                border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><font face="Times New Roman">1<o:p></o:p></font></p>\r\n                                </td>\r\n                                <td width="117" valign="top" style="width:87.75pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\r\n                                6.0pt;margin-left:0in"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>\r\n                                </td>\r\n                                <td width="273" valign="top" style="width:204.65pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n                                </td>\r\n                                <td width="153" valign="top" style="width:114.5pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\r\n                                6.0pt;margin-left:0in"><font face="Times New Roman">Nhân&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; viên<span lang="FR"><o:p></o:p></span></font></p>\r\n                                </td>\r\n                                <td width="74" valign="top" style="width:55.75pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\r\n                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><font face="Times New Roman">Trung bình<o:p></o:p></font></p>\r\n                                </td>\r\n                               </tr>\r\n                              </tbody></table>\r\n                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>2. Đối tượng người dùng của hệ thống</b></font></span>&nbsp;</h1>\r\n\r\n\r\n                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" width="700" style="border: none;">\r\n                               <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:21.75pt">\r\n                                <td width="45" rowspan="2" valign="top" style="width:33.75pt;border:solid windowtext 1.0pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">TT<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="130" rowspan="2" valign="top" style="width:97.65pt;border:solid windowtext 1.0pt;\r\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Tên đối tượng<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="154" rowspan="2" valign="top" style="width:115.55pt;border:solid windowtext 1.0pt;\r\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Mô tả<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="239" colspan="2" valign="top" style="width:179.4pt;border:solid windowtext 1.0pt;\r\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Tương tác với hệ&nbsp; thống<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="123" rowspan="2" valign="top" style="width:92.25pt;border:solid windowtext 1.0pt;\r\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Lợi ích mong đợi<o:p></o:p></font></b></p>\r\n                                </td>\r\n                               </tr>\r\n                               <tr style="mso-yfti-irow:1;height:21.1pt">\r\n                                <td width="128" valign="top" style="width:95.95pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.1pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Vào<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="111" valign="top" style="width:83.45pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.1pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Ra<o:p></o:p></font></b></p>\r\n                                </td>\r\n                               </tr>\r\n                               <tr>\r\n                                <td width="45" valign="top" style="width:33.75pt;border:solid windowtext 1.0pt;\r\n                                border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><font face="Times New Roman">1<o:p></o:p></font></p>\r\n                                </td>\r\n                                <td width="130" valign="top" style="width:97.65pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\r\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><font face="Times New Roman">Nhân\r\n                                viên<o:p></o:p></font></p>\r\n                                </td>\r\n                                <td width="154" valign="top" style="width:115.55pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal"><br></p>\r\n                                </td>\r\n                                <td width="128" valign="top" style="width:95.95pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\r\n                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>\r\n                                </td>\r\n                                <td width="111" valign="top" style="width:83.45pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\r\n                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>\r\n                                </td>\r\n                                <td width="123" valign="top" style="width:92.25pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\r\n                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>\r\n                                </td>\r\n                               </tr>\r\n                              </tbody></table>\r\n\r\n                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>3. Quy trình nghiệp vu</b></font></span>&nbsp;</h1>\r\n\r\n                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" width="700" style="border: none;">\r\n                               <tbody><tr>\r\n                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><b><font face="Times New Roman">STT<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="81" style="width:61.0pt;border:solid windowtext 1.0pt;border-left:\r\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><b><font face="Times New Roman">Mã bước<o:p></o:p></font></b></p>\r\n                                </td>\r\n                                <td width="162" style="width:121.5pt;border:solid windowtext 1.0pt;border-left:\r\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><b><span style="font-size:13.0pt;line-height:150%"><font face="Times New Roman">Tên bước<o:p></o:p></font></span></b></p>\r\n                                </td>\r\n                                <td width="378" style="width:283.5pt;border:solid windowtext 1.0pt;border-left:\r\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><b><font face="Times New Roman">Mô tả<o:p></o:p></font></b></p>\r\n                                </td>\r\n                               </tr>\r\n                               <tr>\r\n                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;border-top:\r\n                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">1<o:p></o:p></font></p>\r\n                                </td>\r\n                                <td width="81" style="width:61.0pt;border-top:none;border-left:none;border-bottom:\r\n                                solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:\r\n                                solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">B.01<o:p></o:p></font></p>\r\n                                </td>\r\n                                <td width="162" valign="top" style="width:121.5pt;border-top:none;border-left:\r\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                <p class="MsoNormal"><br></p></td><td width="378" style="width:283.5pt;border-top:none;border-left:none;\r\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\r\n                                </td>\r\n                               </tr>\r\n                               <tr style="mso-yfti-irow:2;height:20.7pt">\r\n                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;border-top:\r\n                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">2<o:p></o:p></font></p>\r\n                                </td>\r\n                                <td width="81" style="width:61.0pt;border-top:none;border-left:none;border-bottom:\r\n                                solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:\r\n                                solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">B.02<o:p></o:p></font></p>\r\n                                </td>\r\n                                <td width="162" style="width:121.5pt;border-top:none;border-left:none;\r\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><br></p>\r\n                                </td>\r\n                                <td width="378" style="width:283.5pt;border-top:none;border-left:none;\r\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><br></p>\r\n                                </td>\r\n                               </tr>\r\n                               <tr style="mso-yfti-irow:3;mso-yfti-lastrow:yes;height:20.7pt">\r\n                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;border-top:\r\n                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\r\n                                padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">3<o:p></o:p></font></p>\r\n                                </td>\r\n                                <td width="81" style="width:61.0pt;border-top:none;border-left:none;border-bottom:\r\n                                solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:\r\n                                solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">B.03<o:p></o:p></font></p>\r\n                                </td>\r\n                                <td width="162" style="width:121.5pt;border-top:none;border-left:none;\r\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\r\n                                <p class="MsoNormal" style="line-height:150%"><br></p></td><td width="378" style="width:283.5pt;border-top:none;border-left:none;\r\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\r\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\r\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\r\n                                </td>\r\n                               </tr>\r\n                              </tbody></table>\r\n                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>4. Yêu cầu</b></font></span>&nbsp;</h1>', NULL, NULL, NULL, NULL, '<table class="table table-bordered"><tbody><tr><td width="100px" style="text-align: center;"><b>Tên bước</b></td><td style="text-align: center;"><b>Cách xử lý</b></td></tr><tr><td>Bước 1:&nbsp;</td><td><br></td></tr><tr><td>Bước 2:&nbsp;</td><td><br></td></tr><tr><td>Bước 3:&nbsp;</td><td><br></td></tr><tr><td>Bước 4:&nbsp;</td><td><br></td></tr></tbody></table>', NULL, 2, 1, 'LỖI', 1),
	(37, 8, NULL, NULL, 'Test hệ thống sau upcode', NULL, '<h1 style="text-indent: -6px; text-align: center;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>LỊCH SỬ THAY ĐỔI</b></font></span>&nbsp;</h1>\n\n\n                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" width="700" style="border: none;">\n                               <tbody><tr>\n                                <td width="43" style="width:32.05pt;border:solid windowtext 1.0pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><b><font face="Times New Roman">ID<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="90" style="width:67.85pt;border:solid windowtext 1.0pt;border-left:\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><b><font face="Times New Roman">Phiên bản<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="138" style="width:103.5pt;border:solid windowtext 1.0pt;border-left:\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><b><font face="Times New Roman">Người thực hiện<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="150" style="width:112.5pt;border:solid windowtext 1.0pt;border-left:\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><b><font face="Times New Roman">Người phê duyệt<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="126" style="width:94.5pt;border:solid windowtext 1.0pt;border-left:\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><b><font face="Times New Roman">Ngày hiệu lực<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="176" style="width:131.7pt;border:solid windowtext 1.0pt;border-left:\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><b><font face="Times New Roman">Nội dung thay đổi<o:p></o:p></font></b></p>\n                                </td>\n                               </tr>\n                               <tr style="mso-yfti-irow:1;mso-yfti-lastrow:yes;height:23.35pt">\n                                <td width="43" style="width:32.05pt;border:solid windowtext 1.0pt;border-top:\n                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><font face="Times New Roman">1<o:p></o:p></font></span></p>\n                                </td>\n                                <td width="90" style="width:67.85pt;border-top:none;border-left:none;\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><font face="Times New Roman">V1.0<o:p></o:p></font></span></p>\n                                </td>\n                                <td width="138" style="width:103.5pt;border-top:none;border-left:none;\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>\n                                </td>\n                                <td width="150" style="width:112.5pt;border-top:none;border-left:none;\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>\n                                </td>\n                                <td width="126" style="width:94.5pt;border-top:none;border-left:none;\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\n                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;\n                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>\n                                </td>\n                                <td width="176" style="width:131.7pt;border-top:none;border-left:none;\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">\n                                <p class="MsoNormal"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><font face="Times New Roman">&nbsp;Chỉnh sửa chức năng<o:p></o:p></font></span></p>\n                                <p class="MsoNormal"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>\n                                </td>\n                               </tr>\n                              </tbody></table>\n\n                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>1. Chức năng cụ thể</b></font></span>&nbsp;</h1>\n                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" style="border: none;" width="700">\n                               <tbody><tr>\n                                <td width="51" valign="top" style="width:38.0pt;border:solid windowtext 1.0pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">STT<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="117" valign="top" style="width:87.75pt;border:solid windowtext 1.0pt;\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Mã chức năng<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="273" valign="top" style="width:204.65pt;border:solid windowtext 1.0pt;\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Tên chức năng<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="153" valign="top" style="width:114.5pt;border:solid windowtext 1.0pt;\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Đối tượng liên quan<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="74" valign="top" style="width:55.75pt;border:solid windowtext 1.0pt;\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Mức độ ưu tiên<o:p></o:p></font></b></p>\n                                </td>\n                               </tr>\n                               <tr>\n                                <td width="51" valign="top" style="width:38.0pt;border:solid windowtext 1.0pt;\n                                border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><font face="Times New Roman">1<o:p></o:p></font></p>\n                                </td>\n                                <td width="117" valign="top" style="width:87.75pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\n                                6.0pt;margin-left:0in"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>\n                                </td>\n                                <td width="273" valign="top" style="width:204.65pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>\n                                </td>\n                                <td width="153" valign="top" style="width:114.5pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\n                                6.0pt;margin-left:0in"><font face="Times New Roman">Nhân&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; viên<span lang="FR"><o:p></o:p></span></font></p>\n                                </td>\n                                <td width="74" valign="top" style="width:55.75pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\n                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><font face="Times New Roman">Trung bình<o:p></o:p></font></p>\n                                </td>\n                               </tr>\n                              </tbody></table>\n                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>2. Đối tượng người dùng của hệ thống</b></font></span>&nbsp;</h1>\n\n\n                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" width="700" style="border: none;">\n                               <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:21.75pt">\n                                <td width="45" rowspan="2" valign="top" style="width:33.75pt;border:solid windowtext 1.0pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">TT<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="130" rowspan="2" valign="top" style="width:97.65pt;border:solid windowtext 1.0pt;\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Tên đối tượng<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="154" rowspan="2" valign="top" style="width:115.55pt;border:solid windowtext 1.0pt;\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Mô tả<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="239" colspan="2" valign="top" style="width:179.4pt;border:solid windowtext 1.0pt;\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Tương tác với hệ&nbsp; thống<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="123" rowspan="2" valign="top" style="width:92.25pt;border:solid windowtext 1.0pt;\n                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Lợi ích mong đợi<o:p></o:p></font></b></p>\n                                </td>\n                               </tr>\n                               <tr style="mso-yfti-irow:1;height:21.1pt">\n                                <td width="128" valign="top" style="width:95.95pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.1pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Vào<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="111" valign="top" style="width:83.45pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.1pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Ra<o:p></o:p></font></b></p>\n                                </td>\n                               </tr>\n                               <tr>\n                                <td width="45" valign="top" style="width:33.75pt;border:solid windowtext 1.0pt;\n                                border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><font face="Times New Roman">1<o:p></o:p></font></p>\n                                </td>\n                                <td width="130" valign="top" style="width:97.65pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;\n                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><font face="Times New Roman">Nhân\n                                viên<o:p></o:p></font></p>\n                                </td>\n                                <td width="154" valign="top" style="width:115.55pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal"><br></p>\n                                </td>\n                                <td width="128" valign="top" style="width:95.95pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\n                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>\n                                </td>\n                                <td width="111" valign="top" style="width:83.45pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\n                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>\n                                </td>\n                                <td width="123" valign="top" style="width:92.25pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:\n                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>\n                                </td>\n                               </tr>\n                              </tbody></table>\n\n                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>3. Quy trình nghiệp vu</b></font></span>&nbsp;</h1>\n\n                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" width="700" style="border: none;">\n                               <tbody><tr>\n                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="line-height:150%"><b><font face="Times New Roman">STT<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="81" style="width:61.0pt;border:solid windowtext 1.0pt;border-left:\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="line-height:150%"><b><font face="Times New Roman">Mã bước<o:p></o:p></font></b></p>\n                                </td>\n                                <td width="162" style="width:121.5pt;border:solid windowtext 1.0pt;border-left:\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="line-height:150%"><b><span style="font-size:13.0pt;line-height:150%"><font face="Times New Roman">Tên bước<o:p></o:p></font></span></b></p>\n                                </td>\n                                <td width="378" style="width:283.5pt;border:solid windowtext 1.0pt;border-left:\n                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="line-height:150%"><b><font face="Times New Roman">Mô tả<o:p></o:p></font></b></p>\n                                </td>\n                               </tr>\n                               <tr>\n                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;border-top:\n                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">1<o:p></o:p></font></p>\n                                </td>\n                                <td width="81" style="width:61.0pt;border-top:none;border-left:none;border-bottom:\n                                solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:\n                                solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">B.01<o:p></o:p></font></p>\n                                </td>\n                                <td width="162" valign="top" style="width:121.5pt;border-top:none;border-left:\n                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                <p class="MsoNormal"><br></p></td><td width="378" style="width:283.5pt;border-top:none;border-left:none;\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">\n                                </td>\n                               </tr>\n                               <tr style="mso-yfti-irow:2;height:20.7pt">\n                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;border-top:\n                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">2<o:p></o:p></font></p>\n                                </td>\n                                <td width="81" style="width:61.0pt;border-top:none;border-left:none;border-bottom:\n                                solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:\n                                solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">B.02<o:p></o:p></font></p>\n                                </td>\n                                <td width="162" style="width:121.5pt;border-top:none;border-left:none;\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\n                                <p class="MsoNormal" style="line-height:150%"><br></p>\n                                </td>\n                                <td width="378" style="width:283.5pt;border-top:none;border-left:none;\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\n                                <p class="MsoNormal" style="line-height:150%"><br></p>\n                                </td>\n                               </tr>\n                               <tr style="mso-yfti-irow:3;mso-yfti-lastrow:yes;height:20.7pt">\n                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;border-top:\n                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;\n                                padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">3<o:p></o:p></font></p>\n                                </td>\n                                <td width="81" style="width:61.0pt;border-top:none;border-left:none;border-bottom:\n                                solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:\n                                solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\n                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\n                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">B.03<o:p></o:p></font></p>\n                                </td>\n                                <td width="162" style="width:121.5pt;border-top:none;border-left:none;\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\n                                <p class="MsoNormal" style="line-height:150%"><br></p></td><td width="378" style="width:283.5pt;border-top:none;border-left:none;\n                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;\n                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;\n                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">\n                                </td>\n                               </tr>\n                              </tbody></table>\n                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>4. Yêu cầu</b></font></span>&nbsp;</h1>', NULL, NULL, NULL, NULL, '<table class="table table-bordered"><tbody><tr><td width="100px" style="text-align: center;"><b>Tên bước</b></td><td style="text-align: center;"><b>Cách xử lý</b></td></tr><tr><td>Bước 1:&nbsp;</td><td><br></td></tr><tr><td>Bước 2:&nbsp;</td><td><br></td></tr><tr><td>Bước 3:&nbsp;</td><td><br></td></tr><tr><td>Bước 4:&nbsp;</td><td><br></td></tr></tbody></table>', NULL, 2, 1, 'LỖI', 1);
/*!40000 ALTER TABLE `dm_loi` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.don_vi
CREATE TABLE IF NOT EXISTS `don_vi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'id người tạo',
  `ten_don_vi` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_dinh` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `di_dong` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` int(11) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '0: không hoạt động; 1: hoạt động',
  PRIMARY KEY (`id`),
  KEY `FK_don_vi_don_vi` (`parent`),
  KEY `order` (`order`),
  KEY `FK_don_vi_users` (`id_users`),
  CONSTRAINT `FK_don_vi_don_vi` FOREIGN KEY (`parent`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.don_vi: ~20 rows (approximately)
/*!40000 ALTER TABLE `don_vi` DISABLE KEYS */;
INSERT INTO `don_vi` (`id`, `id_users`, `ten_don_vi`, `dia_chi`, `email`, `co_dinh`, `di_dong`, `fax`, `parent`, `order`, `state`) VALUES
	(1, 1, 'VNPT Trà Vinh', '70 Hùng Vương, Phường 4', NULL, NULL, NULL, NULL, NULL, 1, 1),
	(5, 3, 'Trung tâm CNTT', '109 Nguyễn Chí Thanh, Phường 6', NULL, '02943853666', '02943853666', '02943853666', 1, 1, 1),
	(6, 1, 'Phòng giải pháp CNTT', '109 Nguyễn Chí Thanh, Phường 6', NULL, '02943854466', '02943854466', '02943854466', 5, 1, 1),
	(14, 1, 'Phòng tổng hợp', '109 Nguyễn Chí Thanh, Phường 6', NULL, '0294384355', '0294384355', '0294384355', 5, 1, 1),
	(17, 8, 'Phòng Kỹ thuật Đầu tư', '70 Hùng Vương', NULL, NULL, NULL, NULL, 1, 1, 1),
	(18, 1, 'Phòng Nhân sự - Tổng hợp', '70, Hùng Vương', NULL, NULL, NULL, NULL, 1, 1, 1),
	(19, 1, 'Phòng Kế hoạch -Kế toán', '70 Hùng Vương', NULL, NULL, NULL, NULL, 1, 1, 1),
	(20, 1, 'Trung tâm ĐHTT', 'Mậu Thân', NULL, NULL, NULL, NULL, 1, 1, 1),
	(21, 1, 'Trung tâm Viễn thông 1', NULL, NULL, NULL, NULL, NULL, 1, 1, 1),
	(22, 1, 'Trung tâm Viễn thông 2', NULL, NULL, NULL, NULL, NULL, 1, 1, 1),
	(23, 1, 'Trung tâm Viễn thông 3', NULL, NULL, NULL, NULL, NULL, 1, 1, 1),
	(24, 1, 'Tổ khai khác', NULL, NULL, NULL, NULL, NULL, 20, 1, 1),
	(25, 1, 'Tổ vô tuyến', NULL, NULL, NULL, NULL, NULL, 20, 1, 1),
	(26, 1, 'Tổ Tổng hợp', NULL, NULL, NULL, NULL, NULL, 20, 1, 1),
	(27, 1, 'Ban Giám đốc', NULL, NULL, NULL, NULL, NULL, 20, 1, 1),
	(28, 1, 'Tổ kỹ thuật 1', NULL, NULL, NULL, NULL, NULL, 20, 1, 1),
	(29, 1, 'Tổ kỹ thuật 2', NULL, NULL, NULL, NULL, NULL, 20, 1, 1),
	(30, 1, 'Tổ kỹ thuật 3', NULL, NULL, NULL, NULL, NULL, 20, 1, 1),
	(31, 1, 'Tổ kỹ thuật 4', NULL, NULL, NULL, NULL, NULL, 20, 1, 1),
	(32, 1, 'Ban Giám đốc', '109 Nguyễn Chí Thanh, Phường 6', NULL, '02943853666', '02943853666', '02943853666', 5, 1, 1);
/*!40000 ALTER TABLE `don_vi` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.don_vi_tham_so_don_vi
CREATE TABLE IF NOT EXISTS `don_vi_tham_so_don_vi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_don_vi` int(11) unsigned NOT NULL DEFAULT '1',
  `id_tham_so_don_vi` int(11) unsigned NOT NULL,
  `ngay_bat_dau` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_ket_thuc` datetime NOT NULL,
  `gia_tri_tham_so` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_don_vi_tham_so_don_vi_tham_so_don_vi` (`id_tham_so_don_vi`),
  KEY `FK_don_vi_tham_so_don_vi_don_vi` (`id_don_vi`),
  CONSTRAINT `FK_don_vi_tham_so_don_vi_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_don_vi_tham_so_don_vi_tham_so_don_vi` FOREIGN KEY (`id_tham_so_don_vi`) REFERENCES `tham_so_don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.don_vi_tham_so_don_vi: ~0 rows (approximately)
/*!40000 ALTER TABLE `don_vi_tham_so_don_vi` DISABLE KEYS */;
/*!40000 ALTER TABLE `don_vi_tham_so_don_vi` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.giao_viec_cong_viec
CREATE TABLE IF NOT EXISTS `giao_viec_cong_viec` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user_tao` int(11) unsigned NOT NULL DEFAULT '1',
  `id_muc_do_cong_viec` int(11) unsigned NOT NULL DEFAULT '1',
  `id_loai_danh_muc` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'Loại dịch vụ: iGate iOffice Potal',
  `ma_cong_viec` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_cong_viec` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noi_dung_cong_viec` longtext COLLATE utf8_unicode_ci,
  `ghi_chu_cong_viec` longtext COLLATE utf8_unicode_ci,
  `tai_lieu_cong_viec` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `han_xu_ly_cong_viec` datetime DEFAULT NULL,
  `ngay_gio_tao` datetime DEFAULT NULL,
  `sap_xep` int(11) NOT NULL DEFAULT '1',
  `trang_thai` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_giao_viec_cong_viec_users` (`id_user_tao`),
  KEY `FK_giao_viec_cong_viec_giao_viec_muc_do` (`id_muc_do_cong_viec`),
  KEY `FK_giao_viec_cong_viec_loai_danh_muc` (`id_loai_danh_muc`),
  CONSTRAINT `FK_giao_viec_cong_viec_giao_viec_muc_do` FOREIGN KEY (`id_muc_do_cong_viec`) REFERENCES `giao_viec_muc_do` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_giao_viec_cong_viec_loai_danh_muc` FOREIGN KEY (`id_loai_danh_muc`) REFERENCES `loai_danh_muc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_giao_viec_cong_viec_users` FOREIGN KEY (`id_user_tao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.giao_viec_cong_viec: ~0 rows (approximately)
/*!40000 ALTER TABLE `giao_viec_cong_viec` DISABLE KEYS */;
INSERT INTO `giao_viec_cong_viec` (`id`, `id_user_tao`, `id_muc_do_cong_viec`, `id_loai_danh_muc`, `ma_cong_viec`, `ten_cong_viec`, `noi_dung_cong_viec`, `ghi_chu_cong_viec`, `tai_lieu_cong_viec`, `han_xu_ly_cong_viec`, `ngay_gio_tao`, `sap_xep`, `trang_thai`) VALUES
	(76, 8, 1, 1, '76', 'VNPT-iGate Nâng cấp lên version 1.102', '+ Xây dựng chức năng liên thông phần mềm iGate với Hộ tịch thông qua trục ESB (Thủ tục Khai Sinh)\r\n+ Thêm menu [Hướng dẫn] mới trên trang chủ \r\n• Thời gian thực hiện: sau 19h ngày 23/04/2020 (up sau giờ hành chính)\r\n• Thời gian downtime: 19h – 22h 23', NULL, '', NULL, '2020-04-23 20:05:40', 76, 0);
/*!40000 ALTER TABLE `giao_viec_cong_viec` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.giao_viec_loai_xu_ly
CREATE TABLE IF NOT EXISTS `giao_viec_loai_xu_ly` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_loai_xu_ly` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_buoc_ke` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.giao_viec_loai_xu_ly: ~9 rows (approximately)
/*!40000 ALTER TABLE `giao_viec_loai_xu_ly` DISABLE KEYS */;
INSERT INTO `giao_viec_loai_xu_ly` (`id`, `ten_loai_xu_ly`, `ten_buoc_ke`, `trang_thai`) VALUES
	(1, 'Tạo công việc', 'Chuyển thực hiện', 1),
	(2, 'Tạo công việc', 'Chuyển thực hiện', 1),
	(3, 'Chuyển thực hiện', 'Xử lý công việc', 1),
	(4, 'Yêu cầu hỗ trợ', 'Hỗ trợ', 1),
	(5, 'Yêu cầu lãnh đạo duyệt hoàn tất', 'Lãnh đạo duyệt', 1),
	(6, 'Phản hồi yêu cầu hỗ trợ', NULL, 1),
	(7, 'Yêu cầu thực hiện lại', 'Thực hiện lại công việc', 1),
	(8, 'Phản hồi yêu cầu duyệt', NULL, 1),
	(9, 'Hoàn thành', NULL, 1);
/*!40000 ALTER TABLE `giao_viec_loai_xu_ly` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.giao_viec_muc_do
CREATE TABLE IF NOT EXISTS `giao_viec_muc_do` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_muc_do` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.giao_viec_muc_do: ~3 rows (approximately)
/*!40000 ALTER TABLE `giao_viec_muc_do` DISABLE KEYS */;
INSERT INTO `giao_viec_muc_do` (`id`, `ten_muc_do`, `trang_thai`) VALUES
	(1, 'Không khẩn', 1),
	(2, 'Trung bình', 1),
	(3, 'Khẩn cấp', 1);
/*!40000 ALTER TABLE `giao_viec_muc_do` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.giao_viec_user_cong_viec
CREATE TABLE IF NOT EXISTS `giao_viec_user_cong_viec` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_cong_viec` int(11) unsigned NOT NULL,
  `id_user_giao` int(11) unsigned NOT NULL,
  `id_user_thuc_hien` int(11) unsigned NOT NULL,
  `xu_ly` int(11) NOT NULL DEFAULT '0',
  `trang_thai` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_giao_viec_user_cong_viec_giao_viec_cong_viec` (`id_cong_viec`),
  KEY `FK_giao_viec_user_cong_viec_users` (`id_user_giao`),
  KEY `FK_giao_viec_user_cong_viec_users_2` (`id_user_thuc_hien`),
  CONSTRAINT `FK_giao_viec_user_cong_viec_giao_viec_cong_viec` FOREIGN KEY (`id_cong_viec`) REFERENCES `giao_viec_cong_viec` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_giao_viec_user_cong_viec_users` FOREIGN KEY (`id_user_giao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_giao_viec_user_cong_viec_users_2` FOREIGN KEY (`id_user_thuc_hien`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.giao_viec_user_cong_viec: ~4 rows (approximately)
/*!40000 ALTER TABLE `giao_viec_user_cong_viec` DISABLE KEYS */;
INSERT INTO `giao_viec_user_cong_viec` (`id`, `id_cong_viec`, `id_user_giao`, `id_user_thuc_hien`, `xu_ly`, `trang_thai`) VALUES
	(103, 76, 8, 10, 1, 1),
	(104, 76, 8, 19, 1, 0),
	(105, 76, 8, 11, 1, 0),
	(107, 76, 8, 20, 0, 0);
/*!40000 ALTER TABLE `giao_viec_user_cong_viec` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.giao_viec_xu_ly
CREATE TABLE IF NOT EXISTS `giao_viec_xu_ly` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_cong_viec` int(11) unsigned NOT NULL,
  `id_user_xu_ly` int(11) unsigned NOT NULL,
  `id_loai_xu_ly` int(11) unsigned NOT NULL,
  `ngay_gio_xu_ly` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `noi_dung_xu_ly` longtext COLLATE utf8_unicode_ci,
  `file_xu_ly` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_giao_viec_xu_ly_users` (`id_user_xu_ly`),
  KEY `FK_giao_viec_xu_ly_giao_viec_loai_xu_ly` (`id_loai_xu_ly`),
  KEY `FK_giao_viec_xu_ly_giao_viec_xu_ly` (`id_cong_viec`),
  CONSTRAINT `FK_giao_viec_xu_ly_giao_viec_loai_xu_ly` FOREIGN KEY (`id_loai_xu_ly`) REFERENCES `giao_viec_loai_xu_ly` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_giao_viec_xu_ly_giao_viec_xu_ly` FOREIGN KEY (`id_cong_viec`) REFERENCES `giao_viec_cong_viec` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_giao_viec_xu_ly_users` FOREIGN KEY (`id_user_xu_ly`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.giao_viec_xu_ly: ~4 rows (approximately)
/*!40000 ALTER TABLE `giao_viec_xu_ly` DISABLE KEYS */;
INSERT INTO `giao_viec_xu_ly` (`id`, `id_cong_viec`, `id_user_xu_ly`, `id_loai_xu_ly`, `ngay_gio_xu_ly`, `noi_dung_xu_ly`, `file_xu_ly`, `trang_thai`) VALUES
	(217, 76, 8, 1, '2020-04-23 20:05:40', '+ Xây dựng chức năng liên thông phần mềm iGate với Hộ tịch thông qua trục ESB (Thủ tục Khai Sinh)\r\n+ Thêm menu [Hướng dẫn] mới trên trang chủ \r\n• Thời gian thực hiện: sau 19h ngày 23/04/2020 (up sau giờ hành chính)\r\n• Thời gian downtime: 19h – 22h 23', '', 2),
	(218, 76, 8, 3, '2020-04-23 20:06:04', '+ Xây dựng chức năng liên thông phần mềm iGate với Hộ tịch thông qua trục ESB (Thủ tục Khai Sinh)\r\n+ Thêm menu [Hướng dẫn] mới trên trang chủ \r\n• Thời gian thực hiện: sau 19h ngày 23/04/2020 (up sau giờ hành chính)\r\n• Thời gian downtime: 19h – 22h 23', '', 2),
	(219, 76, 10, 5, '2020-04-24 08:37:35', 'Đã thực hiện upcode, testcode.', '', 1),
	(220, 76, 8, 9, '2020-04-24 13:29:26', 'Pass, Up code xong', '', 1);
/*!40000 ALTER TABLE `giao_viec_xu_ly` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.huong_xu_ly
CREATE TABLE IF NOT EXISTS `huong_xu_ly` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned NOT NULL DEFAULT '0',
  `ten_huong_xu_ly` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.huong_xu_ly: ~4 rows (approximately)
/*!40000 ALTER TABLE `huong_xu_ly` DISABLE KEYS */;
INSERT INTO `huong_xu_ly` (`id`, `id_user`, `ten_huong_xu_ly`, `state`) VALUES
	(1, 1, 'Đơn vị tự xử lý', 1),
	(2, 2, 'TTCNTT VNPT xử lý', 1),
	(3, 3, 'IT KV xử lý', 1),
	(4, 4, 'Trung tâm e.Gov hoặc e.Health xử lý', 1);
/*!40000 ALTER TABLE `huong_xu_ly` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.lich_upcode
CREATE TABLE IF NOT EXISTS `lich_upcode` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'id người tạo',
  `id_loai_danh_muc` int(10) unsigned DEFAULT NULL,
  `ten_lich_upcode` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `thoi_gian_bat_dau_du_kien` datetime DEFAULT NULL,
  `thoi_gian_ket_thuc_du_kien` datetime DEFAULT NULL,
  `thoi_gian_bat_dau` datetime DEFAULT NULL,
  `thoi_gian_ket_thuc` datetime DEFAULT NULL COMMENT 'Có thời gian kết thúc là đã hoàn tất',
  `so_luong_nhan_su_tham_gia` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '0 chưa hoàn thành, 1 hoàn thành',
  PRIMARY KEY (`id`),
  KEY `FK_lich_upcode_users` (`id_users`),
  KEY `FK_lich_upcode_loai_danh_muc` (`id_loai_danh_muc`),
  CONSTRAINT `FK_lich_upcode_loai_danh_muc` FOREIGN KEY (`id_loai_danh_muc`) REFERENCES `loai_danh_muc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_lich_upcode_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.lich_upcode: ~0 rows (approximately)
/*!40000 ALTER TABLE `lich_upcode` DISABLE KEYS */;
INSERT INTO `lich_upcode` (`id`, `id_users`, `id_loai_danh_muc`, `ten_lich_upcode`, `thoi_gian_bat_dau_du_kien`, `thoi_gian_ket_thuc_du_kien`, `thoi_gian_bat_dau`, `thoi_gian_ket_thuc`, `so_luong_nhan_su_tham_gia`, `state`) VALUES
	(2, 8, 1, 'Upcode hệ thống iGate - Nâng cấp phiên bản từ 1.101 lên 1.102', '2020-04-23 19:00:00', '2020-04-23 22:00:00', '2020-04-23 00:00:00', '2020-04-23 00:00:00', 1, 0);
/*!40000 ALTER TABLE `lich_upcode` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.loai_danh_muc
CREATE TABLE IF NOT EXISTS `loai_danh_muc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'id người tạo',
  `ten_loai_danh_muc` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_loai_danh_muc_loai_danh_muc` (`id_users`),
  CONSTRAINT `FK_loai_danh_muc_loai_danh_muc` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.loai_danh_muc: ~4 rows (approximately)
/*!40000 ALTER TABLE `loai_danh_muc` DISABLE KEYS */;
INSERT INTO `loai_danh_muc` (`id`, `id_users`, `ten_loai_danh_muc`, `state`) VALUES
	(1, 1, 'VNPT iGate', 1),
	(14, 1, 'VNPT HIS', 1),
	(15, 1, 'VNPT iOffice', 1),
	(16, 10, 'VNPT Portal', 1);
/*!40000 ALTER TABLE `loai_danh_muc` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.password_resets: ~1 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('p.thanhit@gmail.com', '$2y$10$GeJq5nbaNzdeY8UqlCnDIOIh6uSHYw5iZcRhpKuPxDrBtqBT4qAG.', '2019-06-20 02:17:07');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.phan_cong
CREATE TABLE IF NOT EXISTS `phan_cong` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user_phan_cong` int(11) unsigned NOT NULL DEFAULT '1',
  `id_user` int(11) unsigned NOT NULL DEFAULT '1',
  `id_loai_danh_muc` int(11) unsigned NOT NULL DEFAULT '1',
  `tu_ngay` date DEFAULT NULL,
  `den_ngay` date DEFAULT NULL,
  `ghi_chu` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_phan_cong_users` (`id_user_phan_cong`),
  KEY `FK_phan_cong_users_2` (`id_user`),
  KEY `FK_phan_cong_loai_danh_muc` (`id_loai_danh_muc`),
  CONSTRAINT `FK_phan_cong_loai_danh_muc` FOREIGN KEY (`id_loai_danh_muc`) REFERENCES `loai_danh_muc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_phan_cong_users` FOREIGN KEY (`id_user_phan_cong`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_phan_cong_users_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.phan_cong: ~3 rows (approximately)
/*!40000 ALTER TABLE `phan_cong` DISABLE KEYS */;
INSERT INTO `phan_cong` (`id`, `id_user_phan_cong`, `id_user`, `id_loai_danh_muc`, `tu_ngay`, `den_ngay`, `ghi_chu`, `state`) VALUES
	(10, 8, 10, 1, '2020-04-11', NULL, NULL, 1),
	(11, 8, 11, 1, '2020-04-11', NULL, NULL, 1),
	(12, 8, 13, 15, '2020-04-11', NULL, NULL, 1);
/*!40000 ALTER TABLE `phan_cong` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.tham_so_don_vi
CREATE TABLE IF NOT EXISTS `tham_so_don_vi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'id người tạo',
  `ten_tham_so` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gia_tri_mac_dinh` int(11) DEFAULT '1' COMMENT '0: không kích hoạt; 1: kích hoạt',
  `state` int(11) DEFAULT '1' COMMENT '0: ko hoạt động; 1: hoạt động',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.tham_so_don_vi: ~0 rows (approximately)
/*!40000 ALTER TABLE `tham_so_don_vi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tham_so_don_vi` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.thong_tin_ho_tro
CREATE TABLE IF NOT EXISTS `thong_tin_ho_tro` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_dm_loi` int(11) unsigned NOT NULL COMMENT 'id lỗi đã hỗ trợ',
  `id_users` int(11) unsigned NOT NULL COMMENT 'id người hỗ trợ',
  `id_dm_don_vi_yeu_cau` int(11) unsigned NOT NULL COMMENT 'id đơn vị nhờ hỗ trợ',
  `so_lan_ho_tro` int(11) NOT NULL DEFAULT '1',
  `ngay_ho_tro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ghi_chu` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_thong_tin_ho_tro_dm_loi` (`id_dm_loi`),
  KEY `FK_thong_tin_ho_tro_users` (`id_users`),
  KEY `FK_thong_tin_ho_tro_dm_don_vi_yeu_cau` (`id_dm_don_vi_yeu_cau`),
  CONSTRAINT `FK_thong_tin_ho_tro_dm_don_vi_yeu_cau` FOREIGN KEY (`id_dm_don_vi_yeu_cau`) REFERENCES `dm_don_vi_yeu_cau` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_thong_tin_ho_tro_dm_loi` FOREIGN KEY (`id_dm_loi`) REFERENCES `dm_loi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_thong_tin_ho_tro_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.thong_tin_ho_tro: ~0 rows (approximately)
/*!40000 ALTER TABLE `thong_tin_ho_tro` DISABLE KEYS */;
/*!40000 ALTER TABLE `thong_tin_ho_tro` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.to_do
CREATE TABLE IF NOT EXISTS `to_do` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `noi_dung` longtext COLLATE utf8_unicode_ci,
  `ngay_tao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_giao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `han_xu_ly` datetime DEFAULT NULL,
  `ngay_hoan_thanh` datetime DEFAULT NULL,
  `sap_xep` int(11) NOT NULL DEFAULT '0',
  `trang_thai` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_to_do_users` (`id_user`),
  CONSTRAINT `FK_to_do_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.to_do: ~35 rows (approximately)
/*!40000 ALTER TABLE `to_do` DISABLE KEYS */;
INSERT INTO `to_do` (`id`, `id_user`, `noi_dung`, `ngay_tao`, `ngay_giao`, `han_xu_ly`, `ngay_hoan_thanh`, `sap_xep`, `trang_thai`) VALUES
	(4, 1, 'To do công việc 1', '2020-04-21 15:45:10', '2020-04-21 15:45:10', NULL, NULL, 6, 1),
	(6, 1, 'To do công việc 2', '2020-04-21 16:25:11', '2020-04-21 16:25:11', NULL, NULL, 7, 1),
	(7, 1, 'To do công việc 3', '2020-04-21 16:26:54', '2020-04-21 16:26:54', NULL, NULL, 5, 1),
	(8, 1, 'To do công việc 4', '2020-04-21 16:26:57', '2020-04-21 16:26:57', NULL, NULL, 4, 1),
	(9, 1, 'To do công việc 5', '2020-04-21 16:27:00', '2020-04-21 16:27:00', NULL, NULL, 1, 0),
	(10, 31, 'To do công việc 6', '2020-04-21 16:27:56', '2020-04-21 16:27:56', NULL, NULL, 0, 0),
	(14, 8, 'Liên hệ Chí Linh trao đổi SMS Brandname', '2020-04-22 10:56:44', '2020-04-22 10:56:44', '2020-04-22 17:00:00', NULL, 22, 1),
	(15, 8, 'Reset tk chị Linh', '2020-04-22 14:55:38', '2020-04-22 14:55:38', '2020-04-22 17:00:00', NULL, 21, 1),
	(16, 8, 'Note các nội dung về SMS Brandname cho chị linh', '2020-04-22 14:57:04', '2020-04-22 14:57:04', '2020-04-22 17:00:00', NULL, 20, 1),
	(17, 8, 'Bc anh Sang sau khi kiểm tra số liệu STNMT', '2020-04-22 16:52:50', '2020-04-22 16:52:50', '2020-04-22 17:00:00', NULL, 12, 1),
	(21, 8, 'Kiểm tra, xoá hs trể hạn sgd, nhắc chị xa kiểm tra các thủ tục', '2020-04-23 10:25:55', '2020-04-23 10:25:55', '2020-04-23 17:00:00', NULL, 19, 1),
	(22, 8, '- Phối hợp thông tin tiếp nhận y/c khai báo tài khoản giữa KHDN vs CNTT, PBH vs CNTT - VNPT- His CNTT tiếp nhận y/c triển khai mới => thông tin về Phòng KHTCND  Quy trình bán hàng iOffice, VNPT-His, LMS vnEdu,... PHòng BH=> Phòng KHTCDN => CNTT thiết lặp', '2020-04-23 13:08:37', '2020-04-23 13:08:37', '2020-04-23 17:00:00', NULL, 25, 1),
	(23, 8, '- bốc kiểm tra chuyển xử lý văn bản mõi huyện 1 phòng, 1 xã => xong - 2 hs lởi sở công thương => xong - kiểm tra thủ tục đất đai trên cdvcqg => xong - Liên thông thanh toán VNPT Pay CDVCQG vs DVC tỉnh - Bc theo y/c chị mỵ, chị linh trước thứ 2   - Gọi chi linh xin ý kiến sever => xong - goi chi linh xin ý kiến tích hợp  - báo cáo ds tđại sứ truyền thông -    Bc ban đối soát thanh khoàn Bc ds tang cuong lms', '2020-04-23 13:09:06', '2020-04-23 13:09:06', '2020-04-23 17:00:00', NULL, 24, 1),
	(24, 8, 'Nội dung cv thực hiện tuần 12 ngày 16/03/2020 \r\n1. Hướng dẫn Anh em triển khai hướng dẫn lại iOffice và iGate (V.Thanh, Luân => Nhân sự đi hướng dẫn: Luân, Nhựt, A Quốc) \r\n2. Tiếp tục Thiết kế dashboard iGate (V Thanh, Tùng).\r\n3. Triển khai hướng dẫn hệ thống bắt số (Tùng , chiều thứ 2-thứ 3). \r\n4. Viết tài liệu hướng dẫn triển khai hệ thống LLTP (Phối hợp Anh Triều STP) (Tín). \r\n5.  Phối hợp test thủ tục khai sinh vs cục THH. (Tín). \r\n6. Thực hiện outSource các y/c quan trong iGate (Tùng có bc y/c nào ?). \r\n7. Thực hiện outSource các y/c quan trong iOffice (Ngọc  có bc y/c nào ?).  =========================== \r\n3. Tạo task và y/c outsource chức năng bảng tạm lưu mật khẩu iOffice (V Thanh, Ngọc code) => ok  \r\n4. Tạo task chỉnh sửa giao diện trang xác thực SSO (Tín) \r\n5. Cấu hình triển khai ESB (chuyển trực về đường truyền số liệu cấp 1) và test thủ tục lltp (V Thanh, Tín) => 0k 6. Phối hợp test thủ tục khai sinh vs cục THH. (Tín). \r\n7. Giám sát lắp camera ngã tư Hùng vương và VTT (Cam VTT thiếu net, Cam Xanh đỏ thiếu nguồn, net)  ============================ \r\nCv Khác - Bàn giao web vé số từ phán - Bàn giao web BS Lơ \r\n=========================== \r\nNắm tình hình: - Tình hình tích hợp web 5s - Tình hình triển khai tích hợp His Vietinbank - Tình hình ký vnptpay \r\n============================\r\n - Bc Đoàn quí => 0k \r\n- Làm bảng cam kết đảng =>0k  \r\n- Trả lời Anh chuẩn - Kiểm tra và nhắc kết nối VNPT Pay \r\n- Hỏi chi phí lắp đặt cam => ok \r\n- Rà lại bảng phân công công việc. \r\n- Lấy HD cài office 365', '2020-04-23 13:09:38', '2020-04-23 13:09:38', '2020-04-23 17:00:00', NULL, 23, 1),
	(25, 1, 'Test nội dung công việc mới', '2020-04-23 17:01:01', '2020-04-23 17:01:01', '2020-04-23 17:00:00', NULL, 2, 0),
	(26, 8, 'Hỏi lại việc golive VNPT Pay - STP', '2020-04-27 08:16:37', '2020-04-27 08:16:37', '2020-04-27 17:00:00', NULL, 18, 1),
	(27, 8, 'Báo giá web đặng tuyền cho Phong', '2020-04-27 08:16:58', '2020-04-27 08:16:58', '2020-04-27 17:00:00', NULL, 15, 1),
	(28, 8, 'Báo cáo DS nhóm lan tỏa Cho CHị Phượng', '2020-04-27 08:17:13', '2020-04-27 08:17:13', '2020-04-27 17:00:00', NULL, 16, 1),
	(29, 8, 'chuyển thông tin TTPV HCC tỉnh sang VP UB tỉnh', '2020-04-27 17:01:19', '2020-04-27 17:01:19', '2020-04-27 17:00:00', NULL, 11, 1),
	(30, 8, 'Phân công tùng cấu hình lại hệ thống bắt số tại TTPVHCC tỉnh', '2020-04-28 09:54:56', '2020-04-28 09:54:56', '2020-04-28 17:00:00', NULL, 17, 1),
	(31, 8, 'Phần mềm đánh giá, bố trị điều chỉnh câu hỏi theo hàng ngang, mặt khóc, mặt bình thường, mặt cười.', '2020-04-28 10:03:48', '2020-04-28 10:03:48', '2020-04-28 17:00:00', NULL, 14, 1),
	(32, 8, 'Bc danh mục các tiêu chí IOC', '2020-05-02 10:49:48', '2020-05-02 10:49:48', '2020-05-02 17:00:00', NULL, 10, 1),
	(33, 8, 'nghiên cứu demo IOS trình chiếu', '2020-05-02 10:50:10', '2020-05-02 10:50:10', '2020-05-02 17:00:00', NULL, 7, 1),
	(34, 8, 'Xin bc hang tháng, ctrinh năm 2020', '2020-05-06 02:45:00', '2020-05-06 02:45:00', '2020-05-06 17:00:00', NULL, 4, 0),
	(35, 8, 'Đk phân viêc năm 2020', '2020-05-06 02:45:34', '2020-05-06 02:45:34', '2020-05-06 17:00:00', NULL, 5, 1),
	(36, 8, 'Liên hệ ITKV xin api kết nối liên thông quốc gia về KTXH', '2020-05-06 08:29:35', '2020-05-06 08:29:35', '2020-05-06 17:00:00', NULL, 6, 1),
	(37, 8, 'Nhắc Chú Quang về rà soát hs các đơn vị có tỷ lệ cao như ubndtpo', '2020-05-06 10:22:48', '2020-05-06 10:22:48', '2020-05-06 17:00:00', NULL, 8, 1),
	(38, 8, 'Liên hệ Phong tình hình website PK Đặng Tuyền', '2020-05-13 07:59:35', '2020-05-13 07:59:35', '2020-05-13 17:00:00', NULL, 13, 1),
	(39, 8, '-	Họ và tên người mua hàng: Nguyễn Chí Thanh\r\n-	Đơn vị: Trung tâm CÔng nghệ Thông tin – VNPT Trà Vinh\r\n-	Địa chỉ: 83 Lê Lợi, Phường 4, TP Trà Vinh, Tỉnh Trà Vinh\r\n-	MST: 2100118633\r\n-	Nội dung: Dịch vụ ăn uống \r\n-	Ghi rõ số lượng, đơn giá, thành tiền\r\n-	Số tiền:', '2020-05-14 09:14:06', '2020-05-14 09:14:06', '2020-05-14 17:00:00', NULL, 9, 0),
	(41, 8, 'Làm mẫu kinh nghiệm chuyên môn', '2020-05-18 16:12:01', '2020-05-18 16:12:01', '2020-05-18 17:00:00', NULL, 2, 1),
	(42, 8, '1. Liên thông iGate với hệ thống iOffice thông qua tra cứu văn bản\r\n2. bỏ dấu check thủ tục đại diện\r\n3. Nút hop64 hồ sơ trực tuyến đối với thủ tục độ 3-4 khi xem chi tiết hồ sơ tại menu Bộ thủ tục.', '2020-06-04 10:15:27', '2020-06-04 10:15:27', '2020-06-04 17:00:00', NULL, 1, 0),
	(43, 10, 'Kiểm tra chức năng phản hồi hỏi đáp cho a Khương - Sở TT&TT', '2020-06-17 15:24:53', '2020-06-17 15:24:53', '2020-06-18 17:00:00', NULL, 2, 1),
	(44, 10, 'Test chức năng thanh toán trực tuyến', '2020-06-17 15:29:29', '2020-06-17 15:29:29', '2020-06-18 17:00:00', NULL, 1, 0),
	(45, 10, 'Đăng ký thanh toán trực tuyến - Sở TN&MT', '2020-06-17 16:01:22', '2020-06-17 16:01:22', '2020-06-18 17:00:00', NULL, 0, 0),
	(46, 1, 'test', '2021-02-03 08:53:55', '2021-02-03 08:53:55', '2021-02-04 17:00:00', NULL, 3, 0);
/*!40000 ALTER TABLE `to_do` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) unsigned NOT NULL DEFAULT '1',
  `id_don_vi` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'id đơn vị cha có level = 0',
  `id_chuc_danh` int(11) unsigned NOT NULL DEFAULT '1',
  `hinh_anh` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/user.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `di_dong` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `FK_users_don_vi` (`id_don_vi`),
  KEY `FK_users_users_chuc_danh` (`id_chuc_danh`),
  CONSTRAINT `FK_users_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_users_chuc_danh` FOREIGN KEY (`id_chuc_danh`) REFERENCES `users_chuc_danh` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.users: ~34 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `id_don_vi`, `id_chuc_danh`, `hinh_anh`, `remember_token`, `created_at`, `updated_at`, `di_dong`, `state`) VALUES
	(1, 'admin', 'admin', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', 1, 1, 1, '/user.png', '4XC5BVLlac5TaM7wzB0hWKpUVFrMtjKAVexlyTN2sII418S5Ov6KBz80lHNg', NULL, '2020-04-11 20:01:28', '0941138484', 1),
	(8, 'Nguyễn Chí Thanh', 'thanhnc.tvh', '$2y$10$RtlxXvqp14RqZFGNT44WA.qsR/zlhia3oR/77hATGgkGv9/KMYtzm', 4, 1, 1, '/user.png', 'OD6VA88yfV4xFApfRwDXecfbpUUkEObilw4kESaLilJ1LqzMCyQLYMg3gC8U', '2020-04-03 16:17:22', '2020-04-11 20:27:56', '0913658639', 1),
	(10, 'Phan Văn Thanh', 'thanhpv.tvh', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', 3, 1, 5, '/user.png', '5hsjuI8tN5iVWMwWel4WD0X6nHS40vUenDBxzy0VUdBomnucY86Igcgvv8Ne', '2020-04-03 16:25:59', '2020-04-11 20:27:46', '0941138484', 1),
	(11, 'Nguyễn Thanh Tùng', 'tungnt.tvh', '$2y$10$tFnQZXa3aP0GNejj.Kcy.ONJa6hMbluR9j7EM8RZkT.5RAlWdSTxG', 3, 1, 5, '/user.png', '8OAMolOxOYHWKNckCKuG7yAbjTPnLnTrUg683QfNkY6o8kZQBUBK7z2O7W0E', '2020-04-11 18:48:31', '2020-04-11 18:48:31', '0941138484', 1),
	(12, 'Từ Minh Khoa', 'khoatm.tvh', '$2y$10$UPCffm7W0GG9qxGy69BcvON7D4WdhociTO6x7D3077yNUyjRqHNL2', 4, 1, 1, '/user.png', 'reOfJPxYt9A6EzIZEzMpkYdhuemAyuunBN0KxnJ0u7oiRmwu5zh747aURYDs', '2020-04-11 18:56:04', '2020-04-11 20:28:21', '0941138484', 1),
	(13, 'Dương Văn Nhị', 'nhidv.tvh', '$2y$10$QrANvVnD470vNH5m/ALmSesAh4tSyA4BtqKgnjWP.wCVtPl2QzVtO', 5, 1, 5, '/user.png', '8rpaRCa81PwhK5Rynqa9XWTRbeEFLJlL9CXLNbSXeDco2xnMqwx68sYJI84W', '2020-04-11 18:57:10', '2020-04-11 22:09:34', '0941138484', 1),
	(15, 'Trần Quốc Việt', 'viettq.tvh', '$2y$10$mzIsGY09wyuX3lfZDBAD6eLxEPRKDdIfkzU2L0u4/ZJWhKcSKXfkS', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:05:05', '2020-04-11 21:05:05', '0947874156', 1),
	(16, 'Phạm Quốc Việt', 'vietpq.tvh', '$2y$10$ajKpon1ndnIPNgVYh8Tux.ymB3C.UcoQjvMIfdH5RvVE6WXIVyLnG', 6, 1, 1, '/user.png', 'KxIs6n0OE3TPDZID0cZ1y916VWnxaNcHbm0xwTFasmu2Yt9YlsYqvdSrcrG4', '2020-04-11 21:13:07', '2020-04-11 22:11:13', '0919895555', 1),
	(17, 'Hồ Minh Hải', 'haihm.tvh', '$2y$10$xbW5.u4pFwUjCo3fzJsdmeNOC.MRdlf1i.SPsInRAJhlDSuR0UYAm', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:22:16', '2020-04-11 21:22:16', '0916961718', 1),
	(18, 'Võ Duy Hưng', 'hungvd.tvh', '$2y$10$/WA5c2i40M1SeKJ0OB0Bguizp/dCo5kK7rGwORFOkOdZZp1TJ6Vti', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:23:19', '2020-04-11 21:23:19', '0911699736', 1),
	(19, 'Phạm Kim Tín', 'tinpk.tvh', '$2y$10$IDNeDa145SMhVlepiR/TieKH6uLYaRjbitjFc8JXwS4LMGrAJX0l.', 3, 1, 5, '/user.png', 'syFgeGcss4Io8R1AM5nIukToCiJlJsufA0Knhju5clUq8y85reK8zSsRYLxY', '2020-04-11 21:24:49', '2020-04-23 09:42:44', '0944564033', 1),
	(20, 'Lê Minh Nhựt', 'nhutlm.tvh', '$2y$10$vYAj1ItAiEsrfKy/wK6qUO1zGWuE82ZTlo8H0e.NDm4e1Zou8KpBS', 3, 1, 5, '/user.png', '30QysQGD0zXPbZGhqjIPfYGUmicw3HIouXsJAyN8K9wznhwbe5wqziFsI2gZ', '2020-04-11 21:25:48', '2020-04-23 09:50:59', '0941910034', 1),
	(21, 'Trương Thái Bảo Ngọc', 'ngocttb.tvh', '$2y$10$OVsd9CU6c62ndE5ye5oA8uZS/FLIAMB/TgOu2TUEu5bOdGFEkvpiK', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:26:27', '2020-04-11 21:26:27', '0947314376', 1),
	(22, 'Nguyễn Hữu Thuận', 'thuannh.tvh', '$2y$10$siyEraNGi0hpucP5Jfolq.e.c5RtDaKyZ/Yrq/1qpai5cKlgdbbEe', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:27:10', '2020-04-11 21:27:10', '0816780242', 1),
	(23, 'Nguyễn Hữu Quang', 'quangnh.tvh', '$2y$10$DFTQeKJp1AQkYyCaDyr42.CRetUmUwQINV/db5.w0MCaEEHcwuit6', 7, 1, 1, '/user.png', NULL, '2020-04-11 21:28:59', '2020-04-11 22:11:45', '0913891014', 1),
	(24, 'Nguyễn Văn Nam', 'namnv.tvh', '$2y$10$nZyTpoyKyzwQoQPsHIlsO.qhPmAktJxKsrwNrv/bXX/qHD21/ixvO', 7, 1, 2, '/user.png', NULL, '2020-04-11 21:29:42', '2020-04-11 22:12:17', '0919363999', 1),
	(25, 'Huỳnh Minh Luân', 'luanhm.tvh', '$2y$10$tqBgIYTt1PmJnXnzxNZbtupm54e5n9xaL1mZukOAUQ7PGMvjKepre', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:32:01', '2020-04-11 21:32:01', '0944322567', 1),
	(26, 'Trần Anh Tuấn', 'tuanta.tvh', '$2y$10$DKrpoWeRoCJtWhp8R2.XNOTCbLoFyYWjKHfmca6IA/OAGAU6xV.tK', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:32:37', '2020-04-11 21:32:37', '0911771873', 1),
	(27, 'Dương Thị Ngọc Liễu', 'lieudn.tvh', '$2y$10$XGIPLEtXPFZD13PKqp.6qePziPAz/iZE.LVfZfo3THTUVi1OILkoG', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:33:14', '2020-04-11 21:33:14', '0946166399', 1),
	(28, 'Trần Thị Thanh Mỹ', 'myttt.tvh', '$2y$10$ApCKe5NoAzo4RYpOuZcFw.bYyW1PnwARjspyCu2dbmoiTZm9PAwR2', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:33:57', '2020-04-11 21:33:57', '0919345358', 1),
	(29, 'Võ Hoàng Ân', 'anvh.tvh', '$2y$10$7jPrtjtMMzE/t8kUSHK7Mu7s.IcalvQ4lJJtwmuITu8oBvMgriody', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:34:39', '2020-04-11 21:35:32', '0918080279', 1),
	(30, 'Nguyễn Tiến Quốc', 'quocnt.tvh', '$2y$10$PPcc/Pk68G59hLFypF71RetQKVcurdZ6DZGyFZW3sPLKCsX.2k/bG', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:36:05', '2020-04-11 21:36:05', '0918703999', 1),
	(31, 'Bùi Nhật Minh', 'minhbn.tvh', '$2y$10$iIRmvAjSX0GHVrOgVaa3KeIe.qXNlFU3Eg11VoeWctosJgwG2h0Dy', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:39:39', '2020-04-11 21:39:39', '0986508634', 1),
	(32, 'Dương Vỹ Khang', 'khangdv.tvh', '$2y$10$siF4F7O1GkxADrYLZ61vvOBs3jQMfufrcXi/ZYVvtmuOre/kyCw3W', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:42:09', '2020-04-11 21:42:09', '0343975487', 1),
	(33, 'Nguyễn Minh Vương', 'vuongnm.tvh', '$2y$10$yog7.p/y4QjdEcyqqT4oq.raS61FUbOKV4xXTQf3SBPVpjN8kf5jO', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:43:10', '2020-04-11 21:43:10', '0888340508', 1),
	(34, 'Nguyễn Thị Kim Xa', 'xantk.tvh', '$2y$10$E1iN2xnDMwyj./fdMeiuQu0ghYbFdVY9SJ9tE1CY.YmI1UhCXDO.2', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:44:31', '2020-04-11 21:44:31', '0917380098', 1),
	(35, 'Bùi Văn Tính', 'tinhbv.tvh', '$2y$10$IOmJCdrW6yuYFqf.v02As.gd/NJqQJn.YCtgyoS/X2gM2SoS5.dmC', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:45:21', '2020-04-11 21:45:21', '0941240421', 1),
	(36, 'Huỳnh Sa Quang', 'quanghs.tvh', '$2y$10$.lsUNl3xsJ/.TRcKVFQi5O9uIec17j2HTf/lOYWFUYy1aY6nRONcS', 3, 1, 5, '/user.png', NULL, '2020-04-11 21:47:34', '2020-04-11 21:47:34', '0911759134', 1),
	(37, 'Lâm Thành Nhu', 'nhult.tvh', '$2y$10$QtDLWTnO.27hBBSQUDO9O.DLdHsySqiOldu9E.QQQxjqIY5y0si7K', 5, 1, 5, '/user.png', NULL, '2020-04-11 21:54:37', '2020-04-11 22:09:59', '0919329329', 1),
	(38, 'Nguyễn Văn Mãng', 'ngangnv.tvh', '$2y$10$nWztMQtF9KtYipKrvVO1Uuhpk159Gg03GX2./yw7dAqwKQw9MxyXa', 5, 1, 5, '/user.png', NULL, '2020-04-11 21:55:10', '2020-04-11 22:10:44', '0913891098', 1),
	(39, 'Huỳnh Bảo Thiên Ân', 'anhbt.tvh', '$2y$10$IZD41A1WsldMjfhtKZpp.uL5yc9X7n8E1T30fQuT3nn50mRsJPcbu', 5, 1, 5, '/user.png', NULL, '2020-04-11 21:55:45', '2020-04-11 22:10:09', '0918439419', 1),
	(40, 'Mã Đoan Huy', 'huymd.tvh', '$2y$10$bKl6aPVp6EG38edd9mq9SOQe3BgKsFoNQHGIczzn41RfTbNl9y3FG', 5, 1, 5, '/user.png', NULL, '2020-04-11 21:56:15', '2020-04-11 22:10:54', '0913891048', 1),
	(41, 'Nguyễn Thị Kiều Oanh', 'oanhntk.tvh', '$2y$10$bOGMr0/U6nSfwqGzn1b5fekyTJ1d8q5PP7k0FBmM.A.pMqLYuBjL2', 5, 1, 5, '/user.png', NULL, '2020-04-11 21:56:47', '2020-04-11 22:10:19', '0916112304', 1),
	(42, 'Lê Văn Dũng', 'dunglv.tvh', '$2y$10$B7VEOwYyZpFipPnDE53YsOxNmz588zEXkKujd0Uz32m47sBCfA9VS', 6, 1, 5, '/user.png', NULL, '2020-04-11 21:57:30', '2020-04-11 22:11:05', '0919253779', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.users_chuc_danh
CREATE TABLE IF NOT EXISTS `users_chuc_danh` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_chuc_danh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_loai_chuc_danh` int(11) unsigned NOT NULL,
  `state` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_users_chuc_danh_user_loai_chuc_danh` (`id_loai_chuc_danh`),
  CONSTRAINT `FK_users_chuc_danh_user_loai_chuc_danh` FOREIGN KEY (`id_loai_chuc_danh`) REFERENCES `users_loai_chuc_danh` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.users_chuc_danh: ~5 rows (approximately)
/*!40000 ALTER TABLE `users_chuc_danh` DISABLE KEYS */;
INSERT INTO `users_chuc_danh` (`id`, `ten_chuc_danh`, `id_loai_chuc_danh`, `state`) VALUES
	(1, 'Lãnh đạo phòng', 1, 1),
	(2, 'Lãnh đạo Trung tâm', 1, 1),
	(3, 'Lãnh đạo Sở/Ban/Ngành', 1, 1),
	(4, 'Lãnh đạo Tỉnh', 1, 1),
	(5, 'Chuyên viên phòng', 2, 1);
/*!40000 ALTER TABLE `users_chuc_danh` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.users_don_vi
CREATE TABLE IF NOT EXISTS `users_don_vi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_don_vi` int(11) unsigned NOT NULL,
  `id_users` int(11) unsigned NOT NULL,
  `ngay_bat_dau_cong_tac` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_ket_thuc_cong_tac` datetime DEFAULT NULL,
  `state` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_users_don_vi_users` (`id_users`),
  KEY `FK_users_don_vi_don_vi` (`id_don_vi`),
  CONSTRAINT `FK_users_don_vi_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.users_don_vi: ~34 rows (approximately)
/*!40000 ALTER TABLE `users_don_vi` DISABLE KEYS */;
INSERT INTO `users_don_vi` (`id`, `id_don_vi`, `id_users`, `ngay_bat_dau_cong_tac`, `ngay_ket_thuc_cong_tac`, `state`) VALUES
	(1, 5, 1, '2019-07-28 16:07:32', NULL, 1),
	(6, 6, 8, '2020-04-03 16:26:09', NULL, 1),
	(7, 6, 10, '2020-04-03 16:26:09', NULL, 1),
	(8, 6, 11, '2020-04-11 18:54:56', NULL, 1),
	(9, 6, 12, '2020-04-11 18:57:19', NULL, 1),
	(10, 17, 13, '2020-04-11 18:57:19', NULL, 1),
	(11, 6, 15, '2020-04-11 21:05:32', NULL, 1),
	(12, 17, 16, '2020-04-11 21:13:54', NULL, 1),
	(13, 6, 17, '2020-04-11 21:27:27', NULL, 1),
	(14, 6, 18, '2020-04-11 21:27:27', NULL, 1),
	(15, 6, 19, '2020-04-11 21:27:27', NULL, 1),
	(16, 6, 20, '2020-04-11 21:27:27', NULL, 1),
	(17, 6, 21, '2020-04-11 21:27:27', NULL, 1),
	(18, 6, 22, '2020-04-11 21:27:27', NULL, 1),
	(19, 32, 23, '2020-04-11 21:30:18', NULL, 1),
	(20, 32, 24, '2020-04-11 21:30:18', NULL, 1),
	(21, 14, 35, '2020-04-11 21:47:50', NULL, 1),
	(22, 14, 36, '2020-04-11 21:47:50', NULL, 1),
	(23, 14, 34, '2020-04-11 21:47:50', NULL, 1),
	(24, 6, 25, '2020-04-11 21:48:04', NULL, 1),
	(25, 6, 26, '2020-04-11 21:48:04', NULL, 1),
	(26, 6, 27, '2020-04-11 21:48:04', NULL, 1),
	(27, 6, 28, '2020-04-11 21:48:04', NULL, 1),
	(28, 6, 29, '2020-04-11 21:48:04', NULL, 1),
	(29, 6, 30, '2020-04-11 21:48:04', NULL, 1),
	(30, 6, 31, '2020-04-11 21:48:04', NULL, 1),
	(31, 6, 32, '2020-04-11 21:48:04', NULL, 1),
	(32, 6, 33, '2020-04-11 21:48:04', NULL, 1),
	(33, 17, 37, '2020-04-11 21:57:59', NULL, 1),
	(34, 17, 38, '2020-04-11 21:57:59', NULL, 1),
	(35, 17, 39, '2020-04-11 21:57:59', NULL, 1),
	(36, 17, 40, '2020-04-11 21:57:59', NULL, 1),
	(37, 17, 41, '2020-04-11 21:57:59', NULL, 1),
	(38, 17, 42, '2020-04-11 21:57:59', NULL, 1);
/*!40000 ALTER TABLE `users_don_vi` ENABLE KEYS */;

-- Dumping structure for table cntttvho_giaoviec.users_loai_chuc_danh
CREATE TABLE IF NOT EXISTS `users_loai_chuc_danh` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ten_loai_chuc_danh` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table cntttvho_giaoviec.users_loai_chuc_danh: ~2 rows (approximately)
/*!40000 ALTER TABLE `users_loai_chuc_danh` DISABLE KEYS */;
INSERT INTO `users_loai_chuc_danh` (`id`, `ten_loai_chuc_danh`, `state`) VALUES
	(1, 'Lãnh đạo', 1),
	(2, 'Nhân viên', 1);
/*!40000 ALTER TABLE `users_loai_chuc_danh` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

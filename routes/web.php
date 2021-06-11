<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Auth::routes();

// Nhân viên
			Route::get('/nhan-vien',['as'=>'nhanVien','uses'=>'NhanVienController@NhanVien']);
			Route::post('/tao-nhan-vien',['as'=>'taoNhanVien','uses'=>'NhanVienController@TaoNhanVien']);
			Route::post('/sua-nhan-vien',['as'=>'suaNhanVien','uses'=>'NhanVienController@suaNhanVien']);			
			Route::delete('/xoa-nhan-vien/{id}',['as'=>'xoaNhanVien','uses'=>'NhanVienController@XoaNhanVien']);
			Route::post('/get-thong-tin-nhan-vien',['as'=>'getThongTinNhanVien','uses'=>'NhanVienController@getThongTinNhanVien']);	


// phải đăng nhập mới vào được các link bên 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/',['as'=>'home','uses'=>'HomeController@home']);
    Route::get('/chi-tiet-dm-loi/{id}',['as'=>'chiTietDmLoi','uses'=>'HomeController@chiTietDmLoi']);
    
    Route::post('/load-dm-loi-public',['as'=>'loadDmLoiPublic','uses'=>'HomeController@loadDmLoiPublic']); // có thể bỏ bạn này trong view wellcome
    Route::get('/export-loai-danh-muc-to-excel/{tungay}/{denngay}',['as'=>'exportLoaiDanhMucToExcel','uses'=>'HomeController@exportLoaiDanhMucToExcel']);

	// kiểm tra có quyền truy cập không nếu không thì không cho truy cập
	Route::group(['middleware' => 'check-role'], function () {
		

		// trang chủ khi mới đăng nhập xong	
		// nếu có quyền truy cập url thì cho truy cập
		Route::group(['prefix'=>'admin'],function(){
			// trang cập nhật tất cả các action có trong project
			Route::resource('resource', 'AdminResourceRefullController');
			// tạo nhóm quyền
			Route::get('/tao-nhom-quyen',['as'=>'taoNhomQuyen','uses'=>'AdminRoleController@taoNhomQuyenView']);
			Route::post('/tao-nhom-quyen',['as'=>'taoNhomQuyen','uses'=>'AdminRoleController@taoNhomQuyenPost']);
			Route::delete('/xoa-nhom-quyen/{id}',['as'=>'xoaNhomQuyen','uses'=>'AdminRoleController@xoaNhomQuyen']);
			Route::post('/sua-nhom-quyen',['as'=>'suaNhomQuyen','uses'=>'AdminRoleController@suaNhomQuyen']);
			Route::post('/get-thong-tin-nhom-quyen',['as'=>'getThongTinNhomQuyen','uses'=>'AdminRoleController@getThongTinNhomQuyen']);	

			// Phân quyền
			Route::get('/phan-quyen',['as'=>'phanQuyen','uses'=>'AdminRuleController@phanQuyenGet']);
			Route::post('/phan-quyen',['as'=>'phanQuyen','uses'=>'AdminRuleController@phanQuyenPost']);
			Route::post('/danh-sach-quyen',['as'=>'danhSachQuyen','uses'=>'AdminRuleController@danhSachQuyenPost']);


			

				

			// Đơn Vị
			Route::get('/don-vi',['as'=>'donVi','uses'=>'DonViController@donVi']);
			Route::post('/them-don-vi',['as'=>'themDonVi','uses'=>'DonViController@themDonVi']);
			Route::post('/sua-don-vi',['as'=>'suaDonVi','uses'=>'DonViController@suaDonVi']);			
			Route::delete('/xoa-don-vi/{id}',['as'=>'xoaDonVi','uses'=>'DonViController@xoaDonVi']);
			Route::post('/get-thong-tin-don-vi',['as'=>'getThongTinDonVi','uses'=>'DonViController@getThongTinDonVi']);	
			

			// Danh mục lỗi
			Route::get('/danh-muc-loi',['as'=>'danhMucLoi','uses'=>'DanhMucLoiController@danhMucLoi']);
			Route::post('/them-danh-muc-loi',['as'=>'themDanhMucLoi','uses'=>'DanhMucLoiController@themDanhMucLoi']);
			Route::post('/sua-danh-muc-loi',['as'=>'suaDanhMucLoi','uses'=>'DanhMucLoiController@suaDanhMucLoi']);			
			Route::delete('/xoa-danh-muc-loi/{id}',['as'=>'xoaDanhMucLoi','uses'=>'DanhMucLoiController@xoaDanhMucLoi']);
			Route::post('/get-thong-tin-danh-muc-loi',['as'=>'getThongTinDanhMucLoi','uses'=>'DanhMucLoiController@getThongTinDanhMucLoi']);
			Route::get('/urd-danh-muc-loi-word/{id}',['as'=>'urdDanhMucLoiWord','uses'=>'DanhMucLoiController@urdDanhMucLoiWord']);
			Route::post('/get-danh-muc-loi-by-id',['as'=>'getDanhMucLoiById','uses'=>'DanhMucLoiController@getDanhMucLoiById']);


			Route::get('/danh-muc-module-chuc-nang',['as'=>'danhMucModuleChucNang','uses'=>'DanhMucLoiController@danhMucModuleChucNang']);
			Route::post('/them-danh-muc-module-chuc-nang',['as'=>'themDanhMucModuleChucNang','uses'=>'DanhMucLoiController@themDanhMucModuleChucNang']);
			Route::post('/sua-danh-muc-module-chuc-nang',['as'=>'suaDanhMucModuleChucNang','uses'=>'DanhMucLoiController@suaDanhMucModuleChucNang']);			
			Route::post('/xoa-danh-muc-module-chuc-nang',['as'=>'xoaDanhMucModuleChucNang','uses'=>'DanhMucLoiController@xoaDanhMucModuleChucNang']);
			Route::post('/get-danh-muc-module-chuc-nang-by-id',['as'=>'getDanhMucModuleChucNangById','uses'=>'DanhMucLoiController@getDanhMucModuleChucNangById']);
			Route::post('/load-danh-muc-module-chuc-nang',['as'=>'loadDanhMucModuleChucNang','uses'=>'DanhMucLoiController@loadDanhMucModuleChucNang']);






			// Báo cáo công tác hỗ trợ
			Route::get('/cong-tac-ho-tro',['as'=>'congTacHoTro','uses'=>'HoTroController@congTacHoTro']);
			Route::post('/get-danh-muc-loi-theo-loai-danh-muc',['as'=>'getDanhMucLoiTheoLoaiDanhMuc','uses'=>'HoTroController@getDanhMucLoiTheoLoaiDanhMuc']);
			Route::post('/get-danh-cong-tac-ho-tro',['as'=>'getCongTacHoTro','uses'=>'HoTroController@getCongTacHoTro']);
			Route::post('/them-thong-tin-ho-tro',['as'=>'themThongTinHoTro','uses'=>'HoTroController@themThongTinHoTro']);
			Route::get('/bao-cao-cong-tac-ho-tro-tuan-word&nam={nam}&tuan={tuan}&dv={dv}',['as'=>'baoCaoCongTacHoTroTuanWord','uses'=>'HoTroController@baoCaoCongTacHoTroTuanWord']);

			Route::post('/xoa-thong-tin-ho-tro',['as'=>'xoaThongTinHoTro','uses'=>'HoTroController@xoaThongTinHoTro']);
			Route::post('/get-tuan',['as'=>'getTuan','uses'=>'HoTroController@getTuan']);


			// Quản lý lịch upcode
			Route::get('/lich-upcode',['as'=>'lichUpcode','uses'=>'LichUpcodeController@lichUpcode']);
			Route::post('/tao-lich-upcode',['as'=>'taoLichUpcode','uses'=>'LichUpcodeController@taoLichUpcode']);
			Route::post('/sua-lich-upcode',['as'=>'suaLichUpcode','uses'=>'LichUpcodeController@suaLichUpcode']);
			Route::post('/xoa-lich-upcode',['as'=>'xoaLichUpcode','uses'=>'LichUpcodeController@xoaLichUpcode']);
			Route::post('/load-lich-upcode',['as'=>'loadLichUpcode','uses'=>'LichUpcodeController@loadLichUpcode']);
			Route::post('/get-lich-upcode-by-id',['as'=>'getLichUpcodeById','uses'=>'LichUpcodeController@getLichUpcodeById']);
			Route::post('/load-danh-muc-loi',['as'=>'loadDanhMucLoi','uses'=>'LichUpcodeController@loadDanhMucLoi']);
			
			Route::post('/load-ds-nhan-su-upcode',['as'=>'loadDsNhanSuUpcode','uses'=>'LichUpcodeController@loadDsNhanSuUpcode']);
			Route::post('/them-nhan-su-upcode',['as'=>'themNhanSuUpcode','uses'=>'LichUpcodeController@themNhanSuUpcode']);
			Route::post('/xoa-nhan-su-upcode',['as'=>'xoaNhanSuUpcode','uses'=>'LichUpcodeController@xoaNhanSuUpcode']);
			
			Route::post('/load-chi-tiet-upcode',['as'=>'loadChiTietUpcode','uses'=>'LichUpcodeController@loadChiTietUpcode']);
			Route::post('/them-chi-tiet-upcode',['as'=>'themChiTietUpcode','uses'=>'LichUpcodeController@themChiTietUpcode']);
			Route::post('/xoa-chi-tiet-upcode',['as'=>'xoaChiTietUpcode','uses'=>'LichUpcodeController@xoaChiTietUpcode']);
			Route::post('/sua-trang-thai-chi-tiet-upcode',['as'=>'suaTrangThaiChiTietUpcode','uses'=>'LichUpcodeController@suaTrangThaiChiTietUpcode']);

			Route::get('/lich-upcode-ca-nhan',['as'=>'lichUpcodeCaNhan','uses'=>'LichUpcodeController@lichUpcodeCaNhan']);
			Route::post('/load-lich-upcode-ca-nhan',['as'=>'loadLichUpcodeCaNhan','uses'=>'LichUpcodeController@loadLichUpcodeCaNhan']);
			Route::post('/load-chi-tiet-upcode-ca-nhan',['as'=>'loadChiTietUpcodeCaNhan','uses'=>'LichUpcodeController@loadChiTietUpcodeCaNhan']);
			Route::post('/them-chi-tiet-upcode-ca-nhan',['as'=>'themChiTietUpcodeCaNhan','uses'=>'LichUpcodeController@themChiTietUpcodeCaNhan']);

			Route::post('/load-chi-tiet-upcode-ca-nhan-by-id',['as'=>'loadChiTietUpcodeCaNhanById','uses'=>'LichUpcodeController@loadChiTietUpcodeCaNhanById']);
			Route::post('/sua-chi-tiet-upcode-ca-nhan-by-id',['as'=>'suaChiTietUpcodeCaNhanById','uses'=>'LichUpcodeController@suaChiTietUpcodeCaNhanById']);


				
			// phân công chăm sóc khách hàng (phan_cong và chi_tiet_phan_cong)
			Route::get('/bang-phan-cong',['as'=>'bangPhanCong','uses'=>'PhanCongController@bangPhanCong']);
			Route::post('/tao-bang-phan-cong',['as'=>'taoBangPhanCong','uses'=>'PhanCongController@taoBangPhanCong']);
			Route::post('/load-bang-phan-cong',['as'=>'loadBangPhanCong','uses'=>'PhanCongController@loadBangPhanCong']);
			Route::post('/get-bang-phan-cong-by-id',['as'=>'getBangPhanCongById','uses'=>'PhanCongController@getBangPhanCongById']);
			Route::post('/sua-bang-phan-cong',['as'=>'suaBangPhanCong','uses'=>'PhanCongController@suaBangPhanCong']);
			Route::post('/xoa-bang-phan-cong',['as'=>'xoaBangPhanCong','uses'=>'PhanCongController@xoaBangPhanCong']);

			Route::post('/load-chi-tiet-bang-phan-cong',['as'=>'loadChiTietBangPhanCong','uses'=>'PhanCongController@loadChiTietBangPhanCong']);
			Route::post('/them-chi-tiet-bang-phan-cong',['as'=>'themChiTietBangPhanCong','uses'=>'PhanCongController@themChiTietBangPhanCong']);
			Route::post('/xoa-chi-tiet-bang-phan-cong',['as'=>'xoaChiTietBangPhanCong','uses'=>'PhanCongController@xoaChiTietBangPhanCong']);

			
		




			// can_bo
			Route::get('/can-bo',['as'=>'canBo','uses'=>'CanBoController@canBo']);
			Route::post('/load-can-bo',['as'=>'loadCanBo','uses'=>'CanBoController@loadCanBo']);
			Route::post('/them-can-bo',['as'=>'themCanBo','uses'=>'CanBoController@themCanBo']);
			Route::post('/xoa-can-bo',['as'=>'xoaCanBo','uses'=>'CanBoController@xoaCanBo']);
			Route::post('/sua-can-bo',['as'=>'suaCanBo','uses'=>'CanBoController@suaCanBo']);
			Route::post('/get-can-bo-by-id',['as'=>'getCanBoById','uses'=>'CanBoController@getCanBoById']);
			
			// dm_don_vi_yeu_cau
			Route::get('/dm-don-vi-yeu-cau',['as'=>'dmDonViYeuCau','uses'=>'DmDonViYeuCauController@dmDonViYeuCau']);
			Route::post('/load-dm-don-vi-yeu-cau',['as'=>'loadDmDonViYeuCau','uses'=>'DmDonViYeuCauController@loadDmDonViYeuCau']);
			Route::post('/them-dm-don-vi-yeu-cau',['as'=>'themDmDonViYeuCau','uses'=>'DmDonViYeuCauController@themDmDonViYeuCau']);
			Route::post('/xoa-dm-don-vi-yeu-cau',['as'=>'xoaDmDonViYeuCau','uses'=>'DmDonViYeuCauController@xoaDmDonViYeuCau']);
			Route::post('/sua-dm-don-vi-yeu-cau',['as'=>'suaDmDonViYeuCau','uses'=>'DmDonViYeuCauController@suaDmDonViYeuCau']);
			Route::post('/get-dm-don-vi-yeu-cau-by-id',['as'=>'getDmDonViYeuCauById','uses'=>'DmDonViYeuCauController@getDmDonViYeuCauById']);


			// loai_danh_muc
			Route::get('/loai-danh-muc',['as'=>'loaiDanhMuc','uses'=>'LoaiDanhMucController@loaiDanhMuc']);
			Route::post('/load-loai-danh-muc',['as'=>'loadLoaiDanhMuc','uses'=>'LoaiDanhMucController@loadLoaiDanhMuc']);
			Route::post('/them-loai-danh-muc',['as'=>'themLoaiDanhMuc','uses'=>'LoaiDanhMucController@themLoaiDanhMuc']);
			Route::post('/xoa-loai-danh-muc',['as'=>'xoaLoaiDanhMuc','uses'=>'LoaiDanhMucController@xoaLoaiDanhMuc']);
			Route::post('/sua-loai-danh-muc',['as'=>'suaLoaiDanhMuc','uses'=>'LoaiDanhMucController@suaLoaiDanhMuc']);
			Route::post('/get-loai-danh-muc-by-id',['as'=>'getLoaiDanhMucById','uses'=>'LoaiDanhMucController@getLoaiDanhMucById']);

			// users_don_vi	(phân đơn vị cho user) ************************
			Route::get('/phan-don-vi-cho-can-bo',['as'=>'phanDonViChoCanBo','uses'=>'PhanCongCanBoController@phanDonViChoCanBo']);
			Route::post('/load-user-chua-phan-don-vi',['as'=>'loadUserChuaPhanDonVi','uses'=>'PhanCongCanBoController@loadUserChuaPhanDonVi']);
			Route::post('/load-dm-don-vi-can-phan',['as'=>'loadDmDonViCanPhan','uses'=>'PhanCongCanBoController@loadDmDonViCanPhan']);
			Route::post('/cap-nhat-phan-don-vi-cho-can-bo',['as'=>'capNhatPhanDonViChoCanBo','uses'=>'PhanCongCanBoController@capNhatPhanDonViChoCanBo']);
			


			// Báo bù
			Route::get('/bao-cao-nghi-bu',['as'=>'baoCaoNghiBu','uses'=>'BaoBuController@baoCaoNghiBu']);
			Route::post('/load-bao-cao-nghi-bu',['as'=>'loadBaoCaoNghiBu','uses'=>'BaoBuController@loadBaoCaoNghiBu']);
			Route::post('/them-bao-cao-nghi-bu',['as'=>'themBaoCaoNghiBu','uses'=>'BaoBuController@themBaoCaoNghiBu']);
			Route::post('/sua-bao-cao-nghi-bu',['as'=>'suaBaoCaoNghiBu','uses'=>'BaoBuController@suaBaoCaoNghiBu']);
			Route::post('/xoa-bao-cao-nghi-bu',['as'=>'xoaBaoCaoNghiBu','uses'=>'BaoBuController@xoaBaoCaoNghiBu']);
			Route::get('/duyet-bao-cao-nghi-bu',['as'=>'duyetBaoCaoNghiBu','uses'=>'BaoBuController@duyetBaoCaoNghiBu']);
			Route::post('/get-bao-cao-nghi-bu-by-id',['as'=>'getBaoCaoNghiBuById','uses'=>'BaoBuController@getBaoCaoNghiBuById']);

			Route::post('/duyet-bao-cao-nghi-bu-by-id',['as'=>'duyetBaoCaoNghiBuById','uses'=>'BaoBuController@duyetBaoCaoNghiBuById']);
			Route::post('/load-duyet-bao-cao-nghi-bu',['as'=>'loadDuyetBaoCaoNghiBu','uses'=>'BaoBuController@loadDuyetBaoCaoNghiBu']);




			// Báo bù
			Route::get('/dm-link-quan-tri',['as'=>'dmLinkQuanTri','uses'=>'DmLinkQuanTriController@dmLinkQuanTri']);
			Route::post('/load-dm-link-quan-tri',['as'=>'loadDmLinkQuanTri','uses'=>'DmLinkQuanTriController@loadDmLinkQuanTri']);
			Route::post('/them-dm-link-quan-tri',['as'=>'themDmLinkQuanTri','uses'=>'DmLinkQuanTriController@themDmLinkQuanTri']);
			Route::post('/sua-dm-link-quan-tri',['as'=>'suaDmLinkQuanTri','uses'=>'DmLinkQuanTriController@suaDmLinkQuanTri']);
			Route::post('/xoa-dm-link-quan-tri',['as'=>'xoaDmLinkQuanTri','uses'=>'DmLinkQuanTriController@xoaDmLinkQuanTri']);
			Route::post('/get-dm-link-quan-tri-by-id',['as'=>'getDmLinkQuanTriById','uses'=>'DmLinkQuanTriController@getDmLinkQuanTriById']);



			// Giao việc
			/*Route::get('/cong-viec-lanh-dao',['as'=>'congViecLanhDao','uses'=>'GiaoViecController@congViecLanhDao']);
			Route::post('/load-cong-viec-lanh-dao',['as'=>'loadCongViecLanhDao','uses'=>'GiaoViecController@loadCongViecLanhDao']);*/

			Route::get('/cong-viec-nhan-vien',['as'=>'congViecNhanVien','uses'=>'GiaoViecController@congViecNhanVien']);
			Route::post('/load-cong-viec-nhan-vien',['as'=>'loadCongViecNhanVien','uses'=>'GiaoViecController@loadCongViecNhanVien']);

			Route::post('/tao-cong-viec',['as'=>'taoCongViec','uses'=>'GiaoViecController@taoCongViec']);
			Route::post('/sua-cong-viec',['as'=>'suaCongViec','uses'=>'GiaoViecController@suaCongViec']);
			Route::post('/xoa-cong-viec',['as'=>'xoaCongViec','uses'=>'GiaoViecController@xoaCongViec']);
			Route::post('/get-cong-viec-by-id',['as'=>'getCongViecById','uses'=>'GiaoViecController@getCongViecById']);
			Route::post('/tao-xu-ly',['as'=>'taoXuLy','uses'=>'GiaoViecController@taoXuLy']);

			/*Route::post('/load-ds-can-bo-xu-ly',['as'=>'loadDsCanBoXuLy','uses'=>'GiaoViecController@loadDsCanBoXuLy']);*/
			Route::post('/them-can-bo-xu-ly',['as'=>'themCanBoXuLy','uses'=>'GiaoViecController@themCanBoXuLy']);
			Route::post('/xoa-can-bo-xu-ly',['as'=>'xoaCanBoXuLy','uses'=>'GiaoViecController@xoaCanBoXuLy']);



			/*Route::post('/load-ds-noi-dung-xu-ly',['as'=>'loadDsNoiDungXuLy','uses'=>'GiaoViecController@loadDsNoiDungXuLy']);*/
			Route::post('/sua-xu-ly',['as'=>'suaXuLy','uses'=>'GiaoViecController@suaXuLy']);
			Route::post('/get-noi-dung-xu-ly-by-id',['as'=>'getNoiDungXuLyById','uses'=>'GiaoViecController@getNoiDungXuLyById']);
			Route::post('/xoa-xu-ly',['as'=>'xoaXuLy','uses'=>'GiaoViecController@xoaXuLy']);



















			Route::get('/lanh-dao-tao-cong-viec-v2',['as'=>'lanhDaoTaoCongViecV2','uses'=>'GiaoViecController@lanhDaoTaoCongViecV2']);
			Route::get('/nhan-vien-tao-cong-viec-v2',['as'=>'nhanVienTaoCongViecV2','uses'=>'GiaoViecController@nhanVienTaoCongViecV2']);
			Route::post('/tao-cong-viec-v2',['as'=>'taoCongViecV2','uses'=>'GiaoViecController@taoCongViecV2']);
			Route::get('/lanh-dao-giao-cong-viec-v2',['as'=>'lanhDaoGiaoCongViecV2','uses'=>'GiaoViecController@lanhDaoGiaoCongViecV2']);
			Route::post('/load-ds-cong-viec-can-giao-v2',['as'=>'loadDsCongViecCanGiaoV2','uses'=>'GiaoViecController@loadDsCongViecCanGiaoV2']);

			Route::post('/load-cay-xu-ly-cong-viec-v2',['as'=>'loadCayXuLyCongViecV2','uses'=>'GiaoViecController@loadCayXuLyCongViecV2']);
			Route::post('/xoa-cong-viec-v2',['as'=>'xoaCongViecV2','uses'=>'GiaoViecController@xoaCongViecV2']);
			Route::post('/xoa-user-xu-ly-cong-viec2-v2',['as'=>'xoaUserXuLyCongViec2V2','uses'=>'GiaoViecController@xoaUserXuLyCongViec2V2']);

			
			
			Route::post('/get-chi-tiet-cong-viec-v2',['as'=>'getChiTietCongViecV2','uses'=>'GiaoViecController@getChiTietCongViecV2']);
			Route::post('/load-ds-user-xu-ly-cong-viec-v2',['as'=>'loadDsUserXuLyCongViecV2','uses'=>'GiaoViecController@loadDsUserXuLyCongViecV2']);
			Route::post('/load-ds-user-xu-ly-cong-viec2-v2',['as'=>'loadDsUserXuLyCongViec2V2','uses'=>'GiaoViecController@loadDsUserXuLyCongViec2V2']);


			

			Route::post('/them-user-xu-ly-cong-viec-v2',['as'=>'themUserXuLyV2','uses'=>'GiaoViecController@themUserXuLyV2']);
			Route::post('/xoa-user-xu-ly-cong-viec-v2',['as'=>'xoaUserXuLyCongViecV2','uses'=>'GiaoViecController@xoaUserXuLyCongViecV2']);
			Route::post('/them-giao-viec-xu-ly-v2',['as'=>'themGiaoViecXuLyV2','uses'=>'GiaoViecController@themGiaoViecXuLyV2']);
			Route::post('/cap-nhat-giao-viec-xu-ly-v2',['as'=>'capNhatGiaoViecXuLyV2','uses'=>'GiaoViecController@capNhatGiaoViecXuLyV2']);

			Route::get('/xu-ly-cong-viec-v2',['as'=>'xuLyCongViecV2','uses'=>'GiaoViecController@xuLyCongViecV2']);
			Route::post('/load-ds-cong-viec-can-xu-ly-v2',['as'=>'loadDsCongViecCanXuLyV2','uses'=>'GiaoViecController@loadDsCongViecCanXuLyV2']);

			
			Route::post('/chuyen-lanh-dao-duyet-cong-viec-v2',['as'=>'chuyenLanhDaoDuyetCongViecV2','uses'=>'GiaoViecController@chuyenLanhDaoDuyetCongViecV2']);
			Route::post('/chuyen-lanh-dao-ho-tro-cong-viec-v2',['as'=>'chuyenLanhDaoHoTroCongViecV2','uses'=>'GiaoViecController@chuyenLanhDaoHoTroCongViecV2']);


			Route::get('/lanh-dao-ho-tro-xu-ly-v2',['as'=>'lanhDaoHoTroXuLy','uses'=>'GiaoViecController@lanhDaoHoTroXuLy']);
			Route::post('/load-ds-cong-viec-can-lanh-dao-ho-tro-v2',['as'=>'loadDsCongViecCanLanhDaoHoTroV2','uses'=>'GiaoViecController@loadDsCongViecCanLanhDaoHoTroV2']);
			Route::post('/phan-hoi-yeu-cau-ho-tro-v2',['as'=>'phanHoiYeuCauHoTroV2','uses'=>'GiaoViecController@phanHoiYeuCauHoTroV2']);
			Route::post('/duyet-hoan-tat-cong-viec-v2',['as'=>'duyetHoanTatCongViecV2','uses'=>'GiaoViecController@duyetHoanTatCongViecV2']);


			Route::get('/lanh-dao-duyet-cong-viec-v2',['as'=>'lanhDaoDuyetCongViec','uses'=>'GiaoViecController@lanhDaoDuyetCongViec']);
			Route::post('/load-ds-cong-viec-can-lanh-dao-duyet-v2',['as'=>'loadDsCongViecCanLanhDaoDuyetV2','uses'=>'GiaoViecController@loadDsCongViecCanLanhDaoDuyetV2']);
			Route::post('/phan-hoi-yeu-cau-duyet-v2',['as'=>'phanHoiYeuCauDuyetV2','uses'=>'GiaoViecController@phanHoiYeuCauDuyetV2']);
			Route::post('/dong-y-duyet-cong-viec-v2',['as'=>'dongYDuyetCongViecV2','uses'=>'GiaoViecController@dongYDuyetCongViecV2']);


			Route::get('/danh-sach-cong-viec-da-duyet-v2',['as'=>'danhSachCongViecDaDuyetV2','uses'=>'GiaoViecController@danhSachCongViecDaDuyetV2']);
			Route::post('/load-danh-sach-cong-viec-da-duyet-v2',['as'=>'loadDanhSachCongViecDaDuyetV2','uses'=>'GiaoViecController@loadDanhSachCongViecDaDuyetV2']);


			Route::get('/tat-ca-cong-viec-v2',['as'=>'tatCaCongViecV2','uses'=>'GiaoViecController@tatCaCongViecV2']);
			Route::post('/load-tat-ca-cong-viec-v2',['as'=>'loadTatCaCongViecV2','uses'=>'GiaoViecController@loadTatCaCongViecV2']);

			Route::get('/dowload-tai-lieu-cong-viec-v2/{id}/{stt}',['as'=>'downloadTaiLieuCongViecV2','uses'=>'GiaoViecController@downloadTaiLieuCongViecV2']);
			Route::post('/bao-cao-hoan-tat-cong-viec-v2',['as'=>'baoCaoHoanTatCongViecV2','uses'=>'GiaoViecController@baoCaoHoanTatCongViecV2']);

			Route::get('/danh-sach-cong-viec-da-giao-v2',['as'=>'danhSachCongViecDaGiaoV2','uses'=>'GiaoViecController@danhSachCongViecDaGiaoV2']);
			Route::post('/load-ds-cong-viec-da-giao-v2',['as'=>'loadDsCongViecDaGiaoV2','uses'=>'GiaoViecController@loadDsCongViecDaGiaoV2']);

			Route::get('/to-do',['as'=>'toDo','uses'=>'ToDoController@toDo']);
			Route::post('/them-to-do',['as'=>'themToDo','uses'=>'ToDoController@themToDo']);
			Route::post('/load-ds-my-to-do',['as'=>'loadDsMyToDo','uses'=>'ToDoController@loadDsMyToDo']);
			Route::post('/get-to-do-by-id',['as'=>'getToDoById','uses'=>'ToDoController@getToDoById']);
			Route::post('/update-to-do',['as'=>'updateToDo','uses'=>'ToDoController@updateToDo']);
			Route::post('/delete-to-do',['as'=>'deleteToDo','uses'=>'ToDoController@deleteToDo']);
			Route::post('/cap-nhat-trang-thai-to-do',['as'=>'capNhatTrangThaiToDo','uses'=>'ToDoController@capNhatTrangThaiToDo']);
			Route::post('/cap-nhat-thu-tu-to-do',['as'=>'capNhatThuTuToDo','uses'=>'ToDoController@capNhatThuTuToDo']);

			

			
			
			// Cập nhật mẫu báo cáo tuần
			// Thêm chức năng show lịch upcode cho nhân viên cập nhật những thông tin vào


			// Thêm nút xóa trong quản lý lịch biểu
			// sửa phân công chưa làm
			// set lịch chăm sóc khách hàng
			// dm_chuc_vu (đã thêm trực tiếp trên db)
			// tham_so_don_vi (chưa sử dụng đến)
			// don_vi_tham_so_don_vi (chưa sử dụng đến)
			// huong_xu_ly (đúng ra là dm_huong_xu_ly) (đã thêm trực tiếp trên db)

			
			
			
		});
	});	
});
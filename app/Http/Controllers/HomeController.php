<?php

    namespace App\Http\Controllers;

    use App\DanhMucLoi;
    use App\LoaiDanhMuc;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use DB;
    use Auth;
    use Request as RequestAjax;
    class HomeController extends Controller
    {      
        public function home(Request $request){
            

            $loaiDanhMucs=LoaiDanhMuc::getLoaiDanhMuc();
            return view('welcome',compact('loaiDanhMucs'));           
        }

        public function loadDmLoiPublic(){
            $tenDmLoi=RequestAjax::get('ten_dm_loi');
            $idLoaiDanhMuc=RequestAjax::get('id_loai_danh_muc');
            
            $danhMucLois=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state', 'dm_loi.cach_khac_phuc')
            ->join('users','dm_loi.id_user','=','users.id')
            ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
            ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
            ->where('dm_loi.id_huong_xu_ly','=',1);
            if($tenDmLoi){
                $danhMucLois=$danhMucLois->where('dm_loi.ten_dm_loi','like',"%$tenDmLoi%");
            }
            if($idLoaiDanhMuc){
                $danhMucLois=$danhMucLois->where('loai_danh_muc.id','=',$idLoaiDanhMuc);
            }            
            $danhMucLois=$danhMucLois->get()->toArray();
            $view=view('load-welcome', compact('danhMucLois'))->render();             
            return response()->json(['html'=>$view]);
        }


        public function chiTietDmLoi(Request $request){
            $id=$request->id;
            $danhMucLoi=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'dm_loi.state', 'dm_loi.mo_ta', 'dm_loi.hinh_anh', 'dm_loi.file', 'dm_loi.yeu_cau', 'dm_loi.cach_khac_phuc', 'ma_yeu_cau')
            ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
            ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
            ->where('dm_loi.id','=',$id)
            ->where('id_huong_xu_ly','=',1)
            ->get()->toArray();

            if($danhMucLoi){
                $danhMucLoi=$danhMucLoi[0];    
            }
            else{
                $danhMucLoi=array(); 
            }
            return view('chi-tiet-dm-loi',compact('danhMucLoi'));
        }


        public function exportLoaiDanhMucToExcel(Request $request){
            die(var_dump($request->tungay));
            $loaiDanhMucs=LoaiDanhMuc::getLoaiDanhMuc();



            $fileType = \PHPExcel_IOFactory::identify('public/export/excel/excel.xlsx'); // đọc loại file template
            $objReader = \PHPExcel_IOFactory::createReader($fileType);
            $objPHPExcel = $objReader->load('public/export/excel/excel.xlsx'); //load dữ liệu từ file excel luu vao bien $objPHPExcel
         
            $bookData = LoaiDanhMuc::getLoaiDanhMuc(); //đọc dữ liệu từ database
            $this->addDataToExcelFile($objPHPExcel->setActiveSheetIndex(0), $bookData); //chay ham them du lieu vao excel
         
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); //Ham tao moi file excel
         
            //Kiem tra thu muc co ton tai khong, neu khong co thi tao moi
         
            if (!is_dir(public_path('export'))) {
                mkdir(public_path('export'));
            }
         
            if (!is_dir(public_path('export/excel'))) {
                mkdir(public_path('export/excel'));
            }
            //-----------------------------------------------------------
         
            $path = 'export/excel/export.xlsx'; //dat ten cho file excel
         
            $objWriter->save(public_path($path)); //luu file excel vao thu muc
         
            $file = public_path($path);
            return response()->download($file);

        }





        private function addDataToExcelFile ($setCell, $bookData) //HAM THEM DU LIEU VAO FILE EXCEL
        {
            $setCell->setCellValue('D7', 'Đào Hải Long');   //them doan text Dao Hai Long vao o D7
         
            $index = 1;
         
            $row = 12;  //danh dau dong bat dau them data, su dung trong vong lap foreach
         
            foreach ($bookData as $key => $item) {
         
                $setCell
                    ->setCellValue('B' . $row, $index)  //them du lieu vao cot B
                    ->setCellValue('C' . $row, $item['id'])
                    ->setCellValue('E' . $row, $item['id_users'])
                    ->setCellValue('F' . $row, $item['ten_loai_danh_muc'])
                    ->setCellValue('G' . $row, $item['state'])
                    ->setCellValue('H' . $row, '=F' . $row . '*G' . $row); //them dong text vao cot H, su dung ham tinh toan mac dinh trong excel de tinh gia tri
         
                $index++;
         
                $row++;
            }
         
            //them duong vien cho du lieu trong file excel
         
            $setCell->getStyle("B12:H" . ($index+10) )->applyFromArray(array(
                'borders' => array(
                    'outline' => array(
                        'style' => \PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                        'size' => 1,
                    ),
                    'inside' => array(
                        'style' => \PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                        'size' => 1,
                    ),
                ),
            ));
            //------------------------------------------------------------------
         
            return $this;
        }

        
        
    }
?>
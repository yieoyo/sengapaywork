<?php
	require_once(APP_PATH.'/PHPExcel/PHPExcel.php');
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getActiveSheet()->freezePane('A2');
	$conter		=		1;
	if(!empty($thead)){
		foreach($thead as $record){
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()
			->getStyle('A1:Z1')
			->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()
			->setARGB('FFE8E5E5');
			
			// foreach($record as $key=>$val){
				// $objPHPExcel->getActiveSheet()->SetCellValue('A'.$conter, $key);
				
			// }
			// $objPHPExcel->getActiveSheet()->SetCellValue('B'.$conter, $record["country"]);
			// $objPHPExcel->getActiveSheet()->SetCellValue('C'.$conter, $record["destination"]);
			// $objPHPExcel->getActiveSheet()->SetCellValue('D'.$conter, $record["season"]);
			// $objPHPExcel->getActiveSheet()->SetCellValue('E'.$conter, $record["flight"]);
			// $objPHPExcel->getActiveSheet()->SetCellValue('F'.$conter, $record["departure_date"]);
			// $objPHPExcel->getActiveSheet()->SetCellValue('G'.$conter, $record["arrival_date"]);
			// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$conter, $record["created"]);
			// $objPHPExcel->getActiveSheet()->SetCellValue('I'.$conter, $record["time"]);
			$conter++;
		}
	}
	//pr($thead); die;
	$objPHPExcel->getActiveSheet()
						->fromArray(
							$thead,  // The data to set
							NULL,        // Array values with this value will not be set
							'A1'         // Top left coordinate of the worksheet range where
										 //    we want to set these values (default is A1)
						);
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
	$excel = new PHPExcel();
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Contributor-report.xls"');
	header('Cache-Control: max-age=0'); 
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
	
	// This line will force the file to download    
	$writer->save('php://output');
<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
//require_once dirname(__FILE__) . '../Classes/PHPExcel.php';
require "../Classes/PHPExcel.php";
require "dbcon.php";
require "../models/SamplesModel.php";

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();



// Set document properties
$objPHPExcel->getProperties()->setCreator("GRC Tech")
							 ->setLastModifiedBy("GRC Tech")
							 ->setTitle("Office 2007 XLSX Hive Data")
							 ->setSubject("Office 2007 XLSX Hive Data")
							 ->setDescription("GRC Hive Data")
							 ->setKeywords("Bee Hive Honey Mites")
							 ->setCategory("Bee Hive");

$db = writeDatabase();
$samplesModel = new SamplesModel($db);
$sampleList = $samplesModel->getAllSamples();
                        

//Set Row Titles

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hive Name')
            ->setCellValue('B1', 'Mites')
            ->setCellValue('C1', 'Sample Period')
            ->setCellValue('D1', 'Date Recorded');

$rowCount = 2;

// Add some data
while($row = $sampleList->fetch(PDO::FETCH_ASSOC)){
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $rowCount, $row['hive_id'])
            ->setCellValue('B' . $rowCount, $row['num_mites'])
            ->setCellValue('C' . $rowCount, $row['sample_period'])
            ->setCellValue('D' . $rowCount, $row['collection_date']);
    $rowCount++;
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('MiteCount');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="MiteCount.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

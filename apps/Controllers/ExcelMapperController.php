<?php
namespace Application\Controllers;

//use Absoft\App\Security\Auth;
use Absoft\Line\App\Pager\Alert;
use Absoft\Line\Core\FaultHandling\Errors\DBConnectionError;
use Absoft\Line\Core\FaultHandling\Errors\ExecutionException;
use Absoft\Line\Core\HTTP\JSONResponse;
use Absoft\Line\Core\HTTP\ViewResponse;
use Absoft\Line\Core\Modeling\Controller;
use Application\conf\DirConfiguration;
use Application\Models\DaysModel;
use Application\Models\ScheduleModel;
use Application\Models\StudentsModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelMapperController extends Controller{

    public function show() {
        //TODO: here write showing codes to be Executed
        return "";
    }
    
    public function view($request){
        //TODO: here write viewing codes to be Executed
        return "";
    }

    public function save($request){

        if(!isset($_FILES["excel_file"])){
            print_r($this->request);
            Alert::sendInfoAlert("First Select excel file to upload");
            return $this->display("/ExcelMapping/upload_file");
        }

//        print_r($this->request);

        $oname = $_FILES["excel_file"]["name"];
        $tmp_place = $_FILES["excel_file"]["tmp_name"];
        $type = strtolower(pathinfo($oname)["extension"]);
        $file_destination = DirConfiguration::$_main_folder."/uploads/$oname";

        $allowed = array("xls", "xlsx");

        if(!in_array($type, $allowed)){
            unlink($tmp_place);
            Alert::sendErrorAlert("file is not excel file. file extension must be of ".implode(", ", $allowed));
            return $this->display("/ExcelMapping/upload_file");
        }

        if(!move_uploaded_file($tmp_place, $file_destination)){
            unlink($tmp_place);
            Alert::sendErrorAlert("cannot move file!");
            return $this->display("/ExcelMapping/upload_file");
        }

        Alert::sendSuccessAlert("file uploaded successfully. ".$oname);
        return $this->display(
            "/ExcelMapping/map_file", [
                "data" => $this->fetchData($file_destination),
//                "data" => $this->phpExcelDataFetch($file_destination),
                "file_name" => $file_destination
        ]);

    }

    public function fetchData($file_name){

        $data = [];
        $spreadsheet = IOFactory::load($file_name);
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($sheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            // This loops through all cells,
            //    even if a cell value is not set.
            // For 'TRUE', we loop through cells
            //    only when their value is set.
            // If this method is not called,
            //    the default value is 'false'.
            $data[] = $cellIterator;
//            foreach ($cellIterator as $cell) {
//            }

        }

        return $data;

    }

    /**
     * @param $request
     * @return ViewResponse
     * @throws DBConnectionError
     * @throws ExecutionException
     */
    public function import($request) {

        $spreadsheet = IOFactory::load($request["file_name"]);
        $model = new ScheduleModel();
        $days_model = new DaysModel();
        $student_model = new StudentsModel();
        $sheet = $spreadsheet->getActiveSheet();
        $driver_days = [];
        $row_count = 1;

        foreach ($sheet->getRowIterator() as $row) {

            if($row_count == 1){
                $row_count += 1;
                continue;
            }

            $days = explode(",", trim(strtolower($row->getWorksheet()->getCell($request["days"]."$row_count")->getValue())));

            $client_id = $row->getWorksheet()->getCell($request["client"]."$row_count")->getValue();
            $driver_id = $row->getWorksheet()->getCell($request["driver_id"]."$row_count")->getValue();
            $studs = explode(",", $row->getWorksheet()->getCell($request["students"]."$row_count")->getValue());
            $stud_array = [];

            foreach($studs as $stud) {
                $stud_array[] = [
                    "client_id" => $client_id,
                    "name" => $stud
                ];
            }

            $created_schedule = $model->createSchedule(
                $row->getWorksheet()->getCell($request["pick_up"]."$row_count")->getValue(),
                $row->getWorksheet()->getCell($request["drop_off"]."$row_count")->getValue(),
                strtotime(str_replace("\\", "/", $row->getWorksheet()->getCell($request["start_date"]."$row_count")->getValue())),
                Strtotime(str_replace("\\", "/", $row->getWorksheet()->getCell($request["end_date"]."$row_count")->getValue())),
                $driver_id,
                $client_id,
                $row->getWorksheet()->getCell($request["route"]."$row_count")->getValue()
            );

            $driver_days[$driver_id] = array_merge((isset($driver_days[$driver_id]) ? $driver_days[$driver_id] : []), $days_model->dayCreateArray($days, $created_schedule["id"], $driver_id));

            $days_model->importDays($driver_days);
            $student_model->createMultipleStudents($stud_array);

            $row_count += 1;

        }

        Alert::sendSuccessAlert("Imported successfully");
        return $this->display("/ExcelMapping/upload_file");

    }

    /**
     * @param $file_name
     * @return array
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     *
     */
    public function phpExcelDataFetch($file_name){

        $data = [];
        $reader = \PHPExcel_IOFactory::createReaderForFile($file_name);
        $excel_obj = $reader->load($file_name);
        $worksheet = $excel_obj->getSheet('0');

        $last_row = $worksheet->getHighestRow();
        $last_column = $worksheet->getHighestDataColumn();
        $last_column_number = \PHPExcel_Cell::columnIndexFromString($last_column);

        for ($i = 1; $i <= $last_row; $i++) {

            $col = [];
            for ($j = 1; $j <= $last_column_number; $j++){
                $col[] = $worksheet->getCell(\PHPExcel_Cell::stringFromColumnIndex($j).$i)->getValue();
            }

            $data[] = $col;

        }

        return $data;

    }
    
    public function delete($request) {
        //TODO: here write deleting codes to be Executed
        return "";
    }

}
?>
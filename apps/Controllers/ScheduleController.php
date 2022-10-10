<?php
namespace Application\Controllers;

use Absoft\Line\App\Pager\Alert;
use Absoft\Line\Core\HTTP\Route;
use Absoft\Line\Core\Modeling\Controller;
use Application\Models\DaysModel;
use Application\Models\ScheduleModel;

class ScheduleController extends Controller{

    function show($request){

        // if(!$this->validate()) {
        //     Alert::sendErrorAlert($this->validationMessage());
        //     Route::view("/schedule_list");
        // }

        $model = new ScheduleModel();
//        $day = date("D", time());
        // $day = date("D", time());

        if(isset($request["day"])){
            return $this->display("/Schedule/ScheduleList", $model->getSchedulesByDay($request["day"]));
        }

        $query = $model->searchRecord();
        return $this->display("/Schedule/ScheduleList", $query->fetch()->fetchAll());

    }

    /**
     * @param $request
     * @return \Absoft\Line\Core\HTTP\ViewResponse
     * @throws \Absoft\Line\Core\FaultHandling\Errors\DBConnectionError
     * @throws \Absoft\Line\Core\FaultHandling\Errors\ExecutionException
     */
    function view($request){

        if(!$this->validate()) {
            Alert::sendErrorAlert($this->validationMessage());
            Route::view("/schedule_list");
        }
        
        $model = new ScheduleModel();
        return $this->display("/Schedule/ScheduleDetail", $model->getScheduleDetail($request["id"]));

    }

    function freeDrivers($request) {

        if(!$this->validate()) {
            Alert::sendErrorAlert($this->validationMessage());
            Route::view("/");
        }

        $model = new DaysModel();
        $day = $request["day"] ?? 't';
        return $this->display("/FreeDrivers", $model->freeDrivers($day));

    }

    function driverScheduleDetail($request) {

        if(!$this->validate()) {
            Alert::sendErrorAlert($this->validationMessage());
            Route::view("/");
        }

        $model = new DaysModel();
        return $this->display("/DriverDetail", $model->getDriverDetail($request["driver_id"]));

    }

    function driverSchedules($request) {

        if(!$this->validate()) {
            Alert::sendErrorAlert($this->validationMessage());
            Route::view("/");
        }

        $model = new ScheduleModel();
        return $this->display("/DriverDetail", $model->getSingleSchedule($request["driver_id"]));

    }
    
    public function update($request){
        //TODO: here write updating codes to be Executed
        return "";
    }
    
    private function delete($request){
        //TODO: here write deleting codes to be Executed
        return "";
    }

}
?>
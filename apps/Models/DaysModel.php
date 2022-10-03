<?php
namespace Application\Models;

use Absoft\Line\Core\FaultHandling\Errors\DBConnectionError;
use Absoft\Line\Core\FaultHandling\Errors\ExecutionException;
use Absoft\Line\Core\Modeling\Models\Model;

class DaysModel extends Model{

    /*    public $MAINS = ["id", "username", "f_name"];    */
    
    //As the name indicate this is the Table name of the Model

    public string $TABLE_NAME = "Days";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public array $MAINS = ["schedule_id", "driver_id", "day"];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/

    public array $HIDDEN = [];


    /**
     * @param $day_array
     * @param $schedule_id
     * @throws DBConnectionError
     * @throws ExecutionException
     */
    function createDays($day_array, $schedule_id, $dirver_id) {

        $query = $this->addRecord();

        foreach ($day_array as $day){

            $query->add([
                "day" => $day,
                "dirver_id" => $dirver_id,
                "schedule_id" => $schedule_id
            ]);

        }

        $query->insert();

    }

    function importDays($day_array) {

        $query = $this->addRecord();

        $days = ["m", "t", "w", "th", "f", "sa", "su"];

        foreach ($day_array as $driver_id => $driver_days_array) {

            $days_found = [];
            foreach($driver_days_array as $day){

                $days_found[] = $day["day"];
                $query->add($day);

            }

            foreach($days as $d) {

                if(!in_array($d, $days_found)) {

                    $query->add([
                        "day" => $d,
                        "dirver_id" => $driver_id,
                        "schedule_id" => 0
                    ]);
                
                }

            }

        }

        $query->insert();

    }

    function dayCreateArray($day_array, $schedule_id, $dirver_id) {

        $return_array = [];

        foreach ($day_array as $day) {

            $return_array[] = [
                "day" => $day,
                "dirver_id" => $dirver_id,
                "schedule_id" => $schedule_id
            ];

        }

        return $return_array;

    }

    function getByDay($day) {
        $query = $this->searchRecord();
        $query->where("day", $day);
        $result = $query->fetch();
        return $result->fetchAll();
    }

    function freeDrivers($day = ""){
        $query = $this->searchRecord();
        if($day){
            $query->where("day", $day);
        }
        $query->where("schedule_id", 0);
        $result = $query->fetch();
        return $result->fetchAll();
    }

    function getBySchedule($schedule_id) {
        $query = $this->searchRecord();
        $query->where("schedule_id", $schedule_id);
        $result = $query->fetch();
        return $result->fetchAll();
    }

}
?>
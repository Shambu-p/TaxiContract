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

    public array $MAINS = ["schedule_id", "day"];
    
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
    function createDays($day_array, $schedule_id){

        $query = $this->addRecord();

        foreach ($day_array as $day){
            $query->add([
                "day" => $day,
                "schedule_id" => $schedule_id
            ]);
        }

        $query->insert();

    }

    function getByDay($day) {
        $query = $this->searchRecord();
        $query->where("day", $day);
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
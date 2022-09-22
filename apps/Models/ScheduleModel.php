<?php
namespace Application\Models;

use Absoft\Line\Core\FaultHandling\Errors\DBConnectionError;
use Absoft\Line\Core\FaultHandling\Errors\ExecutionException;
use Absoft\Line\Core\Modeling\Models\Model;

class ScheduleModel extends Model{

    /*    public $MAINS = ["id", "username", "f_name"];    */
    
    //As the name indicate this is the Table name of the Model

    public string $TABLE_NAME = "Schedule";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public array $MAINS = ["id", "pick_up", "drop_off", "start_date", "end_date", "driver_id", "client", "route"];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/

    public array $HIDDEN = [];


    function getScheduleByDriver($driver_id){
        return $this->getSchedules("driver_id", $driver_id);
    }

    function getScheduleByClient($client_id){
        return $this->getSchedules("client", $client_id);
    }

    function getSchedules($column, $value){
        $query = $this->searchRecord();
        $query->where($column, $value);
        $result = $query->fetch();
        return $result->fetchAll();
    }

    function getSingleSchedule($schedule_id){
        $query = $this->searchRecord();
        $query->where("id", $schedule_id);
        $result = $query->fetch();

        return ($result->rowCount() > 0) ? $result->fetch() : [];
    }

    /**
     * @param $pu
     * @param $df
     * @param $start
     * @param $end
     * @param $driver_id
     * @param $client
     * @param $route
     * @param $days
     * @return array
     * @throws DBConnectionError
     * @throws ExecutionException
     */
    function createSchedule($pu, $df, $start, $end, $driver_id, $client, $route, $days){

        $query = $this->addRecord();

        $insert_array = [
            "pick_up" => $pu,
            "drop_off" => $df,
            "start_date" => $start,
            "end_date" => $end,
            "driver_id" => $driver_id,
            "client" => $client,
            "route" => $route
        ];

        $query->add($insert_array);

        $query->insert();
        $id = $this->lastInsertId();

        $insert_array["id"] = $id;

        $model = new DaysModel();
        $model->createDays($days, $id);

        return $insert_array;

    }

}
?>
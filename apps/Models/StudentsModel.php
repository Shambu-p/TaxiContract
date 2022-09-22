<?php
namespace Application\Models;

use Absoft\Line\Core\FaultHandling\Errors\DBConnectionError;
use Absoft\Line\Core\FaultHandling\Errors\ExecutionException;
use Absoft\Line\Core\Modeling\Models\Model;

class StudentsModel extends Model{

    /*    public $MAINS = ["id", "username", "f_name"];    */
    
    //As the name indicate this is the Table name of the Model

    public string $TABLE_NAME = "Students";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public array $MAINS = ["client_id", "name"];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/

    public array $HIDDEN = [];


    /**
     * @param $client_id
     * @param $name
     * @throws DBConnectionError
     * @throws ExecutionException
     */
    public function createStudent($client_id, $name){
        $query = $this->addRecord();
        $query->add([
            "client" => $client_id,
            "name" => $name
        ]);

        $query->insert();
    }

    /**
     * @param $array
     * @throws DBConnectionError
     * @throws ExecutionException
     */
    public function createMultipleStudents($array){

        $query = $this->addRecord();
        foreach($array as $student){
            $query->add($student);
        }

        $query->insert();

    }

    /**
     * @param $client
     * @return array
     * @throws DBConnectionError
     * @throws ExecutionException
     */
    public function getClientStudents($client){
        $query = $this->searchRecord();
        $query->where("client", $client);
        $result = $query->fetch();
        return $result->fetchAll();
    }

}
?>
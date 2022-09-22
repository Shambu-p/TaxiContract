<?php
namespace Application\Models;

use Absoft\Line\Core\FaultHandling\Errors\DBConnectionError;
use Absoft\Line\Core\FaultHandling\Errors\ExecutionException;
use Absoft\Line\Core\FaultHandling\Errors\OperationFailed;
use Absoft\Line\Core\Modeling\Models\Model;

class UsersModel extends Model {

    /*    public $MAINS = ["id", "username", "f_name"];    */
    
    //As the name indicate this is the Table name of the Model

    public string $TABLE_NAME = "Users";
    public string $DATABASE_NAME = "third";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public array $MAINS = ["id", "username", "email", "role"];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/

    public array $HIDDEN = ["password"];

    /**
     * @return bool|\PDOStatement
     * @throws DBConnectionError
     * @throws ExecutionException
     */
    function getUsers(){
        $query = $this->searchRecord();
        $query->filter(["id", "username", "email", "role"]);
        return $query->fetch();
    }

    /**
     * @param $username
     * @param $email
     * @param $password
     * @param $role
     * @param $branch_id
     * @return array
     * @throws DBConnectionError
     * @throws ExecutionException
     */
    function createCashier($username, $email, $password, $role, $branch_id){

        $this->beginTransaction();
        $query = $this->addRecord();
        $query->add([
            "username" => $username,
            "email" => $email,
            "role" => $role,
            "password" => $password
        ]);
        $query->insert();

        $id = $this->lastInsertId();

        $cashier_model = new CashierModel();
        $cashier = $cashier_model->newCashier($id, $branch_id);
        $this->commit();

        return [
            "id" => $id,
            "username" => $username,
            "email" => $email,
            "role" => $role,
            "password" => $password,
            "branch" => $cashier
        ];

    }

    /**
     * @param $id
     * @param $password
     * @return array|mixed
     * @throws DBConnectionError
     * @throws ExecutionException
     * @throws OperationFailed
     */
    function changePassword($id, $password) {

        $result = $query = $this->findRecord($id);

        if(empty($result)) {
            throw new OperationFailed("User not found");
        }

        $query = $this->updateRecord();
        $query->set("password", $password);
        $query->where("id", $id);
        $query->update();

        $result["password"] = "";
        return $result;

    }

    /**
     * @param $id
     * @param $role
     * @return array|mixed
     * @throws DBConnectionError
     * @throws ExecutionException
     * @throws OperationFailed
     */
    function changePrivilege($id, $role){

        $result = $this->findRecord($id);

        if(empty($result)){
            throw new OperationFailed("User not found");
        }

        $query = $this->updateRecord();
        $query->set("role", $role);
        $query->where("id", $id);
        $query->update();

        $result["password"] = "";
        $result["role"] = $role;
        return $result;

    }

    /**
     * @param $id
     * @param $username
     * @param $email
     * @return array|mixed
     * @throws DBConnectionError
     * @throws ExecutionException
     * @throws OperationFailed
     */
    function change($id, $username, $email){

        $result = $this->findRecord($id);

        if(empty($result)){
            throw new OperationFailed("user not found!");
        }

        $query = $this->updateRecord();

        $query->set("username", $username);
        $query->set("email", $email);

        $query->where("id", $id);
        $query->update();

        unset($result["password"]);

        $result["username"] = $username;
        $result["email"] = $email;
        return $result;

    }

    /**
     * @return array
     * @throws DBConnectionError
     * @throws ExecutionException
     * @throws OperationFailed
     */
    function allCashiers(){

        $query = $this->searchRecord();
        $query->join("Application\\Models\\CashierModel", "id", "cashier_id", "cashier");
        $query->select("id");
        $query->select("username");
        $query->select("email");
        $query->select("branch_id");
        $query->select("clear_time");
        $query->where("role", "cashier");
        $result = $query->fetch();

        return $result->fetchAll();

    }

}
?>
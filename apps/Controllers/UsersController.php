<?php
namespace Application\Controllers;

use Absoft\Line\App\Security\AuthorizationManagement;
use Absoft\Line\Core\FaultHandling\Errors\DBConnectionError;
use Absoft\Line\Core\FaultHandling\Errors\ExecutionException;
use Absoft\Line\Core\FaultHandling\Errors\ForbiddenAccess;
use Absoft\Line\Core\FaultHandling\Errors\OperationFailed;
use Absoft\Line\Core\HTTP\JSONResponse;
use Absoft\Line\Core\Modeling\Controller;
use Application\Models\UsersModel;

class UsersController extends Controller{

    /**
     * @param $request
     * @return JSONResponse
     * @throws OperationFailed|ForbiddenAccess
     */
    function view($request){

        if(!$this->validate()){
            throw new OperationFailed($this->validationMessage());
        }

        $auth = AuthorizationManagement::viewAuth($request["token"],"user_auth");
        if(empty($auth)){
            throw new ForbiddenAccess();
        }

        $model = new UsersModel();
        return $this->json($model->findRecord($request["id"]));

    }

    /**
     * @param $request
     * @return JSONResponse
     * @throws DBConnectionError
     * @throws ExecutionException|OperationFailed|ForbiddenAccess
     */
    function createCashier($request) {

        if(!$this->validate()){
            throw new OperationFailed($this->validationMessage());
        }

        $auth = AuthorizationManagement::viewAuth($request["token"],"user_auth");
        if(empty($auth) || $auth["role"] != "admin"){
            throw new ForbiddenAccess();
        }

        $model = new UsersModel();
        return $this->json($model->createCashier($request["username"], $request["email"], $request["password"], "cashier", $request["branch_id"]));

    }

    /**
     * @param $request
     * @return JSONResponse
     * @throws DBConnectionError
     * @throws ExecutionException
     * @throws OperationFailed|ForbiddenAccess
     */
    public function updateCashier($request) {

        if(!$this->validate()){
            throw new OperationFailed($this->validationMessage());
        }

        $auth = AuthorizationManagement::viewAuth($request["token"],"user_auth");
        if(empty($auth) || $auth["role"] != "admin"){
            throw new ForbiddenAccess();
        }

        $model = new UsersModel();
        return $this->json($model->change($request["id"], $request["username"], $request["email"]));

    }

    /**
     * @param $request
     * @return JSONResponse
     * @throws OperationFailed
     * @throws DBConnectionError
     * @throws ExecutionException|ForbiddenAccess
     */
    public function changePassword($request){

        if(!$this->validate()){
            throw new OperationFailed($this->validationMessage());
        }

        $auth = AuthorizationManagement::viewAuth($request["token"],"user_auth");
        if(empty($auth) || $auth["role"] != "admin"){
            throw new ForbiddenAccess();
        }

        $model = new UsersModel();
        $user = $model->findRecord($request["id"]);
        if($request["conf_password"] != $request["new_password"]) {
            throw new OperationFailed("password doesn't match!");
        }

        $model->changePassword($request["id"], $request["new_password"]);
        return $this->json($user);

    }

    /**
     * @param $request
     * @return JSONResponse
     * @throws DBConnectionError
     * @throws ExecutionException
     * @throws OperationFailed|ForbiddenAccess
     */
    function cashiers($request){

        if(!$this->validate()){
            throw new OperationFailed($this->validationMessage());
        }

        $auth = AuthorizationManagement::viewAuth($request["token"],"user_auth");
        if(empty($auth) || $auth["role"] != "admin"){
            throw new ForbiddenAccess();
        }

        $model = new UsersModel();
        return $this->json($model->allCashiers());

    }

}
?>
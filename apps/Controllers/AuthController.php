<?php
namespace Application\Controllers;

use Absoft\Line\App\Security\Auth;
use Absoft\Line\App\Security\AuthorizationManagement;
use Absoft\Line\Core\FaultHandling\Errors\DBConnectionError;
use Absoft\Line\Core\FaultHandling\Errors\ExecutionException;
use Absoft\Line\Core\FaultHandling\Errors\ForbiddenAccess;
use Absoft\Line\Core\FaultHandling\Errors\OperationFailed;
use Absoft\Line\Core\FaultHandling\FaultHandler;
use Absoft\Line\Core\HTTP\JSONResponse;
use Absoft\Line\Core\HTTP\Request;
use Absoft\Line\Core\HTTP\Response;
use Absoft\Line\Core\Modeling\Controller;

class AuthController extends Controller {

    /**
     * @param $request
     * @return string
     * @throws ForbiddenAccess
     * @throws DBConnectionError
     * @throws OperationFailed|ExecutionException
     */
    public function index($request){

        if(!$this->validate()){
            throw new OperationFailed($this->validationMessage());
        }

        $auth = Auth::Authenticate("user_auth", [$request["username"], $request["password"]]);

        if(empty($auth)) {
            throw new ForbiddenAccess();
        }

        $token = AuthorizationManagement::set($auth, "user_auth");
        $auth["token"] = $token;

        return $this->json($auth);

    }

    /**
     * @param $request
     * @return Response
     * @throws ForbiddenAccess
     */
    public function authorization($request){

        $saved = AuthorizationManagement::getAuth($request["token"], "user_auth");
        if(empty($saved)) {
            throw new ForbiddenAccess();
        }

        return $this->json($saved);

    }

    /**
     * @param $request
     * @return JSONResponse|Response|void
     * @throws OperationFailed
     */
    public function logout($request) {

        if(!AuthorizationManagement::delete($request["token"], "user_auth")) {
            throw new OperationFailed("Logout Failed");
        }

        return $this->respond([], 1);

    }

}
?>

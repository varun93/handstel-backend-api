<?php
require_once dirname(__FILE__) . '/bootstrap.php';
require_once dirname(__FILE__) . '/Utils/Constants.php';

use API\Middleware\TokenOverBasicAuth;
use API\Exception;
use Utils\StandardResponse;
use API\Exception\ValidationException;

$app->post('/signup',"\HandstelAPI:signup");
$app->post('/login',"\HandstelAPI:login");
$app->get('/getMyGroups/:user_id',"\HandstelAPI:getMyGroups");
$app->get('/discoverGroups/:user_id',"\HandstelAPI:discoverGroups");
$app->post('/createGroup/:group_name',"\HandstelAPI:createGroup");
$app->post('/addUserGroup',"\HandstelAPI:addUserGroup");
$app->post('/getUsers/:user_id',"\HandstelAPI:getUsers");
$app->post('/editProfile/:user_id',"\HandstelAPI:editProfile");
$app->get('/getUserProfile/:user_id',"\HandstelAPI:getUserProfile");
$app->post('/getChatWindowPics',"\HandstelAPI:getChatWindowPics");
$app->post('/joinGroup/:user_id/:group_id',"\HandstelAPI:joinGroup");
$app->get('/getNotifications/:user_id',"\HandstelAPI:getNotifications");
$app->get('/getSchoolList',"\HandstelAPI:getSchoolList");
$app->post('/editProfile/:user_id',"\HandstelAPI:editProfile");
$app->get('/getUserProfile/:user_id',"\HandstelAPI:getUserProfile");
$app->post('/leaveGroup/:user_id/:group_id',"\HandstelAPI:leaveGroup");
$app->get('/getContacts/:user_id',"\HandstelAPI:getContacts");
$app->get('/getUserSubscriptions/:user_id',"\HandstelAPI:getUserSubscriptions");
$app->get('/getSchoolGroups/:school_id',"\HandstelAPI:getSchoolGroups");
$app->get('/getSchoolNotifications/:user_id',"\HandstelAPI:getSchoolNotifications");
$app->post('/pushSchoolNotification',"\HandstelAPI:pushSchoolNotification");
$app->post('/offlineChat',"\HandstelAPI:offlineChat");
$app->post('/inviteMember/:user_id/:group_id',"\HandstelAPI:inviteMember");
$app->post('/logout/:user_id',"\HandstelAPI:logout");
$app->post('/pushNotificationKeys',"\HandstelAPI:pushNotificationKeys");


// JSON friendly errors
// NOTE: debug must be false
// or default error template will be printed
$app->error(function(\Exception $e) use ($app) {
    
        global $app;    
        $res = $app->response();

        $error = array(
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
         'file' => $e->getFile(),
        'line' => $e->getLine()

       
     );


         // Custom error data (e.g. Validations)
    if (method_exists($e, 'getData')) 
    {
        $errors = $e->getData();
    }

    if (!empty($errors)) {
        $error['errors'] = $errors;
    }

            
     echo json_encode(new StandardResponse(FAILURE,$res->status(200),$error));
     return;
    
});

/// Custom 404 error
$app->notFound(function () use ($app) {
    global $app;
    $res = $app->response();
    
    echo json_encode(new StandardResponse(FAILURE,$res->status(404),array('code' => 404,'message' => 'Not found')));
    return;
});


$app->run();

?>

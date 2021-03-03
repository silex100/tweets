<?php
/**
 * Projet Tweet
 * 
 * PHP version 7.4.5
 * 
 * @category App
 * @package  App
 * @author   Christian Shungu <christianshungu@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/silex100
 * @version: 1
 * @date     03/03/2021
 * @file     bootstrap/app.php
 */
$param = require_once APP_ROOT."/config/params.inc";
require_once APP_ROOT.DIRECTORY_SEPARATOR."core/autoload.php";

use App\Router\Router;
use App\Model\Tweet;

$router = new Router($_GET['url']);

$router->get('/', function() {
    var_dump($GLOBALS['param']);
});

$router->get('/events', function() {
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    $response = [];
    $tweet = new Tweet;
    $result = $tweet->findAll();
    if (!empty($result)) {
            $response = $result;
            http_response_code(200);
    } else {
        http_response_code(404);
        $response = [
            'status' => 200,
            'msg' => "Aucun tweet trouve.",
        ];  
    }
    echo json_encode($response);
});

$router->post('/events', function() {

    $data = json_decode(file_get_contents("php://input"));
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");

    $tweet = new Tweet;
    $tweet->tweet_nom = $data->nom;
    $tweet->tweet_message = $data->message;
    $tweet->tweet_tags = is_array($data->hashtags)? explode(',', $data->hashtags) : $data->hashtags ;
    $tweet->tweet_creation ="2021-03-03";
    $id = $tweet->save();
    if ($id) {
        http_response_code(201);
        $response = [
            'status' => 200,
            'msg' => "Tweet a été ajouté avec succès",
            'id' => $id
        ]; 
    } else {
    
        http_response_code(400);
        $msg = "Impossible d'ajouter le tweet. ";
        $msg.= "Les données sont incomplètes ";
        $response = [
            'status' => 400,
            'msg' => $msg,
            'id' => ""
        ];
    }
    echo json_encode($response);
});


$router->get('/events/:nom', function($nom){
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET"); 
    
    $tweet = new Tweet;
    $result = $tweet->findByName($nom);
    $response = "";
    
    if ($result->tweet_id) {
            http_response_code(200);
            $response = $result;
    } else {
        http_response_code(404);
        $response = [
            "status" =>"404",
            "msg" => "Cet utilisateur n'existe pas."
        ];
    }
    echo json_encode($result); 
});

$router->run();
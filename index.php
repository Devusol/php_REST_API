<?php
require __DIR__ . "/inc/bootstrap.php";
// echo "test";
// unable to index with request_uri
if (isset($_SERVER['REQUEST_URI'])) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );
    
    if ((isset($uri[2]) && $uri[2] != 'users') || !isset($uri[3])) {
        header("HTTP/1.1 404 Not Found"); // this causes the error, since headers are sent after the html is sent to the client
        // echo "not found; isNull: " . var_export(!isset($uri[2]), true); // instead, echo, which inserts a string (as html (can be an HTML element)) into the html of the page
        exit();
    }
    
    require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
    
    $objFeedController = new UserController();
    $strMethodName = $uri[3] . 'Action';
    $objFeedController->{$strMethodName}();
}

echo "no request uri";

?>
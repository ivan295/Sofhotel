<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Seguridad Web | Error</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>Acceso no permitido </h1>
		<?php

switch($_SERVER["REDIRECT_STATUS"]){
    case 400:
        $title = "400 Bad Request";
        $description = "The request can not be processed due to bad syntax";
    break;

    case 401:
        $title = "401 Unauthorized";
        $description = "The request has failed authentication";
    break;

    case 403:
        $title = "403 Forbidden";
        $description = "The server refuses to response to the request";
    break;

    case 404:
        $title = "404 Not Found";
        $description = "The resource requested can not be found.";
    break;

    case 500:
        $title = "500 Internal Server Error";
        $description = "There was an error which doesn't fit any other error message";
    break;

    case 502:
        $title = "502 Bad Gateway";
        $description = "The server was acting as a proxy and received a bad request.";
    break;

    case 504:
        $title = "504 Gateway Timeout";
        $description = "The server was acting as a proxy and the request timed out.";
    break;
}
?>
</body>
</html>
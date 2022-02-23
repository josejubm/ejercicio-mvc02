<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1> modelo mvc </h1>

<?php

require_once("config/config.php");

$url=!empty($_GET['url'])? $_GET['url']: 'home/home';
$arrUrl=explode("/",$url);
$controller=$arrUrl[0];
$method=$arrUrl[0];
$params="";

if(!empty($arrUrl[1]))
{
    if($arrUrl[1] !="")
    {
        $method=$arrUrl[1];

    }
}

if(!empty($arrUrl[2]))
{
    if($arrUrl[2] !="")
    {
        for($i=2; $i<count($arrUrl); $i++ )
        {
         $params.= $arrUrl[$i].',';   
        }
        
    }

    //echo $params;
}


spl_autoload_register(function($class){
    if(file_exists(LIBS.'core/'.$class.".php")){
        require_once(LIBS.'core/'.$class.".php");
    };
});


$controllerFile="controllers/".$controller.".php";
if(file_exists($controllerFile)){

    require_once($controllerFile);

    $controller=new $controller();
    if (method_exists($controller, $method)){
        $controller->{$method}($params);
    }else{
        echo "no existe el metodo";
    }
    }else{
        echo "no existe el controlador";
    }




//echo "<br>";
//echo "controlador: ".$controller;
//echo "<br>";
//echo "metodo: ".$method;
//echo "<br>";
//echo "parametros: ".$params;
//echo "<br>";

?>


</body>
</html>
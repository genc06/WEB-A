<?php 
function  getParam()
{

    require_once("./conn.php");
    $db = conn();
    $sql = $db->prepare("select * from PARAMETRE");
    $sql->execute();
    $param = $sql->fetchAll();
    $params = $param[0];
    return $params;
}

?>
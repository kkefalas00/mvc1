<?php



include "config.php";
include "model/Users.php";
include "model/Content.php";


$u1=User::find_DB_using_id(2);

$u=new Content();
$u->setContent(0,'image','Corfu','Pictures from Corfu','img');
$u->deleteCont_from_DB();
var_dump($u);

?>
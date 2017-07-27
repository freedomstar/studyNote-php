<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/4/8
 * Time: 上午11:15
 */
include "../Service/noteService.php";

$noteService=new noteService();
echo json_encode(array('data'=>$noteService->getTopCategory(),'token'=>' '));
?>
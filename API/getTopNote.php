<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/23
 * Time: 上午11:40
 */
include "../Service/noteService.php";
$page=$_POST['page'];

$noteService=new noteService();
echo json_encode(array('data'=>$noteService->getTopNote($page),'token'=>' '));
?>
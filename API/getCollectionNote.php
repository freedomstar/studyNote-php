<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/noteService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/25
 * Time: 上午10:52
 */
$user_id=$_POST['user_id'];
$page=$_POST['page'];
$noteService=new noteService();
$noteList=$noteService->getCollectionNote($user_id,$page);
echo json_encode(array('data'=>$noteList,'token'=>' '));
?>
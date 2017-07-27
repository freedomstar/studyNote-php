<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/21
 * Time: 下午4:11
 */
include "../Service/noteService.php";
$user_id=$_POST['user_id'];
$page=$_POST['page'];
$noteService=new noteService();
echo json_encode(array('data'=>$noteService->getNotesByUserID($user_id,$page),'token'=>' '));
?>
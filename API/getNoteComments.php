<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/noteService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/25
 * Time: 上午11:20
 */
$note_id=$_POST['note_id'];
$page=$_POST['page'];
$user_id=$_POST['user_id'];
$noteService=new noteService();
echo json_encode(array('data'=>$noteService->getNoteComments($note_id,$user_id,$page),'token'=>' '));
?>
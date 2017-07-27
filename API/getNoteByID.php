<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/21
 * Time: 下午2:50
 */
include "../Service/noteService.php";

$note_id=$_POST['note_id'];
$user_id=$_POST['user_id'];
$noteService=new noteService();
$note=$noteService->getNoteByID($note_id);
$note['isLike']=$noteService->isLikeNote($note_id,$user_id);
$note['isCollection']=$noteService->isCollection($note_id,$user_id);
echo urldecode(json_encode(array('data'=>$note,'token'=>' ')));
?>
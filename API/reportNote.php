<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/25
 * Time: 上午11:08
 */
include "../Service/noteService.php";

$note_id=$_POST['note_id'];
$user_id=$_POST['user_id'];
$content=$_POST['content'];
$noteService=new noteService();
echo json_encode(array ('state'=>$noteService->reportNote($note_id,$user_id,$content),'token'=>' '));
?>
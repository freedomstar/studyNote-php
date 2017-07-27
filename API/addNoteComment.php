<?php
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/25
 * Time: 上午11:50
 */
header("Content-type:text/json; charset=UTF-8");
include "../Service/noteService.php";
$content=$_POST['content'];
$note_id=$_POST['note_id'];
$user_id=$_POST['user_id'];

$noteService=new noteService();
echo json_encode(array ('state'=>$noteService->addNoteComment($content,$note_id,$user_id),'token'=>' '));
?>
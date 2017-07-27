<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/noteService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/25
 * Time: 上午11:59
 */
$note_comment_id=$_POST['note_comment_id'];
$noteService=new noteService();
echo json_encode(array ('state'=>$noteService->deleteNoteComment($note_comment_id),'token'=>' '));
?>
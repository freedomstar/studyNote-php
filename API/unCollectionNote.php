<?php
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/23
 * Time: 下午12:02
 */
header("Content-type:text/json; charset=UTF-8");

include "../Service/noteService.php";
$user_id=$_POST['user_id'];
$note_id=$_POST['note_id'];
$noteService=new noteService();
echo json_encode(array ('state'=>$noteService->unCollectionNote($user_id,$note_id),'token'=>' '));
?>
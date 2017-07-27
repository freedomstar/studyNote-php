<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/23
 * Time: 上午11:24
 */

include "../Service/noteService.php";


$user_id=$_POST['user_id'];
$note_id=$_POST['note_id'];
$noteService=new noteService();
echo  json_encode(array ('state'=>$noteService->likeNote($note_id,$user_id),'token'=>' '));
?>
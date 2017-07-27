<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/21
 * Time: 下午5:13
 */

include "../Service/noteService.php";


$note_id=$_POST['note_id'];

$noteService=new noteService();
echo json_encode(array ('state'=>$noteService->deleteNote($note_id),'token'=>' '));

?>
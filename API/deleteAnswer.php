<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/31
 * Time: 下午12:42
 */
include "../Service/answerService.php";


$answer_id=$_POST['answer_id'];
$answerService=new answerService();
echo json_encode(array ('state'=>$answerService->deleteAnswer($answer_id),'token'=>' '));
?>

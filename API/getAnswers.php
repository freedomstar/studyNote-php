<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/answerService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/30
 * Time: 上午8:52
 */

$answer_id=$_POST['answer_id'];
$user_id=$_POST['user_id'];
$answerService=new answerService();
echo json_encode(array('data'=>$answerService->getAnswer($answer_id,$user_id),'token'=>' '));
?>



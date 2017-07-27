<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/answerService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/31
 * Time: 下午1:28
 */
$page=$_POST['page'];
$answer_id=$_POST['answer_id'];
$user_id=$_POST['user_id'];
$answerService=new answerService();
echo json_encode(array('data'=>$answerService->getAnswerComments($answer_id,$page,$user_id),'token'=>' '));
?>
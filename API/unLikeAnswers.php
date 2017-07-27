<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/answerService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/31
 * Time: 下午12:53
 */
$answer_id=$_POST['answer_id'];
$user_id=$_POST['user_id'];
$answerService=new answerService();
echo json_encode(array('state'=>$answerService->unLikeAnswers($answer_id,$user_id),'token'=>' '));
?>
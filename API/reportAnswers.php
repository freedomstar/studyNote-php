<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/31
 * Time: 下午1:00
 */
include "../Service/answerService.php";

$answer_id=$_POST['answer_id'];
$user_id=$_POST['user_id'];
$content=$_POST['content'];
$answerService=new answerService();
echo json_encode(array('state'=>$answerService->reportAnswers($answer_id,$user_id,$content),'token'=>' '));
?>
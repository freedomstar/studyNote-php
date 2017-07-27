<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/29
 * Time: 上午11:51
 */
include "../Service/questionService.php";

$question_id=$_POST['question_id'];
$user_id=$_POST['user_id'];
$content=$_POST['content'];

$questionService=new questionService();
echo json_encode(array('state'=>$questionService->reportQuestions($question_id,$user_id,$content),'token'=>' '));

?>
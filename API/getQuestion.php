<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/questionService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/30
 * Time: 上午8:56
 */
$question_id=$_POST['question_id'];

$questionService=new questionService();
echo json_encode(array('data'=>$questionService->getQuestion($question_id),'token'=>' '));
?>
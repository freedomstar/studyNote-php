<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/29
 * Time: 上午11:44
 */
include "../Service/questionService.php";

$question_id=$_POST['question_id'];
$questionService=new questionService();
echo json_encode(array ('state'=>$questionService->deleteQuestions($question_id),'token'=>' '));
?>
<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/29
 * Time: 上午11:23
 */
include "../Service/questionService.php";

$introduction=$_POST['introduction'];
$question_id=$_POST['question_id'];
$content=$_POST['content'];
$education_id=$_POST['education_id'];
$title=$_POST['title'];
$cover=$_POST['cover'];
$questionService=new questionService();
echo json_encode(array('state'=>$questionService->updateQuestions($question_id,$content,$education_id,$title,$introduction,$cover),'token'=>' '));

?>

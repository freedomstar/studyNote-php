<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/answerService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/30
 * Time: 上午9:39
 */

$question_id=$_POST['question_id'];
$page=$_POST['page'];
$answerService=new answerService();
echo json_encode(array('data'=>$answerService->getAnswersByQuestionID($question_id,$page),'token'=>' '));
?>

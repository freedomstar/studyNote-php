<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/answerService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/30
 * Time: 上午9:45
 */
$question_id=$_POST['question_id'];
$content=$_POST['content'];
$answerer_id=$_POST['answerer_id'];
$introduction=$_POST['introduction'];
$cover=$_POST['cover'];
$answerService=new answerService();
echo json_encode(array('state'=>$answerService->addAnswer($question_id,$content,$answerer_id,$introduction,$cover),'token'=>' '));
?>


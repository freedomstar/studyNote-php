<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/answerService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/4/9
 * Time: 上午11:33
 */
$page=$_POST['page'];
$answerService=new answerService();
echo json_encode(array('data'=>$answerService->getTopAnswer($page),'token'=>' '));
?>
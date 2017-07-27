<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/questionService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/26
 * Time: 下午4:12
 */
$key=$_POST['keyWord'];
$page=$_POST['page'];
$order=$_POST['order'];
$finshed=$_POST['finshed'];
$education=$_POST['education'];
$questionService=new questionService();
echo json_encode(array('data'=>$questionService->searchQuestion($key,$page,$order,$finshed,$education),'token'=>' '));
?>
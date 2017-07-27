<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/23
 * Time: 上午11:13
 */
include "../Service/noteService.php";

$key=$_POST['keyWord'];
$page=$_POST['page'];
$order=$_POST['order'];
$education=$_POST['education'];
$noteService=new noteService();
echo json_encode(array('data'=>$noteService->searchnote($key,$page,$order,$education),'token'=>' '));
?>
<?php
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/31
 * Time: 下午4:22
 */
header("Content-type:text/json; charset=UTF-8");


//注意设置目录读写权限
//$pathPrefix="http://127.0.0.1/php/studynote";
$pathPrefix="http://192.168.2.1/php/studynote";
if (($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/pjpeg"))
// && ($_FILES["file"]["size"] < 20000)) // 小于20k
{
    if ($_FILES["file"]["error"] > 0) {
        echo $_FILES["file"]["error"]; // 错误代码
    } else
        {
            $user_id=$_POST['user_id'];
            $fillname = $_FILES['file']['name']; // 得到文件全名
            $dotArray = explode('.', $fillname); // 以.分割字符串，得到数组
            $type = end($dotArray); // 得到最后一个元素：文件后缀

            if (!file_exists("../photo/$user_id"))
            {
                mkdir ("../photo/$user_id");
            }
            $path = "../photo/$user_id/".md5(uniqid(rand())).'.'.$type; // 产生随机唯一的名字

            move_uploaded_file( // 从临时目录复制到目标目录
                $_FILES["file"]["tmp_name"], // 存储在服务器的文件的临时副本的名称
                $path);

            $urlStr=str_replace("..",$pathPrefix,$path);
            $url=array("url"=>"$urlStr",'token'=>' ');

            echo json_encode($url);
        }
}
else
{
//   echo json_encode(array("no"));
}
?>


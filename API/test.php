<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/31
 * Time: 下午6:11
 */
?>
<html>
<body>

<form action="uploadPhoto.php" method="post"
      enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="file" id="file" />
    <br />
    <input type="submit" name="submit" value="Submit" />
    <label for="file">Filename:</label>



</form>

</body>
</html>

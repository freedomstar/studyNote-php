<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 下午1:05
 */
class answer_commentDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function release()
    {
        parent::release();
    }

    public function addAnswerComment($answer_id,$user_id,$content)
    {
        $sql="insert into answer_comment(user_id,answer_id,content) VALUES ('$user_id','$answer_id','$content')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function deleteAnswerComment($answer_comment_id)
    {
        $sql="delete from answer_comment WHERE answer_comment_id='$answer_comment_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function getAnswerComments($answer_id,$page)
    {
        $pages=$this->page($page);
        $sql="select * from answer_comment WHERE answer_id='$answer_id' $pages";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $list=array();
            while ($rs=mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                $list[]=$rs;
            }
            return $list;
        }
    }
}
?>
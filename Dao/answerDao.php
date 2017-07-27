<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 下午12:55
 */
class answerDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function release()
    {
        parent::release();
    }

    public function getAnswer($answer_id)
    {
        $sql="select * from answer WHERE answer_id='$answer_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $rs;
        }
    }

    public function getAnswersByUserID($user_id,$page)
    {
        $pages=$this->page($page);
        $sql="select * from answer WHERE answerer_id='$user_id' ORDER by create_time $pages";
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

    public function getAnswersByQuestionID($question_id,$page)
    {
        $pages=$this->page($page);
        $sql="select * from answer WHERE question_id = '$question_id' ORDER by create_time $pages";
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

    public function searchAnswersByQuestionID($question_id)
    {
        $sql="select * from answer WHERE question_id = '$question_id' ORDER by create_time";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $rs;
        }
    }


    public function addAnswer($question_id,$content,$answerer_id,$introduction,$cover)
    {
        $sql="insert into answer(question_id,content,answerer_id,introduction,cover) VALUES ('$question_id','$content','$answerer_id','$introduction','$cover')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function deleteAnswer($answer_id)
    {
        $sql="delete from answer WHERE answer_id='$answer_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function updateAnswer($answer_id,$content,$introduction,$cover)
    {
        $sql="update answer set answer_id='$answer_id',content='$content',introduction='$introduction',cover='$cover' WHERE answer_id='$answer_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function likeAnswers($answer_id,$user_id)
    {
        $sql="insert into user_like_answer(user_id,answer_id) VALUES ('$user_id','$answer_id')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function unLikeAnswers($answer_id,$user_id)
    {
        $sql="delete from user_like_answer WHERE answer_id='$answer_id' AND user_id='$user_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function reportAnswers($answer_id,$user_id,$content)
    {
        $sql="insert into be_report_answer(user_id,answer_id,content) VALUES ('$user_id','$answer_id','$content')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function getUserAnswerCount($user_id)
    {
        $sql="select count(*) from answer WHERE answerer_id='$user_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $result["count(*)"];
        }
    }

    public function addAnswerHot($answer_id,$hotCount)
    {
        $sql="update answer set hot=hot+$hotCount where answer_id = '$answer_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die();
        }
    }



    public function getTopAnswer($page)
    {
        $pages=$this->page($page);
        $sql = "select * from answer where DATE_SUB(CURDATE(), INTERVAL 100 DAY) <= date(create_time) ORDER BY hot DESC $pages";
        if ($this->_con != null) {
            $query = mysqli_query($this->_con, $sql) or die(json_encode(array('state' => 100)));
            $list = array();
            while ($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $list[] = $rs;
            }
            return $list;
        }
    }


    public function getAnswerCommentCount($answer_id)
    {
        $sql="select count(*) from answer_comment WHERE answer_id='$answer_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $result['count(*)'];
        }
    }

    public function getAnswerLikeCount($answer_id)
    {
        $sql="select count(*) from user_like_answer WHERE answer_id='$answer_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $result['count(*)'];
        }
    }

    public function isLikeAnswer($answer_id,$user_id)
    {
        $sql="select 1 from user_like_answer where answer_id = '$answer_id' AND user_id = '$user_id' limit 1";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100))) ;
            $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
            if ($rs==null){
                return false;
            }
            else
            {
                return true;
            }
        }
    }

}
?>
<?php
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/16
 * Time: 上午8:36
 */
class note_commentDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function release()
    {
        parent::release();
    }

    public function getNoteComments($note_id,$page)
    {
        $pages=$this->page($page);
        $sql="select * from note_comment WHERE note_id='$note_id' ORDER BY note_comment_id DESC $pages";
        if ($this->_con!=null)
        {
            $CommentList=array();
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            while ($rs=mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                $CommentList[]=$rs;
            }
            return $CommentList;
        }
    }

    public function addNoteComment($content,$note_id,$user_id)
    {
        $sql="insert into note_comment(content,note_id,user_id) VALUES ('$content','$note_id','$user_id')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function deleteNoteComment($note_comment_id)
    {
        $sql="delete from note_comment WHERE note_comment_id='$note_comment_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }
}
?>
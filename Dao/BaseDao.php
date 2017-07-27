<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 上午11:52
 */
class BaseDao
{
    private $daoIP="127.0.0.1";
    private $daoUsername="root";
    private $daoPassword="12081208";
    private $daoDatabase="studynote";
    protected $_con = null;
    private $pageCount=10;

    public function __construct()
    {
        if ($this->_con == null) {
            $this->_con = mysqli_connect($this->daoIP, $this->daoUsername, $this->daoPassword)or die(json_encode(array ('state'=>100)));
            if ($this->_con == FALSE) {
                echo("connect to db server failed.");
                $this->_con = null;
                return;
            }
            @mysqli_select_db($this->_con,$this->daoDatabase) or die(json_encode(array ('state'=>100)));
            mysqli_query($this->_con,"SET NAMES utf8");
        }
    }

    public function release()
    {
        mysqli_close($this->_con) or die(json_encode(array ('state'=>100)));
    }

    protected function page($page)
    {
        $lastCount=$this->pageCount*$page;
        $count=$this->pageCount*($page-1);
        return "LIMIT $count,$lastCount";
    }

}
?>
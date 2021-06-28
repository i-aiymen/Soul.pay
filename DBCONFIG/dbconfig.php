<?php

    class DATABASE_CONNECT
    {
        public $connect = array();

        public function __construct()
        {
            $this->connect[0] = "remotemysql.com";
            $this->connect[1] = "B5zVo366oe";
            $this->connect[2] = "VvjCYtf2y0";
            $this->connect[3] = "B5zVo366oe";
        }

        public function __destruct()
        {
            $this->connect[0] = null;
            $this->connect[1] = null;
            $this->connect[2] = null;
            $this->connect[3] = null;
        }
    }

?>



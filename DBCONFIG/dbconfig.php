<?php

    class DATABASE_CONNECT
    {
        public $connect = array();

        public function __construct()
        {
            $this->connect[0] = "127.0.0.1";
            $this->connect[1] = "root";
            $this->connect[2] = "almaas03";
            $this->connect[3] = "banking";
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



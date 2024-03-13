<?php
    require_once "./api/ApiView.php";
    abstract Class ApiController{

        protected  $apiView;
        protected  $model;
        private $data;
        public function __construct(){
            $this->apiView = new ApiView();
            $this->data = file_get_contents("php://input");
        }

        function getData(){
            return json_decode($this->data);
        }


    }
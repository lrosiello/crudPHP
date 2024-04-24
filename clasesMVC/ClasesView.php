<?php 

    Class ClasesView{

   
        public function __construct(){

        }


        public function showClases($clases){
            foreach ($clases as $key => $clase) {
                echo "< " . $clase->nombre . "_" . $clase->id . "> ";
            };
        }

        public function showNoHayClases(){
            echo 'no hay clases para mostrar';
        }

        public function showClaseById($clase){
            echo  $clase->nombre;
        }

        public function showMessage($message){
            echo $message;
        }
    }
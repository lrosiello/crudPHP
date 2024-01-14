<?php

echo ("hola");
    function isNotSetted($input){
        if (!isset($_POST[$input]) || empty($_POST[$input])){
            echo("no has ingresado ningun nombre, proceso abortado");
            return;
        }
    }



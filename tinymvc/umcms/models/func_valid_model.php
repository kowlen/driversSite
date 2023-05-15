<?php
    class Func_valid_Model extends TinyMVC_Model
    {

        function valid_login($data){
            if (!preg_match("/^[A-Za-z0-9][A-Za-z0-9-_.\ ]+[A-Za-z0-9]$/is", $data))
            return "0";
        else
            return "1";
        }

        function valid_sort_rows($data){
            //if (!preg_match("/^[A-Z\,\_]+$/is", $data))
            if (!preg_match("/^[A-Z0-9\,\_]+$/is", $data))
            return "0";
        else
            return "1";
        }

    }
?>
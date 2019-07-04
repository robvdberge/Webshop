<?php

// Format class
class Format{

        public function validate($data){

            $data = trim(stripcslashes(htmlspecialchars($data)));
            return $data;
        }
}
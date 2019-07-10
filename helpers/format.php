<?php

// Format class
class Format{

    public function textShorten($text, $limit = 400){
        $text = htmlspecialchars_decode($text);
        if ( strlen( $text ) >= $limit ){
        $text = $text . "";
        $text = substr($text, 0, $limit);
        $text = $text . "...";
        return $text;
        } else { 
            return $text;
        };
    }

    public function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
       }
}
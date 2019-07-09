<?php

// Format class
class Format{

    public function textShorten($text, $limit = 400){
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
        $data = trim(stripcslashes(htmlspecialchars($data)));
        return $data;
       }
}
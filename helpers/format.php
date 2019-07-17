<?php
// validate input, shorten strings, give orderstatus
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

    public function datumFormat($date)
    {
        return date('j F Y,g:i a', strtotime($date));
        // Format : Dag Maand Jaar , Uur : Minuut AM/PM
    }

    public function getStatus($nr)
    {
        switch ($nr) {
            case '0':
                return 'In behandeling';
                break;
            case '1':
                return 'Verzonden';
                break;
            case '2':
                return 'Aangekomen';
                break;
            default:
                return 'In behandeling';
                break;
            }
    }
}

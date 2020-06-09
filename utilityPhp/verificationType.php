<?php

class verificationType
{
    public static function isseter($tbl) : bool
    {
        $retour = true;
        foreach ($tbl as $i)
        {
            if(!isset($i))
            {
                $retour = false;
            }
        }
        return $retour;
    }
    
    public static function emptyer($tbl) : bool
    {
        $retour = true;
        foreach ($tbl as $i)
        {
            if(empty($i))
            {
                $retour = false;
            }
        }
        return $retour;
    }
    
    public static function password($data) : bool
    {
        return (preg_match("/^(?=.{8,16}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)\S*$/", $data));
    }
    
    public static function simpleText($data) : bool
    {
        return (preg_match("/^(?=.{1,32}$)(?=.*\S).*$/", $data));
    }
}

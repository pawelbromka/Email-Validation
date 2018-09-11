<?php

namespace App\Service;

class EmailValidator
{
    public function check($email)
    {
        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email))
            return false;
        
        $login = explode('@', $email)[0];
        
        if (strlen($login) < 2) 
            return false;            
            
        if (is_numeric($login)) 
            return false;            
        
        return true;
    }
}
<?php

class User {

    private $db;

    private $id;
    private $rights;
    private $l_name;
    private $f_name;
    private $password;
    private $email;
    private $date;


    public function __construct($db)
    {
        $this->db = $db;
    }


    /*\ GETTERS */
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->l_name;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->f_name;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return timestamp
     */
    public function getDate()
    {
        return $this->date;
    }


    /*\SETTERS */
    /**
     * @param $rights
     * @return int
     */
    public function setRights($rights)
    {
        $rights = intval($rights);
        $this->rights = $rights;
    }

    /**
     * @param $lastName
     * @return bool
     * @throws Exception
     */
    public function setLastName($lastName)
    {
        if(strlen($lastName) >= 3  && strlen($lastName) <= 63 )
        {
            if (preg_match("#[a-zA-Z0-9]+[ -_']*$#", $lastName))
            {
                $this ->l_name = $lastName;
                return true;
            }
            else
            {
                throw new Exception('Last name not valid');
            }
        }
        else
        {
            throw new Exception('Length last name errors');
        }
    }

    /**
     * @param $firstName
     * @return bool
     * @throws Exception
     */
    public function setFirstName($firstName)
    {
        if(strlen($firstName) >= 3  && strlen($firstName) <= 63 )
        {
            if (preg_match("#[a-zA-Z0-9]+[ -_']*$#", $firstName))
            {
                $this ->f_name = $firstName;
                return true;
            }
            else
            {
                throw new Exception('First name format not valid');
            }
        }
        else
        {
            throw new Exception('Length first name errors');
        }
    }

    /**
     * @param $password
     * @param $passwordRepeat
     * @return bool
     * @throws Exception
     */
    public function setPassword($password, $passwordRepeat)
    {
        if (strlen($password) > 7 && strlen($password) < 64)
        {
            if ($password == $passwordRepeat)
            {
                $this ->password = password_hash($password, PASSWORD_DEFAULT);
                return true;
            }
            else
            {
                throw new Exception("Passwords don't match");
            }
        }
        else
        {
            throw new Exception('Password must be between 8 and 31 characters');
        }
    }

    /**
     * @param $email
     * @return bool
     * @throws Exception
     */
    public function setEmail($email, $emailRepeat)
    {
        if (strlen($email) > 5 && strlen($email) < 127)
        {
            if (preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,5}$#", $email))
            {
                if($email == $emailRepeat)
                {
                    $this ->email = $email;
                    return true;
                }
                else
                {
                    throw new Exception('Email repeat not right');
                }
            }
            else
            {
                throw new Exception('Email format invalid');
            }
        }
        else
        {
            throw new Exception('Email format invalid');
        }
    }

    /**
     * @param $date
     * @return bool
     * @throws Exception
     */
    public function setDate($date)
    {
        if (!is_nan($date))
        {
            $this -> date = $date;
            return true;
        }
        else
        {
            throw new Exception('Format needs to be a timestamp');
        }
    }

    /**
     * @param $password
     * @return bool
     * @throws Exception
     */
    public function verifPassword($password)
    {
        if($retour = password_verify($password, $this->password))
        {
            return true;
        }
        else
        {
            throw new Exception('Incorrect password');
        }
    }





}
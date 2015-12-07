<?php

class User {

    private $id;
    private $rights;
    private $l_name;
    private $f_name;
    private $password;
    private $email;
    private $date;



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
    public function getPassword()
    {
        return $this->password:
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







}
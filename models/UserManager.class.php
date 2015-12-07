<?php

class UserManager {

    private $db;


    /**
     * UserManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }


    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function findById($id)
    {
        $id     = intval($id);
        $query  = "SELECT * FROM user WHERE id = ".$id;
        $data   = $this->db->query($query);

        if($data)
        {
            if($user = $data->fetchObject("User", array($this->db)))
            {
                return $user;
            }
            else
            {
                throw new Exception('Object user error');
            }
        }
        else
        {
            throw new Exception('Error db connect');
        }
    }



    /**
     * @param $lastname
     * @param $firstname
     * @param $password
     * @param $passwordRepeat
     * @param $email
     * @return array
     * @throws Exception
     */
    public function create($lastname, $firstname, $password, $passwordRepeat, $email)
    {
        $user = new User($this->db);
        try
        {
            $user->setLastName($lastname);
            $user->setFirstName($firstname);
            $user->setPassword($password, $passwordRepeat);
            $user->setEmail($email);
        }
        catch (Exception $e)
        {
            $errors[] = $e->getMessage();
            return $errors;
        }

        if(count($errors) == 0)
        {
            $lastname   = $this->db->quote($user->getLastName());
            $firstname  = $this->db->quote($user->getFirstName());
            $password   = $user->getHash();
            $email      = $this->db->quote($user->getEmail());

            $query      = '  INSERT INTO user(l_name, f_name, password, email)
                             VALUES("'.$lastname.'", "'.$firstname.'", "'.$password.'", "'.$email.'")';

            $data = $this->db->exec($query);

            if($data)
            {
                $id = $this->db->lastInsertId();
                if($id)
                {
                    try
                    {
                       return $this -> findById($id);
                    }
                    catch(Exception $e)
                    {
                        $errors[] = $e->getMessage();
                        return $errors;
                    }

                }
                else
                {
                    throw new Exception('Last insert Id error');
                }

            }
            else
            {
                throw new Exception('Insert error');
            }




        }


    }

}
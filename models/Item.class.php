<?php

class Item
{
    private $db;
    private $id;
    private $id_subcategory;
    private $subcategory;
    private $id_promo;
    private $promo;
    private $name;
    private $descr;
    private $short_descr;
    private $note;
    private $price;
    private $stock;


    public function __construct($db)
    {
        $this->db = $db;
    }


    public function getId()
    {
        return $this->id;
    }
    public function getSubcategory()
    {
        return $this->subcategory;
    }
    public function getPromo()
    {
        return $this->promo;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDescription()
    {
        return $this->descr;
    }
    public function getShortDescription()
    {
        return $this->short_descr;
    }
    public function getNote()
    {
        return $this->note;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getStock()
    {
        return $this->stock;
    }


    public function setSubcategory(Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;
        $this->id_subcategory = $subcategory->getId();
        return true;
    }

    public function setPromo(Promo $promo)
    {
        $this->promo = $promo;
        $this->id_promo = $promo->getId();
        return true;
    }

    public function setName($name)
    {
        if(is_string($name))
        {
            if(strlen(trim($name)) >  3 && strlen(trim($name)) <= 255)
            {
                $this->name = $name;
            }
            else
            {
                throw new Exception('Name length error');
            }
        }
        else
        {
            throw new Exception('Invalid format name');
        }
    }

    public function setDescription($description)
    {
        if(is_string($description))
        {
            if(strlen($description) >  3 && strlen($description) <= 255)
            {
                $this->descr = $description;
            }
            else
            {
                throw new Exception('Description length error');
            }
        }
        else
        {
            throw new Exception('Invalid format description');
        }
    }



}
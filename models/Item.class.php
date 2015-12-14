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
    private $photos = array();
    private $quantity;


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
    public function getPhotos()
    {
        return $this->photos;
    }
    public function getQuantity()
    {
        $query = "SELECT quantity FROM order WHERE id_item = ".$this->getId();
        $result = $this->db->query($query);
        if ( $result )
        {
            $quantity = $result;
            if ( ctype_digit($quantity) )
            {
                return $quantity;
            }
            else
            {
                $errors[] = "Erreur quantité.";
            }
        }
        else
        {
            $errors[] = "Catastrophe base de données.";
        }
    }



    /**
     * @param Subcategory $subcategory
     * @return bool
     */
    public function setSubcategory(Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;
        $this->id_subcategory = $subcategory->getId();
        return true;
    }

    /**
     * @param Promo $promo
     * @return bool
     */
    public function setPromo(Promo $promo)
    {
        $this->promo = $promo;
        $this->id_promo = $promo->getId();
        return true;
    }

    /**
     * @param $name
     * @return bool
     * @throws Exception
     */
    public function setName($name)
    {
        if(is_string($name))
        {
            if(strlen(trim($name)) >  3 && strlen(trim($name)) <= 255)
            {
                $this->name = $name;
                return true;
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

    /**
     * @param $description
     * @throws Exception
     * @return bool
     */
    public function setDescription($description)
    {
        if(is_string($description))
        {
            if(strlen($description) >=  3 && strlen($description) <= 2047)
            {
                $this->descr = $description;
                return true;
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

    /**
     * @param $shortdescription
     * @throws Exception
     * @return bool
     */
    public function setShortDescription($shortdescription)
    {
        if(is_string($shortdescription))
        {
            if(strlen($shortdescription) >=  3 && strlen($shortdescription) <= 511)
            {
                $this->short_descr = $shortdescription;
                return true;
            }
            else
            {
                throw new Exception('Short description length error');
            }
        }
        else
        {
            throw new Exception('Invalid format short description');
        }
    }

    /**
     * @param $note
     * @throws Exception
     * @return bool
     */
    public function setNote($note)
    {
        $note = intval($note);
        if( $note >= 0 && $note <= 5 )
        {
            $this->note = $note;
            return true;
        }
        else
        {
            throw new Exception('Invalid note');
        }
    }

    /**
     * @param $price
     * @throws Exception
     */
    public function setPrice($price)
    {
        if(is_numeric($price))
        {
            $this->price = $price;
        }
        elseif(strpos($price, ","))
        {
            $price = str_replace(",", ".", $price);
            if(is_numeric($price))
            {
                $this->price = $price;
            }
            else
            {
                throw new Exception('Invalid price format');
            }
        }
        else
        {
            throw new Exception("Invalid price format");
        }
    }

    /**
     * @param string $stock
     * @throws Exception
     */
    public function setStock($stock = "")
    {
        if($stock == "")
        {
            $this->stock = $stock;
        }
        else
        {
            $stock = intval($stock);
            if($stock >= 0 && $stock <= 9999)
            {
                $this->stock = $stock;
            }
            else
            {
                throw new Exception('Invalid format stock');
            }
        }

    }


    /**
     * @param array $photo_item
     * @throws Exception
     */
    public function setPhotos($photo_item)
    {
        if(is_array($photo_item))
        {
            $this->photos = $photo_item;
        }
        else
        {
            throw new Exception('Invalid photo item format');
        }
    }
}
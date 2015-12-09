<?php

class ItemManager
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param int $id
     * @return Object
     * @throws Exception
     */
    public function findById($id)
    {
        $id     = intval($id);
        $query  = "SELECT * FROM item WHERE id = ".$id;
        $data   = $this->db->query($query);
        if($data)
        {
            $item = $data->fetchObject("Item", array($this->db));
            return $item;
        }
        else
        {
            throw new Exception('Query error');
        }

    }

    /**
     * @param int $number : not required
     * @return Array with Object
     * @throws Exception
     */
    public function getLast($number = 0)
    {
        $number = intval($number);
        if($number == 0)
        {
            $query  = "SELECT * FROM item";
            $data   = $this->db->query($query);

            if($data)
            {
                $items = $data->fetchAll(PDO::FETCH_CLASS, "Item", array($this->db));
                if($items)
                {
                    return $items;
                }
                else
                {
                    throw new Exception("Fetch error");
                }
            }
            else
            {
                throw new Exception('Query error');
            }

        }
        else
        {
            $query  = "SELECT * FROM item LIMIT ".$number;
            $data   = $this->db->query($query);

            if($data)
            {
                $items = $data->fetchAll(PDO::FETCH_CLASS, "Item", array($this->db));
                if($items)
                {
                    return $items;
                }
                else
                {
                    throw new Exception("Fetch error");
                }
            }
            else
            {
                throw new Exception("Query error");
            }
        }
    }


    /**
     * @param Item $item
     * @return mixed
     * @throws Exception
     */
    public function findPhotosByItem(Item $item)
    {
        $id_item    = $item->getId();
        $query      = "SELECT * FROM photo_item WHERE id_item = ".$id_item;
        $data       = $this->db->query($query);
        if($data)
        {
            $photos = $data->fetchAll(PDO::FETCH_CLASS, "Item", array($this->db));
            if($photos)
            {
                return $photos;
            }
            else
            {
                throw new Exception('Fetch error');
            }
        }
        else
        {
            throw new Exception('Query error');
        }
    }


    /**
     * @param Subcategory $subcategory
     * @param $name
     * @param $descr
     * @param $short_descr
     * @param $price
     * @param $stock
     * @return array
     * @throws Exception
     */
    public function create(Subcategory $subcategory, $name, $descr, $short_descr, $price, $stock)
    {
        $errors = array();
        $item = new Item($this->db);
        try
        {
            $item->setName($name);
            $item->setDescription($descr);
            $item->setShortDescription($short_descr);
            $item->setPrice($price);
            $item->setStock($stock);
        }
        catch(Exception $e)
        {
            $errors[] = $e->getMessage();
        }

        if(count($errors) == 0)
        {
            $name               = $this->db->quote($item->getName());
            $description        = $this->db->quote($item->getDescription());
            $shortDescription   = $this->db->quote($item->getShortDescription());
            $price              = $this->db->quote($item->getPrice());
            $stock              = $this->db->quote($item->getStock());


            $query      =   "  INSERT INTO item(id_subcategory, name, descr, short_descr, price, stock)
                               VALUES(".$subcategory->getId().", ".$name.", ".$description.", ".$shortDescription.", ".$price.", ".$stock.")";
            $data   = $this->db->exec($query);

            if($data)
            {
                $id = $this->db->lastInsertId();
                if($id)
                {
                    try
                    {
                        return $this->findById($id);
                    }
                    catch (Exception $e)
                    {
                        $errors[] = $e->getMessage();
                        return $errors;
                    }
                }
                else
                {
                    throw new Exception('Last insert error');
                }
            }
            else
            {
                throw new Exception('Db error');
            }


        }
        else
        {
            return $errors;
        }
    }


    /**
     * @param Item $item
     * @return bool
     * @throws Exception
     */
    public function delete(Item $item)
    {
        if(is_object($item))
        {
            $id = $item->getId();

            $query  = "DELETE FROM item WHERE id = ".$id;
            $data   = $this->db->exec($query);
            if($data)
            {
                return true;
            }
            else
            {
                throw new Exception("Query error");
            }

        }
        else
        {
            throw new Exception("Format item is not valid");
        }
    }


}
<?php

class ItemManager
{

    private $db;


    public function __construct($db)
    {
        $this->db = $db;
    }

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
                throw new Exception('Db erro');
            }


        }
        else
        {
            return $errors;
        }
    }


}
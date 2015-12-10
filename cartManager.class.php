<?php

class CartManager
{


// ________ PROPRIETES ________
    private $database;
// ________________


// ________ CONSTRUCT ________
    public function __construct($database)
    {
        $this->database = $database;
    }
// ________________


// ________ METHODES ________
    // findById ==> user->getCart();
    /*public function findById($id)
    {
        $id = intval($id);

        $query = "SELECT * FROM cart WHERE id = ".$id;
        $result = $this->database->query($query);

        if ( $result )
        {
            $cart = $result->fetchObject("Cart", array($this->database));
            if ( $cart )
            {
                return $cart;
            }
            else
            {
                throw new Exception("Panier introuvable.");
            }
        }
        else
        {
            throw new Exception("Erreur - Base de données.");
        }
    }*/
    public function create(User $user)
    {
        $cart = new Cart($this->database);

        // if ( isset($_SESSION['id']) )
        // {
        $set = $cart->setUser($user);
        if ( $set === true )
        {
            $set = $cart->setStatus(1);
            if ( $set === true )
            {
                $idUser = intval($cart->getUser()->getId());
                $status = intval($cart->getStatus());
                $query = "INSERT INTO cart (id_user, status) VALUES (".$idUser.", ".$status.")";

                $result = $this->database->exec($query);
                if ( $result )
                {
                    $id = $this->database->lastInsertId();
                    if ( $id )
                    {
                        // return $this->findById($id);
                        return $user->getCart();
                    }
                    else
                    {
                        throw new Exception("Catastrophe serveur.");
                    }
                }
                else
                {
                    throw new Exception("Catastrophe base de données.");
                }
            }
            else
            {
                throw new Exception($set);
            }
        }
        else
        {
            throw new Exception($set);
        }
        // }
        /*
        else
        {
            $_SESSION['order'] = array();
            // $_SESSION['cart_status'] = 1;
            // if isset($_SESSION['order'])
        }*/
    }
    // addToCart => cart->addItem(Item $item, $quantity)
    /*
    if (isset($_SESSION['id']))
    {
        $currentUser->getCart()->add($item, $quantity);
    }
    else
    {
        for ( $i=0; $i<count($_SESSION['order']); $i++ )
        {
            $localItem = $_SESSION['order'][$i]['item'];
            if ( $localItem == $item->getId() )
            {
                if ( $quantity <= $item->getStock() )
                {
                    $quantity = $quantity;
                }
                else
                {
                    $quantity = $item->getStock();
                }
                $_SESSION['order'][$i]['quantity'] = $quantity;
                header();
                exit;// Success
            }
        }
        if ( $quantity <= $item->getStock() )
        {
            $quantity = $quantity;
        }
        else
        {
            $quantity = $item->getStock();
        }
        $_SESSION['order'][] = array('item'=>$item->getId(), 'quantity'=>$quantity);
        header();
        exit;// Success
    }
    */
    // $user->getCart()->update($item, 1);
    public function addToCart(User $user, Item $item, $quantity)
    {
        $idItem = intval($item->getId());

        if ( ctype_digit($quantity) )
        {
            if ( $quantity > 0 )
            {
                if ( $quantity <= $item->getStock() )
                {
                    $quantity = intval($quantity);
                }
                else
                {
                    // throw new Exception("Stocks insuffisants. Nous ajustons votre quantité.");
                    $quantity = intval($item->getStock());
                }

                if ( $quantity )
                {
                    if ( isset($_SESSION['id']) )
                    {
                        $idCart = intval($user->getCart()->getId());

                        $query = "INSERT INTO order (id_cart, id_item, quantity) VALUES (".$idCart.", ".$idItem.", ".$quantity.")";

                        $result = $this->database->exec($query);
                        if ( $result )
                        {
                            $id = $this->database->lastInsertId();
                            if ( $id )
                            {
                                return $user->getCart();
                            }
                            else
                            {
                                throw new Exception("Catastrophe serveur.");
                            }
                        }
                        else
                        {
                            throw new Exception("Catastrophe base de données.");
                        }
                    }
                }
                else
                {
                    throw new Exception("Pas de quantité, sérieusement ? ON ENVOIE AU HASARD ?");
                }
            }
            else
            {
                throw new Exception("La quantité doit être supérieure à 0, vilain violeur de poules.");
            }
        }
        else
        {
            throw new Exception("La quantité doit être un nombre, vilain lutin violeur de lapins.");
        }
    }
    public function importSession($list)
    {
        $i = 0;
        ...
        $this->getCart()->add($list[$i]['item'], $list[$i]['quantity']);
    }
$user->importSession($_SESSION['order']);
    /*
    public function logCart(User $user)
    {
        if ( $user )
        {
            if ( isset($_SESSION['cart_status']) && $_SESSION['cart_status'] == 1 )
            {
                if ( isset($_SESSION['order']) )
                {
                    $manager = new ItemManager($this->database);

                    for ( $i=0; $i<count($_SESSION['order']); $i++ )
                    {
                        $itemArray = explode(', ', $_SESSION['order'][$i]);
                        // ____ 0 : $idItem \ 1 : $quantity ____

                        $item = $manager->findById($itemArray[0]);
                        if ( $item )
                        {
                            $quantity = $itemArray[1];
                            $add = $hatis->addToCart($item, $quantity);
                        }
                        else
                        {
                            throw new Exception("Article ".$i." introuvable.");
                        }
                    }
                }
            }
        }
        else
        {
            throw new Exception("Erreur connexion utilisateur.");
        }
    }*/
// ________________


}

?>
exception.php
heritage.php
htaccess.txt
info.txt
integration.txt
pdo.php
exemple_orm.php
CartManager.class.php
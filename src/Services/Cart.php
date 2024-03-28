<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{

    private $requestStack;

    public function __construct(RequestStack $requestStack,)
    {
        $this->requestStack = $requestStack;
    }



    //ajout d'un id d'un produit

    public function add($id)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);


        //on test si le produit correspondant a l'id est vide

        if (!empty($cart[$id])) {

            $cart[$id]++;
        } else $cart[$id] = 1; //ajout d'une seule quantité




        $this->requestStack->getSession()->set('cart', $cart);
    }


    // recuperation du panier
    public function get()
    {

        return $this->requestStack->getSession()->get('cart', []);
    }

    public function remove()
    {

        return $this->requestStack->getSession()->remove('cart');
    }


    //enlever un produit

    public function delete($id)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);

        unset($cart[$id]);

        $this->requestStack->getSession()->set('cart', $cart);
    }

    //decrementer
    public function subtract($id)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]--;
            if ($cart[$id] <= 0) {
                unset($cart[$id]); // Supprimer le produit du panier si la quantité est inférieure ou égale à zéro
            }
        }

        $this->requestStack->getSession()->set('cart', $cart);
    }
}

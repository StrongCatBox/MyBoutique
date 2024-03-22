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

    public function supress($id)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);

        // Vérifier si le produit correspondant à l'ID existe dans le panier
        if (!empty($cart[$id])) {
            // Si la quantité est supérieure à 1, décrémenter la quantité
            if ($cart[$id] > 1) {
                $cart[$id]--;
            } else {
                // Si la quantité est égale à 1, supprimer l'article du panier
                unset($cart[$id]);
            }
        }

        // Mettre à jour le panier dans la session
        $this->requestStack->getSession()->set('cart', $cart);
    }
}

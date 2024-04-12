<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Stripe\StripeClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderSuccessController extends AbstractController
{
    #[Route('/compte/commande/merci/{CHECKOUT_SESSION_ID}/{reference}', name: 'order_success')]
    public function index($CHECKOUT_SESSION_ID, OrderRepository $repo, $reference): Response

    {

        dd($repo->findOneByReference($reference));
        //dd($CHECKOUT_SESSION_ID);

        $stripeSecretKey = $this->getParameter('STRIPE_KEY');

        $stripe = new StripeClient($stripeSecretKey);

        $session = $stripe->checkout->sessions->retrieve($CHECKOUT_SESSION_ID);
        // $customer = $stripe->customers->retrieve($session->customer);

        //dd($session);



        return $this->render('order_success/index.html.twig', [

            'total' => $session->amount_total


        ]);
    }
}

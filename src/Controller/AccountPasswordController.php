<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountPasswordController extends AbstractController
{
    #[Route('/compte/modifier-mot-de-passe', name: 'account_password')]
    public function index(Request $request): Response
    {
        // recupere l'utilisateur connecté
        $user = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class, $user);



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        }


        return $this->render('account/accountPassword.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

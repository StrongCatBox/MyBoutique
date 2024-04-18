<?php

namespace App\Services;

use App\Services\StripeService;
use Symfony\Component\HttpFoundation\RequestStack;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StripeService extends AbstractCrudController
{

    private $requestStack;

    public function __construct(RequestStack $requestStack,)
    {
        $this->requestStack = $requestStack;
    }

    public function get()
    {

        return $this->requestStack->get('order', []);
    }
}

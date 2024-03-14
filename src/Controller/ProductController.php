<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/nos-produits', name: 'products')]
    public function index(EntityManagerInterface $entityManager, ProductRepository $repo): Response
    {

        $products = $repo->findAll();


        // Aller chercher le produit avec l'ID 189 : 
        // $product = $entityManager->getRepository(Product::class)->find(14);

        // Aller chercher tous les produits : 
        // $product = $entityManager->getRepository(Product::class)->findAll();

        // le produit dont le sous-titre est "exercitationem praesentium voluptatibus" : 
        // $product = $entityManager->getRepository(Product::class)->findOneBySubtitle('exercitationem praesentium voluptatibus');

        // les produits qui ont un sous-titre commun : 
        // $product = $entityManager->getRepository(Product::class)->findBySubtitle('exercitationem praesentium voluptatibus');

        // Faire de la pagination (les 10 premiers produits, les 10 suivants, etc. : findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null))

        //les produits de la categorie 10 par ordre croissant 
        //$product = $entityManager->getRepository(Product::class)->findBy(['category'=>10],['price'=>'asc']);

        //dd($products);


        return $this->render('product/products.html.twig', [
            'products' => $repo->findAll()
        ]);
    }
    #[Route('/produit/{slug}', name: 'product')]
    public function produit(Product $product): Response
    {



        return $this->render('product/product.html.twig', [
            'product' => $product
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\SearchFilters;
use App\Form\SearchFiltersType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/nos-produits', name: 'products')]
    public function index(Request $request, ProductRepository $repo): Response
    {

        $products = $repo->findAll();

        $searchFilter = new SearchFilters;

        $form = $this->createForm(SearchFiltersType::class, $searchFilter);
        $form->handleRequest($request);

        // $products = [];

        if ($form->isSubmitted() && $form->isValid()) {

            // $categories = $searchFilter->getCategories();

            if (count($searchFilter->getCategories()) > 0) {


                foreach ($searchFilter->getCategories() as $categorie) {

                    $tabId[] = $categorie->getId();
                }
                $products = $repo->findByCategory($tabId);
            } else {
                $products = $repo->findAll();
            }

            //$id = $searchFilter->getCategories()->getId();

            //$products = $repo->findByCategory($id);

        } else {
            $products = $repo->findAll();
        }


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
            'products' => $products,
            'form' => $form->createView()
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

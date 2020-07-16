<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\ProductFactory;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function index()
    {
        try
        {
            $file1 = 'data/wholesaler_a.csv';
            $file2 = 'data/wholesaler_b.json';

            $product = ProductFactory::create($file1);
            $products = $product->getProducts();

            $json = $product->toJson($products);
            //$xml = $product->toXml($products);        

            return new JsonResponse($json,200,[],true);     
        } catch (Exception $ex)
        {  
            return new Response($ex->getMessage(),404);
        }
    }
}
 
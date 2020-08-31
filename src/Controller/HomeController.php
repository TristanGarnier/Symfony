<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;

class HomeController extends AbstractController {
    
    /**
     * @var Twig\Environment
     */
    private $twig;

    public function __construct(Environment $twig) {
        $twig->twig = $twig;
    }
    
    public function index(PropertyRepository $repository) :Response
    {
        $properties = $repository->findLatest();
        return $this->render($view = 'pages/home.html.twig', [
            'properties' => $properties]);
    }
}


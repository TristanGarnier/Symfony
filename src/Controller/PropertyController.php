<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use App\Entity\Property;
use Doctrine\Common\Persistence\ObjectManager;
use Cocur\Slugify\Slugify;


class PropertyController extends AbstractController
{
    private $repository;
    
    public function __construct(PropertyRepository $repository, ObjectManager $em) {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response {
        $property = $this->repository->findAllVisible();
        //dump($property);
        //$this->em->flush();
        return $this->render($view = 'property/index.html.twig',['current_menu' => 'properties']);
    }
    
    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, string $slug): Response {
        if ($property->getSlug() !== $slug){
            return $this->redirectToRoute($route ='property.show', [
                'id' =>$property->getId(),
                'slug'=> $property->getSlug()
            ],$status = 301);
        }
        return $this->render($view = 'property/show.html.twig',[
            'property' => $property,
            'current_menu' => 'properties']);
    }
}
<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController{

  /**
   * @var $repository
   */
  private $repository;

  /**
   * @var ObjectManager
   */
  private $em;

  public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
  {
    $this->repository = $repository;
    $this->em = $em;
  }
  /**
   * @Route("/biens", name="property.index")
   * @return Response
   */
  public function index(){
    return $this->render('property/index.html.twig', [
      'current_menu'=> 'properties'
    ]);
  }

  /**
   * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug":"[a-z0-9\-]*"})
   * @return Response
   */
  public function show(Property $property, string $slug){
    if($property->getSlug() !== $slug){
      return $this->redirectToRoute('property.show', [
        'id' => $property->getId(),
        'slug' => $property->getSlug()
      ], 301);
    }
    return $this->render('property/show.html.twig', [
      'property' => $property,
      'current_menu'=> 'properties'
    ]);
  }

}
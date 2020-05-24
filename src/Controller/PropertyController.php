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

}
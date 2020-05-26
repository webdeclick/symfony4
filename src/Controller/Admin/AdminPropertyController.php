<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{
  /**
   * @var PropertyRepository
   */
  private $repository;

  private $em;

  public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
  {
    $this->repository = $repository;
    $this->em = $em;
  }

  /**
   * Undocumented function
   *
   * @Route("/admin", name="admin.property.index")
   */
  public function index()
  {
    $properties = $this->repository->findAll();
    return $this->render('admin/property/index.html.twig', compact('properties'));
  }

  /**
   * @Route("/admin/property/create", name="admin.property.new")
   */
  public function new(Request $request)
  {
    $property = new Property();
    $form = $this->createForm(PropertyType::class, $property);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
      $this->em->persist($property);
      $this->em->flush();
      return $this->redirectToRoute('admin.property.index');
    }

    return $this->render('admin/property/new.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }

  /**
   *
   * @Route("/admin/property/{id}", name="admin.property.edit")
   */
  public function edit(Property $property, Request $request)
  {
    $form = $this->createForm(PropertyType::class, $property);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
      $this->em->flush();
      return $this->redirectToRoute('admin.property.index');
    }

    return $this->render('admin/property/edit.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }


}
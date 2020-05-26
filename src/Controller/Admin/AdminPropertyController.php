<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{
  /**
   * @var PropertyRepository
   */
  private $repository;

  public function __construct(PropertyRepository $repository)
  {
    $this->repository = $repository;
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
   * Undocumented function
   *
   * @Route("/admin/edit/{id}", name="admin.property.edit")
   */
  public function edit(Property $property)
  {
    return $this->render('admin/property/edit.html.twig', compact('property'));
  }


}
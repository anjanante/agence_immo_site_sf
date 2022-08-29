<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/admin", name="app_admin_property")
     */
    public function index(): Response
    {
        $properties = $this->repository->findAll();
        dump($properties);
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

    /**
     * @Route("/admin/edit-{id}", name="app_admin_property_edit")
     * @param Property $property
     * @return Response
     */
    public function edit(Property $property): Response
    {
        $form = $this->createForm(PropertyType::class, $property);

        return $this->render('admin/property/edit.html.twig', [
            'property'  => $property,
            'form'      => $form->createView()
        ]);
    }
}

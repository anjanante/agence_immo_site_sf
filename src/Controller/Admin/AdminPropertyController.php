<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     *
     * @param PropertyRepository $repository
     * @param EntityManagerInterface $em
     */
    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="app_admin_property")
     */
    public function index(): Response
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

    /**
     * @Route("/admin/property/add", name="app_admin_property_add")
     * @param Request $request
     */
    public function add(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Successfully added');
            return $this->redirectToRoute('app_admin_property');
        }

        return $this->render('admin/property/new.html.twig', [
            'property'  => $property,
            'form'      => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/edit-{id}", name="app_admin_property_edit", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function edit(Property $property, Request $request): Response
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Changed successfully');
            return $this->redirectToRoute('app_admin_property');
        }
        return $this->render('admin/property/edit.html.twig', [
            'property'  => $property,
            'form'      => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/delete-{id}", name="app_admin_property_delete", methods="DELETE")
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function delete(Property $property, Request $request)
    {
        if($this->isCsrfTokenValid('delete'.$property->getId(),$request->get('_token'))){
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'Delete successfully');
        }

        return $this->redirectToRoute('app_admin_property');
    }
}

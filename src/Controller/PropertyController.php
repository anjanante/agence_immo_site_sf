<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
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
     * @Route("/properties", name="app_properties")
     */
    public function index(): Response
    {
        $properties = $this->repository->findAllVisible();
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
        ]);
    }

    /**
     * @Route("/properties/{slug}-{id}", name="app_properties.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $property
     * @param String $slug
     * @return Response
     */
    public function show(Property $property, String $slug): Response
    {
        dump($property);
        //redirect to correct property with id even slug is modified directly
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('app_properties.show', [
                'id' =>  $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }

        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'property' => $property
        ]);
    }

    /**
     * @Route("/properties-insert", name="app_properties_insert")
     */
    public function insert()
    {
        for ($i=1;$i<=10;$i++)
        {
            $property = new Property();
            $property->setTitle('My Property N°'.$i)
                ->setPrice(rand(10000,200000))
                ->setRooms(4+$i)
                ->setBedrooms(3+$i)
                ->setDescription('Small Description for '.$i)
                ->setSurface(60+$i)
                ->setFloor(4+$i)
                ->setHeat(rand(0,1))
                ->setCity('Antananarivo '.$i)
                ->setAddress('Lot 001'.$i)
                ->setPostalCode('101'.$i);

            echo 'Save '.$i.'<br>';

            $em = $this->getDoctrine()->getManager();
            $em->persist($property);
            $em->flush();
        }

        dd('end');
    }
}

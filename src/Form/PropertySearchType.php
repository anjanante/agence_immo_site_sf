<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\PropertySearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxPrice', IntegerType::class,[
                'required'  => false,
                'label'     => false,
                'attr'      => [
                    'placeholder'   => 'Max. budget',
                ]
            ])
            ->add('minSurface', IntegerType::class,[
                'required'  => false,
                'label'     => false,
                'attr'      => [
                    'placeholder'   => 'Min. surface area',
                ]
            ])
            ->add('options', EntityType::class,[
                'required'  => false,
                'label'     => false,
                'class'     => Option::class,
                'choice_label' => 'name',
                'multiple'  => true,
                'attr'      => [
                    'placeholder'   => 'Options',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=> PropertySearch::class,
            'method'    => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBLockPrefix(){
        return '';
    }
}
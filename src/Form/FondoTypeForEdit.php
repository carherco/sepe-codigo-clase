<?php

namespace App\Form;

use App\Entity\Fondo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FondoTypeForEdit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('edicion')
            ->add('publicacion')
            ->add('categoria')
            ->add('autores')
            ->add('editorial')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fondo::class,
        ]);
    }
}

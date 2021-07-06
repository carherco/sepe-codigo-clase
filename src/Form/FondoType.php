<?php

namespace App\Form;

use App\Entity\Fondo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FondoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('isbn')
            ->add('autores', CollectionType::class, [
                'entry_type' => AutorType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
            ])
            ->add('editorial')
            ->add('edicion')
            ->add('publicacion', MoneyType::class, [
                
                'label' => 'To Be Completed Before',
            ])
            ->add('categoria')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fondo::class,
        ]);
    }
}

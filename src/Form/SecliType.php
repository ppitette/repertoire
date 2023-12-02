<?php

namespace App\Form;

use App\Entity\Secli;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecliType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('auteur')
            ->add('compositeur')
            ->add('editeur')
            ->add('fiche')
            ->add('importe')
            ->add('titre')
            ->add('annee')
            ->add('cote')
            ->add('coteNew')
            ->add('snpls')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Secli::class,
        ]);
    }
}

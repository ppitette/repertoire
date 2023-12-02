<?php

namespace App\Form;

use App\Entity\Chant;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'required' => true,
            ])
            ->add('annee', IntegerType::class, [
                'required' => false,
            ])
            ->add('cote', TextType::class, [
                'required' => true,
            ])
            ->add('coteNew', TextType::class, [
                'required' => true,
            ])
            ->add('coteEdit', TextType::class, [
                'required' => true,
            ])
            ->add('snpls', IntegerType::class, [
                'required' => false,
            ])
            ->add('source', TextType::class, [
                'required' => true,
            ])
            ->add('ordinaire', CheckboxType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('texte', CKEditorType::class)
            ->add('auteur', ArtisteAutocompleteField::class)
            ->add('compositeur', ArtisteAutocompleteField::class)
            ->add('editeur', EditeurAutocompleteField::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chant::class,
        ]);
    }
}

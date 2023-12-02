<?php

namespace App\Form;

use App\Entity\Editeur;
use App\Repository\EditeurRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
// use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class EditeurAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Editeur::class,
            'placeholder' => 'Choisissez un éditeur',
            'choice_label' => 'libSecli',

            'query_builder' => function (EditeurRepository $editeurRepository) {
                return $editeurRepository->createQueryBuilder('e')
                    ->orderBy('e.libSecli', 'ASC');
            },
            // 'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}

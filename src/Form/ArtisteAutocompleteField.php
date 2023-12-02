<?php

namespace App\Form;

use App\Entity\Artiste;
use App\Repository\ArtisteRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
// use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class ArtisteAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Artiste::class,
            'placeholder' => 'Choisissez un artiste',
            'choice_label' => 'fullname',
            'multiple' => true,
            'query_builder' => function (ArtisteRepository $artisteRepository) {
                return $artisteRepository->createQueryBuilder('a')
                    ->orderBy('a.lastname', 'ASC')
                    ->addOrderBy('a.firstname', 'ASC');
            },
            // 'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}

<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('username')
            ->add('rating', ChoiceType::class, [
                'choices' => [
                    'Liste des choix' => false,
                    'Fuyez, pauvre fou' => 1,
                    'Je déconseille' => 2,
                    'Bon produit' => 3,
                    'Trés bien' => 4,
                    'Je recommande' => 5
                ]
            ])
            ->add('commentary')
            ->add('imageFile', FileType::class, ['required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}

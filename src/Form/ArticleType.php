<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'titre de l\'article'
                ]
            ])
            ->add('introduction', TextType::class, [
                'label' => 'introduction',
                'attr' => [
                    'placeholder' => 'intro de l\'article'
                ]
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Article',

            ])
            ->add('image', UrlType::class, [
                'label' => 'Telecharger une image',
                'required' => false
            ])
            // ->add('date', DateType::class, [
            //     'widget' => 'single_text'
            // ])
            ->add('source', TextType::class, [
                'label' => 'Sources cité dans cet article',
                'attr' => [
                    'placeholder' => 'citez vos sources'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'enregistrer',
                'attr' => [
                    'class' => 'btn btn-lg btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

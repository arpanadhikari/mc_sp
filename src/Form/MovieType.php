<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Cast;
use App\Entity\Director;
use App\Entity\Genre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('releaseDate')
            ->add('revenue')
            ->add('director',EntityType::class,[
                'class'=>Director::class,
                'choice_label'=>'fullName'
            ])
            ->add('cast',EntityType::class,[
                'class'=>Cast::class,
                'choice_label'=>'fullName',
                'multiple'=>'true'
            ])
            ->add('genre',EntityType::cass,[
                'class'=>Genre::class,
                'choice_label'=>'genre',
                'multiple'=>'true'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}

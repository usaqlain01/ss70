<?php

namespace PosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PosterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('category')
            ->add('positions_count')
            ->add('location')
            ->add('is_published');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'PosterBundle\Entity\Poster'
        ]);
    }

    public function getName()
    {
        return 'poster_bundle_poster_form_type';
    }
}

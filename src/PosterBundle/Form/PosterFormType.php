<?php

namespace PosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PosterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Choose a Category that best matches your poster' => null,
                    'Sports' => 'Sports',
                    'Adventure' => 'Adventure',
                    'Activity' => 'Activity',
                    'Charity' => 'Charity',
                    'Clubs' => 'Clubs',
                    'Social Event' => 'Social Event',
                    'Open To Public' => 'Open To Public',
                    'Movement' => 'Movement',
                    'Hobby' => 'Hobby',
                    'Opportunity' => 'Opportunity',
                    'Learn/Mentor' => 'Education',
                    'Carpool' => 'Carpool'
                ]
            ])
            ->add('positions_count')
            ->add('location', null, [
                'placeholder' => 'Choose the location for your Poster'
            ])
            ->add('event_date', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
            ])
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

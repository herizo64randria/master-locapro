<?php

namespace GroupeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', TextType::class,array(
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'required',

                )
            ))
            ->add('marque', TextType::class,array(
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'required',

                )
            ))
            ->add('modele', TextType::class,array(
                'label' => 'Modèle',
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'required',

                )
            ))
            ->add('numeroSerie', TextType::class,array(
                'label' => 'Numéro de série',
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'required',

                )
            ))
            ->add('annee', TextType::class,array(
                'label' => 'Année',
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'required',

                )
            ))
            ->add('puissance', TextType::class,array(
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'required',

                )
            ))
            ->add('premierDemarrage', TextType::class,array(
                'label' => 'Heure du premier démarrage',
                'attr' => array(
                    'class' => 'form-control only_float',
                    'required',

                )
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GroupeBundle\Entity\Groupe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'groupebundle_groupe';
    }


}

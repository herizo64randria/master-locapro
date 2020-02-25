<?php

namespace ProduitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HuileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation',TextType::class,array(
                'label' => 'Désignation',
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'required',
                )
            ))
            ->add('code', TextType::class,array(
                'label' => 'Code interne',
                'attr' => array(
                    'class' => 'form-control text-primary',
                ),
                'required' => false,
            ))
            ->add('prixAchat', TextType::class,array(
                'label' => 'Prix d\'achat',
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'placeholder' => 'Facultatif'
                ),
                'required' => false,
            ))
            ->add('alert', TextType::class,array(
                'label' => 'Alert de stock',
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'placeholder' => 'Facultatif'
                ),
                'required' => false,
            ))
            ->add('note', TextareaType::class,array(
                'label' => 'Note:',
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'placeholder' => 'Facultatif',

                    ),
                'required' => false,
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProduitBundle\Entity\Huile'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'produitbundle_huile';
    }


}

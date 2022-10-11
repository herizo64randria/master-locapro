<?php

namespace ProduitBundle\Form;

use ProduitBundle\Entity\Pvsn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation', TextType::class,array(
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
            ->add('reference', TextType::class,array(
                'label' => 'Référence',
                'attr' => array(
                    'class' => 'form-control text-primary',
                ),
                'required' => false,
            ))
            ->add('refEqui', TextType::class,array(
                'label' => 'Référenece equivalente',
                'attr' => array(
                    'class' => 'form-control text-primary',
                ),
                'required' => false,
            ))
            // ->add('numeroDeSerie', TextType::class,array(
            //     'label' => 'Numéro de série',
            //     'attr' => array(
            //         'class' => 'form-control text-primary',
            //     ),
            //     'required' => false,
            // ))
            ->add('prixAchat', TextType::class,array(
                'label' => 'Prix d\'achat',
                'attr' => array(
                    'class' => 'form-control text-primary',
                ),
                'required' => false,
            ))
            ->add('prixVente', TextType::class,array(
                'label' => 'Prix de vente',
                'attr' => array(
                    'class' => 'form-control text-primary',
                ),
                'required' => false,
            ))
            ->add('alert', TextType::class,array(
                'label' => 'Alert de stock',
                'attr' => array(
                    'class' => 'form-control text-primary',
                ),
                'required' => false,
            ))
            ->add('note', TextareaType::class,array(
                'label' => 'Note',
                'attr' => array(
                    'class' => 'form-control text-primary',
                    'placeolder' => 'Facultatif'
                ),
                'required' => false,
            ))
            ->add("numeroSerie", EntityType::class, [
                "class" => Pvsn::class,
                "choice_label" => "numeroSerie",
                "label" => 'Numero de Série: ',
                'attr' => [
                    'class' => 'form-control text-primary',
                ],
                //"property" => "numeroSerie"

            ]);
  }/**
     * {@inheritdoc}
     */ 
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array( 'data_class' => 'ProduitBundle\Entity\Produit'));}

        /** * {@inheritdoc}*/
        public function getBlockPrefix()
        { return 'produitbundle_produit';}
}
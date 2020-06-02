<?php

namespace GroupeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PieceRefEqivType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('designation',TextType::class,array('attr'=>array(

            'class' => 'form-control text-primary',
            'required',),
            'label'=>'Désignation'

        ))

                ->add('marque',TextType::class,array('attr'=>array( 'class' => 'form-control text-primary',
                    'required',),
                    'label'=>'Référence'
                ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GroupeBundle\Entity\PieceRefEqiv'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'groupebundle_piecerefeqiv';
    }


}

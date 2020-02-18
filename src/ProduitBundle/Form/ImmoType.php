<?php

namespace ProduitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImmoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class,array(
                'label'=>'Code Immo',
                'attr'=>array(
                    'class'=>'form-control text-primary',

                ),
                'required'=>true,
            ))
            ->add('designation', TextType::class,array(
                'label'=>'Désignation',
                'attr'=>array(
                    'class'=>'form-control text-primary',

                ),
                'required'=>true,
            ))

            ->add('reference', TextType::class,array(
                'label'=>'Référence',
                'attr'=>array(
                    'class'=>'form-control text-primary',

                ),
                'required'=>true,
            ))

            ->add('note', TextareaType::class,array(
                'label'=>'Note:',
                'attr'=>array(
                    'class'=>'form-control text-primary',
                    'rows' => 4
                ),
                'required'=>true,
            ))
        ;

        $builder->get('note')->setRequired(false);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProduitBundle\Entity\Immo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'produitbundle_immo';
    }


}

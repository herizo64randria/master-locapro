<?php

namespace FournisseurBundle\Form;

use Symfony\Component\DomCrawler\Tests\Field\ChoiceFormFieldTest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\View\ChoiceListView;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class FournisseurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array(
                'label'=>'Nom du fournisseur',
                'attr'=>array(
                    'class'=>'form-control text-primary',

                ),
            ))
            ->add('adresse', TextType::class,array(
            'label' => 'Adresse',
            'attr' => array(
                'class' => 'form-control text-primary'
                 ),

             ))
            ->add('contact', TextType::class,array(
                'label' => 'Contact',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control text-primary',

                ),

            ))

            ->add('nif', TextType::class,array(
                'label' => 'NIF',
                'attr' => array(
                    'class' => 'form-control text-primary',
                ),
                'required' => false,
            ))
            ->add('stat', TextType::class,array(
                'label' => 'STAT',
                'attr' => array(
                    'class' => 'form-control text-primary'
                ),
                'required' => false,
            ));




    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FournisseurBundle\Entity\Fournisseur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fournisseurbundle_fournisseur';
    }


}

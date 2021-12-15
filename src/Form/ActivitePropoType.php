<?php

namespace App\Form;

use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class ActivitePropoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('duree',TextType::class)
        //  ->add('date',\Symfony\Component\Form\Extension\Core\Type\DateType::class)

        ->add('date', null, [
            'label' => 'Date',
            'required' => false,
            'widget' => 'single_text',

        ])

            ->add('nombremax')
            ->add('type')
            ->add('description')
            ->add('lieu')



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

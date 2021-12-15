<?php

namespace App\Form;

use App\Entity\Entraide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntraideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question')
            ->add('categorie')

            ->add('date', null, [
                'label' => 'Date ',
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('email')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entraide::class,
        ]);
    }
}

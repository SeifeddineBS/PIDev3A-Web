<?php


namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Activite;
use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchForm extends AbstractType
{
 public function buildForm(FormBuilderInterface $builder, array $options)
 {
     $builder
         ->add('lieu', TextType::class, [
             'label' => false,
             'required' => false,
             'attr' => [
                 'placeholder' => 'lieu'
             ]
         ])
         ->add('description', TextType::class, [
             'label' => false,
             'required' => false,
             'attr' => [
                 'placeholder' => 'description'
             ]
         ])
         ->add('nombremax', NumberType::class, [
             'label' => false,
             'required' => false,
             'attr' => [
                 'placeholder' => 'nombremax'
             ]
         ])

     ;
        }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
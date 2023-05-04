<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangeImageWordType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('id', HiddenType::class)
                ->add('oldName', HiddenType::class)
                ->add('image', FileType::class, [
                        'mapped' => false,
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Form;

use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Gender;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Level;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;

class CreateWordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $genders = [];
        foreach (Gender::validValues() as $gender) {
            $genders[$gender] = $gender;
        }

        $levels = [];
        foreach (Level::validValues() as $level) {
            $levels[$level] = $level;
        }

        $builder->add('gender', ChoiceType::class, [
                        'choices' => $genders,
                        'attr' => ['class' => 'form-control  ']
                ])
                ->add('word',TextType::class, ['attr' => ['class' => 'form-control  ']])
                ->add('level', ChoiceType::class, [
                    'choices' => $levels,
                    'attr' => ['class' => 'form-control  ']
                ])
                ->add('category', EntityType::class,[
                    'class' => Category::class,
                    'placeholder' => 'Select a category...',
                    'choice_label'  => function (Category $category) {
                        return $category->name();
                    },
                    'label' => 'Category',
                    'attr' => ['class' => 'form-control  ']
                    ])
                ->add('image', FileType::class, [
                    'mapped' => false,
                    'required' => true,
                    'attr' => ['class' => 'form-control  ']
                ]);



    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
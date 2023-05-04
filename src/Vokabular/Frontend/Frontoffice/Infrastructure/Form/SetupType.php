<?php

namespace App\Vokabular\Frontend\Frontoffice\Infrastructure\Form;

use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Level;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SetupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $levels = [];
        foreach (Level::validValues() as $level) {
            $levels[$level] = $level;
        }



        $builder->add('n_words', IntegerType::class, [
            'required'   => true,
            'label' => 'Die Menge der Wörter *',
            'label_attr' => [ 'class' => 'mt-2 fw-bolder'],
            'attr' => ['class' => 'form-control  mt-1', 'min' => 5, 'max' => 25],
            'help' => 'Anzahl der Wörter für das Training/Quiz. Mindestens 5 und höchstens 25',
            'help_attr' => [ 'class' => 'text-muted']
        ])
            ->add('level', ChoiceType::class, [
                'choices' => $levels,
                'multiple' => true,
                'required'   => false,
                'label' => 'Niveau',
                'label_attr' => [ 'class' => 'mt-2 fw-bolder'],
                'attr' => ['class' => 'form-control  mt-1'],
                'help' => 'Leer lassen, damit eine beliebige Niveau erscheint. [Control+click : Um mehrere Optionen gleichzeitig auszuwählen]',
                'help_attr' => [ 'class' => 'text-muted']
            ])
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'multiple' => true,
                'required'   => false,
                'placeholder' => 'Wähle ein Thema...',
                'choice_label'  => function (Category $category) {
                    return $category->name();
                },
                'choice_value' => function (Category $category) {
                    return $category->id()->value();
                },
                'label' => 'Themen',
                'label_attr' => [ 'class' => 'mt-4 fw-bolder'],
                'attr' => ['class' => 'form-control mt-1'],
                'help' => 'Leer lassen, um alle Themen auszuwählen. [Control+click : Um mehrere Optionen gleichzeitig auszuwählen]',
                'help_attr' => [ 'class' => 'text-muted']
            ])
        ->add('destination', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
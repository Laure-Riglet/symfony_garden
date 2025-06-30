<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Family;
use App\Entity\PlantBlueprint;
use App\Entity\Tag;
use App\Entity\TaskBlueprint;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantBlueprintForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('species')
            ->add('sun_requirements')
            ->add('watering_needs')
            ->add('germination_months')
            ->add('planting_months')
            ->add('flowering_months')
            ->add('harvest_months')
            ->add('hardiness')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('createdBy', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
            ])
            ->add('updatedBy', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
            ])
            ->add('taskBlueprints', EntityType::class, [
                'class' => TaskBlueprint::class,
                'choice_label' => 'title',
                'multiple' => true,
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('family', EntityType::class, [
                'class' => Family::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlantBlueprint::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\MatchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchTypesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        dump($options);
        $builder->add('goalsAway', TextType::class, [
            'label' => 'dsadas'
        ]);

        $builder->add('goalsHome', TextType::class, [
            'label' => 'dasdsa'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MatchType::class
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', PasswordType::class, [
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Hasło musi mieć przynajmniej {{ limit }} znaków.',
                        'max' => 4096,
                    ]),
                    new UserPassword([
                        'message' => 'Nieprawidłowe hasło.'
                    ])
                ],
                'label' => 'Stare hasło',
            ])
            ->add('newPassword', PasswordType::class, [
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Hasło musi mieć przynajmniej {{ limit }} znaków.',
                        'max' => 4096,
                    ]),
                    new NotCompromisedPassword([
                        'message' => 'Hasło jest zbyt słabe. Użyj mocniejszego unikatowego hasła składającego się z liter, cyfr i znaków specjalnych.'
                    ])
                ],
                'label' => 'Nowe hasło',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}

<?php


namespace App\Service;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserService
{
    /**
     * @param UserInterface $user
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @return bool
     */
    public function checkFbPassword(UserInterface $user, UserPasswordEncoderInterface $userPasswordEncoder): bool {
        if($userPasswordEncoder->isPasswordValid($user, '!QAZFDFH%$YHRW%&^HGF#FDMN')) {
            return false;
        }
        return true;
    }
}
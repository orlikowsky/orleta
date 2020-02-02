<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use App\Form\ChangeUserNameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/account")
 *
 * Class SecurityController
 * @package App\Controller
 */

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/change_password/{facebook}/", name="app_change_password")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param int|null $facebook
     * @return Response
     */
    public function changePassword(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $userPasswordEncoder,
        int $facebook
    )
    : Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        $form = $this->createForm(ChangePasswordType::class);
        if($facebook === 1) {
            $this->addFlash('notice', 'Zostałeś zalogowany.');
            $form->remove('password');
        }
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var UserInterface $user
             */
            $user = $this->getUser();

            $password = $userPasswordEncoder->encodePassword($user, $form->getData()->getNewPassword());
            $user->setPassword($password);

            $entityManager->persist($user);

            try {
                $entityManager->flush();
                $this->addFlash('notice', 'Hasło pomyślnie zmienione. Baw się dobrze.');
                if($facebook === 1) {
                    return $this->redirectToRoute('match_types_index', ['queue' => 0]);
                }
                return $this->redirectToRoute('app_change_password', ['facebook' => 0]);
            }catch (\Exception $exception) {
                $this->addFlash('notice', $exception->getMessage());
                return $this->redirectToRoute('app_change_password', ['facebook' => 0]);
            }


        }

        return $this->render('security/change_password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/change_user_name/", name="app_change_user_name")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function changeUserName(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {

        $form = $this
            ->createForm(ChangeUserNameType::class, $this->getUser())
            ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());

            try {
                $entityManager->flush();
                $this->addFlash('notice', 'Nazwa usera pomyśnie zmieniona.');
            } catch (\Exception $exception) {
                $this->addFlash('notice', $exception->getMessage());
            }
        }



        return $this->render('security/change_user_name.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

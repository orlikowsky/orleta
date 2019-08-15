<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app")
     * @param int $a
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function index($a = 1)
    {

        phpinfo();

        if($a) {
            print_r(1);
        }

        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }
}

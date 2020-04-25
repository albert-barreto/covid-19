<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CovidController extends AbstractController
{
    /**
     * @Route("/covid", name="covid")
     */
    public function index()
    {
        return $this->render('covid/index.html.twig', [
            'controller_name' => 'CovidController',
        ]);
    }

}

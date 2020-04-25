<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/covid", name="covid")
 */
class CovidController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('covid/index.html.twig', [
            'controller_name' => 'CovidController',
        ]);
    }

    /**
     * @Route("/countries", name="countries")
     */
    public function countries()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.covid19api.com/countries');

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();

        return $this->json([
            'data' => $content
        ]);
    }

}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

/**
 * @Route("/covid", name="covid")
 */
class CovidController extends AbstractController
{
    /** @var HttpClient */
    private $client;
    /**
     * CovidController constructor.
     */
    public function __construct()
    {
        $this->client = HttpClient::create();
    }

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
     * @Route("/countries", name="countries, methods={GET}")
     */
    public function countries()
    {
        $response = $this->client->request('GET', 'https://api.covid19api.com/countries');
        return ($response->getStatusCode() == 200) ? $this->json($response->toArray()) : $this->json(['error' => 'no countries found']);
    }

    /**
     * @Route("/countries/{country}", name="country, methods={GET}")
     */
    public function country($country)
    {
        $response = $this->client->request('GET', 'https://api.covid19api.com/live/country/' . $country);
        return ($response->getStatusCode() == 200) ? $this->json($response->toArray()) : $this->json(['error' => 'no countries found']);
    }

}

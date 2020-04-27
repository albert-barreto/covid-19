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
        $x = 10;
        return $this->render('covid/index.html.twig', [
            'controller_name' => 'CovidController',
            'x' => $x
        ]);
    }

    /**
     * @Route("/countries", name="countries, methods={GET}")
     */
    public function countries()
    {
        $response = $this->client->request('GET', 'https://api.covid19api.com/countries');
        return ($response->getStatusCode() == 200) ? $this->json($response->toArray()) : $this->json(['error' => 'countries not found']);
    }

    /**
     * @Route("/countries/{country}", name="country, methods={GET}")
     */
    public function country($country)
    {
        $response = $this->client->request('GET', 'https://api.covid19api.com/live/country/' . $country);
        return ($response->getStatusCode() == 200) ? $this->json($response->toArray()) : $this->json(['error' => 'country not found']);
    }

}

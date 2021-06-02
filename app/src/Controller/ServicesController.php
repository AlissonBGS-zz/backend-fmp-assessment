<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Services;
use Exception;

class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="services")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ServicesController.php',
        ]);
    }

    /**
     * @Route("/allServices", name="allServices")
     */
    public function getServices(Request $request): Response {
        try {
            $service_repository = $this->getDoctrine()->getRepository(Services::class);
            $services = $service_repository->findAll();
    
            $services = [];
            foreach($service_repository->findAll() as $service){
                array_push($services,(Object) [
                    'name' => $service->getName(),
                    'slug' => $service->getSlug(),
                    'description' => $service->getDescription(),
                    'tiers' => $service->getTiers(),
                ]);
            }

            $response = [
                'status_code' => 200,
                'services' => $services
            ];
        } catch (Exception $e){
            $response = [
                'status_code' => 500,
                'msg' => 'Unexpected error trying to get services!',
            ];
        }

        return new Response(json_encode($response));
    }

    /**
     * @Route("/service/{id}", name="service")
     */
    public function getService(int $id): Response {
        try {
            $service_repository = $this->getDoctrine()->getRepository(Services::class);
            $service = $service_repository->find($id);
    
            $response = [
                'status_code' => 200,
                'service' => [
                    'name' => $service->getName(),
                    'slug' => $service->getSlug(),
                    'description' => $service->getDescription(),
                    'tiers' => $service->getTiers(),
                ]
            ];
        } catch (Exception $e) {   
            $response = [
                'status_code' => 500,
                'msg' => 'Unexpected error trying to get service!',
            ];
        }
        
        return new Response(json_encode($response));
    }
}

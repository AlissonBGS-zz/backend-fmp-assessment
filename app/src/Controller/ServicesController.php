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

        return new Response(
            json_encode($response),
            Response::HTTP_OK,
            ['content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*']
        );
    }

    /**
     * @Route("/services/{slug}", name="service")
     */
    public function getService(string $slug): Response {
        try {
            $service_repository = $this->getDoctrine()->getRepository(Services::class);
            $service = $service_repository->findOneBy(['slug' => $slug]);
    
            if($service){
                $response = [
                    'status_code' => 200,
                    'service' => [
                        'name' => $service->getName(),
                        'slug' => $service->getSlug(),
                        'description' => $service->getDescription(),
                        'tiers' => $service->getTiers(),
                    ]
                ];
            }else{
                $response = [
                    'status_code' => 404,
                    'msg' => 'Service not found!',
                ];
            }
        } catch (Exception $e) {   
            $response = [
                'status_code' => 500,
                'msg' => 'Unexpected error trying to get service!',
            ];
        }
        
        return new Response(
            json_encode($response),
            Response::HTTP_OK,
            ['content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'] 
        );
    }
}

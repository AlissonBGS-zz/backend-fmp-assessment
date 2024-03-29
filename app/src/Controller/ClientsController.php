<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Clients;
use App\Repository\ClientsRepository;

class ClientsController extends AbstractController
{
    /**
     * @Route("/clients/create", name="create_client", methods={"POST"})
     */
    public function create(Request $request): Response {
    
        $data = json_decode($request->getContent());
        
        if (empty($data->first_name) || empty($data->last_name) || empty($data->address) || empty($data->country) || empty($data->email) ||empty($data->state) ||empty($data->zip_code) || empty($data->payment_type)){
            $response = [
                'status_code' => 400,
                'msg' => 'Missing fields',
                'data' => $data
            ];
        } else {
            if(filter_var($data->email, FILTER_VALIDATE_EMAIL)){
                $client_repository = $this->getDoctrine()->getRepository(Clients::class);
            
                if($client_repository->findOneby(['email' => $data->email])){
                    $response = [
                        'status_code' => 409,
                        'msg' => 'Email already registered!'
                    ];
                } else {
    
                    $entityManager = $this->getDoctrine()->getManager();
                    
                    $service = [
                        $data->service => $data->tier
                    ];
    
                    $client = new Clients();
                    $client->setFirstName($data->first_name);
                    $client->setLastName($data->last_name);
                    $client->setEmail($data->email);
                    $client->setPassword('fakepass');
                    $client->setToken('faketoken');
                    $client->setAddress($data->address);
                    $client->setCountry($data->country);
                    $client->setState($data->state);
                    $client->setZipCode($data->zip_code);
                    $client->setPaymentType($data->payment_type);
                    $client->setServices($service);
                    $created_at = new \DateTime('now');
                    $client->setCreatedAt($created_at);
        
                    $entityManager->persist($client);
                    $entityManager->flush(); 
        
                    if($client->getId()){
                        $response = [
                            'status_code' => 200,
                            'msg' => "Welcome ".$client->getFirstName()."!"
                        ];
                    } else {
                        $response = [
                            'status_code' => 500,
                            'msg' => "Ops, it wasn't possible to finish your request!"
                        ];
                    }
                }
            }else{
                $response = [
                    'status_code' => 400,
                    'msg' => "Invalid email!"
                ];
            }
            
        }

        return new Response(
            json_encode($response),
            Response::HTTP_OK,
            [
                'Access-Control-Allow-Origin' => '*',
                'Accept'=> 'application/json',
                'content-type' => 'application/json'
            ]
        );
        
    }
}

<?php

namespace Semantikos\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Debug\Debug;


class SearchServicesController extends Controller
{
    public function indexAction()
    {
        return $this->render('SemantikosClientBundle:SearchServices:index.html.twig');
    }    
    
    public function callAction(Request $request)
    {        
        $service = $request->request->get('service');
        $parameters = $request->request->get('parameters');  
        $response;                
        
        $ws_params = $this->container->get('client.helper.utils')->decodeParameters($parameters);                                
        
        switch($service) {
            case 'ws001':
                $response = $this->container->get('client.helper.clients')->callWS001($ws_params);
                break;     
            case 'ws002':
                $response = $this->container->get('client.helper.clients')->callWS002($ws_params);
                break;  
            case 'ws004':
                $response = $this->container->get('client.helper.clients')->callWS004($ws_params);
                break;  
        }                
        
        //var_dump($response);
        
        //array('error' => $error, 'message' => $message);
        
        return new Response($response);
    }    
    
}

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
        $operation = $request->request->get('operation');
        $parameters = $request->request->get('parameters');  
        $response;                
        
        $ws_params = $this->container->get('client.helper.utils')->decodeParameters($parameters);                                
        
        switch($operation) {
            case 'ws001':
                $response = $this->container->get('client.helper.clients')->callWS001($ws_params);
                break;     
            case 'ws002':
                $response = $this->container->get('client.helper.clients')->callWS002($ws_params);
                break;  
            case 'ws004':
                $response = $this->container->get('client.helper.clients')->callWS004($ws_params);
                break;  
            case 'ws005':
                $response = $this->container->get('client.helper.clients')->callWS005($ws_params);
                break;     
            case 'ws007':
                $response = $this->container->get('client.helper.clients')->callWS007($ws_params);
                break;             
            case 'ws008':
                $response = $this->container->get('client.helper.clients')->callWS008($ws_params);
                break;  
            case 'ws009':
                $response = $this->container->get('client.helper.clients')->callWS009($ws_params);
                break;  
            case 'ws022':
                $response = $this->container->get('client.helper.clients')->callWS022($ws_params);
                break; 
            case 'ws023':
                $response = $this->container->get('client.helper.clients')->callWS023($ws_params);
                break;   
            case 'ws024':
                $response = $this->container->get('client.helper.clients')->callWS024($ws_params);
                break;              
            case 'ws025':
                $response = $this->container->get('client.helper.clients')->callWS025($ws_params);
                break;                          
        }                
        
        //var_dump($response);
        
        //array('error' => $error, 'message' => $message);
        
        return new Response($response);
    }    
    
}

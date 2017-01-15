<?php
namespace Semantikos\ClientBundle\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

use Symfony\Component\HttpFoundation\Response;
 

/**
 * Description of FiltersHelper
 *
 * @author diego
 */
class ClientsHelper {
    //put your code here    
    private $container;
    
    private $logger;

    public function __construct(Container $container=null)
    {        
        $this->container = $container;
        $this->logger = $this->container->get('logger');
    }
          
    public function callWS001($params_array = null){
        
        $ch=curl_init();
        
        //$url = "http://www.minsal.cl/semantikos/ws/ServicioDeBusqueda?";
        
        $url = "http://192.168.0.226/semantikos/ws/ServicioDeBusqueda?";                
        
        $params= $this->container->get('client.helper.utils')->serializeParametersURL($params_array);                                                  
                
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        
        var_dump($server_output);
        
        curl_close ($ch);

        return new Response($server_output);
        
    }

    public function callWS002($params_array = null){                                                        
        
        $builder = $this->container->get('besimple.soap.client.builder.search');
        
        $peticion = $this->container->get('client.helper.mapping')->mapWS002Parameters($params_array);                                                                          
                      
        $client = $builder->build();                                                                              
        
        $result = $client->conceptosPorCategoria($peticion);                    
                
        return json_encode($result);
    }      
    
    public function callWS004($params_array = null){                                                        
                        
        $builder = $this->container->get('besimple.soap.client.builder.search');                                        
        
        $peticion = $this->container->get('client.helper.mapping')->mapWS004Parameters($params_array);                  
                      
        $client = $builder->build();                 
        
        $result = $client->buscarTruncatePerfect($peticion);                    
                
        return json_encode($result);
    }  
    
    /*
    public function callWS001($params_array = null){
        
        //$url = "http://www.minsal.cl/semantikos/ws/ServicioDeBusqueda?";
        
        $url = "http://192.168.0.226/semantikos/ws/ServicioDeBusqueda?";
        
        $response;
        
        $url= $url.$this->container->get('client.helper.utils')->serializeParametersURL($params_array);                                  
        
        $restClient = $this->container->get('circle.restclient');
        
        try {
            $response = $restClient->get($url);            
        } catch (Exception $ex) {
            $logger->error('An error occurred');
        }        
        
        var_dump($url);
        
        return new Response($response);        
    }
    */
}                

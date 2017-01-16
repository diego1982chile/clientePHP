<?php
namespace Semantikos\ClientBundle\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

use Symfony\Component\HttpFoundation\Response;

use Semantikos\ClientBundle\API\RespuestaRefSets;
 

/**
 * Description of FiltersHelper
 *
 * @author diego
 */
class ClientsHelper {
    //put your code here    
    private $container;
    
    private $soapClient;
    
    private $restClient;
    
    private $logger;

    public function __construct(Container $container=null)
    {        
        $this->container = $container;
        $this->logger = $this->container->get('logger');
        
        $builder = $this->container->get('besimple.soap.client.builder.search');
        /**
         * Agregar opciones al builder
         */
        $this->soapClient = $builder->build();            
        $this->restClient = $this->container->get('circle.restclient');
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
        
        $peticion = $this->container->get('client.helper.mapping')->mapWS002Parameters($params_array);                                                                                                                                                                                                                                   
        
        try {
            $result = $this->soapClient->conceptosPorCategoria($peticion);                    
        } catch (\SoapFault $soapFault) {
            return json_encode($soapFault);
        }
                
        return json_encode($result);
    }      
    
    public function callWS004($params_array = null){                                                        
                                                                              
        $peticion = $this->container->get('client.helper.mapping')->mapWS004Parameters($params_array);                                                  
        
        try {
            $result = $this->soapClient->buscarTruncatePerfect($peticion);                    
        } catch (\SoapFault $soapFault) {
            return json_encode($soapFault);
        }
                
        return json_encode($result);
    }  
    
    public function callWS005($params_array = null){                                                        
                                                                           
        $peticion = $this->container->get('client.helper.mapping')->mapWS005Parameters($params_array);                                                
        
        try {
            $result = $this->soapClient->obtenerTerminosPedibles($peticion);                    
        } catch (\SoapFault $soapFault) {
            return json_encode($soapFault);
        }
                        
        return json_encode($result);
    }  
    
    public function callWS007($params_array = null){                                                                                                                              
        
        $peticion = $this->container->get('client.helper.mapping')->mapWS007Parameters($params_array);                                                
        
        try {
            $result = $this->soapClient->refSetsPorIdDescripcion($peticion);                    
        } catch (\SoapFault $soapFault) {
            return json_encode($soapFault);
        }
                        
        return json_encode($result);
    }  
    
    public function callWS008($params_array = null){                                                                                                                                
        
        $peticion = $this->container->get('client.helper.mapping')->mapWS008Parameters($params_array);                                                
        
        try {
            $result = $this->soapClient->listaRefSet($peticion);                    
        } catch (\SoapFault $soapFault) {
            return json_encode($soapFault);
        }
                        
        return json_encode($result);
    } 
    
    public function callWS009($params_array = null){                                                                                        
        
        try {
                                    
            $finalResponse = array();
            
            foreach(explode(',',$params_array['descriptionIds']) as $key => $value) {  
                
                $parameters = array();                                
                
                $parameters['descriptionId'] = $value;
                $parameters['incluyeEstablecimiento'] = $params_array['incluyeEstablecimiento'];
                $parameters['idEstablecimiento'] = $params_array['idEstablecimiento'];
                
                $peticion = $this->container->get('client.helper.mapping')->mapWS007Parameters($parameters);
                
                $result = $this->soapClient->refSetsPorIdDescripcion($peticion);   
                
                array_push($finalResponse, $result);                                
            }                         
        } catch (\SoapFault $soapFault) {
            return json_encode($soapFault);
        }                
        
        return json_encode($finalResponse);
    }
    
    public function callWS022($params_array = null){                                 
        
        $peticion = $this->container->get('client.helper.mapping')->mapWS022Parameters($params_array);                                                
        
        try {
            $result = $this->soapClient->conceptosPorRefSet($peticion);                    
        } catch (\SoapFault $soapFault) {
            return json_encode($soapFault);
        }
                        
        return json_encode($result);
    } 
    
    public function callWS023($params_array = null){                                                                         
        
        $peticion = $this->container->get('client.helper.mapping')->mapWS022Parameters($params_array);                                                      
        
        try {
            $result = $this->soapClient->conceptosPorRefSet($peticion);                    
        } catch (\SoapFault $soapFault) {
            return json_encode($soapFault);
        }
                        
        return json_encode($result);
    }    
    
    public function callWS024($params_array = null){                                               
        
        try {
            $result = $this->soapClient->getCrossmapSets($params_array['idEstablecimiento']);                    
        } catch (\SoapFault $soapFault) {
            return json_encode($soapFault);
        }
                        
        return json_encode($result);
    }      
    
    public function callWS025($params_array = null){                                               
        
        try {
            $result = $this->soapClient->crossmapSetMembersDeCrossmapSet($params_array['nombreAbreviadoCrossmapSet']);                    
        } catch (\SoapFault $soapFault) {
            return json_encode($soapFault);
        }
                        
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

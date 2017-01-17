<?php
namespace Semantikos\ClientBundle\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
 

/**
 * Description of FiltersHelper
 *
 * @author diego
 */
class UtilsHelper {
    //put your code here    
    private $container;

    public function __construct(Container $container=null)
    {        
        $this->container = $container;
    }         
    
    public function decodeParameters($parameters = null){            
        
        $ws_params = array();
        $regex= '/\[(.*?)\]/';
        $last = sizeof($parameters)-1;        
        
        foreach($parameters as $key => $value) {   
            if($key === $last)
                continue;            
            preg_match('/\[(.*?)\]/', $value['name'], $match);
            $name = str_replace(array( '[', ']' ), '', $match[0]);
            $ws_params[$name] = $value['value'];            
        }
        
        return $ws_params;
    }
    
    public function serializeParametersURL($params_array = null){            
        
        $params_url='';
        
        foreach($params_array as $key => $value){                
            $params_url = $params_url.$key.'='.$value.'&';
        }  
        
        return substr($params_url, 0, -1);
    }
    
}                

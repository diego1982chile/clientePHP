<?php
namespace Semantikos\ClientBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Semantikos\ClientBundle\Helper\FormsHelper;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GlobalFiltersExtension
 *
 * @author diego
 */
class FormsExtension extends \Twig_Extension {
    //put your code here
    private $container;
    public function __construct(Container $container=null)
    {
        $this->container = $container;
        //var_dump ($container); exit; //  prints null !!!
    } 
    
     protected function get($service)
    {
        return $this->container->get($service);
    }
        
    public function getGlobals()
    {
        return array(
            "Forms" => array( "ws001" => $this->container->get("client.helper.forms")->getWS001Form(),
                              "ws002" => $this->container->get("client.helper.forms")->getWS002Form(),
                              "ws004" => $this->container->get("client.helper.forms")->getWS004Form() 
                            )
        );
    }

    public function getName()
    {
        return 'Forms_extension';
    }
    
     public function getForms()
     {
        return array(
            new \Twig_Filter_Function('Forms', array($this, 'Forms')),
        );
    } 
}

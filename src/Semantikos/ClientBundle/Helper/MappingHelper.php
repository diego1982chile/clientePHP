<?php
namespace Semantikos\ClientBundle\Helper;

use Semantikos\ClientBundle\API\PeticionPorCategoria;
use Semantikos\ClientBundle\API\PeticionBuscarTermino;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
 

/**
 * Description of FiltersHelper
 *
 * @author diego
 */
class MappingHelper {
    //put your code here    
    private $container;

    public function __construct(Container $container=null)
    {        
        $this->container = $container;
    }         
    
    public function mapWS002Parameters($parameters = null){                                    
        
        $peticionPorCategoria = new PeticionPorCategoria($parameters['nombreCategoria'],
                                                         $parameters['idEstablecimiento']);        
        
        return array( 'peticionConceptosPorCategoria' => $peticionPorCategoria );
    }
    
    public function mapWS004Parameters($parameters = null){                       
        
        $peticionBuscarTermino = new PeticionBuscarTermino();
        
        $peticionBuscarTermino->setTermino($parameters['termino']);
        $peticionBuscarTermino->setNombreCategoria(explode(',',$parameters['categorias']));
        $peticionBuscarTermino->setNombreRefSet(explode(',',$parameters['refSets']));
        $peticionBuscarTermino->setIdEstablecimiento($parameters['idEstablecimiento']);
        
        return array( 'peticionBuscarTermino' => $peticionBuscarTermino );
    }
        
}                

<?php
namespace Semantikos\ClientBundle\Helper;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Session\Session;

use Semantikos\ClientBundle\Entity\Category;
use Semantikos\ClientBundle\Entity\RefSet;
use Symfony\Component\Form\FormEvents;

use Doctrine\ORM\EntityManager;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
 

/**
 * Description of FiltersHelper
 *
 * @author diego
 */
class FormsHelper {
    //put your code here
    protected $formFactory;
    protected $em;
    protected $session;
    private $container;

    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, Session $session, Container $container=null)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->session = $session;
        $this->container = $container;
    }
        
    public function getWS001Form(){                                
        
        return $ws001Form = $this->formFactory->createNamedBuilder('ws001',FormType::class, null)
            ->setAction($this->container->get('router')->generate('search_call'))
            ->setMethod('POST')                    
            ->add('termino', TextType::class)            
            ->add('categorias', TextType::class, array('required' => false))
            ->add('refSets', TextType::class, array('required' => false)) 
            ->add('idEstablecimiento', NumberType::class)
            ->add('call', SubmitType::class, array('label' => 'Invocar WS', 'attr' => array('class' => 'btn btn-primary')))                                  
            ->getForm()->createView();                    
    }
    
    public function getWS002Form(){                                
        
        return $ws002Form = $this->formFactory->createNamedBuilder('ws002',FormType::class, null)
            ->setAction($this->container->get('router')->generate('search_call'))
            ->setMethod('POST')            
            ->add('nombreCategoria', TextType::class)            
            ->add('idEstablecimiento', NumberType::class)                              
            ->add('call', SubmitType::class, array('label' => 'Invocar WS', 'attr' => array('class' => 'btn btn-primary')))
            ->getForm()->createView();                    
    }
    
    public function getWS004Form(){                                
        
        return $ws004Form = $this->formFactory->createNamedBuilder('ws004',FormType::class, null)
            ->setAction($this->container->get('router')->generate('search_call'))
            ->setMethod('POST')        
            ->add('termino', TextType::class)            
            ->add('categorias', TextType::class, array('required' => false))
            ->add('refSets', TextType::class, array('required' => false)) 
            ->add('idEstablecimiento', NumberType::class)
            ->add('call', SubmitType::class, array('label' => 'Invocar WS', 'attr' => array('class' => 'btn btn-primary')))  
            ->getForm()->createView();                    
    }
}                

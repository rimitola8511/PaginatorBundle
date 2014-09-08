<?php

Namespace Jmardz\PaginatorBundle\Twig\Extension;

use Jmardz\PaginatorBundle\Helper\PaginatorHelper;

class PaginationExtension extends \Twig_Extension{
    
    protected $pgHelper;
    
    public function __construct(PaginatorHelper $pgHelper) 
    {
        $this->pgHelper = $pgHelper;
    }

    public function getFunctions()
    {
        return array(
            'jmardz_paginator_render' => new \Twig_Function_Method($this, 'render',array('is_safe' => array('html'))),
        );
    }
    
    public function render($view = null,$options = array())
    {
       return $this->pgHelper->render($view,$options);
    }
    
    public function getName() 
    {
        return 'jmardz_paginator_extension';
    }

}

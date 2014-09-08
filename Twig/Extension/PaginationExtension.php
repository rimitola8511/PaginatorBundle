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
    
    public function render()
    {
       return $this->pgHelper->render();
    }
    
    public function getName() 
    {
        return 'jmardz_paginator_extension';
    }

}

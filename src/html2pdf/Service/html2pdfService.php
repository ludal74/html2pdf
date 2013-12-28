<?php

namespace html2pdf\Service;

use Zend\View\Model\ViewModel;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Model\ModelInterface;


class html2pdfService
{
 
    protected $renderer;
    
    protected $fileName = "html2pdf";
    
    
	public function __construct( $renderer )
	{    
	    $this->renderer = $renderer;
	}
	
	
	public function setFileName( $fileName )
	{
		$this->fileName = $fileName;
	}

	public function generate( $view, $variables )
	{
	    $viewModel = new \Zend\View\Model\ViewModel();
	    $viewModel->setTerminal(true);
	    $viewModel->setTemplate($view);
	    
	    if( isset( $variables ) )
	       $viewModel->setVariables( $variables );

	    $content = $this->renderer->render( $viewModel );
	    
	    $html2pdf = new \Html2pdf();
	    $html2pdf->WriteHTML($content);
	    $output = $html2pdf->Output( $this->fileName.'.pdf', "D" );
	    
	    return $output;
	}
	
}
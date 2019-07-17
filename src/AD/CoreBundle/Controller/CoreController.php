<?php

namespace AD\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoreController extends Controller
{
    public function indexAction(Request $request)
    {
    	return $this->redirectToRoute('core_homepage',array(
    			'_locale' => $request->getLocale()
    	));
    }
    
    public function indexWithLocaleAction()
    {
    	$page = $this->getDoctrine()->getManager()->getRepository("CoreBundle:HomePage")->findOneBy(array(
    			"enabled" => true
    	));
    	
    	return $this->render('CoreBundle:Core:index.html.twig', array(
    			"page" => $page
    	));
    }
}

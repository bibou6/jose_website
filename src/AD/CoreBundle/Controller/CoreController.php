<?php

namespace AD\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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
    
    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function uploadHomePageMainImageAction($id, Request $request){
    	
    	$logger = $this->get('logger');
    	$em = $this->getDoctrine()->getManager();
    	
    	//Retrieving flat on which you add the file
    	
    	$home = $em->getRepository('CoreBundle:HomePage')->find($id);
    	$uploaded_file = $request->files->get('file');
    	
    	if($request->isMethod("POST")){
    		if($uploaded_file !== null){
    			$logger->info('Main image upload for home : '.$id);
    			
    			$home->setMainImageFile($uploaded_file);
    			$em->flush();
    			
    		}
    		// redirect to the 'list' view of the given entity
    		return new JsonResponse(array('success' => true));
    	}
    	
    	// redirect to the 'list' view of the given entity
    	return new JsonResponse(array('success' => false));
    	
    	
    	
    }
    
    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function uploadHomePageSecondaryImageAction($id, Request $request){
    	
    	$logger = $this->get('logger');
    	$em = $this->getDoctrine()->getManager();
    	
    	//Retrieving flat on which you add the file
    	
    	$home = $em->getRepository('CoreBundle:HomePage')->find($id);
    	$uploaded_file = $request->files->get('file');
    	
    	if($request->isMethod("POST")){
    		if($uploaded_file !== null){
    			$logger->info('Secondary image upload for home : '.$id);
    			
    			$home->setSecondaryImageFile($uploaded_file);
    			$em->flush();
    			
    		}
    		// redirect to the 'list' view of the given entity
    		return new JsonResponse(array('success' => true));
    	}
    	
    	// redirect to the 'list' view of the given entity
    	return new JsonResponse(array('success' => false));
    	
    }
}

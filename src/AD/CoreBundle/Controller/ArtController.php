<?php
namespace AD\CoreBundle\Controller;

use AD\CoreBundle\Entity\Art;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ArtController extends AbstractController
{
	
	public function indexAction(Request $request){
		return $this->redirectToRoute('core_homepage',array(
				'_locale' => $request->getLocale()
		));
	}
	
	
	
	public function listOilAction()
	{
		$translator = $this->get ( 'translator' );
		$arts = $this->getDoctrine()->getManager()->getRepository("CoreBundle:Art")->findBy(array(
				'medium' => 'Oil'
		),array(
				'uploadedAt' => 'DESC'
		));
		
		return $this->render('CoreBundle:art:list.html.twig',array(
				"arts" => $arts,
				"title" => $translator->trans('art.medium.oil')
		));
	}
	
	public function listMixAction()
	{
		$translator = $this->get ( 'translator' );
		$arts = $this->getDoctrine()->getManager()->getRepository("CoreBundle:Art")->findBy(array(
				'medium' => 'Mix'
		),array(
				'uploadedAt' => 'DESC'
		));
		
		return $this->render('CoreBundle:art:list.html.twig',array(
				"arts" => $arts,
				"title" => $translator->trans('art.medium.mix')
		));
	}
	
	public function listDrawingAction()
	{
		$translator = $this->get ( 'translator' );
		$arts = $this->getDoctrine()->getManager()->getRepository("CoreBundle:Art")->findBy(array(
				'medium' => 'Drawing'
		),array(
				'uploadedAt' => 'DESC'
		));
		
		return $this->render('CoreBundle:art:list.html.twig',array(
				"arts" => $arts,
				"title" => $translator->trans('art.medium.drawing')
		));
	}
	
	public function viewAction(Art $art){
		return $this->render('CoreBundle:art:view.html.twig',array(
				"art" => $art
		));
	}
	
	/**
	 * @Security("has_role('ROLE_ADMIN')")
	 */
	public function uploadArtImageAction($id, Request $request){
		
		$logger = $this->get('logger');
		$em = $this->getDoctrine()->getManager();
		
		//Retrieving flat on which you add the file
		
		$art = $em->getRepository('CoreBundle:Art')->find($id);
		$uploaded_file = $request->files->get('file');
		
		if($request->isMethod("POST")){
			if($uploaded_file !== null){
				$logger->info('Image upload for Art : '.$art->getTitle());
				
				$art->setImageFile($uploaded_file);
				$em->flush();
				
			}
			// redirect to the 'list' view of the given entity
			return new JsonResponse(array('success' => true));
		}
		
		// redirect to the 'list' view of the given entity
		return new JsonResponse(array('success' => false));
		
	}
	
}
<?php
namespace AD\CoreBundle\Controller;

use AD\CoreBundle\Entity\Art;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

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
}
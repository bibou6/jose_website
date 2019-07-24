<?php

namespace AD\CoreBundle\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use AD\CoreBundle\Entity\Mail;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends BaseAdminController
{
	protected function initialize(Request $request)
	{
		$this->get('translator')->setLocale('es');
		parent::initialize($request);
	}
	
	
	public function showMailAction()
	{
		
		$id = $this->request->query->get('id');
		$mail = $this->em->getRepository('CoreBundle:Mail')->find($id);
		
		
		$mail->setOpened(true);
		$this->em->persist($mail);
		$this->em->flush();
		
		return parent::showAction();
	}
	
	
	

	
}
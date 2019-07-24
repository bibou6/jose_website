<?php
namespace AD\CoreBundle\Controller;

use AD\CoreBundle\Entity\Art;
use AD\CoreBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;
use AD\CoreBundle\Entity\Mail;

class MailController extends AbstractController
{
	
	public function indexAction(Request $request){
		
		
		$mail = new Mail();
		$translator = $this->get('translator');
		
		$form = $this->createForm(MailType::class, $mail, array(
				"label" => "contact.labels.title"
		));
		
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			
			$this->save($mail);
			
			$this->addFlash("success", $translator->trans("mail.labels.sent"));
			return $this->redirectToRoute('contact_homepage');
			
		}else{
			return $this->render('CoreBundle:Contact:index.html.twig',array(
					"form" => $form->createView()
			));
		}
	}
	
	public function deleteAction(Mail $mail){
		$this->delete($mail);
		return $this->redirectToRoute('mail_homepage');
	}
	
	
	
	
	
	public function save(Mail $mail){
		$em = $this->getDoctrine()->getManager();
		$em->persist($mail);
		$em->flush();
	}
	
	public function delete(Mail $mail){
		$em = $this->getDoctrine()->getManager();
		$em->remove($mail);
		$em->flush();
	}
	
	
	final function addFlash($type,$message){
		$flashbag = $this->get('session')->getFlashBag();
		$flashbag->add($type, $message);
	}
}
<?php

namespace AD\CoreBundle\Form;

use AD\CoreBundle\Entity\Mail;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('name',null, array(
				"label" => "mail.labels.name",
				"required" => true
		))
		->add('body',CKEditorType::class, array(
				'config_name' => 'my_config',
				'label' => "mail.labels.body",
				'required' => true
		))
		->add('phone',null, array(
				"label" => "mail.labels.phone",
				"required" => false
		))
		->add('email',null, array(
				"label" => "mail.labels.email",
				"required" => true
		));
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
				'data_class' => Mail::class,
		]);
	}
}
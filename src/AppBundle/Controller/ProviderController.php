<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Model\ProviderRegistration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\Type\ProviderRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ProviderController extends Controller
{
	/**
	 * @Route("/provider", name="provider")
	 */
	public function indexAction(Request $request) {
		return $this->render('provider/index.html.twig', array());
	}

	/**
	 * @Route("/provider/service/add", name="provider_service_add")
	 */
	public function serviceAddAction(Request $request) {
		return $this->render('provider/service/add.html.twig', array());
	}

	/**
	 * @Route("/provider/register", name="provider_register")
	 */
	public function registerAction(Request $request)
	{
		$registration = new ProviderRegistration();
		$form = $this->createForm(new ProviderRegistrationType(), $registration);

		$form->handleRequest($request);

		if ($form->isValid()) {
//			Encode password
			/** @var User $user */
			$user    = $registration->getUser();
//			Add provider-role
			$user->addRole('ROLE_PROVIDER');

			$factory = $this->get('security.encoder_factory');
			$encoder = $factory->getEncoder($user);
			$user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));

			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();

//			Login user
			$token = new UsernamePasswordToken($user, null, 'backend', $user->getRoles());
			$this->get('security.token_storage')->setToken($token);

			return $this->redirectToRoute('provider');
		}

		return $this->render('provider/register.html.twig', array(
			'form' => $form->createView(),
		));
	}
    
}

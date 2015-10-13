<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\LoginType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

	/**
	 * @Route("/login", name="login")
	 */
	public function loginAction(Request $request)
	{
		$authenticationUtils = $this->get('security.authentication_utils');

		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();

		return $this->render(
			'default/login.html.twig',
			array(
				'last_username' => $lastUsername,
				'error'         => $error,
			)
		);
	}

	/**
	 * @Route("/login_check", name="login_check")
	 */
	public function loginCheckAction() {
		// this controller will not be executed,
		// as the route is handled by the Security system
	}
    
}

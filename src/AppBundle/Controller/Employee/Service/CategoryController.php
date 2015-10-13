<?php

namespace AppBundle\Controller\Employee\Service;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{

	/**
	 * @Route(
	 * "/employee/service/category/{args}",
	 * defaults={"args" : ""},
	 * name="employee_service_category")
	 */
	public function categoryAction($args) {
		$parameters = explode("&", $args);
		$filters = array();
		foreach($parameters as $parameter) {
			$foo = explode("=", $parameter);
			if(sizeof($foo) == 2) {
				$filters[$foo[0]] = $foo[1];
			}
		}

		$categoryRepository = $this->getDoctrine()->getRepository('AppBundle:ServiceCategory');
		$categories = array();

		if(isset($filters['branch'])) {
			$branches = explode(',', $filters['branch']);
			if(sizeof($branches) > 0) {
				$categories = $categoryRepository->findBy(array(
					'branch' => $branches
				));
			}
		} else {
			$categories = $categoryRepository->findAll();
		}

		return $this->render('employee/service/category.html.twig', array(
			'categories' => $categories,
		));
	}

}

<?php

namespace AppBundle\Controller\Employee\Translation;

use AppBundle\Entity\Translation\Language;
use AppBundle\Entity\Translation\Message;
use AppBundle\Entity\Translation\Translation;
use AppBundle\Form\Type\LanguageType;
use AppBundle\Form\Type\MessageType;
use AppBundle\Form\Type\TranslationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

class TranslationController extends Controller
{
    /**
     * @Route("/employee/translation", name="employee_translation")
     */
    public function indexAction(Request $request)
    {
	    $em = $this->getDoctrine()->getManager();

//	    Translation
	    $translation = new Translation();
	    $form_addTranslation = $this->createForm(new TranslationType(), $translation);
	    $form_addTranslation->handleRequest($request);
	    if($form_addTranslation->isValid()) {
		    if(empty($translation->getDomain())) {
//			    This saves space in the database, since we don't need to save messages here.
			    $translation->setDomain('');
		    }
		    $translation->setEditedBy($this->getUser());

		    if($translation->isInCharge()) {
//			    Check if there already is another version of this translation in charge.
			    /** @var Translation $possibleRival */
			    $possibleRival = $this->getDoctrine()->getRepository('AppBundle:Translation\\Translation')->findOneBy(array(
				    'inCharge' => true,
				    'message' => $translation->getMessage(),
			    ));

			    if(!empty($possibleRival)) {
					$possibleRival->setInCharge(false);
				    $em->persist($possibleRival);
			    }
		    }

		    $em->persist($translation);
		    $this->clearTranslationCache();
	    }

//	    Message
	    $message = new Message();
	    $form_addMessage = $this->createForm(new MessageType(), $message);
	    $form_addMessage->handleRequest($request);
	    if($form_addMessage->isValid()) {
			$em->persist($message);
	    }

//	    Language
	    $language = new Language();
	    $form_addLanguage = $this->createForm(new LanguageType(), $language);
	    $form_addLanguage->handleRequest($request);
	    if($form_addLanguage->isValid()) {
		    $em->persist($language);
	    }

	    $em->flush();

        return $this->render('employee/translation/index.html.twig', array(
	        'form_addTranslation' => $form_addTranslation->createView(),
	        'form_addMessage' => $form_addMessage->createView(),
	        'form_addLanguage' => $form_addLanguage->createView(),
        ));
    }

	protected function clearTranslationCache() {
		$fs = new Filesystem();
		try {
			$path = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'dev' . DIRECTORY_SEPARATOR . 'translations';
			$fs->remove($path);
		} catch (IOException $e) {

		}
	}

}

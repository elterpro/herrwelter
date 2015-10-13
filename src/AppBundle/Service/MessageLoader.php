<?php
namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\SecurityBundle\Tests\Functional\app\AppKernel;
use Symfony\Component\Translation\Exception\InvalidResourceException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\MessageCatalogue;

class MessageLoader implements LoaderInterface {

	/**
	 * @var EntityManager $em;
	 */
	protected $em;

	/*
	 * @var \Doctrine\ORM\EntityRepository $languageRepository, $translationRepository
	 */
	/*protected $languageRepository, $translationRepository, $translationInChargeRepository;*/

	public function __construct(EntityManager $em) {
		$this->em = $em;
		/*$this->languageRepository = $em->getRepository('AppBundle:Translation\Language');
		$this->translationRepository = $em->getRepository('AppBundle:Translation');
		$this->translationInChargeRepository = $em->getRepository('AppBundle:TranslationInCharge');*/
	}

	/**
	 * Loads a locale.
	 *
	 * @param mixed $resource A resource
	 * @param string $locale A locale
	 * @param string $domain The domain
	 *
	 * @return MessageCatalogue A MessageCatalogue instance
	 *
	 * @api
	 *
	 * @throws NotFoundResourceException when the resource cannot be found
	 * @throws InvalidResourceException  when the resource cannot be loaded
	 */
	public function load($resource, $locale, $domain = 'messages') {
		$query = $this->em->createQuery("SELECT Trn ".
			"FROM AppBundle:Translation\\Language Lng, AppBundle:Translation\\Message Msg, AppBundle:Translation\\Translation Trn ".
			"WHERE Lng.locale = :locale ".
			"AND Trn.language = Lng AND Trn.domain = :domain AND Trn.inCharge = true ".
			"AND Trn.message = Msg")
			->setParameter('locale', $locale)
			->setParameter('domain', ($domain == 'messages') ? '' : $domain);
		$translations = $query->getResult();



		$catalogue = new MessageCatalogue($locale);

		/** @var \AppBundle\Entity\Translation\Translation $translation */
		foreach($translations as $translation) {
			$catalogue->set($translation->getMessage()->getName(), $translation->getText(), ($translation->getDomain() == '') ? 'messages' : $translation->getDomain());
		}

		return $catalogue;
	}

}
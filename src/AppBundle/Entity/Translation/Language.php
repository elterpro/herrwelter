<?php
namespace AppBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity("locale")
 * @ORM\Table(name="translation_languages")
 */
class Language {

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @var int $id
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=5)
	 * @Assert\NotBlank()
	 * @Assert\Locale()
	 * @var String $locale
	 */
	protected $locale;

	/**
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	 * @var String $name
	 */
	protected $name;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return String
	 */
	public function getLocale() {
		return $this->locale;
	}

	/**
	 * @param String $locale
	 */
	public function setLocale($locale) {
		$this->locale = $locale;
	}

	/**
	 * @return String
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param String $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

}
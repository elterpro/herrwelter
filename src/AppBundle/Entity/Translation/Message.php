<?php
namespace AppBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity("name")
 * @ORM\Table(name="translation_messages")
 */
class Message {

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @var int $id
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	 * @var String $name
	 */
	protected $name;

	public function __construct() {

	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
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
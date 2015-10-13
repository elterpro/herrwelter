<?php
namespace AppBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="translation_translations")
 */
class Translation {

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @var int $id
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Message", fetch="EAGER")
	 * @Assert\NotBlank()
	 * @var Message $message
	 */
	protected $message;

	/**
	 * @ORM\ManyToOne(targetEntity="Language", fetch="EAGER")
	 * @Assert\NotBlank()
	 * @var Language $language
	 */
	protected $language;

	/**
	 * @ORM\Column(type="string")
	 * @var String $domain
	 */
	protected $domain;

	/**
	 * @ORM\Column(type="text")
	 * @Assert\NotBlank()
	 * @var String $text
	 */
	protected $text;

	/**
	 * @ORM\Column(type="boolean")
	 *
	 * When there are multiple versions of this translation, should this one be in charge?
	 * @var boolean $inCharge;
	 */
	protected $inCharge;

	/**
	 * @ORM\Column(type="datetime")
	 * @var \DateTime $edited_last;
	 */
	protected $edited_last;

	/**
	 * @ManyToOne(targetEntity="AppBundle\Entity\User")
	 * @var User $edited_by;
	 */
	protected $edited_by;

	/**
	 * @ORM\Column(type="boolean")
	 *
	 * When multiple versions of one message are available,
	 * after some time the older versions get deleted. You can
	 * save them from that by setting $forceSave to true.
	 * @var boolean $edited_forceSave;
	 */
	protected $edited_forceSave;

	public function __construct() {
		$this->domain = '';
		$this->edited_last = new \DateTime("now");
		$this->edited_forceSave = false;
		$this->inCharge = true;
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return Message
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param Message $message
	 */
	public function setMessage(Message $message) {
		$this->message = $message;
	}

	/**
	 * @return String
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * @param Language $language
	 */
	public function setLanguage(Language $language) {
		$this->language = $language;
	}

	/**
	 * @return String
	 */
	public function getDomain() {
		return $this->domain;
	}

	/**
	 * @param String $domain
	 */
	public function setDomain($domain) {
		$this->domain = $domain;
	}

	/**
	 * @return String
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * @param String $text
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * @return boolean
	 */
	public function isInCharge() {
		return $this->inCharge;
	}

	/**
	 * @param boolean $inCharge
	 */
	public function setInCharge($inCharge = true) {
		$this->inCharge = $inCharge;
	}

	/**
	 * @return \DateTime
	 */
	public function getEditedLast() {
		return $this->edited_last;
	}

	/**
	 * @return User
	 */
	public function getEditedBy() {
		return $this->edited_by;
	}

	/**
	 * @param User $edited_by
	 */
	public function setEditedBy(User $edited_by) {
		$this->edited_by = $edited_by;
	}

	/**
	 * @return boolean
	 */
	public function isEditedForceSave() {
		return $this->edited_forceSave;
	}

	/**
	 * @param boolean $edited_forceSave
	 */
	public function setEditedForceSave($edited_forceSave = true) {
		$this->edited_forceSave = $edited_forceSave;
	}

}
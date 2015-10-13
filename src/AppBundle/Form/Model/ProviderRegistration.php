<?php
namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use AppBundle\Entity\User;

class ProviderRegistration {
	/**
	 * @Assert\Type(type="AppBundle\Entity\User")
	 * @Assert\Valid()
	 * @var User
	 */
	protected $user;

	/**
	 * @Assert\NotBlank()
	 * @Assert\True()
	 * @var bool
	 */
	protected $termsAccepted;

	/**
	 * @return User
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param User $user
	 */
	public function setUser(User $user) {
		$this->user = $user;
	}

	/**
	 * @return bool
	 */
	public function getTermsAccepted() {
		return $this->termsAccepted;
	}

	/**
	 * @param bool $termsAccepted
	 */
	public function setTermsAccepted($termsAccepted) {
		$this->termsAccepted = (bool) $termsAccepted;
	}


}
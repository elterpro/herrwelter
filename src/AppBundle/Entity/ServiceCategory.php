<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity("serviceName")
 * @ORM\Table(name="ServiceCategories")
 */
class ServiceCategory {

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @var int
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=64)
	 * @Assert\NotBlank()
	 * @var String
	 */
	protected $branch;

	/**
	 * @ORM\Column(type="string", length=64, unique=true)
	 * @Assert\NotBlank()
	 * @var String
	 */
	protected $serviceName;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getBranch() {
		return $this->branch;
	}

	public function setBranch($branch) {
		$this->branch = $branch;
	}

	public function getServiceName() {
		return $this->serviceName;
	}

	public function setServiceName($serviceName) {
		$this->serviceName = $serviceName;
	}
}
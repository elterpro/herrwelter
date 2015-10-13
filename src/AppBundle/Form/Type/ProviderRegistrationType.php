<?php
namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProviderRegistrationType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('user', new ProviderType())
			->add('terms', 'checkbox', array(
				'property_path' => 'termsAccepted',
			))
			->add('save', 'submit', array('label' => 'Registrieren'))
		;
	}

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName() {
        return 'app_provider_registration';
    }
}
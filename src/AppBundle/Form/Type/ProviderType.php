<?php
namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('username', 'email', array('label' => 'E-Mail'))
			->add('password', 'repeated', array(
				'type' => 'password',
				'first_options' => array('label' => 'Passwort'),
				'second_options' => array('label' => 'Passwort wiederholen'),
			))
			->add('forename', 'text', array('label' => 'Vorname'))
			->add('surname', 'text', array('label' => 'Nachname'))
			->add('country', 'country', array(
				'label' => 'Wohnhaft in',
				'preferred_choices' => array('DE'),
			))
		;
	}

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName() {
        return 'app_provider';
    }

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\User',
		));
	}
}
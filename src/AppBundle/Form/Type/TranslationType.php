<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslationType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('message', 'entity', array(
				'class' => 'AppBundle:Translation\\Message',
				'choice_label' => 'name',
				'label' => 'type.translation.message',
			))
			->add('language', 'entity', array(
				'class' => 'AppBundle:Translation\\Language',
				'choice_label' => 'name',
				'label' => 'type.translation.language',
			))
			->add('domain', 'text', array(
				'label' => 'type.translation.domain',
				'required' => false,
			))
			->add('text', 'textarea', array('label' => 'type.translation.text'))
			->add('edited_forceSave', 'checkbox', array(
				'label' => 'type.translation.saveFromDeleting',
				'required' => false,
			))
			->add('inCharge', 'checkbox', array(
				'label' => 'type.translation.setInCharge',
				'data' => true,
				))
			->add('save', 'submit', array('label' => 'form.save'))
		;
	}

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName() {
        return 'app_translation';
    }

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\Translation\Translation',
		));
	}
}
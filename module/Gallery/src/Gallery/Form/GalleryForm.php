<?php
namespace Gallery\Form;

use Zend\Form\Form;

class GalleryForm extends Form
{
    public function init()
    {
        $this->add(
            array(
                'name' => 'id',
                'type' => 'hidden',
            )
        );

        $this->add(
            array(
                'name'       => 'title',
                'type'       => 'text',
                'options'    => array('label' => 'Titel'),
                'attributes' => array('class' => 'span5'),
            )
        );

        $this->add(
            array(
                'name'       => 'thumburl',
                'type'       => 'file',
                'options'    => array('label' => 'Thumb'),
                'attributes' => array('class' => 'span5'),
            )
        );

        $this->add(
            array(
                'name'       => 'bigurl',
                'type'       => 'file',
                'options'    => array('label' => 'Bild'),
                'attributes' => array('class' => 'span5'),
            )
        );

        $this->add(
            array(
                'type'       => 'Submit',
                'name'       => 'save',
                'attributes' => array(
                    'value' => 'Speichern',
                    'id'    => 'save',
                    'class' => 'btn btn-primary',
                ),
            )
        );
    }
}
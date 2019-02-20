<?php

namespace DeskFlix\Form;

use Kris\LaravelFormBuilder\Form;

class VideoForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('title', 'text', [
                'rules' => 'required|max:255'
            ])
            ->add('description', 'textarea', [
                'rules' => 'required'
            ]);
    }
}

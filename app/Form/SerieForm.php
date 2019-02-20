<?php

namespace DeskFlix\Form;

use Kris\LaravelFormBuilder\Form;

class SerieForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        //$rulesThumbFile = 'image|max:1024';
        //$rulesThumbFile = !$id ? "required|$rulesThumbFile" : $rulesThumbFile;

        $this
            ->add('title', 'text',[
                'rules' => 'required|max:255',
                'label' => 'Título'
            ])
            ->add('description', 'textarea',[
                'rules' => 'required',
                'label' => 'Descrição'
            ])
            ->add('thumb_file', 'file',[
                'required' => !$id ? true : false,
                'label' => 'Imagem Thumbnail',
                'rules' => 'image|max:1024'
            ]);
    }
}

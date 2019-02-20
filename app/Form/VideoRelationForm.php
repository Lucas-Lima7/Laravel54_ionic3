<?php

namespace DeskFlix\Form;

use DeskFlix\Models\Category;
use DeskFlix\Models\Serie;
use Kris\LaravelFormBuilder\Form;

class VideoRelationForm extends Form
{
    public function buildForm()
    {
        $this->add('categories', 'entity', [
            'class' => Category::class,
            'property' => 'name',
            //'selected' => $this->model->categories->pluck('id')->toArray(),  //comentei pq já está selecionando as categorias do video
            'multiple' => true,
            'label' => 'Categorias',
            'attr' => [
                'name' => 'categories[]'
            ],
            'rules' => 'required|exists:categories, id'
        ])
            ->add('serie_id', 'entity',[
               'class' => Serie::class,
               'property' => 'title',
               'empty_value' => 'Selecione a série',
                'label' => 'Série',
                'rules' => 'nullable|exists:series,id'
            ]);
    }
}

@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de categorias</h3>
            {!!Button::PRIMARY('Nova categoria')->asLinkTo(route('admin.categories.create'))!!}
        </div>
        <div class="row">
            {!! Table::withContents($categories->items())->striped()
                ->callback('Ações', function($field, $category){
                    $linkEdit = route('admin.categories.edit', ['user' => $category->id]);
                    $linkShow = route('admin.categories.show', ['user' => $category->id]);
                    return Button::LINK(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                            Button::LINK(Icon::create('remove'))->asLinkTo($linkShow);
                 })
             !!}
        </div>
        {!! $categories->links() !!}
    </div>
@endsection

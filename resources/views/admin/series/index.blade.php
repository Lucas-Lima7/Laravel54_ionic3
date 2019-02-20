@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de séries</h3>
            {!!Button::PRIMARY('Nova série')->asLinkTo(route('admin.series.create'))!!}
        </div>
        <div class="row">
            {!! Table::withContents($series->items())->striped()
               ->callback('Descrição',function ($field, $serie){
                   return \Bootstrapper\Facades\MediaObject::withContents(
                   [
                       'image' => $serie->thumb_small_asset,
                       'link' => $serie->thumb_path,
                       'heading' => $serie->title,
                       'body' => $serie->description
                   ]);
               })
               ->callback('Ações', function($field, $serie){
                   $linkEdit = route('admin.series.edit', ['user' => $serie->id]);
                    $linkShow = route('admin.series.show', ['user' => $serie->id]);
                    return Button::LINK(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                            Button::LINK(Icon::create('remove'))->asLinkTo($linkShow);
                })
            !!}
        </div>
        {!! $series->links() !!}
    </div>
@endsection

@push('styles')
    <style type="text/css">
        .media-body{
            width: 400px;
        }
    </style>
@endpush
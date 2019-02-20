@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de vídeos</h3>
            {!!Button::PRIMARY('Novo vídeo')->asLinkTo(route('admin.videos.create'))!!}
        </div>
        <div class="row">
            {!! Table::withContents($videos->items())->striped()
                ->callback('Descrição',function ($field, $video){
                    return \Bootstrapper\Facades\MediaObject::withContents(
                    [
                        'image' => $video->thumb_small_asset,
                        'link' => $video->file_asset,
                        'heading' => $video->title,
                        'body' => $video->description
                    ]);
                })
                ->callback('Ações', function($field, $video){
                    $linkEdit = route('admin.videos.edit', ['user' => $video->id]);
                    $linkShow = route('admin.videos.show', ['user' => $video->id]);
                    return Button::LINK(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                            Button::LINK(Icon::create('remove'))->asLinkTo($linkShow);
                 })
             !!}
        </div>
        {!! $videos->links() !!}
    </div>
@endsection

@push('styles')
<style type="text/css">
    .media-body{
        width: 400px;
    }
</style>
@endpush

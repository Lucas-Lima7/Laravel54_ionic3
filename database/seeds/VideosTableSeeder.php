<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $series = \DeskFlix\Models\Serie::all();
        $categories = \DeskFlix\Models\Category::all();
        $repository = app(\DeskFlix\Repositories\VideoRepository::class);
        $collectionThumbs = $this->getThumb();
        $collectionVideos = $this->getVideo();

        factory(\DeskFlix\Models\Video::class,2)
            ->create()
            ->each(function ($video) use (
                $series,
                $categories,
                $repository,
                $collectionThumbs,
                $collectionVideos
            ){
                $repository->uploadThumb($video->id, $collectionThumbs->random());
                $repository->uploadFile($video->id, $collectionVideos->random());

                //fazer relacionamento 1 vídeo e inserir em 4 categorias, não precisa 'save' pq o attach já salva
                $video->categories()->attach($categories->random(4)->pluck('id'));
                $num = rand(1,3);
                if($num%2==0){
                    $serie = $series->random();
                    $video->serie_id = $serie->id;
                    $video->serie()->associate($serie);
                    $video->save();
                }
            });
    }

    protected function getThumb(){
        return new \Illuminate\Support\Collection([
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/thumbs/thumb_ge.png'),
                'thumb_ge.png'
            ),
        ]);
    }

    protected function getVideo(){
        return new \Illuminate\Support\Collection([
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/videos/video_teste.mp4'),
                'video_teste.mp4'
            ),
        ]);
    }
}

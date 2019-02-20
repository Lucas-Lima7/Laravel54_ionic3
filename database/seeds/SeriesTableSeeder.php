<?php

use DeskFlix\Models\Serie;
use DeskFlix\Repositories\SerieRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Collection $series */
        $series = factory(Serie::class, 5)->create();
        $repository = app(SerieRepository::class);
        $collectionThumbs = $this->getThumb();
        $series->each(function ($serie) use($repository, $collectionThumbs){
            $repository->uploadThumb($serie->id, $collectionThumbs->random());
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
}

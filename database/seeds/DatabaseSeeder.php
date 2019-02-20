<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rootPath = config('filesystems.disks.videos_local.root');
        \File::deleteDirectory($rootPath, true); //vai excluir tudo oq tiver dentro de videos_test

        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SeriesTableSeeder::class);
        $this->call(VideosTableSeeder::class);
    }
}

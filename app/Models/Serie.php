<?php

namespace DeskFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use DeskFlix\Media\SeriePaths;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model implements TableInterface
{
    use SeriePaths;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'thumb'];

    public function getTableHeaders()
    {
        return ['#'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
        }
    }
}

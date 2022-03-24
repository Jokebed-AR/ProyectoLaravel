<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UpdateMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:media';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para actualizar los archivos media';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $medias = Media::all();
        foreach ($medias as $media) {
            $media->conversions_disk = $media->disk;
            if ($media->uuid == null)
                $media->uuid = Str::uuid();
            $media->update();
        }

        return "Media actualizado";
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Photo;
USE App\Http\Controllers\PhotoController;


class SyncPhotos extends Command
{
 
    protected $signature = 'app:sync-photos';
    protected $description = 'Sincronizar las fotos de la API en nuestra base de datos';

    public function handle()
    {
        $photoController = new PhotoController();
        $photoController->syncPhotos();

        $this->info('Datos sincronizados exitosamente');
    }
}

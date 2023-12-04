<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Photo;


class PhotoController extends Controller
{
    public function syncPhotos()
    {
        try {
            $response = Http::retry(5)->timeout(10)->get('https://jsonplaceholder.typicode.com/photos');
          } catch (Exception $e) {
            abort(500, 'Hubo un error al conectar con la API externa');
          }

        $photos = $response->json();
        foreach ($photos as $photo) {
            if (!is_int($photo['id'])) {
                throw new Exception('El campo `id` debe ser un número entero');
            }
            if (!filter_var($photo['url'], FILTER_VALIDATE_URL)) {
                throw new Exception('El campo `url` no es una URL válida');
            }
        }

        foreach ($photos as $photo) {
            Photo::create([
                'albumId' => $photo['albumId'],
                'id' => $photo['id'],
                'title' => $photo['title'],
                'url' => $photo['url'],
                'thumbnailUrl' => $photo['thumbnailUrl'],
            ]);
        }

        
        return response()->json(['message' => 'Datos sincronizados exitosamente'], 200);

    }
}
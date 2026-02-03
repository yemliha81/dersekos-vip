<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class SeederController extends Controller
{
    public function runStudentSeeder(Request $request)
    {
        

        // Basit güvenlik anahtarı
        if ($request->get('key') !== 'secret123') {
            abort(403, 'Yetkisiz erişim.');
        }

        Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\StudentSeeder'
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'StudentSeeder başarıyla çalıştırıldı'
        ]);
    }
}

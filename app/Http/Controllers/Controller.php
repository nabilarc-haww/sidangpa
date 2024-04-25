<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Deklarasikan properti untuk URL endpoint dan API key Supabase sebagai variabel global
    protected $supabaseUrl;
    protected $supabaseApiKey;

    // Konstruktor untuk menginisialisasi nilai properti
    public function __construct()
    {
        $this->supabaseUrl = 'https://ihpqktbogxquohofeevj.supabase.co';
        $this->supabaseApiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImlocHFrdGJvZ3hxdW9ob2ZlZXZqIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MTM2MjMxOTQsImV4cCI6MjAyOTE5OTE5NH0.Evc1UjzoodkQvz2WAbJsN_Ui6w4dRz8-mPyAeo97_Yc';
    }
}

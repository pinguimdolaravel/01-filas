<?php

use Illuminate\Bus\BatchRepository;
use Illuminate\Support\Facades\Route;

Route::get('/', function (BatchRepository $batchRepository) {
    return view('welcome', [
        'batches' => $batchRepository->get(),
    ]);
});

<?php

use App\Jobs\MakeOrder;
use App\Jobs\RunPayment;
use App\Jobs\SendNotificationsJob;
use App\Jobs\ValidateCard;
use Illuminate\Bus\BatchRepository;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;

Route::get('/', function (BatchRepository $batchRepository) {
    return view('welcome', [
        'batches' => $batchRepository->get(),
    ]);
});

Route::get('send-notification-to-all', function () {
    SendNotificationsJob::dispatch();

    return redirect('/');
});

Route::get('run-batch', function () {
    Bus::batch([
        new MakeOrder,
        new ValidateCard,
        new RunPayment
    ])
    ->name('Run Batch Example ' . rand(1, 10))
    ->dispatch();

    return redirect('/');
});

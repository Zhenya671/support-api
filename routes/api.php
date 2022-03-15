<?php

use App\Http\Controllers\Api\Messages\SupportResponseController;
use App\Http\Controllers\Api\Messages\UserRequestController;
use App\Http\Controllers\Api\Support\Status\TicketStatusController;
use App\Http\Controllers\Api\Support\SupportController;
use App\Http\Controllers\Api\User\TicketController;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::apiResource('/ticket', TicketController::class)
            ->only([
                'index', 'show', 'store',
            ]);
        Route::prefix('ticket/{id}/request')
            ->group(function () {
                Route::post('/', [UserRequestController::class, 'sendMessage']);
            });
        Route::middleware('support.permission')
            ->prefix('/support')
            ->group(function () {
                Route::apiResource('/ticket', SupportController::class)
                    ->only([
                        'index', 'show',
                    ])->name('show', 'show.ticket');
                Route::prefix('/ticket/{id}/change-status-to')->group(function () {
                    Route::patch('/open', [TicketStatusController::class, 'changeStatus']);
                    Route::patch('/in-process', [TicketStatusController::class, 'changeStatus']);
                    Route::patch('/closed', [TicketStatusController::class, 'changeStatus']);
                });
                Route::post('/ticket/{id}/response', [SupportResponseController::class, 'sendMessage']);
            });
    });

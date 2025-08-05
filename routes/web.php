<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('home');
})->name('home');

Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');
Route::post('/artists', [ArtistController::class, 'create'])->name('artist.create');
Route::delete('/artists/{id}', [ArtistController::class, 'delete'])->name('artist.delete');
Route::patch('/artists/{id}', [ArtistController::class, 'update'])->name('artist.update');


Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
Route::post('/songs', [SongController::class, 'create'])->name('song.create');
Route::delete('/songs/{id}', [SongController::class, 'delete'])->name('song.delete');
Route::patch('/songs/{id}', [SongController::class, 'update'])->name('song.update');

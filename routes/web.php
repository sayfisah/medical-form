<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\FormSelector;
use Illuminate\Support\Str;

Route::get('/', FormSelector::class);

// Dynamic route to auto-map to Livewire form component
Route::get('/form/{formName}', function ($formName) {
    // Convert the formName (e.g., 'f1-apd-commence') to a class name (e.g., 'F1ApdCommence')
    $className = 'App\\Livewire\\Forms\\' . Str::studly(str_replace('-', '_', $formName));

    if (!class_exists($className)) {
        abort(404, 'Form component not found: ' . $className);
    }

    return app()->call($className);

    
});



<?php

namespace App\Providers;

use Filament\Forms\Form;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Form::configureUsing(function (Form $form) {
            $form->extraAttributes([
                'lang' => 'en'
            ]);
        });

        TextColumn::configureUsing(function (Column $column) {
            $column->extraAttributes([
                'lang' => 'en'
            ]);
        });

    }
}

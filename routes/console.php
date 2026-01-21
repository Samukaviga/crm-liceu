<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('analytics-template-colegio-itaqua')
    ->timezone('America/Sao_Paulo')
    ->everyMinute()
    // ->everyThreeHours()
    // ->hourly()
    ->onOneServer()
    ->runInBackground();

Schedule::command('analytics-template-doremi')
    ->timezone('America/Sao_Paulo')
    ->everyMinute()
    // ->everyThreeHours()
    // ->hourly()
    ->onOneServer()
    ->runInBackground();

Schedule::command('analytics-template-fisk-itaqua')
    ->timezone('America/Sao_Paulo')
    ->everyMinute()
    // ->everyThreeHours()
    // ->hourly()
    ->onOneServer()
    ->runInBackground();

Schedule::command('analytics-template-fisk-suzano')
    ->timezone('America/Sao_Paulo')
    ->everyMinute()
    // ->everyThreeHours()
    // ->hourly()
    ->onOneServer()
    ->runInBackground();

Schedule::command('analytics-template-liceu-aruja')
    ->timezone('America/Sao_Paulo')
    ->everyMinute()
    // ->everyThreeHours()
    // ->hourly()
    ->onOneServer()
    ->runInBackground();

Schedule::command('analytics-template-liceu-itaqua')
    ->timezone('America/Sao_Paulo')
    ->everyMinute()
    // ->everyThreeHours()
    // ->hourly()
    ->onOneServer()
    ->runInBackground();

Schedule::command('analytics-template-liceu-suzano')
    ->timezone('America/Sao_Paulo')
    ->everyMinute()
    // ->everyThreeHours()
    // ->hourly()
    ->onOneServer()
    ->runInBackground();

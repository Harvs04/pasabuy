<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    DB::table('users')
        ->where('pasabuy_points', '<', 100)
        ->increment('pasabuy_points', 1);
})->dailyAt('14:00')->timezone('Asia/Manila');


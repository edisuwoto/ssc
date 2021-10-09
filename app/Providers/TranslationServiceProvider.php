<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (DB::connection()->getDatabaseName() != ''){
            if (Schema::hasTable('sm_languages')){
                if (is_null(app('general_settings')->get('chat_language_cache'))){
                    Cache::forget('translations');
                    app('general_settings')->put('chat_language_cache','cached');
                }
                Cache::remember('translations', Carbon::now()->addHours(6),function () {
                    return $this->getTranslations();
                });
            }
        }
    }


    public function getTranslations()
    {
        $translations = collect();

        $ln = DB::table('sm_languages')->pluck('language_universal')->toArray();
        foreach ($ln as $locale) {
            $translations[$locale] = [
                'json' => $this->jsonTranslations($locale),
            ];
        }
        return $translations;
    }

    private function phpTranslations($locale)
    {
        $path = resource_path("lang/$locale");

        return collect(File::allFiles($path))->flatMap(function ($file) use ($locale) {
            $key = ($translation = $file->getBasename('.php'));

            return [$key => trans($translation, [], $locale)];
        });
    }

    private function jsonTranslations($locale)
    {
        $path = resource_path("lang/$locale/$locale.json");

        if (is_string($path) && is_readable($path)) {
            return json_decode(file_get_contents($path), true);
        }

        return [];
    }
}
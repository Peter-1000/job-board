<?php

namespace App\Providers;

use App\Repositories\IAttributeRepository;
use App\Repositories\ICategoryRepository;
use App\Repositories\ICityRepository;
use App\Repositories\ICountryRepository;
use App\Repositories\Implementations\AttributeRepository;
use App\Repositories\Implementations\CategoryRepository;
use App\Repositories\Implementations\CityRepository;
use App\Repositories\Implementations\CountryRepository;
use App\Repositories\Implementations\LanguageRepository;
use App\Repositories\Implementations\OurJobRepository;
use App\Repositories\Implementations\StateRepository;
use App\Repositories\ILanguageRepository;
use App\Repositories\IOurJobRepository;
use App\Repositories\IStateRepository;
use App\Services\IAttributeServices;
use App\Services\ICategoryServices;
use App\Services\ICityServices;
use App\Services\ICountryServices;
use App\Services\ILanguageServices;
use App\Services\Implementations\AttributeService;
use App\Services\Implementations\CategoryService;
use App\Services\Implementations\CityService;
use App\Services\Implementations\CountryService;
use App\Services\Implementations\LanguageService;
use App\Services\Implementations\OurJobService;
use App\Services\Implementations\StateService;
use App\Services\IOurJobServices;
use App\Services\IStateServices;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(ICityRepository::class, CityRepository::class);
        $this->app->bind(ICountryRepository::class, CountryRepository::class);
        $this->app->bind(ILanguageRepository::class, LanguageRepository::class);
        $this->app->bind(IOurJobRepository::class, OurJobRepository::class);
        $this->app->bind(IStateRepository::class, StateRepository::class);
        $this->app->bind(IAttributeRepository::class, AttributeRepository::class);

        $this->app->bind(ICategoryServices::class, CategoryService::class);
        $this->app->bind(ICityServices::class, CityService::class);
        $this->app->bind(ICountryServices::class, CountryService::class);
        $this->app->bind(ILanguageServices::class, LanguageService::class);
        $this->app->bind(IOurJobServices::class, OurJobService::class);
        $this->app->bind(IStateServices::class, StateService::class);
        $this->app->bind(IAttributeServices::class, AttributeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}

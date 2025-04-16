<?php

namespace App\Providers;

use App\Models\House;
use App\Policies\HousePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
// use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        House::class => HousePolicy::class, // تأكد من أن السياسة مسجلة بشكل صحيح هنا
        // يمكن إضافة المزيد من السياسات هنا إذا لزم الأمر
    ];
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
        $this->registerPolicies();


        RateLimiter::for('uploads', function (Request $request) {
            return $request->user() ? Limit::perMinute(100)->by($request->user()->id) : Limit::perMinute(10)->by($request->ip());
        });
    }
}

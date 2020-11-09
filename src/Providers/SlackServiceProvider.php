<?php

namespace Slack\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\ChannelManager;
use Slack\Services\Slack;
use Slack\Notifications\Channels;

class SlackServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/slack.php' => config_path('slack.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Slack\Services\Slack', function ($app) {
            return new Slack();
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('slack-bot', function ($app) {
                return new Channels\SlackBotChannel();
            });
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('slack-webhook', function ($app) {
                return new Channels\SlackWebhookChannel();
            });
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Slack::class];
    }
}

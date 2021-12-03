<?php

namespace Slack\Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\ChannelManager;

use Slack\Laravel\Console\Commands\SlackMessageMakeCommand;
use Slack\Laravel\Console\Commands\SlackViewMakeCommand;
use Slack\Laravel\Services\Slack;
use Slack\Laravel\Notifications\Channels;

/**
 * Class SlackServiceProvider
 *
 * @package Slack\Laravel\Providers
 */
class SlackServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerConfiguration();
        $this->registerCommands();
    }

    /**
     * Register the configuration files of the service.
     */
    private function registerConfiguration()
    {
        if ($this->app->runningInConsole())
        {
            $this->publishes([
                __DIR__.'/../../config/slack.php' => config_path('slack.php'),
            ]);
        }
    }

    /**
     * Register the console commands of the service.
     */
    private function registerCommands()
    {
        if ($this->app->runningInConsole())
        {
            $this->commands([
                SlackMessageMakeCommand::class,
                SlackViewMakeCommand::class
            ]);
        }
    }

    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('Slack\Laravel\Services\Slack', function () {
            return new Slack();
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('slack-bot', function () {
                return new Channels\SlackBotChannel();
            });
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('slack-webhook', function () {
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

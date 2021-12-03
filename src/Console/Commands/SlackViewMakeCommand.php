<?php

namespace Slack\Laravel\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class SlackViewMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:slack-view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new SlackView implementation.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'SlackView';

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle() : bool|null
    {
        if (!$this->option('modal') && !$this->option('home-tab'))
        {
            $this->error('You must specify the type of the view.');
            $this->info('--modal: Create a Modal view');
            $this->info('--home-tab: Create an HomeTab view');
            return false;
        }
        else if ($this->option('modal') && $this->option('home-tab'))
        {
            $this->error('View cannot be of multiple types.');
            return false;
        }

        return parent::handle();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub() : string
    {
        return __DIR__.'/stubs/SlackView.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace) : string
    {
        if ($this->option('modal'))
            return $rootNamespace.'\Slack\Views\Modals';
        else if ($this->option('home-tab'))
            return $rootNamespace.'\Slack\Views\HomeTabs';

        return $rootNamespace.'\Slack\Views';
    }

    /**
     * Build the class with the given name.
     * Remove the base controller import if we are already in base namespace.
     *
     * @param string $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name) : string
    {
        if ($this->option('modal'))
        {
            return str_replace(
                '{{ type }}',
                'SlackView::Modal',
                parent::buildClass($name)
            );
        }
        else if ($this->option('home-tab'))
        {
            return str_replace(
                '{{ type }}',
                'SlackView::HomeTab',
                parent::buildClass($name)
            );
        }

        return 0;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() : array
    {
        return [
            ['modal', null, InputOption::VALUE_NONE, 'Set the view as a Modal view'],
            ['home-tab', null, InputOption::VALUE_NONE, 'Set the view as a Home Tab view'],
        ];
    }

}

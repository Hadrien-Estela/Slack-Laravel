<?php

namespace Slack\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class SlackMessageMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:slack-message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new SlackMessage implementation.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'SlackMessage';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/SlackMessage.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Slack\Messages';
    }

}

<?php

namespace Slack\Http\Middleware;

use Closure;
use Exception;

use GetOpt\GetOpt;
use GetOpt\Option;
use GetOpt\ArgumentException;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

use Slack\Objects\SlackMessage;


abstract class SlackCommand
{
    /**
     * Handle a slash command from slack
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Auth the user if exists.
        $this->authenticateUser($request->input('user_id'));

        // Create GetOpt instance.
        $opt = new GetOpt(null, [GetOpt::SETTING_STRICT_OPERANDS => true]);
        $opt->getHelp()->setUsageTemplate($this->usageTemplatePath());
        $opt->getHelp()->setOptionsTemplate($this->optionsTemplatePath());
        $opt->getHelp()->setCommandsTemplate($this->commandsTemplatePath());

        // Add the payload to the Request instance.
        $request->merge([
            'command' => $opt
        ]);

        // Get command options if available.
        if (method_exists(Route::current()->getController(),$method = 'commandOptionsFor'.Str::studly(Route::current()->getActionMethod())))
        {
            // Retreive options.
            Route::current()->getController()->{$method}($opt);

            // Add help option by default
            $opt->addOption( (new Option('h', 'help'))
                ->setDescription('Display command help'));
        }

        // Process the input text provided with the slash command.
        try
        {
            $opt->process($request->input('text'));
        }
        catch (ArgumentException $e)
        {
            // Return help if validation not passed
            return new SlackMessage($e->getMessage().PHP_EOL.PHP_EOL.$opt->getHelpText());
        }

        // Display Help if option --help found
        if ($opt['help'])
        {
            if (method_exists(Route::current()->getController(),$method = 'helpFor'.Str::studly(Route::current()->getActionMethod())))
                return Route::current()->getController()->{$method}($request);
            else
                return new SlackMessage($opt->getHelpText());
        }

        // Treat command if exists
        if ($opt->getCommand())
        {
            $callable = $opt->getCommand()->getHandler();

            // Call the command action
            if (is_callable($callable))
                return call_user_func($callable, $request);
        }

        return $next($request);
    }

    /**
     * Authenticate the user to your app using its slack ID.
     *
     * @param  string   $slack_user_id
     */
    abstract protected function authenticateUser(string $slack_user_id);

    /**
     * Return the usage template path.
     * http://getopt-php.github.io/getopt-php/help.html
     *
     * @return string|null
     */
    protected function usageTemplatePath()
    {
        return null; // use the default GetOpt template
    }

    /**
     * Return the options template path.
     * http://getopt-php.github.io/getopt-php/help.html
     *
     * @return string|null
     */
    protected function optionsTemplatePath()
    {
        return null; // use the default GetOpt template
    }

    /**
     * Return the commands template path.
     * http://getopt-php.github.io/getopt-php/help.html
     *
     * @return string|null
     */
    protected function commandsTemplatePath()
    {
        return null; // use the default GetOpt template
    }

}

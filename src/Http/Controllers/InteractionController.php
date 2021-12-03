<?php

namespace Slack\Laravel\Http\Controllers;

use BadFunctionCallException;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Abstract class as a base to handle slack interactions incoming requests.
 * @link(https://api.slack.com/interactivity/handling, more)
 */
abstract class InteractionController extends Controller
{

    /**
     * Array of actions associated to view submission action.
     *
     * @var array
     */
    protected $view_submission_callback_actions = [
        // 'callback_id' => [MyClass::class, 'myMethod']
        // ...
    ];

    /**
     * Array of actions associated to view closed action.
     *
     * @var array
     */
    protected $view_closed_callback_actions = [
        // 'callback_id' => [MyClass::class, 'myMethod']
        // ...
    ];

    /**
     * Array of actions associated to block actions.
     *
     * @var array
     */
    protected $block_actions_callback_actions = [
        // 'callback_id' => [MyClass::class, 'myMethod']
        // ...
    ];

    /**
     * Array of actions associated to block suggestions.
     *
     * @var array
     */
    protected $block_suggestions_callback_actions = [
        // 'callback_id' => [MyClass::class, 'myMethod']
        // ...
    ];

    /**
     * Array of actions associated to block suggestions.
     *
     * @var array
     */
    protected $shortcut_callback_actions = [
        // 'callback_id' => [MyClass::class, 'myMethod']
        // ...
    ];

    /**
     * Handle the interaction request.
     *
     * @link(https://api.slack.com/reference/interaction-payloads/block-actions, more)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|null
     * @throws \Exception
     */
    public function index(Request $request)
    {
        // In case the SlackInteraction middleware has already replaced the input string by an object.
        if (is_object($request->input('payload')))
            $payload = $request->input('payload');
        else
            $payload = json_decode($request->input('payload'));

        switch ($payload->type)
        {
            case 'block_actions':
                $this->blockActions($request, $payload->actions);
                break;

            case 'block_suggestion':
                return $this->blockSuggestions($request, $payload->action_id);

            case 'view_submission':
                return $this->viewAction($request, $payload->view, $this->view_submission_callback_actions);

            case 'view_closed':
                return $this->viewAction($request, $payload->view, $this->view_closed_callback_actions);

            case 'shortcut':
                return $this->shortcut($request, $payload->callback_id);

            // case 'message_action':

            //     break;

            default:
                throw new Exception("Not implemented action type: $payload->type");
        }
    }

    /**
     * Call the associated view callback action.
     *
     * @param \Illuminate\Http\Request $request
     * @param Object $view
     * @param array $callback_actions_arr
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    private function viewAction(Request $request, Object $view, array $callback_actions_arr)
    {
        if (array_key_exists($view->callback_id, $callback_actions_arr))
        {
            $callable = $callback_actions_arr[$view->callback_id];
            if (is_callable($callable))
            {
                $controller = new $callable[0];
                $method = $callable[1];
                return call_user_func(array($controller,$method), $request, $view);
            }
            else
                throw new BadFunctionCallException('Non callable `view` callback.');
        }
        else
            throw new Exception("Not implemented `view` callback: $view->callback_id");
    }

    /**
     * Call method associated with action.
     *
     * @param \Illuminate\Http\Request $request
     * @param  array $actions
     */
    private function blockActions(Request $request, array $actions)
    {
        foreach ($actions as $action)
        {
            if (array_key_exists($action->action_id, $this->block_actions_callback_actions))
            {
                $callable = $this->block_actions_callback_actions[$action->action_id];
                if (is_callable($callable))
                {
                    $controller = new $callable[0];
                    $method = $callable[1];
                    call_user_func(array($controller,$method), $request, $action);
                }
                else
                    throw new BadFunctionCallException('Non callable `block_action` callback.');
            }
            // else
            //     throw new Exception("Not implemented `block_action` callback: $action->action_id");
        }
    }

    /**
     * Return the options suggestion.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $action_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    private function blockSuggestions(Request $request, string $action_id)
    {
        if (array_key_exists($action_id, $this->block_suggestions_callback_actions))
        {
            $callable = $this->block_suggestions_callback_actions[$action_id];
            if (is_callable($callable))
            {
                $controller = new $callable[0];
                $method = $callable[1];
                return call_user_func(array($controller,$method), $request);
            }
            else
                throw new BadFunctionCallException('Non callable `block_suggestion` callback.');
        }
        else
            throw new Exception("Not implemented `block_suggestion` callback: $action_id");
    }


    private function shortcut(Request $request, string $callback_id)
    {
        if (array_key_exists($callback_id, $this->shortcut_callback_actions))
        {
            $callable = $this->shortcut_callback_actions[$callback_id];
            if (is_callable($callable))
            {
                $controller = new $callable[0];
                $method = $callable[1];
                return call_user_func(array($controller,$method), $request);
            }
            else
                throw new BadFunctionCallException('Non callable `shortcut` callback.');
        }
        else
            throw new Exception("Not implemented `shortcut` callback: $callback_id");
    }

}

<?php

namespace Slack\Laravel\Objects\BlockElements\SelectMenu;

use Slack\Laravel\Objects\BlockElements\Menu;

/**
 * A select menu, just as with a standard HTML <select> tag,
 * creates a drop down menu with a list of options for a user to choose.
 * The select menu also includes type-ahead functionality,
 * where a user can type a part or all of an option string to filter the list.
 * @link(https://api.slack.com/reference/block-kit/block-elements#select, more)
 *
 * @package Slack\Laravel\Objects\BlockElements\SelectMenu
 */
abstract class SelectMenu extends Menu
{

    protected const Static = 'static_select';
    protected const External = 'external_select';
    protected const User = 'users_select';
    protected const Conversation = 'conversations_select';
    protected const Channel = 'channels_select';

}

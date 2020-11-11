<?php

namespace Slack\Objects\BlockElements\SelectMenu;

use Slack\Objects\BlockElements\Menu;

/**
 * A select menu, just as with a standard HTML <select> tag,
 * creates a drop down menu with a list of options for a user to choose.
 * The select menu also includes type-ahead functionality,
 * where a user can type a part or all of an option string to filter the list.
 *
 * @link(https://api.slack.com/reference/block-kit/block-elements#select, more)
 */
abstract class SelectMenu extends Menu
{

    const Static = 'static_select';
    const External = 'external_select';
    const User = 'users_select';
    const Conversation = 'conversations_select';
    const Channel = 'channels_select';

}

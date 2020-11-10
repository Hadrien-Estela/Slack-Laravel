# Changelog

[UNRELEASED]

* Fix `Slack\Objects\BlockElements\SelectMenu\StaticSelect`
  Contruct now takes a single option as `initial_option`.
* `Slack\Objects\Blocks\ActionBlock` can now take an array of elements in contructor.
* Fix `Slack\Http\Controllers\InteractionController` block_suggestions.
* Fix missing user authentication in `Slack\Http\Middleware\SlackCommand`.
* Improve `Slack\Helpers\View`.

## [1.1.0] - 2020-11-10

* Add abstract class `Slack\Http\Middleware\SlackInteraction`.
  This class provides a way to handle a slack interaction payload and authenticate the user.
* Add abstract class `Slack\Http\Middleware\SlackCommand`.
  This class provides a way to handle a slack command using GetOpt and authenticate the user.
* Add abstract class `Slack\Http\Controllers\InteractionController`.
  This class provides a way to handle interaction hand dispatch them to your application using callbacks.
* `slack_response_action()` helper method can now be used to respond to block_suggestion by calling `slack_response_action()->options($options_array)`;

## [1.0.0] - 2020-11-09

* Api Methods
  - users.lookupByEmail
  - users.profile.get
  - chat.postMessage
  - views.open
  - views.update
  - views.push
  - views.publish
* Serializable objects for messaging
  - Blocks
  - BlockElements
  - CompositionObjects 
  - SlackMessage
  - SlackView
* Notifications channels
  - slack-bot
  - slack-webhook
* Add generator commands
  - slack-message
  - slack-view

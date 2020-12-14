# Changelog

## [1.2.6] - 2020-12-14

* Add `files.list` API method to service class as `listFiles()`.
* Add `files.delete` API method to service class as `deleteFiles()`.

## [1.2.5] - 2020-11-24

* Add `deleteMessage` method to Slack service
* Fix `initial_options` name collision in `\Slack\Objects\BlockElements\Concerns\HasOptions`
* Add extra constructor parameters to `\Slack\Objects\Blocks\SectionBlock`

## [1.2.4] - 2020-11-19

* Bunch of Fixes
* Bunch of Doc Improvements

## [1.2.3] - 2020-11-18

* Clean unused imports
* Various Fixes

## [1.2.2] - 2020-11-17

* Modify `use \App\Http\Controller` to `use \Illuminate\Routing\Controller`

## [1.2.1] - 2020-11-15

* Add max string parameter length checks.

## [1.2.0] - 2020-11-15

* `Slack\Helpers\View::encode_metadata()` helper method.

## [1.1.1] - 2020-11-11

* Fix `Slack\Objects\BlockElements\SelectMenu\StaticSelect`
  Construct now takes a single option as `initial_option`.
* `Slack\Objects\Blocks\ActionBlock` constructor can now take an array of elements.
* Fix `Slack\Http\Controllers\InteractionController` block_suggestions.
* Fix missing user authentication in `Slack\Http\Middleware\SlackCommand`.
* Improve `Slack\Helpers\View`.
* Generate documentation.

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

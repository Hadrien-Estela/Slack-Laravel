# Changelog

## [Unreleased]

* Add abstract class \Slack\Http\Middleware\SlackInteraction.
  This class provides a way to handle a slack interaction payload and authenticate the user.
* Add abstract class \Slack\Http\Middleware\SlackCommand.
  This class provides a way to handle a slack command using GetOpt and authenticate the user.

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

<?php

namespace Drupal\preethy_exercise\Event;

// Base class.
use Drupal\Component\EventDispatcher\Event;
// Used to get user details.
use Drupal\user\UserInterface;

/**
 * Event that is fired when a user logs in.
 */
class UserLoginEvent extends Event {

  // This makes it easier for subscribers to reliably use our event name.
  const EVENT_NAME = 'preethy_exercise_user_login';

  /**
   * The user account.
   *
   * @var \Drupal\user\UserInterface
   */
  public $account;

  /**
   * Constructs the object.
   *
   * @param \Drupal\user\UserInterface $account
   *   The account of the user logged in.
   */
  public function __construct(UserInterface $account) {
    // Returns user account.
    $this->account = $account;
  }

}

<?php

namespace Drupal\preethy_exercise\Event; //name space for user login event

use Drupal\Component\EventDispatcher\Event; // base class
use Drupal\user\UserInterface; //used to get user details

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
    $this->account = $account; //returns user account
  }

}

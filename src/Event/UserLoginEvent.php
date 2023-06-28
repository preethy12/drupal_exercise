<?php

namespace Drupal\preethy_exercise\Event;

// Included the class name event.
use Drupal\Component\EventDispatcher\Event;
use Drupal\user\UserInterface;

/**
 * Event that is triggered when a user logs in.
 */
class UserLoginEvent extends Event {
  // Name of the event.The event get dispatched.
  // When the user get logged in into the system.
  const EVENT_NAME = 'preethy_exercise_user_login';

  /**
   * The user account.
   *
   * @var \Drupal\user\UserInterface
   *   This is the user interface.
   */
  public $account;

  /**
   * Constructs the object.
   *
   * @param \Drupal\user\UserInterface $account
   *   The account of the user logged in.
   */

  /**
   * Defining a new variable that will call account.
   */

  /**
   * Which will hold current users objects.
   */
  public function __construct(UserInterface $account) {

    $this->account = $account;
  }

}

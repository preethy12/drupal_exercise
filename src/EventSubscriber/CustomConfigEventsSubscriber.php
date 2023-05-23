<?php

namespace Drupal\preethy_exercise\EventSubscriber;

use Drupal\preethy_exercise\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UserLoginSubscriber.
 *
 * @package Drupal\preethy_exercise\EventSubscriber
 */
class CustomConfigEventsSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      /* Static class constant => method on this class. */
      UserLoginEvent::EVENT_NAME => 'onUserLogin',
    ];
  }

  /**
   * Subscribe to the user login event dispatched.
   *
   * @param \Drupal\preethy_exercise\Event\UserLoginEvent $event
   *   Our custom event object.
   */
  public function onUserLogin(UserLoginEvent $event) {
  /* Database is initialized.*/
    $database = \Drupal::database();
    //formatstimestamp into date time
    $dateFormatter = \Drupal::service('date.formatter');

    //fetching user data
    $account_created = $database->select('users_field_data', 'ud')
      ->fields('ud', ['created'])
      ->condition('ud.uid', $event->account->id())
      ->execute()
      ->fetchField();

    \Drupal::messenger()->addStatus(t('Welcome, your account was created on %created_date.', [ '%created_date' => $dateFormatter->format($account_created, 'short'),]));
  }

}

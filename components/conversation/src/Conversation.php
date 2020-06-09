<?php

namespace Saber\Conversation;

class Conversation {

  public function __construct() {

    require_once( SABER_PATH . 'components/Conversation/src/models/conversation.php' );

    add_action('init', [$this, 'registerPostTypes']);
    add_action('init', [$this, 'registerFields']);

  }

  public function registerPostTypes() {

    require_once( SABER_PATH . 'components/conversation/src/cpt/ConversationPostType.php' );
    $pt = new ConversationPostType();
    $pt->register();

  }

  public function registerFields() {
    require_once( SABER_PATH . 'components/conversation/assets/fields/fields.php' );
  }

}

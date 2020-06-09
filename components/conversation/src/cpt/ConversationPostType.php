<?php

namespace Saber\Conversation;

class ConversationPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'conversation';
  }

}

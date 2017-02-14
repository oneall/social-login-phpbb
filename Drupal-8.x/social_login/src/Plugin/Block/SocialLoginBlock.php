<?php

namespace Drupal\social_login\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Displays a Social Login block.
 */
class SocialLoginBlock extends BlockBase {

  /**
   * Indicates whether the block should be shown.
   */
  public function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIf($account->isAnonymous());
  }

  /**
   * Display the Social Login Block.
   */
  public function build() {
    return \Drupal::formBuilder()->getForm('Drupal\social_login\Form\SocialLoginBlockForm');
  }

}

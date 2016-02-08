<?php

namespace Drupal\social_login\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'SocialLogin' block.
 *
 * @Block(
 *   id = "social_login_block",
 *   admin_label = @Translation("Social Login"),
 * )
 */
class SocialLoginBlock extends BlockBase {

	/**
	 * {@inheritdoc}
	 */
	public function blockAccess(AccountInterface $account) {
		return AccessResult::allowedIf($account->isAnonymous());
	}

	/**
	 * {@inheritdoc}
	 */
	public function build() {
		return \Drupal::formBuilder()->getForm('Drupal\social_login\Form\SocialLoginBlockForm');
	}
}
?>
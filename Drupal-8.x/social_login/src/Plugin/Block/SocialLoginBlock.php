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
		\Drupal::logger('social_login')->notice('> '. __FUNCTION__ .'@'. __LINE__ .'('. $account->isAnonymous() .')');

		return AccessResult::allowedIf($account->isAnonymous());
	}

	/**
	 * {@inheritdoc}
	 */
	public function build() {
		\Drupal::logger('social_login')->notice('> '. __FUNCTION__ .'@'. __LINE__ .'()');

		return \Drupal::formBuilder()->getForm('Drupal\social_login\Form\SocialLoginBlockForm');
	}
}
?>
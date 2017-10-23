<?php
/**
 * @package   	OneAll Social Login
 * @copyright 	Copyright 2011-2017 http://www.oneall.com
 * @license   	GPL-2.0
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
 *
 * The "GNU General Public License" (GPL) is available at
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */
namespace oneall\sociallogin\migrations\v10x;

/**
 * Migration stage 1: Initial schema changes to the database
 */
class m1_initial_schema extends \phpbb\db\migration\migration
{
	public function update_schema ()
	{
		return array (
			'add_tables' => array (
				$this->table_prefix . 'oasl_identity' => array (
					'COLUMNS' => array (
						'oasl_identity_id' => array (
							'UINT',
							NULL,
							'auto_increment'
						),
						'oasl_user_id' => array (
							'UINT',
							0
						),
						'identity_token' => array (
							'VCHAR:255',
							''
						),
						'identity_provider' => array (
							'VCHAR:255',
							''
						),
						'num_logins' => array (
							'UINT',
							0
						),
						'date_added' => array (
							'TIMESTAMP',
							0
						),
						'date_updated' => array (
							'TIMESTAMP',
							0
						)
					),
					'PRIMARY_KEY' => 'oasl_identity_id',
					'KEYS' => array (
						'oaid' => array (
							'UNIQUE',
							'oasl_identity_id'
						)
					)
				),
				$this->table_prefix . 'oasl_login_token' => array (
					'COLUMNS' => array (
						'oasl_login_token_id' => array (
							'UINT',
							NULL,
							'auto_increment'
						),
						'login_token' => array (
							'VCHAR:255',
							''
						),
						'user_id' => array (
							'UINT',
							0
						),
						'date_creation' => array (
							'TIMESTAMP',
							0
						)
					),
					'PRIMARY_KEY' => 'oasl_login_token_id',
					'KEYS' => array (
						'oatok' => array (
							'UNIQUE',
							'oasl_login_token_id'
						)
					)
				),
				$this->table_prefix . 'oasl_user' => array (
					'COLUMNS' => array (
						'oasl_user_id' => array (
							'UINT',
							NULL,
							'auto_increment'
						),
						'user_id' => array (
							'UINT',
							0
						),
						'user_token' => array (
							'VCHAR:255',
							''
						),
						'date_added' => array (
							'TIMESTAMP',
							0
						)
					),
					'PRIMARY_KEY' => 'oasl_user_id',
					'KEYS' => array (
						'oauid' => array (
							'UNIQUE',
							'oasl_user_id'
						)
					)
				),
				$this->table_prefix . 'oasl_session' => array (
					'COLUMNS' => array (
						'oasl_session_id' => array (
							'UINT',
							NULL,
							'auto_increment'
						),
						'session_id' => array (
							'CHAR:32',
							''
						),
						'user_data' => array (
							'TEXT',
							''
						),
						'date_creation' => array (
							'TIMESTAMP',
							0
						)
					),
					'PRIMARY_KEY' => 'oasl_session_id',
					'KEYS' => array (
						'oases' => array (
							'UNIQUE',
							'oasl_session_id'
						)
					)
				)
			)
		);
	}

	public function revert_schema ()
	{
		return array (
			'drop_tables' => array (
				$this->table_prefix . 'oasl_user',
				$this->table_prefix . 'oasl_login_token',
				$this->table_prefix . 'oasl_identity',
				$this->table_prefix . 'oasl_session'
			)
		);
	}
}

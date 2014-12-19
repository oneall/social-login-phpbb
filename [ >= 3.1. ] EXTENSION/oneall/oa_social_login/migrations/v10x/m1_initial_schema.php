<?php

/**
 * @package   	OneAll Social Login
 * @copyright 	Copyright 2014 http://www.oneall.com - All rights reserved.
 * @license   	GNU/GPL 2 or later
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
namespace oneall\oa_social_login\migrations\v10x;

/**
 * Migration stage 1: Initial schema changes to the database
 */
class m1_initial_schema extends \phpbb\db\migration\migration
{

	/**
	 * Add the oneall column to the users table.
	 *
	 * @return array Array of table schema
	 * @access public
	 */
	public function update_schema ()
	{
		return array (
			'add_tables' => array (
				$this->table_prefix . 'oasl_identity' => array (
					'COLUMNS' => array (
						'oasl_identity_id' => array (
							'INT:10',
							NULL,
							'auto_increment'
						),
						'oasl_user_id' => array (
							'INT:10',
							NULL
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
							'INT:10',
							NULL
						),
						'date_added' => array (
							'INT:10',
							NULL
						),
						'date_updated' => array (
							'INT:10',
							NULL
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
							'INT:10',
							NULL,
							'auto_increment'
						),
						'login_token' => array (
							'VCHAR:255',
							''
						),
						'user_id' => array (
							'INT:10',
							NULL
						),
						'date_creation' => array (
							'INT:10',
							NULL
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
							'INT:10',
							NULL,
							'auto_increment'
						),
						'user_id' => array (
							'INT:10',
							NULL
						),
						'user_token' => array (
							'VCHAR:255',
							''
						),
						'date_added' => array (
							'INT:10',
							NULL
						)
					),
					'PRIMARY_KEY' => 'oasl_user_id',
					'KEYS' => array (
						'oauid' => array (
							'UNIQUE',
							'oasl_user_id'
						)
					)
				)
			)
		);
	}

	/**
	 * Drop the oa_social_login column from the users table.
	 *
	 * @return array Array of table schema
	 * @access public
	 */
	public function revert_schema ()
	{
	}
}

<?php
/**
 * @package       OneAll Social Login
 * @copyright     Copyright 2011-Present http://www.oneall.com
 * @license       GPL-2.0
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
namespace oneall\sociallogin\auth\provider;

/**
 * OneAll authentication provider for phpBB3
 */
class oneall extends \phpbb\auth\provider\db
{
    /**
     * Database Authentication Constructor
     *
     * @param \phpbb\db\driver\driver_interface $db
     */
    public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\passwords\manager $passwords_manager, \phpbb\request\request $request, \phpbb\user $user, \Symfony\Component\DependencyInjection\ContainerInterface $phpbb_container, $phpbb_root_path, $php_ext)
    {
        $this->db = $db;
        $this->config = $config;
        $this->passwords_manager = $passwords_manager;
        $this->request = $request;
        $this->user = $user;
        $this->phpbb_root_path = $phpbb_root_path;
        $this->php_ext = $php_ext;
        $this->phpbb_container = $phpbb_container;
    }

    /**
     * {@inheritdoc}
     */
    public function get_acp_template($new_config)
    {
        return array(
            'TEMPLATE_FILE' => '@oneall_sociallogin/auth_provider_oneall.html',
            'TEMPLATE_VARS' => array(
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function get_login_data()
    {
        $login_data = array(
            'TEMPLATE_FILE' => '@oneall_sociallogin/login_body_oneall.html'
        );

        return $login_data;
    }
}

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
namespace oneall\sociallogin\core;

/**
 * API Result Container
 */
class api_result
{
    // HTTP Code
    private $code = null;

    // HTTP Headers
    private $headers = array();

    // HTTP Data
    private $data = null;

    // HTTP Status
    private $status_is_successfull = null;

    // HTTP Status description
    private $status_description = null;

    // Setter
    public function set_result(Array $result)
    {
        foreach ($result as $key => $data)
        {
            $method_name = 'set_' . $key;
            if (method_exists($this, $method_name))
            {
                $this->{$method_name}($data);
            }
        }
    }

    // Set Code
    public function set_code($code)
    {
        $this->code = $code;
    }

    // Get Code
    public function get_code()
    {
        return $this->code;
    }

    // Set Headers
    public function set_headers($headers)
    {
        $this->headers = $headers;
    }

    // Get Headers
    public function get_headers()
    {
        return $this->headers;
    }

    // Set Data
    public function set_data($data)
    {
        $this->data = $data;
    }

    // Get Data
    public function get_data()
    {
        return $this->data;
    }

    // Set status
    private function set_status($is_successfull, $description)
    {
        $this->status_is_successfull = $is_successfull;
        $this->status_description = $description;
    }

    // Set status success
    public function set_status_success($description = null)
    {
        $this->set_status(true, $description);
    }

    // Set status error
    public function set_status_error($description = null)
    {
        $this->set_status(false, $description);
    }
}

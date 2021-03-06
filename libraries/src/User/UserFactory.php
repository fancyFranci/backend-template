<?php
/**
 * Joomla! Content Management System
 *
 * @copyright  Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\User;

defined('_JEXEC') or die;

use Joomla\Database\DatabaseInterface;

/**
 * Default factory for creating User objects
 *
 * @since  __DEPLOY_VERSION__
 */
class UserFactory implements UserFactoryInterface
{
	/**
	 * The database.
	 *
	 * @var  DatabaseInterface
	 */
	private $db;

	/**
	 * UserFactory constructor.
	 *
	 * @param   DatabaseInterface  $db  The database
	 */
	public function __construct(DatabaseInterface $db)
	{
		$this->db = $db;
	}

	/**
	 * Method to get an instance of a user for the given id.
	 *
	 * @param   int  $id  The id
	 *
	 * @return  User
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function loadUserById(int $id): User
	{
		return new User($id);
	}

	/**
	 * Method to get an instance of a user for the given username.
	 *
	 * @param   string  $username  The username
	 *
	 * @return  User
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function loadUserByUsername(string $username): User
	{
		// Initialise some variables
		$query = $this->db->getQuery(true)
			->select($this->db->quoteName('id'))
			->from($this->db->quoteName('#__users'))
			->where($this->db->quoteName('username') . ' = ' . $this->db->quote($username));
		$query->setLimit(1, 0);
		$this->db->setQuery($query);

		return $this->loadUserById((int) $this->db->loadResult());
	}
}

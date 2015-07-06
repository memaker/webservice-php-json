<?php
/**
 * API class
 * @author Rob
 * @version 2015-06-22
 */

class api
{
	private $db;

	/**
	 * Constructor - open DB connection
	 *
	 * @param none
	 * @return database
	 */
	function __construct()
	{
		$conf = json_decode(file_get_contents('configuration.json'), TRUE);
		$this->db = new mysqli($conf["host"], $conf["user"], $conf["password"], $conf["database"]);
	}

	/**
	 * Destructor - close DB connection
	 *
	 * @param none
	 * @return none
	 */
	function __destruct()
	{
		$this->db->close();
	}

	/**
	 * Get the list of users
	 *
	 * @param none or user id
	 * @return list of data on JSON format
	 */
	function get($params)
	{
		$query = 'SELECT u.id AS id'
		. ', u.username AS username'
		. ', u.realname AS realname'
		. ', u.password AS password'
		. ', u.email AS email'
		. ' FROM user AS u'
		. ($params['id'] == ''? '' : ' WHERE u.id = \'' . $this->db->real_escape_string($params['id']) . '\'')
		. ' ORDER BY u.username'
		;
		$list = array();
		$result = $this->db->query($query);
		while ($row = $result->fetch_assoc())
		{
			$list[] = $row;
		}
		return $list;
	}
}

<?php

include_once 'Destination.php';
include_once 'Tour.php';

class DataContext {

	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $database = 'travel_agency';
	public $defaultLimit = 8;

	private function getConnection()
	{
		$db = new mysqli($this->host, $this->user, $this->password, $this->database);
		$db->set_charset('utf8');
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}

		return $db;
	}

	public function getTours($options = array())
	{
		$db = $this->getConnection();

		$defaults = array(
			/*'page' => null,*/
			'limit' => $this->defaultLimit,
			'offset' => 0,
			'search' => '',
			'published' => 1,
			'destination_id' => '%'
		);
		$options = array_merge($defaults, $options);
				
		if (isset($options['page'])) {
			$limit = $this->defaultLimit;
			$offset = ($options['page'] - 1) * $this->defaultLimit;
		} else {
			$limit = $options['limit'];
			$offset = $options['offset'];
		}
		$search = '%' . $options['search'] . '%';
		$published = $options['published'];
		if (is_array($published)) {
			$published = implode(',', $published);
		}
		$destinationId = $options['destination_id'];
		if (is_array($destinationId)) {
			$destinationId = implode(',', $destinationId);
		}

		$statement = $db->prepare(
				"SELECT * FROM `tours`
			WHERE (`published` IN (?) OR `published` LIKE ?)
			AND (`destination_id` IN (?) OR `destination_id` LIKE ?)
			AND (`name` LIKE ? OR `description` LIKE ? OR `short_description` LIKE ?)
			ORDER BY `published_date` DESC
			LIMIT ? OFFSET ?");
		$statement->bind_param('sssssssii', $published, $published, $destinationId, $destinationId, $search, $search, $search, $limit, $offset);
		$statement->execute();

		$tours = array();
		$tour = new Tour();
		$statement->bind_result($tour->id, $tour->name, $tour->details, $tour->thumbnail, $tour->image, $tour->price, $tour->shortDescription, $tour->description, $tour->destinationId, $tour->published, $tour->publishedDate, $tour->createdDate, $tour->modifiedDate);
		while ($statement->fetch()) {
			$tours[] = unserialize(serialize($tour));
		}

		$statement->close();
		$db->close();

		return $tours;
	}

	public function getCountTours($options = array())
	{
		unset($options['page']);
		$options['offset'] = 0;
		$options['limit'] = PHP_INT_MAX;
		return count($this->getTours($options));
	}

	public function getPageCountTours($options = array())
	{
		return (int) ceil($this->getCountTours($options) / $this->defaultLimit);
	}

	public function getDestinations($options = array())
	{
		$db = $this->getConnection();

		$defaults = array(
			/*'page' => null,*/
			'limit' => $this->defaultLimit,
			'offset' => 0,
			'search' => '',
			'published' => 1,
		);
		$options = array_merge($defaults, $options);

		if (isset($options['page'])) {
			$limit = $this->defaultLimit;
			$offset = ($options['page'] - 1) * $this->defaultLimit;
		} else {
			$limit = $options['limit'];
			$offset = $options['offset'];
		}
		$search = '%' . $options['search'] . '%';
		$published = $options['published'];
		if (is_array($published)) {
			$published = implode(',', $published);
		}

		$statement = $db->prepare(
				"SELECT * FROM `destinations` 
				WHERE `name` LIKE ? OR `description` LIKE ?
				LIMIT ? OFFSET ?");
		$statement->bind_param('ssii', $search, $search, $limit, $offset);
		$statement->execute();

		$destinations = array();
		$destination = new Destination();
		$statement->bind_result($destination->id, $destination->name, $destination->image, $destination->description, $destination->published, $destination->publishedDate, $destination->createdDate, $destination->modifiedDate);
		while ($statement->fetch()) {
			$destinations[] = unserialize(serialize($destination));
		}

		$statement->close();
		$db->close();

		return $destinations;
	}

	public function getDestinationById($id)
	{
		$db = $this->getConnection();

		$statement = $db->prepare(
				"SELECT * FROM `destinations` 
				WHERE `id` = ?
				LIMIT 1 OFFSET 0");
		$statement->bind_param('i', $id);
		$statement->execute();

		$destination = new Destination();
		$statement->bind_result($destination->id, $destination->name, $destination->image, $destination->description, $destination->published, $destination->publishedDate, $destination->createdDate, $destination->modifiedDate);
		if (!$statement->fetch()) {
			$destination = null;
		}

		$statement->close();
		$db->close();

		return $destination;
	}

}

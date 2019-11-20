<?php


include_once('classes.php');




class databaseHelper {

    protected $connection;
	protected $query;
	public $query_count = 0;
	
	public function __construct(/*$dbhost = 'localhost', $dbuser = 'root', $dbpass = '', $dbname = '' /*, $charset = 'utf8' */) {
		$this->connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
		if ($this->connection->connect_error) {
			die('Failed to connect to Database - ' . $this->connection->connect_error);
		}
		// $this->connection->set_charset($charset);
    }
    

    public function _destruct() {
		mysqli_close($this->connection);
	}
	

	/*
		Add a method for creating a user
	*/
	public function registerClient(string $fname, string $lname, string $gender, string $email, string $contact, string $password){
		// first encrypt password with one way encryption
		$password = md5($password);
		$response = $this->query('INSERT INTO `clients` (`fname`, `lname`, `gender`, `email`, `contact`, `password`) 
		VALUES (?, ?, ?, ?, ?, ?)', array($fname, $lname, $gender, $email, $contact, $password))->affectedRows();

		if ($response == 1) {
			return true;
		}
		return false;
	}


	/*
		Add method to check email availablity
	*/
	public function emailUnused(string $email): bool{
		$result = $this->query('SELECT fname FROM clients WHERE email = ?', array($email))->fetchArray();

		if (empty($result)){
			return true;
		}
		return false;
	}


	/**
	 * 
	 */
	public function login(string $email, string $password) {
		// First encrypt the password
		$password = md5($password);
		return $this->query('SELECT * FROM clients WHERE email = ? AND password = ?', array($email, $password))->fetchArray();
	}



    public function getAvailableTimeSlots(string $date, string $booked_service_id) {
		// First convert date from html format to what the MySQL database will expect
		$date = FormHandler::parseHtmlDateToSQL($date);

		return $this->query('SELECT id, label FROM time_slots
							WHERE id NOT IN (
									SELECT time_slot_id FROM bookings
									WHERE booking_date = ? AND service_id = ?)', array($date, $booked_service_id))->fetchAll();
	}
	

	public function getServices() {
		return $this->query('SELECT id, name, price FROM services')->fetchAll();
	}


    /**
	 * This function should create a new booking and return true if the insertion is successful. False otherwise.
	 */
	public function createNewBooking(string $time_slot_id, string $client_id, string $service_id, string $booking_date): bool {
        $booking_date = FormHandler::parseHtmlDateToSQL($booking_date);
		$response = $this->query('INSERT INTO `bookings` (`time_slot_id`, `client_id`, `service_id`, `booking_date`) 
		VALUES (?, ?, ?, ?)', array($time_slot_id, $client_id, $service_id, $booking_date))->affectedRows();

		if ($response == 1) {
			return true;
		}
		return false;
	}
	

	/*
		Add a method for creating a new comment/testimonial
	*/
	public function createTestimonial(string $client_id, string $subject, string $message): bool{
		$response = $this->query('INSERT INTO `testimonials` (`client_id`, `subject`, `message`) 
		VALUES (?, ?, ?)', array($client_id, $subject, $message))->affectedRows();

		if ($response == 1) {
			return true;
		}
		return false;
	}
    

	
    private function query($query) {
		if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
				$types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
					if (is_array($args[$k])) {
						foreach ($args[$k] as $j => &$a) {
							$types .= $this->_gettype($args[$k][$j]);
							$args_ref[] = &$a;
						}
					} else {
	                	$types .= $this->_gettype($args[$k]);
	                    $args_ref[] = &$arg;
					}
                }
				array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
           	if ($this->query->errno) {
				die('Unable to process MySQL query (check your params) - ' . $this->query->error);
           	}
			$this->query_count++;
        } else {
            die('Unable to prepare statement (check your syntax) - ' . $this->connection->error);
        }
		return $this;
    }

	private function fetchAll() {
	    $params = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            $result[] = $r;
        }
        $this->query->close();
		return $result;
	}

	public function fetchArray() {
	    $params = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
		while ($this->query->fetch()) {
			foreach ($row as $key => $val) {
				$result[$key] = $val;
			}
		}
        $this->query->close();
		return $result;
	}
	
	private function numRows() {
		$this->query->store_result();
		return $this->query->num_rows;
	}

	private function close() {
		return $this->connection->close();
	}

	public function affectedRows() {
		return $this->query->affected_rows;
	}

	private function _gettype($var) {
	    if(is_string($var)) return 's';
	    if(is_float($var)) return 'd';
	    if(is_int($var)) return 'i';
	    return 'b';
    }

}

?>
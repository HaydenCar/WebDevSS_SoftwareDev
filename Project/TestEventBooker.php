<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

class EventBookerTest {
    private $pdo;
    private $eventBooker;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->eventBooker = new EventBooker($this->pdo, 1); // Assuming a user ID of 1 for testing
    }

    public function testEventBooking() {
        // Test Case 1: Valid Event ID
        $result = $this->eventBooker->displayEvent(101); // Assuming 101 is a valid event ID
        echo 'Test Case 1 - Expected: Event details displayed, Actual: ' . $result . "\n";

        // Test Case 2: Invalid Event ID
        $result = $this->eventBooker->displayEvent(null);
        echo 'Test Case 2 - Expected: No event specified, Actual: ' . $result . "\n";

        // Test Case 3: Future Date Validation
        $result = $this->eventBooker->checkEventDate('2030-12-31');
        echo 'Test Case 3 - Expected: Valid future date, Actual: ' . $result . "\n";

        // Test Case 4: Past Date Validation
        $result = $this->eventBooker->checkEventDate('2000-01-01');
        echo 'Test Case 4 - Expected: Invalid past date, Actual: ' . $result . "\n";
    }
}

// Modify the EventBooker class to include dummy methods for these tests
class EventBooker {
    private $pdo;
    private $userId;

    public function __construct($pdo, $userId) {
        $this->pdo = $pdo;
        $this->userId = $userId;
    }

    public function displayEvent($eventId) {
        if (!$eventId) {
            return "No event specified";
        }
        // Dummy logic to simulate fetching an event
        if ($eventId == 101) { // Simulate valid event ID
            return "Event details displayed";
        }
        return "Event not found";
    }

    public function checkEventDate($date) {
        // Check if date is in the future
        if (strtotime($date) > time()) {
            return "Valid future date";
        }
        return "Invalid past date";
    }
}

// Assuming $pdo is a PDO object connected to a database
$pdo = new PDO('mysql:host=localhost;dbname=combinedb', 'user', 'password');
$test = new EventBookerTest($pdo);
$test->testEventBooking();
?>

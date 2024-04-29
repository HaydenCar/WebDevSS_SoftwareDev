
<?php
function testUsername($username) {
    if (strlen($username) < 5 || strlen($username) > 15) {
        return "Invalid Username";
    }
    return "Valid Username";
}

function testPassword($password) {
    if (strlen($password) < 4 || strlen($password) > 12) {
        return "Invalid Password";
    }
    return "Valid Password";
}

// Test Cases for Username
echo testUsername("Ibra") . "\n"; // Invalid, less than 5 characters
echo testUsername("Ibra12345") . "\n"; // Valid
echo testUsername("Ibrahim1234567890") . "\n"; // Invalid, more than 15 characters


// Test Cases for Password
echo testPassword("123") . "\n"; // Invalid, less than 4 characters
echo testPassword("1234") . "\n"; // Valid
echo testPassword("1234567890123") . "\n"; // Invalid, more than 12 characters
?>
<?php

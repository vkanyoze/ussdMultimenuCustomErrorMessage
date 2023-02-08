<?php

// Define the menu options for each level
$mainMenu = [
    "1" => "Check Account Balance",
    "2" => "Transfer Funds",
    "3" => "Pay Bills",
    "4" => "Exit"
];

$balanceMenu = [
    "1" => "Check Savings Account Balance",
    "2" => "Check Current Account Balance",
    "3" => "Back"
];

$transferMenu = [
    "1" => "Transfer to another account",
    "2" => "Transfer to a mobile wallet",
    "3" => "Back"
];

$billPaymentMenu = [
    "1" => "Pay Electricity Bill",
    "2" => "Pay Water Bill",
    "3" => "Pay Internet Bill",
    "4" => "Back"
];

// Define the initial level and display the main menu
$level = 1;
displayMenu($mainMenu, $level);

// The main logic for handling the USSD session
while (true) {
    // Read the input from the user
    $input = readInput();

    // Navigate to the previous menu if the user inputs "0"
    if ($input == "0") {
        if ($level > 1) {
            $level--;
        }
        displayMenu(${"menuLevel" . $level}, $level);
        continue;
    }

    // Handle the input based on the current level
    switch ($level) {
        case 1:
            switch ($input) {
                case "1":
                    $level = 2;
                    displayMenu($balanceMenu, $level);
                    break;
                case "2":
                    $level = 3;
                    displayMenu($transferMenu, $level);
                    break;
                case "3":
                    $level = 4;
                    displayMenu($billPaymentMenu, $level);
                    break;
                case "4":
                    exit();
                default:
                    displayError("Invalid option. Please try again.");
            }
            break;
        case 2:
        case 3:
        case 4:
            switch ($input) {
                case "3":
                    $level--;
                    displayMenu(${"menuLevel" . $level}, $level);
                    break;
                default:
                    displayError("Invalid option. Please try again.");
            }
            break;
    }
}

// Function to display the menu options
function displayMenu($menu, $level) {
    echo "LEVEL $level\n\n";
    foreach ($menu as $key => $value) {
        echo "$key. $value\n";
    }
}

// Function to display error messages
function displayError($message) {
    echo "ERROR: $message\n\n";
    displayMenu(${"menuLevel" . $level}, $level);
}

// Function to read the input from the user
function readInput() {
    // This is just a placeholder, you will need to implement the actual logic to read the input from the USSD gateway
    return trim(fgets(STDIN));
}

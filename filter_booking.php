<?php

//include db
include_once("config/database.php");

$employee_name = "";
$event_name = "";
$event_date = "";
$all_booking = array();

//get listing of all booking to display on page load
$booking_qry = "SELECT participation_id, employee_name, employee_email, event_name, 
        participation_fee, event_date, pversion FROM `rexx_bookings`";
//if run query then continue
$booking_result = $conn->query($booking_qry);
if(is_object($booking_result) && $booking_result->num_rows >0){
    while($booking_data = $booking_result->fetch_assoc()){
        $all_booking[] = $booking_data;
    }
}

//print_r($all_booking);exit;

//check if form posted then fetch data as per input
if(isset($_POST['get_bookings'])){

    //print_r($_POST);exit;
    //set filte input variables
    $employee_name = isset($_POST['employee_name']) ? htmlspecialchars($_POST['employee_name']) : '';
    $event_name = isset($_POST['event_name']) ? htmlspecialchars($_POST['event_name']) : '';
    $event_date = isset($_POST['event_date']) ? htmlspecialchars($_POST['event_date']) : '';
    
    $where = "";
    $all_booking = array();
    if(!empty($employee_name)){
        $where .="employee_name LIKE '%".$employee_name."%' AND ";
    }
    if(!empty($event_name)){
        $where .="event_name LIKE '%".$event_name."%' AND ";
    }
    if(!empty($event_date)){
        $where .="event_date LIKE '%".$event_date."%' AND ";
    }

    //trim last AND for proper result
    $where = rtrim($where, " AND ");

    //get booking data based on filter input
    //get bookings data
    if(!empty($where)){
        $filter_booking_qry = "SELECT participation_id, employee_name, employee_email, event_name, 
            participation_fee, event_date, pversion FROM `rexx_bookings`
            WHERE $where";
        //if run query then continue
        $filter_result = $conn->query($filter_booking_qry);
        if(is_object($filter_result) && $filter_result->num_rows >0){
            while($filter_data = $filter_result->fetch_assoc()){
                $all_booking[] = $filter_data;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Booking Data Filter</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include jQuery UI library -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        /* Customize datepicker appearance if needed */
        .ui-datepicker {
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Filter Booking Data</h2>
<!-- set form to allow users to filter booking data -->
<form method="post" name="booking_form" action="">
    <p><label for="keyword">Filter By:</label></p>
    <label for="keyword">Employee Name:</label>
    <input type="text" name="employee_name" id="employee_name" value="<?php echo $employee_name; ?>">
    <label for="keyword">Event Name:</label>
    <input type="text" name="event_name" id="event_name" value="<?php echo $event_name; ?>">
    <label for="event_date">Select Date:</label>
    <input type="text" name="event_date" id="event_date" placeholder="Please select a date" value="<?php echo $event_date; ?>">
    <button type="submit" name="get_bookings">Search Booking</button>
</form>

<table>
<thead>
    <tr>
        <th>Participant ID</th>
        <th>Employee Name</th>
        <th>Employee Email</th>
        <th>Event Name</th>
        <th>Participant Fee</th>
        <th>Event Date</th>
        <th>Version</th>
    </tr>
</thead>
<tbody>
<?php   
    $total_fees = 0;
    if(is_array($all_booking) && count($all_booking) >0) { 
        foreach($all_booking as $val){
            $total_fees += $val['participation_fee'];
         
?>
<tr>
    <td><?php echo $val['participation_id']; ?></td>
    <td><?php echo $val['employee_name']; ?></td>
    <td><?php echo $val['employee_email']; ?></td>
    <td><?php echo $val['event_name']; ?></td>
    <td><?php echo $val['participation_fee']; ?></td>
    <td><?php echo $val['event_date']; ?></td>
    <td><?php echo $val['pversion']; ?></td>
</tr>
<?php } //end foreach
    }//end if bookings has data
?>
<?php if(!empty($total_fees)){ ?>
<tr>
    <td colspan="4"></td>
    <td><strong>Total Participant Fees:</strong> <?php echo $total_fees; ?></td>
    <td colspan="2"></td>
</tr>
<?php } ?>

<?php if(empty($all_booking)){ ?>
<tr style="color:red">
    <td colspan="7">No result found!</td>
</tr>
<?php } ?>
</tbody>
</table>

<script>
    // Initialize the datepicker
    $(document).ready(function() {
        $("#event_date").datepicker({
            dateFormat: 'yy-mm-dd', // Set the date format
            changeMonth: true, // Allow changing months
            changeYear: true, // Allow changing years
            showButtonPanel: true // Show a button panel with Today and Done buttons
        });
    });
</script>
</body>
</html>
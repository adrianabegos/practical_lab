<?php

if (isset($_POST['calculate'])) {

    // Get electricity usage from index.php
    $firstkWh = (float) ($_POST['usage'][0] ?? 0);
    $secondkWh = (float) ($_POST['usage'][1] ?? 0);
    $thirdkWh = (float) ($_POST['usage'][2] ?? 0);
    $fourthkWh = (float) ($_POST['usage'][3] ?? 0);
    $fifthkWh = (float) ($_POST['usage'][4] ?? 0);

    // Validate electricity usage
    if (
        $firstkWh < 0 || $firstkWh > 200 ||
        $secondkWh < 0 || $secondkWh > 100 ||
        $thirdkWh < 0 || $thirdkWh > 300 ||
        $fourthkWh < 0 || $fourthkWh > 300 ||
        $fifthkWh < 0
    ) {
        echo "<p style='color:red;'>Please enter a valid value.</p>";
    } else {

        // Calculate charges
        $charge1 = $firstkWh * 0.218;
        $charge2 = $secondkWh * 0.334;
        $charge3 = $thirdkWh * 0.516;
        $charge4 = $fourthkWh * 0.546;
        $charge5 = $fifthkWh * 0.571;

        // Calculate total electricity consumption
        $totalUsage = $firstkWh + $secondkWh +
            $thirdkWh + $fourthkWh + $fifthkWh;

        // Calculate total charges
        $totalCharges = $charge1 + $charge2 +
            $charge3 + $charge4 + $charge5;

        // Minimum monthly charge: RM3.00
        $totalBill = max(3.00, $totalCharges);

        // Apply 6% SST if consumption exceeds 600 kWh
        if ($totalUsage > 600) {
            $sst = $totalBill * 0.06;
            $totalBill = $totalBill + $sst;
        }

        // Display results
        echo "<h2>Electricity Bill Calculation</h2>";

        echo "The charge for the first 200 kWh: RM " .
            number_format($charge1, 2) . "<br>";

        echo "The charge for the next 100 kWh: RM " .
            number_format($charge2, 2) . "<br>";

        echo "The charge for the next 300 kWh: RM " .
            number_format($charge3, 2) . "<br>";

        echo "The charge for the next 300 kWh: RM " .
            number_format($charge4, 2) . "<br>";

        echo "The charge for usage above 900 kWh: RM " .
            number_format($charge5, 2) . "<br>";

        echo "<br>Total Electricity Consumption: " .
            number_format($totalUsage, 2) . " kWh";

        echo "<h3>Total Electricity Bill: RM " .
            number_format($totalBill, 2) . "</h3>";
    }
}

?>

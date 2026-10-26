
<?php
$conn = new mysqli("localhost", "root", "", "tax_system");

if ($conn->connect_error) {
    die("Database connection failed.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["taxpayer_name"] ?? "");
    $pin = trim($_POST["kra_pin"] ?? "");
    $type = trim($_POST["tax_type"] ?? "");
    $amount = $_POST["amount"] ?? "";
    $method = trim($_POST["payment_method"] ?? "");

    if ($name == "" || $pin == "" || $type == "" ||
        $amount == "" || !is_numeric($amount) ||
        (float)$amount <= 0 || $method == "") {

        $message = "Please fill in all details correctly!";

    } else {
        $receipt = "DEMO-" . strtoupper(bin2hex(random_bytes(5)));

        $sql = "INSERT INTO tax_payments
        (taxpayer_name, kra_pin, tax_type, amount,
         payment_method, receipt_number)
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Database error: " . $conn->error);
        }

        $amount = (float)$amount;

        $stmt->bind_param(
            "sssdss",
            $name,
            $pin,
            $type,
            $amount,
            $method,
            $receipt
        );

        if ($stmt->execute()) {
            $message = "Tax payment record saved successfully! Demo receipt: "
                     . $receipt;
        } else {
            $message = "Unable to save the tax payment record.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Government Tax Payment</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
        }

        .container {
            width: 350px;
            margin: 40px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h2 {
            text-align: center;
            color: green;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            background: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: darkgreen;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Government Tax Payment</h2>

    <form method="POST">
        <label>Taxpayer Name *</label>
        <input type="text" name="taxpayer_name" required>

        <label>KRA PIN *</label>
        <input type="text" name="kra_pin" required>

        <label>Tax Type *</label>
        <select name="tax_type" required>
            <option value="">Select tax type</option>
            <option value="Income Tax">Income Tax</option>
            <option value="VAT">VAT</option>
            <option value="PAYE">PAYE</option>
            <option value="Turnover Tax">Turnover Tax</option>
        </select>

        <label>Amount (KES) *</label>
        <input type="number" name="amount"
               min="0.01" step="0.01" required>

        <label>Payment Method *</label>
        <select name="payment_method" required>
            <option value="">Select method</option>
            <option value="M-Pesa">M-Pesa</option>
            <option value="Bank">Bank</option>
            <option value="Card">Card</option>
        </select>

        <button type="submit">Submit Tax Record</button>
    </form>
</div>

<?php if ($message != ""): ?>
<script>
    alert(<?php echo json_encode($message); ?>);
</script>
<?php endif; ?>

</body>
</html>

<?php
include '../config.php';
$status_filter = isset($_GET['status']) ? mysqli_real_escape_string($conn, $_GET['status']) : '';
$status_condition = $status_filter ? "WHERE o.status = '$status_filter'" : '';

$query = "
    SELECT o.id AS order_id, o.user_id, u.name AS user_name, o.total_price, o.status, o.created_at
    FROM orders o
    JOIN users u ON o.user_id = u.id
    $status_condition
    ORDER BY o.created_at DESC
";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "<tr><td colspan='6' class='text-center'>Error fetching orders: " . mysqli_error($conn) . "</td></tr>";
} else {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['order_id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['user_id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['user_name']) . '</td>';
            echo '<td>$' . htmlspecialchars(number_format($row['total_price'], 2)) . '</td>';
            echo '<td><select class="form-control statusSelect" data-id="' . $row['order_id'] . '">';
            foreach (['Pending', 'Processing', 'Completed', 'Cancelled'] as $status) {
                echo '<option value="' . $status . '"' . ($row['status'] === $status ? ' selected' : '') . '>' . $status . '</option>';
            }
            echo '</select></td>';
            echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
            echo '</tr>';
        }
    } else {
        echo "<tr><td colspan='6' class='text-center'>No orders found.</td></tr>";
    }
}
mysqli_close($conn);
?>

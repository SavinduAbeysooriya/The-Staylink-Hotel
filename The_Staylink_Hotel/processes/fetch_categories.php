<?php
include '../config.php';

$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);

$output = '';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '
    <tr>
        <td>' . $row['id'] . '</td>
        <td>' . $row['name'] . '</td>
        <td>
            <button class="btn btn-warning edit-btn" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '">Edit</button>
            <button class="btn btn-danger delete-btn" data-id="' . $row['id'] . '">Delete</button>
        </td>
    </tr>
    ';
}

echo $output;
?>

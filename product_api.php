<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

$host = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "tailor_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$method = $_SERVER['REQUEST_METHOD'];
if (isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) {
    $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
} else {
    $request = [];
}

$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if (isset($request[0]) && is_numeric($request[0])) {
            $id = intval($request[0]);
            $sql = "SELECT * FROM products WHERE id = $id";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            echo json_encode($data, JSON_PRETTY_PRINT);
        } else {
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
        break;

    case 'POST':
        $name = $input['name'] ?? '';
        $description = $input['description'] ?? '';
        $image_url = $input['image_url'] ?? '';
        $price = $input['price'] ?? 0.00; // Menambahkan price
        $sql = "INSERT INTO products (name, description, image_url, price) VALUES ('$name', '$description', '$image_url', '$price')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "Product created successfully"]);
        } else {
            echo json_encode(["message" => "Error creating product: " . $conn->error]);
        }
        break;

    case 'PUT':
        if (isset($request[0]) && is_numeric($request[0])) {
            $id = intval($request[0]);
            $name = $input['name'] ?? '';
            $description = $input['description'] ?? '';
            $image_url = $input['image_url'] ?? '';
            $price = $input['price'] ?? 0.00; // Menambahkan price
            $sql = "UPDATE products SET name='$name', description='$description', image_url='$image_url', price='$price' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Product updated successfully"]);
            } else {
                echo json_encode(["message" => "Error updating product: " . $conn->error]);
            }
        } else {
            echo json_encode(["message" => "Invalid or missing ID"]);
        }
        break;

    case 'DELETE':
        if (isset($request[0]) && is_numeric($request[0])) {
            $id = intval($request[0]);
            $sql = "DELETE FROM products WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Product deleted successfully"]);
            } else {
                echo json_encode(["message" => "Error deleting product: " . $conn->error]);
            }
        } else {
            echo json_encode(["message" => "Invalid or missing ID"]);
        }
        break;

    default:
        echo json_encode(["message" => "Invalid HTTP method"]);
        break;
}

$conn->close();
?>
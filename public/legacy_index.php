<?php

require_once __DIR__ . '/../vendor/autoload.php';

use CarbonPHP\CarbonPHP;

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

switch ($uri) {
    case '/':
        echo '<!doctype html>';
        echo '<html lang="en">';
        echo '<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Respina Online Printing System</title>';
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">';
        echo '</head><body class="bg-light">';
        echo '<div class="container py-5">';
        echo '<div class="card shadow-sm">';
        echo '<div class="card-body">';
        echo '<h1 class="card-title">Respina Online Printing System</h1>';
        echo '<p class="card-text">Welcome to Respina. Upload documents, preview print settings, and place orders instantly.</p>';
        echo '<a href="/orders" class="btn btn-primary">Get Started</a>';
        echo '</div></div></div>';
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>';
        echo '</body></html>';
        break;

    case '/orders':
        echo '<!doctype html>';
        echo '<html lang="en">';
        echo '<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Print Orders — Respina</title>';
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">';
        echo '</head><body class="bg-light">';
        echo '<div class="container py-5">';
        echo '<div class="card shadow-sm">';
        echo '<div class="card-body">';
        echo '<h1 class="card-title">Create a Print Order</h1>';
        echo '<form method="post" action="/orders/upload" enctype="multipart/form-data">';
        echo '<div class="mb-3"><label class="form-label">Document title</label><input type="text" name="title" class="form-control" required></div>';
        echo '<div class="mb-3"><label class="form-label">Upload file</label><input type="file" name="document" class="form-control" accept="application/pdf,image/*" required></div>';
        echo '<div class="mb-3"><label class="form-label">Quantity</label><input type="number" name="quantity" class="form-control" min="1" value="1" required></div>';
        echo '<div class="mb-3"><label class="form-label">Color mode</label><select name="color" class="form-select"><option value="color">Color</option><option value="bw">Black & White</option></select></div>';
        echo '<button type="submit" class="btn btn-success">Submit Order</button>';
        echo '</form>';
        echo '<a href="/" class="btn btn-link mt-3">Back</a>';
        echo '</div></div></div>';
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>';
        echo '</body></html>';
        break;

    case '/orders/upload':
        if ($method !== 'POST') {
            header('Location: /orders');
            exit;
        }

        $title = trim($_POST['title'] ?? 'Untitled');
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));
        $color = $_POST['color'] ?? 'color';
        $uploaded = $_FILES['document'] ?? null;

        if (!$uploaded || $uploaded['error'] !== UPLOAD_ERR_OK) {
            header('Location: /orders');
            exit;
        }

        $uploads = __DIR__ . '/uploads';
        if (!is_dir($uploads)) {
            mkdir($uploads, 0777, true);
        }

        $destination = $uploads . '/' . basename($uploaded['name']);
        move_uploaded_file($uploaded['tmp_name'], $destination);

        echo '<!doctype html>';
        echo '<html lang="en">';
        echo '<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Order Received — Respina</title>';
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">';
        echo '</head><body class="bg-light">';
        echo '<div class="container py-5">';
        echo '<div class="alert alert-success shadow-sm">';
        echo '<h4 class="alert-heading">Order received!</h4>';
        echo '<p>Your print order for <strong>' . htmlspecialchars($title) . '</strong> has been received.</p>';
        echo '<p>Quantity: ' . htmlspecialchars($quantity) . '</p>';
        echo '<p>Color mode: ' . htmlspecialchars($color) . '</p>';
        echo '<p>Uploaded file: ' . htmlspecialchars(basename($destination)) . '</p>';
        echo '<hr>';
        echo '<a href="/" class="btn btn-primary">Return Home</a>';
        echo '</div></div>';
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>';
        echo '</body></html>';
        break;

    default:
        http_response_code(404);
        echo '<h1>404 Not Found</h1>';
        break;
}

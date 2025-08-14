<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .error-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            text-align: center;
        }

        .error-illustration {
            max-height: 300px;
            margin-bottom: 2rem;
        }

        .error-title {
            color: #38b66c;
            font-weight: 700;
        }

        .btn-primary {
            background-color: #38b66c;
            border-color: #38b66c;
        }

        .btn-primary:hover {
            background-color: #2e9a5b;
            border-color: #2e9a5b;
        }

        .btn-outline-secondary {
            color: #38b66c;
            border-color: #38b66c;
        }

        .btn-outline-secondary:hover {
            background-color: #38b66c;
            color: white;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <img src="{{ asset('frontend/assets/img/errors/403.svg') }}" alt="403 Forbidden"
            class="img-fluid error-illustration">
        <h1 class="display-4 error-title">403 - Access Denied</h1>
        <p class="lead fs-4">You don't have permission to access this resource.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ url('/') }}" class="btn btn-primary px-4">
                <i class="fas fa-home me-2"></i> Go Home
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">
                <i class="fas fa-arrow-left me-2"></i> Go Back
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

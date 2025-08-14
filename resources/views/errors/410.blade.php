<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>410 Page Expired</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-container {
            max-width: 700px;
            margin: auto;
            padding: 2rem;
            text-align: center;
        }

        .error-icon {
            font-size: 90px;
            color: #38b66c;
            margin-bottom: 1.2rem;
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #38b66c;
        }

        .error-code {
            font-size: 5rem;
            font-weight: 800;
            color: #38b66c;
        }

        .error-desc {
            font-size: 1.2rem;
            color: #6c757d;
            margin-top: 10px;
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
        <div class="error-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="error-code">410</div>
        <h1 class="error-title">Page Expired</h1>
        <p class="error-desc">Sorry, the page you're looking for is no longer available or has expired.</p>
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

<!DOCTYPE html>
<html>
<head>
    <title>Helpdesk Ticketing System</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Helpdesk System</a>
        <div>
            <a href="/" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
            <a href="/tickets" class="btn btn-outline-light btn-sm me-2">Tickets</a>
            <a href="/tickets/create" class="btn btn-light btn-sm">Create Ticket</a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <h2 class="mb-4">Helpdesk Ticketing System</h2>

    @yield('content')

</div>

</body>
</html>
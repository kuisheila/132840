<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<!-- Header -->
<header class="bg-dark text-white text-center p-3">
    <h1>Welcome to the Admin Dashboard</h1>
</header>

<!-- Navigation Menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#createEditDelete">Create, Edit, and Delete Accounts</a></li>
        <li class="nav-item"><a class="nav-link" href="#reportingAnalytics">Reporting and Analytics</a></li>
        <li class="nav-item"><a class="nav-link" href="#generateAnalyzeReports">Generate and Analyze Usage Reports</a></li>
        <li class="nav-item"><a class="nav-link" href="#trackEngagement">Track Donor and Children's Home Engagement</a></li>
        <!-- Add more menu items as needed -->
    </ul>
</nav>

<!-- Main Content -->
<main class="container mt-4">

    <!-- Section: Create, Edit, and Delete Accounts -->
    <section id="createEditDelete" class="mb-4">
        <h2>Create, Edit, and Delete Accounts</h2>
        <!-- Form to create, edit, and delete accounts -->
        <form method="post" action="#">
            <!-- Include form fields for creating, editing, and deleting accounts -->
            <!-- Example: Account Type, Account Data, Action (Create, Edit, Delete) -->

            <div class="form-group">
                <label for="accountType">Account Type:</label>
                <input type="text" class="form-control" name="accountType" required>
            </div>

            <div class="form-group">
                <label for="accountData">Account Data:</label>
                <input type="text" class="form-control" name="accountData" required>
            </div>

            <div class="form-group">
                <label for="action">Action:</label>
                <select class="form-control" name="action">
                    <option value="createAccount">Create Account</option>
                    <option value="editAccount">Edit Account</option>
                    <option value="deleteAccount">Delete Account</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>

    <!-- Section: Reporting and Analytics -->
    <section id="reportingAnalytics" class="mb-4">
        <h2>Reporting and Analytics</h2>
        <!-- Download PDF button for reporting and analytics -->
        <form method="post" action="#">
            <button type="submit" class="btn btn-success">Download PDF Report</button>
        </form>
    </section>

    <!-- Section: Generate and Analyze Usage Reports -->
    <section id="generateAnalyzeReports" class="mb-4">
        <h2>Generate and Analyze Usage Reports</h2>
        <!-- Include content for generating and analyzing reports -->
    </section>

    <!-- Section: Track Engagement -->
    <section id="trackEngagement">
        <h2>Track Donor and Children's Home Engagement</h2>
        <!-- Include content for tracking engagement -->
        <form method="post" action="#">
            <div class="form-group">
                <label for="userId">User ID:</label>
                <input type="text" class="form-control" name="userId" required>
            </div>

            <div class="form-group">
                <label for="actionType">Action Type:</label>
                <input type="text" class="form-control" name="actionType" required>
            </div>

            <button type="submit" class="btn btn-primary">Track Engagement</button>
        </form>
    </section>

    <!-- Add more sections as needed -->

</main>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-3 fixed-bottom">
    <p>&copy; <?php echo date("Y"); ?> Your Company Name. All rights reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>
</html>

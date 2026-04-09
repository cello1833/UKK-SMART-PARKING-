<!DOCTYPE html>
<html>
<head>

<title>Login Petugas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    height: 100vh;
}

/* Card */
.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

/* Input */
.form-control {
    border-radius: 8px;
    padding: 10px;
}

/* Button */
.btn-primary {
    border-radius: 8px;
    padding: 10px;
    font-weight: 500;
}

/* Judul */
h4 {
    font-weight: 600;
    color: #1e293b;
}

/* Center full */
.full-height {
    height: 100vh;
}
</style>

</head>

<body>

<div class="container full-height d-flex align-items-center justify-content-center">

<div class="col-md-4">

<div class="card p-4">

<h4 class="text-center mb-4"> Login Petugas</h4>

<form action="../controllers/AuthController.php" method="POST">

<input name="username" class="form-control mb-3" placeholder="Username" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button class="btn btn-primary w-100">Login</button>

</form>

</div>

</div>

</div>

</body>
</html>
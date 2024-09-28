<?php
session_start();
$errors = [];
$sanitized_inputs = [];

// Name
if (isset($_POST['name']) && empty($_POST['name'])) {
    $errors['name'] = "Name is required.";
} elseif (isset($_POST['name']) && !preg_match("/^[a-zA-Z ]*$/", $_POST['name'])) {
    $errors['name'] = "Only letters and spaces allowed in name.";
} else {
    $sanitized_inputs['name'] = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
}

// Email
if (isset($_POST['email']) && empty($_POST['email'])) {
    $errors['email'] = "Email is required.";
} elseif (isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format.";
} else {
    $sanitized_inputs['email'] = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
}

// Facebook URL
if (isset($_POST['fb_url']) && empty($_POST['fb_url'])) {
    $errors['fb_url'] = "Facebook URL is required.";
} elseif (isset($_POST['fb_url']) && !filter_var($_POST['fb_url'], FILTER_VALIDATE_URL)) {
    $errors['fb_url'] = "Invalid URL format.";
} else {
    $sanitized_inputs['fb_url'] = isset($_POST['fb_url']) ? htmlspecialchars($_POST['fb_url']) : '';
}

// Phone number
if (isset($_POST['phone']) && empty($_POST['phone'])) {
    $errors['phone'] = "Phone number is required.";
} elseif (isset($_POST['phone']) && !preg_match("/^(09|\+639)\d{9}$/", $_POST['phone'])) {
    $errors['phone'] = "Invalid phone number format.";
} else {
    $sanitized_inputs['phone'] = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
}

// Password
if (isset($_POST['password']) && empty($_POST['password'])) {
    $errors['password'] = "Password is required.";
} elseif (isset($_POST['password']) && !preg_match("/^(?=.*[A-Z]).{8,}$/", $_POST['password'])) {
    $errors['password'] = "Password must be at least 8 characters and contain at least 1 uppercase letter.";
}

// Confirm password
if (isset($_POST['confirm_password']) && isset($_POST['password']) && $_POST['confirm_password'] !== $_POST['password']) {
    $errors['confirm_password'] = "Passwords do not match.";
}

// Gender
if (isset($_POST['gender']) && empty($_POST['gender'])) {
    $errors['gender'] = "Gender is required.";
} else {
    $sanitized_inputs['gender'] = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
}

// Country
if (isset($_POST['country']) && empty($_POST['country'])) {
    $errors['country'] = "Country is required.";
} else {
    $sanitized_inputs['country'] = isset($_POST['country']) ? htmlspecialchars($_POST['country']) : '';
}

// Skills
if (empty($_POST['skills'])) {
    $errors['skills'] = "At least one skill must be selected.";
} else {
    $sanitized_inputs['skills'] = $_POST['skills'];
}

// Biography
if (isset($_POST['biography']) && empty($_POST['biography'])) {
    $errors['biography'] = "Biography is required.";
} elseif (isset($_POST['biography']) && strlen($_POST['biography']) > 200) {
    $errors['biography'] = "Biography must be less than 200 characters.";
} else {
    $sanitized_inputs['biography'] = isset($_POST['biography']) ? htmlspecialchars($_POST['biography']) : '';
}

if (empty($errors)) {
    $_SESSION['user'] = $sanitized_inputs;
    header("Location: about.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e7e9;">
    <div class="container mt-5">
        <form action="assign1.php" method="POST">
            <h2>Registration Form</h2>

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                <div class="text-danger"><?= $errors['name'] ?? '' ?></div>
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                <div class="text-danger"><?= $errors['email'] ?? '' ?></div>
            </div>

            <!-- Facebook URL -->
            <div class="mb-3">
                <label for="fb_url" class="form-label">Facebook URL</label>
                <input type="url" class="form-control" id="fb_url" name="fb_url" value="<?= htmlspecialchars($_POST['fb_url'] ?? '') ?>">
                <div class="text-danger"><?= $errors['fb_url'] ?? '' ?></div>
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                <div class="text-danger"><?= $errors['phone'] ?? '' ?></div>
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="text-danger"><?= $errors['password'] ?? '' ?></div>
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                <div class="text-danger"><?= $errors['confirm_password'] ?? '' ?></div>
            </div>

            <!-- Gender Field -->
            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <input type="radio" id="male" name="gender" value="Male" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'checked' : '' ?>> Male
                <input type="radio" id="female" name="gender" value="Female" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'checked' : '' ?>> Female
                <div class="text-danger"><?= $errors['gender'] ?? '' ?></div>
            </div>

            <!-- Country Field -->
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" name="country">
                    <option value="">Select your country</option>
                    <option value="Philippines" <?= (isset($_POST['country']) && $_POST['country'] == 'Philippines') ? 'selected' : '' ?>>Philippines</option>
                    <option value="Japan" <?= (isset($_POST['country']) && $_POST['country'] == 'Japan') ? 'selected' : '' ?>>Japan</option>
                    <option value="South Korea" <?= (isset($_POST['country']) && $_POST['country'] == 'South Korea') ? 'selected' : '' ?>>South Korea</option>
                    <option value="Switzerland" <?= (isset($_POST['country']) && $_POST['country'] == 'Switzerland') ? 'selected' : '' ?>>Switzerland</option>
                </select>
                <div class="text-danger"><?= $errors['country'] ?? '' ?></div>
            </div>

            <!-- Skills Field -->
            <div class="mb-3">
                <label class="form-label">Skills</label><br>
                <input type="checkbox" name="skills[]" value="PHP" <?= (isset($_POST['skills']) && in_array('PHP', $_POST['skills'])) ? 'checked' : '' ?>> PHP<br>
                <input type="checkbox" name="skills[]" value="JavaScript" <?= (isset($_POST['skills']) && in_array('JavaScript', $_POST['skills'])) ? 'checked' : '' ?>> JavaScript<br>
                <input type="checkbox" name="skills[]" value="HTML" <?= (isset($_POST['skills']) && in_array('HTML', $_POST['skills'])) ? 'checked' : '' ?>> HTML<br>
                <input type="checkbox" name="skills[]" value="Phyton" <?= (isset($_POST['skills']) && in_array('Phyton', $_POST['skills'])) ? 'checked' : '' ?>> Phyton<br>
                <input type="checkbox" name="skills[]" value="UI/UX" <?= (isset($_POST['skills']) && in_array('UI/UX', $_POST['skills'])) ? 'checked' : '' ?>> UI/UX<br>
                <div class="text-danger"><?= $errors['skills'] ?? '' ?></div>
            </div>

            <!-- Biography Field -->
            <div class="mb-3">
                <label for="biography" class="form-label">Biography</label>
                <textarea class="form-control" id="biography" name="biography" rows="3"><?= htmlspecialchars($_POST['biography'] ?? '') ?></textarea>
                <div class="text-danger"><?= $errors['biography'] ?? '' ?></div>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>

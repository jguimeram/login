<?php include('../views/layouts/header.php') ?>

<body>
    <div class="container">
        <!-- Registration Form -->
        <div id="registerForm" class="auth-card">
            <div class="form-header">
                <h1 class="form-title">Create Account</h1>
                <p class="form-subtitle">Join us today and get started</p>
            </div>

            <div class="success-message" id="registerSuccess">
                Account created successfully! You can now sign in.
            </div>

            <div class="error-message" id="registerError">
                Please fill in all required fields correctly.
            </div>

            <form id="registrationForm" method="POST" action="/register">
                <div class="form-group">
                    <label class="form-label" for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" class="form-input"
                        placeholder="Enter your first name" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" class="form-input"
                        placeholder="Enter your last name" required>
                </div>

                <!-- <div class="form-group">
                    <label class="form-label" for="regEmail">Email Address</label>
                    <input type="email" id="regEmail" name="email" class="form-input"
                        placeholder="Enter your email address" required>
                </div>

                <div class="form-group password-field">
                    <label class="form-label" for="regPassword">Password</label>
                    <input type="password" id="regPassword" name="password" class="form-input"
                        placeholder="Create a strong password" required>
                    <button type="button" class="password-toggle"
                        onclick="togglePassword('regPassword', this)">👁️</button>
                </div>

                <div class="form-group password-field">
                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-input"
                        placeholder="Confirm your password" required>
                    <button type="button" class="password-toggle"
                        onclick="togglePassword('confirmPassword', this)">👁️</button>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="agreeTerms" class="checkbox-input" required>
                    <label for="agreeTerms" class="checkbox-label">
                        I agree to the Terms of Service and Privacy Policy
                    </label>
                </div>
 -->
                <button type="submit" class="submit-btn">Create Account</button>
            </form>

            <div class="form-divider">
                <span>Already have an account?</span>
            </div>

            <div class="form-footer">
                <a href="#" class="switch-link">Sign in to your account</a>
            </div>
        </div>
    </div>

    <?php include('../views/layouts/footer.php') ?>
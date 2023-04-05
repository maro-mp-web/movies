<div id="qss-login-form">
    <h2>Login to QSS API</h2>
    <form id="qss-login-form">
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

<script>
    jQuery('#qss-login-form').on('submit', function(event) {
        event.preventDefault();

        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'qss_login',
                email: jQuery('input[name="email"]').val(),
                password: jQuery('input[name="password"]').val(),
            },
            success: function(data) {
                if (data.success) {
                    alert('Login successful!');
                } else {
                    alert('Login failed. Please check your email and password.');
                }
            },
            error: function() {
                alert('An error occurred while trying to login.');
            }
        });
    });
</script>
<?php
include 'utility/secure_connection.php';
include 'header.php';
?>
<h1 class="text-center">Contact Form</h1>
<div class="col-lg-6 mx-auto">
    <form action="." method="post">
        <hr>
        <p>Please enter the information in the form below.  Thank you.</p>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control<?php echo (!empty($nameError)) ? ' is-invalid' : ''; ?>"
                   placeholder="First &amp; Last Name" autofocus value="<?php if (!empty($name)) echo $name; ?>">
            <?php if (!empty($nameError)) echo $nameError; ?>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="form-control<?php echo (!empty($emailError)) ? ' is-invalid' : ''; ?>"
                   placeholder="example@domain.com" value="<?php if (!empty($email)) echo $email; ?>">
            <?php if (!empty($emailError)) echo $emailError; ?>
        </div>
        <div class="form-group">
            <label for="company-name">Company Name:</label>
            <input type="text" name="company-name" id="company-name" class="form-control<?php echo (!empty($companyNameError)) ? ' is-invalid' : ''; ?>"
                   value="<?php if (!empty($companyName)) echo $companyName; ?>">
            <?php if (!empty($companyNameError)) echo $companyNameError; ?>
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <select class="custom-select<?php echo (!empty($countryError)) ? ' is-invalid' : ''; ?>" name="country" id="country">
                <option value="">Select your Country</option>
                <option value="Canada"<?php if ($country === 'Canada') echo ' selected'; ?>>Canada</option>
                <option value="Mexico"<?php if ($country === 'Mexico') echo ' selected'; ?>>Mexico</option>
                <option value="United States"<?php if ($country === 'United States') echo ' selected'; ?>>United States</option>
            </select>
            <?php if (!empty($countryError)) echo $countryError; ?>
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea name="comment" id="comment" rows="4"
                        class="form-control<?php echo (!empty($commentError)) ? ' is-invalid' : ''; ?>"><?php if (!empty($comment)) echo $comment; ?></textarea>
            <?php if (!empty($commentError)) echo $commentError; ?>
        </div>
        <div class="form-group text-center">
            <input type="hidden" name="action" value="send-email">
            <input type="submit" class="btn btn-secondary" value="Send Email">
            <a class="btn btn-secondary" href=".?action=show-email-form">Reset</a>
            <a class="btn btn-secondary" href=".">Cancel</a>
        </div>
    </form>
    <?php if ($result) : ?>
        <img src="style/check.png" alt="Green checkmark" class="float-left">
        <h2 class="pt-1">Email Successfully Sent</h2>
    <p>Thank you, <strong><?php echo $name; ?></strong>, for your email!!</p>
    <table class="table table-striped" aria-label="Email confirmation information">
        <tr>
            <th scope="row">Name:</th>
            <td><?php echo $name; ?></td>
        </tr>
        <tr>
            <th scope="row">Email:</th>
            <td><?php echo $email; ?></td>
        </tr>
        <tr>
            <th scope="row">Company Name:</th>
            <td><?php echo $companyName; ?></td>
        </tr>
        <tr>
            <th scope="row">Country:</th>
            <td><?php echo $country; ?></td>
        </tr>
        <tr>
            <th scope="row">Comment:</th>
            <td><?php echo nl2br($comment); ?></td>
        </tr>
    </table>
    <a class="btn btn-secondary d-block" href=".">Back to the Video Games List</a>
    <?php endif; ?>
</div>
<?php include 'footer.php' ?>

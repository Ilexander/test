<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <x-page-orientation/>
</head>
<body>
<script>
    if(localStorage.getItem('theme') == 'dark') {
        document.querySelector('body').classList.add('_dark-theme');
    }
</script>

<div class="wrapper d-flex">
    <x-nav-bar/>
    <section class="order section ps-3 pt-lg-3 pt-5 mt-4 mt-lg-0 pb-5 pe-1 pe-lg-3">
        <x-header/>

        <div class="order__block mt-3">
            <div class="order__block--body _section-block">
                <form action="#" id="mail-set-form" class="p-5">
                    <div class="add-service-header-block">
                        <div class="add-service-header"><i class="fa fa-edit" style="padding-right: 6px;"></i>Email Template</div>
                    </div>
                    <hr>
                    <div class="form-header-templates py-3"><i class="fa fa-link" style="padding-right: 6px;"></i>Email verification for new customer accounts</div>
                    <div class="input-group mt-2">
                        <label for="subject-new" style="width: 100%;">Subject</label>
                        <input type="text" class="form-control" value="{website_name} - Please validate your account" name="subject-new" id="subject-new">
                    </div>

                    <div class="input-group mt-2">
                        <label for="subject-new-tarea" style="width: 100%">Content</label>
                        <textarea name="subject-new-tarea" id="subject-new-tarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-header-templates py-3"><i class="fa fa-link" style="padding-right: 6px;"></i>New User Welcome Email</div>
                    <div class="input-group mt-2">
                        <label for="subject" style="width: 100%;">Subject</label>
                        <input type="text" class="form-control" value="{website_name} - Getting Started with Our Service!" name="subject-welcome" id="subject-welcome" style="widht: 100%">
                    </div>

                    <div class="input-group mt-2">
                        <label for="subject-welcoming-tarea" style="width: 100%">Content</label>
                        <textarea name="subject-welcoming-tarea" id="subject-welcoming-tarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-header-templates py-3"><i class="fa fa-link" style="padding-right: 6px;"></i>New User Notification Email</div>
                    <div class="input-group mt-2">
                        <label for="notify" style="width: 100%;">Subject</label>
                        <input type="text" class="form-control" value="{website_name} - New Registration" name="notify" id="notify">
                    </div>

                    <div class="input-group mt-2">
                        <label for="notify-tarea" style="width: 100%">Content</label>
                        <textarea name="notify-tarea" id="notify-tarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-header-templates py-3"><i class="fa fa-link" style="padding-right: 6px;"></i>Password Recovery</div>
                    <div class="input-group mt-2">
                        <label for="recovery" style="width: 100%;">Subject</label>
                        <input type="text" class="form-control" value="{website_name} - Password Recovery" name="recovery" id="recovery">
                    </div>

                    <div class="input-group mt-2">
                        <label for="recovery-tarea" style="width: 100%">Content</label>
                        <textarea name="recovery-tarea" id="recovery-tarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-header-templates py-3"><i class="fa fa-link" style="padding-right: 6px;"></i>Payment Notification Email</div>
                    <div class="input-group mt-2">
                        <label for="payment" style="width: 100%;">Subject</label>
                        <input type="text" class="form-control" value="{website_name} -  Thank You! Deposit Payment Received" name="payment" id="payment">
                    </div>

                    <div class="input-group mt-2">
                        <label for="payment-tarea" style="width: 100%">Content</label>
                        <textarea name="payment-tarea" id="payment-tarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-note mt-2">
                        <strong>Note: </strong>You can use the following template within the message template:
                        <ul>
                            <li style="list-style-type: disc">{user_firstname} - displays the user's first name</li>
                            <li style="list-style-type: disc">{user_lastname} - displays the user's last name</li>
                            <li style="list-style-type: disc">{user_email} - displays the user's email</li>
                            <li style="list-style-type: disc">{user_timezone} - displays the user's timezone</li>
                            <li style="list-style-type: disc">{recovery_password_link} - displays recovery password link</li>
                        </ul>
                    </div>

                    <div class="btn-holder pt-5">
                        <button class="btn btn-success" style="width: 156px !important; height: 40px !important;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('admin/js/libs.min.js')}}"></script>
<script src="{{asset('admin/js/main.min.js')}}"></script>
<script>

    tinymce.init({
        selector:'#subject-new-tarea',
        width:'100%',
        height: 400,
        autoresize_min_height: 400,
        autoresize_max_height: 800,
        setup: function (editor) {
            editor.on('init', function (e) {
                editor.setContent(`
                    <p><b>Welcome to {website_name}!</b></p>
                    <p>Hello <b>{user_firstname}!</b></p>
                    <p>Thank you for joining! We're glad to have you as community member, and we're stocked for you to start exploring our service. If you don't verify your address, you won't be able to create a User Account.</p>
                    <p>All you need to do is activate your account by click this link: {activation_link}</p>
                    <p>Thanks and Best Regards!</p>
                `);
        });
    }});

    tinymce.init({
        selector:'#subject-welcoming-tarea',
        width:'100%',
        height: 400,
        autoresize_min_height: 400,
        autoresize_max_height: 800,
        setup: function (editor) {
            editor.on('init', function (e) {
                editor.setContent(`
                    <p><b>Welcome to {website_name}!</b></p>
                    <p>Hello <b>{user_firstname}!</b></p>
                    <p>Congratulations! You have successfully signed up for our service - {website_name} with follow data</p>
                    <ul>
                        <li style="list-style-type: disc">Firstname: {user_firstname}</li>
                        <li style="list-style-type: disc">Lastname: {user_lastname}</li>
                        <li style="list-style-type: disc">Email: {user_email}</li>
                        <li style="list-style-type: disc">Timezone: {user_timezone}</li>

                    </ul>
                    <p>We want to exceed your expectations, so please do not hesitate to reach out at any time if you have any questions or concerns. We look to working with you.</p>
                    <p>Best Regards,</p>
                `);
        });
    }});

    tinymce.init({
        selector:'#notify-tarea',
        width:'100%',
        height: 400,
        autoresize_min_height: 400,
        autoresize_max_height: 800,
        setup: function (editor) {
            editor.on('init', function (e) {
                editor.setContent(`
                    <p>Hi Admin!</p>
                    <p>Someone signed up in <b>{website_name}</b> with follow data</p>
                    <ul>
                        <li style="list-style-type: disc">Firstname: {user_firstname}</li>
                        <li style="list-style-type: disc">Lastname: {user_lastname}</li>
                        <li style="list-style-type: disc">Email: {user_email}</li>
                        <li style="list-style-type: disc">Timezone: {user_timezone}</li>
                `);
        });
    }});

    tinymce.init({
        selector:'#recovery-tarea',
        width:'100%',
        height: 400,
        autoresize_min_height: 400,
        autoresize_max_height: 800,
        setup: function (editor) {
            editor.on('init', function (e) {
                editor.setContent(`
                    <p>Hi <b>{user_firstname}!</b></p>
                    <p>Somebody (hopefully you) requested a new password for your account.</p>
                    <p>No changes have been made to your account yet. You can reset your password by click this link: {recovery_password_link}</p>
                    <p>If you did not request a password reset, no further action is required.</p>
                    <p>Thanks and Best Regards!</p>
                `);
        });
    }});

    tinymce.init({
        selector:'#payment-tarea',
        width:'100%',
        height: 400,
        autoresize_min_height: 400,
        autoresize_max_height: 800,
        setup: function (editor) {
            editor.on('init', function (e) {
                editor.setContent(`
                    <p>Hi <b>{user_firstname}!</b></p>
                    <p>We've just received your final remittance and would like to thank you. We appreciate your diligence in adding funds to your balance in our service.</p>
                    <p>It has been a pleasure doing business with you. We wish you the best of luck.</p>
                    <p>Thanks and Best Regards!</p>
                `);
        });
    }});
</script>
</body>
</html>

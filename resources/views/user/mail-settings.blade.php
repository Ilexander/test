<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <div class="add-service-header">Email Setting</div>
                    </div>
                    <hr>
                    <div class="input-holder mt-1">
                        <input type="checkbox" name="verify" id="verify">
                        <label for="verify"> Email verification for new customer accounts (Preventing Spam Account)</label>
                    </div>
                    <div class="input-holder mt-1">
                        <input type="checkbox" name="welcoming" id="welcoming">
                        <label for="welcoming"> New User Welcome Email</label>
                    </div>
                    <div class="input-holder mt-1">
                        <input type="checkbox" name="notify" id="noitfy">
                        <label for="noitfy"> New User Notification Email <span class="input-smallspan">(Receive notification when a new user registers to the site)</span></label>
                    </div>
                    <div class="input-holder mt-1">
                        <input type="checkbox" name="payment" id="payment">
                        <label for="payment"> Payment notify <span class="input-smallspan">(Send notification when a new user add funds successfully to user balance)</span></label>
                    </div>
                    <div class="input-holder mt-1">
                        <input type="checkbox" name="ticket" id="ticket">
                        <label for="ticket"> Ticket Notification Email <span class="input-smallspan">(Send notification to user when Admin reply to a ticket)</span></label>
                    </div>
                    <div class="input-holder mt-1">
                        <input type="checkbox" name="ticket" id="ticket">
                        <label for="ticket"> Ticket Notification Email <span class="input-smallspan">(Send notification to Admin when user open a ticket)</span></label>
                    </div>
                    <div class="input-holder mt-1">
                        <input type="checkbox" name="ticket" id="ticket">
                        <label for="ticket"> Ticket Notification Email <span class="input-smallspan">(Receive notification when a user place order successfully)</span></label>
                    </div>
                    <div class="input-holder mt-2">
                        <label for="from">From</label>
                        <input type="text" class="form-control" id="from" name="from">
                    </div>
                    <div class="input-holder mt-2">
                        <label for="name">Your name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="phpmail" name="phpmail" value="yes" checked>
                        <label class="form-check-label" for="phpmail">PHP mail function</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="smtp" name="smtp" value="yes">
                        <label class="form-check-label" for="smtp">SMTP <span class="input-smallspan">(Recommended)</span></label>
                    </div>
                    <div class="form-note"><strong>Note:</strong> Sometime, email is going into recepients' spam folders if PHP mail function is enabled.</div>
                    <div class="smtp-adv">
                        <div class="input-group mt-2">
                            <label for="server" style="width: 100%"><b>SMTP Server</b></label>
                            <input type="text" id="server" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="input-group mt-2" style="width: 45%">
                                <label for="server" style="width: 100%"><b>SMTP Port</b></label>
                                <input type="text" id="server" class="form-control">
                            </div>
                            <div class="input-group mt-2" style="width: 45%">
                                <label for="encryption" style="width: 100%"><b>SMTP Encryption</b></label>
                                <select name="encryption" id="encryption" class="form-select">
                                    <option value="none">None</option>
                                    <option value="ssl">SSL</option>
                                    <option value="tls">TLS</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="input-group mt-2" style="width: 45%">
                                <label for="server" style="width: 100%"><b>SMTP Username</b></label>
                                <input type="text" id="server" class="form-control">
                            </div>
                            <div class="input-group mt-2" style="width: 45%">
                                <label for="server" style="width: 100%"><b>SMTP Password</b></label>
                                <input type="text" id="server" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="btn-holder pt-5">
                        <button class="btn btn-success" style="width: 156px !important; height: 40px !important;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script src="{{asset('admin/js/libs.min.js')}}"></script>
<script src="{{asset('admin/js/main.min.js')}}"></script>
<script>

    var smtpSwitch = document.getElementById('smtp'),
        phpSwitch = document.getElementById('phpmail'),
        smtpAdv = document.querySelector(".smtp-adv");

    function toggleMailSwitchers(e) {
        if(e.target.checked && e.target.id === 'smtp') {
            phpSwitch.checked = false;
            smtpAdv.classList.add("active");
        } else {
            smtp.checked = false;
            smtpAdv.classList.remove("active");
        }
    }
    [smtpSwitch, phpSwitch].forEach(switcher => {
        switcher.addEventListener("change", (e) => {
            toggleMailSwitchers(e);
        })
    });
</script>
</body>
</html>

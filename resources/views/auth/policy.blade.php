<!DOCTYPE html>
<html lang="{{strtolower(Config::get('app.locale'))}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Follow Sale - Terms & Privacy Policy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <x-page-orientation/>
    <link rel="stylesheet" href="{{asset('admin/sass/secondary.min.css')}}">
</head>
<body>
<div class="preloader">
    <picture><source srcset="{{asset('new/img/logo.svg')}}" type="image/webp"><img src="{{asset('new/img/logo.svg')}}"></picture>
</div>
<div class="popup">
    <div class="popup-close">
        <div class="popup-cross"></div>
    </div>
    <x-user-register/>
</div>
@include('auth.header')
<main>
    <div class="round-blue"></div>
    <div class="round-pink"></div>
    <section class="secondary">
        <div class="secondary-wrapper">
            <div class="secondary-header">
                {{$page_translation['service_title_name']['field_value'] ?? 'Terms & Privacy Policy'}}
            </div>
            <div class="secondary-header secondary-header-section">
                {{$page_translation['service_terms_name']['field_value'] ?? 'Terms'}}
            </div>

            @if(isset($page_content['content_of_terms']['field_value']))

                {!! $page_content['content_of_terms']['field_value'] !!}

            @else

                <div class="secondary-text">The use of services provided by follow.sale establishes an agreement to these terms. By registering or using our services you agree that you have read and fully understood the following terms of Service and amzpro will not be held liable for loss in any way for users who have not read the below terms of service.</div>

                <div class="secondary-header secondary-header-item">1. General</div>
                <ol class="secondary-list">
                    <li>By placing an order with follow.sale you automatically accept all the below-listed terms of service weather you read them or not.</li>
                    <li>We reserve the right to change these terms of service without notice. You are expected to read all terms of service before placing an order to ensure you are up to date with any changes or any future changes.</li>
                    <li>You will only use the follow.sale website in a manner which follows all agreements made with Instagram/Facebook/Twitter/Youtube/Other social media site on their individual Terms of Service page.</li>
                    <li>Follow.sale rates are subject to change at any time without notice. The payment/refund policy stays in effect in the case of rate changes.</li>
                    <li>Follow.sale does not guarantee a delivery time for any services. We offer our best estimation for when the order will be delivered. This is only an estimation and follow.sale will not refund orders that are processing if you feel they are taking too long.</li>
                    <li>Follow.sale tries hard to deliver exactly what is expected from us by our re-sellers. In this case, we reserve the right to change a service type if we deem it necessary to complete an order.</li>
                </ol>

                <div class="secondary-header secondary-header-attention">Disclaimer:</div>
                <li>Follow.sale will not be responsible for any damages you or your business may suffer.</li>

                <div class="secondary-header secondary-header-attention">Liabilities:</div>
                <li>Follow.sale is in no way liable for any account suspension or picture deletion done by Instagram or Twitter or Facebook or YouTube or Other Social Media.</li>

                <div class="secondary-header secondary-header-item">2. Services</div>
                <ol class="secondary-list">
                    <li>Follow.sale will only be used to promote your Instagram/Twitter/Facebook or Social account and help boost your "Appearance" only.</li>
                    <li>We DO NOT guarantee your new followers will interact with you, we simply guarantee you to get the followers you pay for.</li>
                    <li>We DO NOT guarantee 100% of our accounts will have a profile picture, full bio and uploaded pictures, although we strive to make this the reality for all accounts.</li>
                    <li>You will not upload anything into the follow.sale site including nudity or any material that is not accepted or suitable for the Instagram/Twitter/Facebook or Social Media community.</li>
                    <li>Private accounts would not get a refund! Please ensure that your account is public before ordering</li>
                </ol>

            @endif

            <div class="secondary-header secondary-header-section">
                {{$page_translation['service_privacy_policy_name']['field_value'] ?? 'Privacy Policy'}}
            </div>

            @if(isset($page_content['content_of_policy']['field_value']))
                {!! $page_content['content_of_policy']['field_value'] !!}
            @else
                <div class="secondary-header secondary-header-item">3. Refund Policy</div>
                <ol class="privacy-list">
                    <li>No refunds will be made to your payment method. After a deposit has been completed, there is no way to reverse it. You must use your balance on orders from follow.sale .</li>
                    <li>You agree that once you complete a payment, you will not file a dispute or a chargeback against us for any reason.</li>
                    <li>If you file a dispute or charge-back against us after a deposit, we reserve the right to terminate all future orders, ban you from our site. We also reserve the right to take away any followers or likes we delivered to you or your clients Instagram/Facebook/Twitter or other social media account.</li>
                    <li>Orders placed in follow.sale will not be refunded or cancelled after they are placed. You will receive a refund credit to your follow.sale account if the order is non-deliverable</li>
                    <li>Misplaced or Private account orders will not qualify for a refund. Be sure to confirm each and every order before placing it.</li>
                    <li>Fraudulent activity such as using unauthorized or stolen credit cards will lead to termination of your account. Thereare no exceptions.</li>
                    <li>Please do not use more than one server at the same time for the same page. We cannot give you the correct followers/likes number in that case. We will not refund for these orders.</li>
                </ol>

                <div class="secondary-header secondary-header-item">4. Privacy Policy</div>
                <ol class="policy-list">
                    <li>This policy covers how we use your Personal Information. We take your privacy seriously and will take all measures to protect your personal information.</li>
                    <li>Any personal information received will only be used to fill your order. We will not sell or redistribute your information to anyone. All information is encrypted and saved in secure servers.</li>
                </ol>
            @endif

        </div>
    </section>
</main>
@include('auth.footer')

<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('new/main.js')}}"></script>
</body>
</html>

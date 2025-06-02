<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('pdf.Terms and Conditions') }} | PeakPost</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        h1, h3 {
            color: #333;
            margin: 0;
        }

        h1 {
            font-size: 24px;
        }

        p {
            text-align: justify;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .last-updated {
            font-style: italic;
            color: #777;
            text-align: right;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 15px;
            margin-bottom: 20px;
        }

        .header img {
            width: 70px;
            height: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="{{ public_path('assets/logo.png') }}" alt="Logo">
        <h1>{{ __('pdf.Terms and Conditions') }}</h1>
    </div>

    <p class="last-updated">{{ __('pdf.Last updated') }}: 02/06/2025</p>

    <h3>1. {{ __('pdf.Introduction') }}</h3>
    <p>{{ __('pdf.Welcome to PeakPost. By accessing and using our services, you agree to comply with these terms and conditions. If you do not agree with any of the terms, we recommend that you do not use our site.') }}</p>

    <h3>2. {{ __('pdf.Definitions') }}</h3>
    <p>{{ __('pdf.In these terms and conditions:') }}</p>
    <ul>
        <li>{{ __('pdf."Website" refers to PeakPost and all its services.') }}</li>
        <li>{{ __('pdf."User" refers to any person who accesses or uses the website.') }}</li>
        <li>{{ __('pdf."We" or "our" refers to PeakPost, the company that owns the website.') }}</li>
    </ul>

    <h3>3. {{ __('pdf.Use of the Site') }}</h3>
    <p>{{ __('pdf.By using our website, you agree to:') }}</p>
    <ul>
        <li>{{ __('pdf.Not use it for illegal or unauthorized activities.') }}</li>
        <li>{{ __('pdf.Not attempt to access restricted areas or third-party systems without authorization.') }}</li>
        <li>{{ __('pdf.Not post content that is offensive, defamatory, or infringes the rights of others.') }}</li>
    </ul>

    <h3>4. {{ __('pdf.Account Registration') }}</h3>
    <p>{{ __('pdf.To access certain features, you may need to create an account. You agree to provide truthful information and to maintain the confidentiality of your password. We are not responsible for unauthorized use of your account.') }}</p>

    <h3>5. {{ __('pdf.Intellectual Property') }}</h3>
    <p>{{ __('pdf.All contents of PeakPost, including texts, images, logos, and software, are protected by copyright and intellectual property laws. You may not copy, modify, or distribute the content without our consent.') }}</p>

    <h3>6. {{ __('pdf.Privacy Policy') }}</h3>
    <p>{{ __('pdf.The use of PeakPost is subject to our Privacy Policy, where we explain how we collect, use, and protect your information.') }}</p>

    <h3>7. {{ __('pdf.Limitation of Liability') }}</h3>
    <p>{{ __('pdf.We do not guarantee that the website will operate without interruptions or errors. We are not liable for direct or indirect damages resulting from the use of the site.') }}</p>

    <h3>8. {{ __('pdf.Third-party Links') }}</h3>
    <p>{{ __('pdf.PeakPost may contain links to third-party websites. We are not responsible for the content or privacy policies of such websites.') }}</p>

    <h3>9. {{ __('pdf.Changes to the Terms') }}</h3>
    <p>{{ __('pdf.We reserve the right to modify these terms at any time. We will notify you of important changes through a notice on the website.') }}</p>

    <h3>10. {{ __('pdf.Service Termination') }}</h3>
    <p>{{ __('pdf.We may suspend or terminate your access to PeakPost in the event of a violation of these terms, without prior notice.') }}</p>

    <h3>11. {{ __('pdf.Applicable Law') }}</h3>
    <p>{{ __('pdf.These terms are governed by the laws of Spain. Any dispute will be resolved in the courts of Spain.') }}</p>

    <h3>12. {{ __('pdf.Contact') }}</h3>
    <p>{{ __('pdf.If you have questions about these terms, you can contact us.') }}</p>
</div>

</body>
</html>

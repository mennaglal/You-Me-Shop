<!DOCTYPE html>

<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <title></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" type="text/css"/>
    <!--<![endif]-->
    <style type="text/css">
        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: inherit !important;
        }

        p {
            line-height: inherit
        }
        .membership-main table {
            width: 100%;
            margin: 0 auto;
            max-width: 640px;
        }
        .membership-main .table-mem {
            padding: 0 35px;
        }
        .text-center{
            text-align: center;
        }
        .w-100{
            width: 100%;
        }
        .p-3 {
            padding: 3rem;
        }
        .py-3 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        .pt-2 {
            padding-top: 2rem;
        }
        .pt-1 {
            padding-top: 1rem;
        }
        .py-1 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .py-2 {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        mb-5{
            margin-bottom: 5rem !important;
        }
        mt-5{
            margin-top: 5rem !important;
        }
        .color-60{
            color: #66788d;
        }
        .color-80{
            color: #334b67;
        }
        .fw-400{
            font-weight: 400;
        }
        .fs-16{
            font-size: 16px;
            line-height: 26px;
        }
        .fw-500{
            font-weight: 500;
        }
        .bg-white{
            background-color:#fff;
        }
        .d-block{
            display: block;
        }
        .btn-primary {
            background-color: #1848a3;
            white-space: nowrap;
            text-decoration: none;
            padding: 5px 15px;
            border-radius: 5px;
            letter-spacing: .5px;
            color: white;
            font-weight: bold;
        }
        .border-member{
            border: 32px solid #F8FAFC;
        }
        .customer_name{
            color: #e96525;
            font-weight: bold;
            text-transform: capitalize;
        }
    </style>
</head>
<body style="background-color: #f2f2f2; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
<div class="membership-main p-3">
    <table class="bg-white border-member table-mem">
        <thead>
        <tr>
            <th class="text-center w-100 py-2">
                <img width="120" src="{{ URL::to('/front_assets/images/logo31.jpg') }}" download="false" alt="Logo website">
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center fs-16 fw-400 color-80 pt-1">Dear <span class="customer_name">{{ $mailData['customer_name'] }}</span>,</td>
        </tr>
        <tr>
            <td class="text-center fs-16 fw-400 color-80">Thank you for your order in amount of <span class="customer_name"> ${{ $mailData['total_price'] }}</span>,it will be processed and delivered in the next two week.</td>
        </tr>
        <tr>
            <td>
                <table>
                    <tbody class="d-block py-2">
                    <tr class="text-center d-block">
                        <td class="text-center color-80 fs-16 d-block">
                            <a type="button" class="btn-primary mb-5" href="{{ $mailData['url'] }}">Show Invoice</a>
                        </td>
                    </tr>
                    <tr class="text-center d-block">
                        <td class="text-center color-80 fs-16 d-block mt-5">Best wishes,</td>
                    </tr>
                    <tr class="text-center d-block">
                        <td class="text-center color-80 fs-16 d-block">You&Me Shop</td>
                    </tr>
                    <tr class="text-center d-block pt-2">
                        <td class="text-center d-block">
                            <a class="color-60 fw-500 fs-14" href="#" role="button" style="text-decoration: none;">@ All right reserved for You&Me Shop</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>


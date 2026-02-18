<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Withdrawal Request #{{ $withdrawal->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 5px;
        }

        h2 {
            text-align: center;
            color: #000;
            margin-bottom: 5px;
        }

        h4 {
            background-color: #fe0000; /* brand red */
            color: #fff;
            padding: 5px 5px;
            border-radius: 5px;
            margin-bottom: 2px;
        }

        .section {
            background-color: #f9f9f9; /* light gray */
            padding: 5px 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        label {
            font-weight: bold;
        }

        .field {
            margin-bottom: 8px;
        }

        .field span {
            margin-left: 5px;
        }

        .signature {
            margin-top: 10px;
        }

        .readonly-section {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
        }

        ul {
            padding-left: 20px;
        }

        .signature img {
            max-width: 300px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
    <tr>
        <td width="20%" style="vertical-align:middle;">
           <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents('/home3/attilach/public_html/images/logo1.jpg')) }}" style="width:120px;">



        </td>

        <td width="80%" style="vertical-align:middle; text-align:center;">
            <h2 style="
                margin:0;
                font-size:20px;
                text-transform:uppercase;
            ">
                ATTILA CHICKEN INVESTMENT WITHDRAWAL FORM
            </h2>
        </td>
    </tr>
</table>

<hr>


    {{-- INVESTOR DETAILS --}}
    <div class="section">
        <h4>A. INVESTOR DETAILS</h4>
        <div class="field"><label>Full Name:</label> <span>{{ $withdrawal->investor->full_name }}</span></div>
        <div class="field"><label>Phone:</label> <span>{{ $withdrawal->investor->phone }}</span></div>
        <div class="field"><label>Email:</label> <span>{{ $withdrawal->investor->email }}</span></div>
        <div class="field"><label>ID Number:</label> <span>{{ $withdrawal->investor->id_number }}</span></div>
    </div>

    {{-- INVESTMENT DETAILS --}}
    <div class="section">
        <h4>B. INVESTMENT DETAILS</h4>
        <div class="field"><label>Investment / Contract:</label> <span>{{ $withdrawal->investment->contract_number }} - {{ $withdrawal->investment->investment_package }}</span></div>
        <div class="field"><label>Full Refundable Amount:</label> <span>KES {{ number_format($withdrawal->amount_requested) }}</span></div>
    </div>

    {{-- WITHDRAWAL DETAILS --}}
    <div class="section">
        <h4>C. WITHDRAWAL DETAILS</h4>
        <div class="field"><label>Type of Withdrawal:</label> <span>{{ $withdrawal->type_of_withdrawal }}</span></div>
        <div class="field"><label>Amount Requested:</label> <span>KES {{ number_format($withdrawal->amount_requested) }}</span></div>
        <div class="field"><label>Reason:</label> <span>{{ $withdrawal->reason }}</span></div>
        <div class="field"><label>Preferred Payment Date:</label> <span>{{ $withdrawal->preferred_payment_date }}</span></div>
    </div>

    {{-- BANK DETAILS --}}
    <div class="section">
        <h4>D. BANK DETAILS</h4>
        <div class="field"><label>Bank Name:</label> <span>{{ $withdrawal->bank_name }}</span></div>
        <div class="field"><label>Branch:</label> <span>{{ $withdrawal->branch }}</span></div>
        <div class="field"><label>Account Name:</label> <span>{{ $withdrawal->account_name }}</span></div>
        <div class="field"><label>Account Number:</label> <span>{{ $withdrawal->account_number }}</span></div>
        <div class="field"><label>SWIFT Code:</label> <span>{{ $withdrawal->swift_code }}</span></div>
        <div class="field"><label>Bank Address:</label> <span>{{ $withdrawal->bank_address }}</span></div>
    </div>

    {{-- DECLARATION --}}
    <div class="section">
        <h4>E. DECLARATION BY INVESTOR</h4>
        <p>I, the undersigned, hereby confirm that:</p>
        <ul>
            <li>The information provided is true and accurate.</li>
            <li>Withdrawal requests follow the terms of the Investment Agreement.</li>
            <li>Applicable fees, penalties, taxes, or notice periods may apply.</li>
            <li>Attila Chicken House reserves the right to approve or decline this request.</li>
        </ul>

        <div class="field"><label>Investor Name:</label> <span>{{ $withdrawal->investor->full_name }}</span></div>
        <div class="field"><label>Date:</label> <span>{{ $withdrawal->created_at->format('Y-m-d') }}</span></div>
        <div class="signature">
            <label>Signature:</label><br>
            @if($withdrawal->signature_path)
                <img src="{{ storage_path('app/public/'.$withdrawal->signature_path) }}" alt="Signature">
            @endif
        </div>
    </div>

   {{-- OFFICIAL USE (PDF SAFE) --}}
<div style="margin-top:20px;">
    <h4 style="margin-bottom:10px;">F. FOR OFFICIAL USE ONLY (ATTILA CHICKEN HOUSE)</h4>

    <table width="100%" cellspacing="0" cellpadding="6" style="border-collapse: collapse;">
        <tr>
            <td style="border:1px solid #000; width:50%;">
                <strong>Application Received By</strong><br><br>
            </td>
            <td style="border:1px solid #000; width:50%;">
                <strong>Date Received</strong><br><br>
            </td>
        </tr>

        <tr>
            <td style="border:1px solid #000;">
                <strong>Approved Amount (KES)</strong><br><br>
            </td>
            <td style="border:1px solid #000;">
                <strong>Approval Status</strong><br><br>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border:1px solid #000;">
                <strong>Comments</strong><br><br><br>
            </td>
        </tr>

        <tr>
            <td style="border:1px solid #000;">
                <strong>Authorized By</strong><br><br>
            </td>
            <td style="border:1px solid #000;">
                <strong>Date</strong><br><br>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border:1px solid #000; height:90px;">
                <strong>Signature & Stamp</strong>
            </td>
        </tr>
    </table>
</div>


</body>
</html>

@extends('layouts.app')

@section('content')
<style>
:root {
    --brand-red: #fe0000;
    --brand-yellow: #ffc600;
    --brand-black: #000000;
    --navbar-bg: #ffffff;
    --light-gray: #f9f9f9;
}

h4.section-title {
    background-color: var(--brand-red);
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.section {
    background-color: var(--light-gray);
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
}

.field label {
    font-weight: bold;
}

#signature-pad {
    border: 1px solid #ccc;
    border-radius: 5px;
}

.readonly-section input,
.readonly-section textarea {
    background-color: #e9ecef;
}
</style>

<div class="container">
    <h2>Investment Withdrawal Form</h2>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Pending notice --}}
    <div id="pending-alert" class="alert alert-warning" style="display:none;">
        You already have a pending withdrawal request. You cannot submit another until it is processed.
    </div>

    <form method="POST" action="{{ route('withdrawal.submit') }}" id="withdrawalForm">
        @csrf
        {{-- Hidden input for signature --}}
        <input type="hidden" name="signature_data" id="signature_data">

        {{-- ------------------- INVESTOR DETAILS ------------------- --}}
        <div class="section" id="investor-section">
            <h4 class="section-title">A. Investor Details</h4>
            <div class="mb-3 field">
                <label>ID Number</label>
                <input type="text" id="id_number" class="form-control" placeholder="Enter ID Number" required>
            </div>
            <div class="mb-3 field">
                <label>Full Name</label>
                <input type="text" id="full_name" class="form-control" readonly>
            </div>
            <div class="mb-3 field">
                <label>Phone</label>
                <input type="text" id="phone" class="form-control" readonly>
            </div>
            <div class="mb-3 field">
                <label>Email</label>
                <input type="email" id="email" class="form-control" readonly>
            </div>
            <input type="hidden" name="investor_id" id="investor_id">
        </div>

        {{-- ------------------- INVESTMENT DETAILS ------------------- --}}
        <div class="section">
            <h4 class="section-title">B. Investment & Contract Details</h4>
            <div class="mb-3 field">
                <label>Select Investment / Contract</label>
                <select name="investment_id" id="investment_select" class="form-control">
                    <option value="">Select Contract</option>
                </select>
            </div>
            <div class="mb-3 field">
                <label>Full Amount Refundable</label>
                <input type="number" id="full_refundable_amount" class="form-control" readonly>
            </div>
        </div>

        {{-- ------------------- WITHDRAWAL DETAILS ------------------- --}}
        <div class="section">
            <h4 class="section-title">C. Withdrawal Details</h4>
            <div class="mb-3 field">
                <label>Type of Withdrawal</label>
                <select name="type_of_withdrawal" id="type_of_withdrawal" class="form-control">
                    <option value="Full">Full</option>
                    <option value="Partial">Partial</option>
                </select>
            </div>
            <div class="mb-3 field" id="amount_requested_container">
                <label>Amount Requested</label>
                <input type="number" name="amount_requested" id="amount_requested" class="form-control">
            </div>
            <div class="mb-3 field">
                <label>Reason</label>
                <textarea name="reason" class="form-control"></textarea>
            </div>
            <div class="mb-3 field">
                <label>Preferred Payment Date</label>
                <input type="date" name="preferred_payment_date" id="preferred_payment_date" class="form-control" required>
            </div>
        </div>

        {{-- ------------------- BANK DETAILS ------------------- --}}
        <div class="section">
            <h4 class="section-title">D. Bank Details</h4>
            <div class="mb-3 field">
                <label>Bank Name</label>
                <input type="text" name="bank_name" id="bank_name" class="form-control" readonly>
            </div>
            <div class="mb-3 field">
                <label>Branch</label>
                <input type="text" name="branch" id="branch_name" class="form-control" readonly>
            </div>
            <div class="mb-3 field">
                <label>Account Name</label>
                <input type="text" name="account_name" id="account_name" class="form-control" readonly>
            </div>
            <div class="mb-3 field">
                <label>Account Number</label>
                <input type="text" name="account_number" id="account_number" class="form-control" readonly>
            </div>
            <div class="mb-3 field">
                <label>SWIFT Code</label>
                <input type="text" name="swift_code" id="swift_code" class="form-control" readonly>
            </div>
            <div class="mb-3 field">
                <label>Bank Address</label>
                <input type="text" name="bank_address" id="bank_address" class="form-control" readonly>
            </div>
        </div>

        {{-- ------------------- DECLARATION ------------------- --}}
        <div class="section">
            <h4 class="section-title">E. Declaration by Investor</h4>
            <p>I, the undersigned, hereby confirm that:</p>
            <ul>
                <li>The information provided is true and accurate.</li>
                <li>Withdrawal requests follow the terms of the Investment Agreement.</li>
                <li>Applicable fees, penalties, taxes, or notice periods may apply.</li>
                <li>Attila Chicken House reserves the right to approve or decline this request.</li>
            </ul>
            <div class="mb-3 field">
                <label>Signature</label>
                <canvas id="signature-pad" class="border" style="width:100%; height:200px;"></canvas>
                <button type="button" id="clear-signature" class="btn btn-secondary btn-sm mt-1">Clear Signature</button>
            </div>
        </div>

        {{-- ------------------- OFFICIAL USE ------------------- --}}
        <div class="section readonly-section">
            <h4 class="section-title">F. For Official Use Only (Attila Chicken House)</h4>
            <div class="row mb-3">
                <div class="col-md-6 field">
                    <label>Application Received By</label>
                    <input type="text" class="form-control" readonly>
                </div>
                <div class="col-md-6 field">
                    <label>Date Received</label>
                    <input type="date" class="form-control" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 field">
                    <label>Approved Amount (KES)</label>
                    <input type="number" class="form-control" readonly>
                </div>
                <div class="col-md-6 field">
                    <label>Approval Status</label>
                    <input type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="mb-3 field">
                <label>Comments</label>
                <textarea class="form-control" rows="3" readonly></textarea>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 field">
                    <label>Authorized By</label>
                    <input type="text" class="form-control" readonly>
                </div>
                <div class="col-md-6 field">
                    <label>Date</label>
                    <input type="date" class="form-control" readonly>
                </div>
            </div>
            <div class="mb-3 field">
                <label>Signature & Stamp</label>
                <div style="height: 100px; border: 1px solid #ccc; border-radius: 4px; background:#fff;"></div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit Withdrawal Request</button>
    </form>
</div>




<!-- Signature Pad -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.3/dist/signature_pad.umd.min.js"></script>

<script>
let data = {};
const fullRefundable = {'BRONZE':1957500,'SILVER':3915000,'GOLD':7830000};
let selectedInvestment = null;

const withdrawalForm = document.getElementById('withdrawalForm');
const pendingAlert = document.getElementById('pending-alert');
const canvas = document.getElementById('signature-pad');

// Signature Pad setup
function resizeCanvas() {
    const ratio = Math.max(window.devicePixelRatio||1,1);
    canvas.width = canvas.offsetWidth*ratio;
    canvas.height = canvas.offsetHeight*ratio;
    canvas.getContext("2d").scale(ratio,ratio);
}
window.addEventListener("resize", resizeCanvas);
resizeCanvas();

const signaturePad = new SignaturePad(canvas, {backgroundColor:'rgb(255,255,255)', penColor:'rgb(0,0,0)'});
document.getElementById('clear-signature').addEventListener('click', ()=> signaturePad.clear());

// Investor ID blur
document.getElementById('id_number').addEventListener('blur', function(){
    const id_number = this.value.trim();
    if(!id_number) return;

    // Check pending request
    fetch(`/investor/${id_number}/pending`)
        .then(res => res.json())
        .then(res => {
            if(res.pending){
                pendingAlert.style.display = 'block';
                withdrawalForm.querySelectorAll('input, select, textarea, button').forEach(el=>{
                    el.disabled = true;
                });
            } else {
                pendingAlert.style.display = 'none';
                withdrawalForm.querySelectorAll('input, select, textarea, button').forEach(el=>{
                    el.disabled = false;
                });
            }
        });

    // Fetch investor info
    fetch(`/investor/${id_number}`)
        .then(res => res.json())
        .then(res => {
            if(res.error){ alert(res.error); return; }
            data = res;
            document.getElementById('full_name').value = res.investor.full_name;
            document.getElementById('phone').value = res.investor.phone;
            document.getElementById('email').value = res.investor.email;
            document.getElementById('investor_id').value = res.investor.id;

            if(res.bank_account){
                document.getElementById('bank_name').value = res.bank_account.bank_name;
                document.getElementById('branch_name').value = res.bank_account.branch_name || '';
                document.getElementById('account_name').value = res.bank_account.account_name;
                document.getElementById('account_number').value = res.bank_account.account_number;
                document.getElementById('swift_code').value = res.bank_account.swift_code || '';
                document.getElementById('bank_address').value = res.bank_account.bank_address || '';
            }

            const select = document.getElementById('investment_select');
            select.innerHTML = '<option value="">Select Contract</option>';
            res.investments.forEach(inv=>{
                const option = document.createElement('option');
                option.value = inv.id;
                option.text = `${inv.contract_number} - ${inv.investment_package}`;
                option.dataset.package = inv.investment_package.toUpperCase();
                select.appendChild(option);
            });
        });
});

// Investment selection
document.getElementById('investment_select').addEventListener('change', function(){
    const opt = this.selectedOptions[0];
    if(!opt) return;
    selectedInvestment = {id:opt.value, package:opt.dataset.package};
    document.getElementById('full_refundable_amount').value = fullRefundable[selectedInvestment.package];
    if(document.getElementById('type_of_withdrawal').value==='Full'){
        document.getElementById('amount_requested').value = fullRefundable[selectedInvestment.package];
    }
});

// Withdrawal type
document.getElementById('type_of_withdrawal').addEventListener('change', function(){
    const amountContainer = document.getElementById('amount_requested_container');
    if(this.value==='Full'){
        amountContainer.style.display='none';
        if(selectedInvestment){
            document.getElementById('amount_requested').value = fullRefundable[selectedInvestment.package];
        }
    } else {
        amountContainer.style.display='block';
        document.getElementById('amount_requested').value = '';
    }
});
if(document.getElementById('type_of_withdrawal').value==='Full'){
    document.getElementById('amount_requested_container').style.display='none';
}

// Preferred payment date
const preferredDateInput = document.getElementById('preferred_payment_date');
const today = new Date();
const minDate = new Date(today.setDate(today.getDate()+14));
preferredDateInput.min = minDate.toISOString().split('T')[0];

// Form submit
withdrawalForm.addEventListener('submit', function(e){
    // Validate date
    const selectedDate = new Date(preferredDateInput.value);
    const todayCheck = new Date();
    const minValidDate = new Date(todayCheck.setDate(todayCheck.getDate()+14));
    if(selectedDate < minValidDate){
        alert('Preferred Payment Date cannot be earlier than 14 days from today.');
        e.preventDefault();
        return false;
    }

    // Validate signature
    if(signaturePad.isEmpty()){
        alert('Please provide your signature before submitting.');
        e.preventDefault();
        return false;
    }

    // Set signature Base64
    document.getElementById('signature_data').value = signaturePad.toDataURL('image/png');
});
</script>
@endsection

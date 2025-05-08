EBANX API TEST
Software Engineer Take-home Assignment

Candidate: Gabriel Alexandre Aguiar
Language: PHP

🚀 Setup & Execution
Run Services:

Start Apache

Launch Ngrok (for external testing)

Testing Methods:

Tested via Ipkiss (Postman alternative)

JavaScript fetch() calls to endpoints

🔧 Features Implemented
✅ Account Management

Account creation (auto-generated if nonexistent during deposit)

Account validation

✅ Transaction Operations

Deposit

Withdraw (with balance validation)

Transfer (with balance validation)

✅ Balance Checks

Pre-validation for withdrawals/transfers

⚠️ Prerequisites
Apache Configuration: Must be properly configured for routing and PHP execution.

Ensure mod_rewrite is enabled for clean URLs.

Verify PHP module is active (e.g., php8.x).

📝 Notes
Endpoints follow RESTful conventions.

Error responses include HTTP status codes (e.g., 402 for insufficient funds).

Example Request (JavaScript):
fetch('PASTE THE NGROK URL HERE', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
})

For Withdraw
const data = {
 type: 'withdraw',
    origin: '100',
    amount: 50

}

For Deposits
const data = {
 type: 'deposit',
    destination: '100',
    amount: 50

}

For Transfer
const data = {
 type: 'transfer',
    origin: '100',
    amount: 50,
    destination: '300'

}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Complaint Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        label.required {
            display: inline-flex;
            align-items: center;
            gap: 10px; /* Space between checkbox and text */
        }

        label.required input[type="checkbox"] {
            margin: 0; /* Ensure no extra space is added around the checkbox */
        }



        .agreement-container input[type="checkbox"] {
            margin-right: 10px;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #34693c;
        }
        .progress-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .progress-step {
            flex: 1;
            text-align: center;
            padding: 10px;
            background-color: #e0e0e0;
            color: #666;
        }
        .progress-step.active {
            background-color: #34693c;
            color: #fff;
        }
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #34693c;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        button {
            background-color: #34693c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #34693c;
        }
        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .required::after {
            content: " *";
            color: red;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
            display: none;
        }
        .invalid {
            border-color: red;
        }
        .invalid + .error-message {
            display: block;
        }
        #verificationStep {
            text-align: center;
        }
        #verificationCode {
            max-width: 200px;
            margin: 0 auto;
        }
        #thankYouMessage {
            text-align: center;
            font-size: 1.2em;
            color: #34693c;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Complaint Registration Form</h1>
    <div class="progress-bar">
        <div class="progress-step active">Personal Info</div>
        <div class="progress-step">Verify Email</div>
        <div class="progress-step">Complaint Details</div>
        <div class="progress-step">Review & Submit</div>
    </div>
    <form id="complaintForm" method="POST" action="{{route('complaint.store')}}" >
        @csrf
        <div class="step active" id="step1">
            <h2>Personal Information</h2>
            <label for="name" class="required">Full Name:</label>
            <input type="text" id="name" name="name" required>
            <div class="error-message">Please enter your full name.</div>

            <label for="email" class="required">Email:</label>
            <input type="email" id="email" name="email" required>
            <div class="error-message">Please enter a valid email address.</div>

            <div class="buttons">
                <button type="button" id="next1">Next</button>
            </div>
        </div>

        <div class="step" id="step2">
            <h2>Email Verification</h2>
            <p>A verification code has been sent to your email. Please enter it below:</p>

            <div id="verificationFeedback" class="alert" style="display: none;"></div>

            <input type="text" id="verificationCode" name="verificationCode" required>
            <div class="error-message">Please enter the verification code.</div>

            <div class="buttons">
                <button type="button" id="prev2">Previous</button>
                <button type="button" id="verifyCode">Verify Code</button>
            </div>
        </div>


        <div class="step" id="step3">
            <h2>Complaint Details</h2>
            <label for="department" class="required">Department:</label>
            <select id="department" name="department" required>
                <option value="">Select a department</option>
                <option value="academic">Academic Affairs</option>
                <option value="admin">Administration</option>
                <option value="finance">Finance</option>
                <option value="it">IT Services</option>
            </select>
            <div class="error-message">Please select a department.</div>

            <label for="complaint_type" class="required">Complaint Type:</label>
            <select id="complaint_type" name="complaint_type" required>
                <option value="">Select complaint type</option>
                <option value="service">Service Related</option>
                <option value="academic">Academic Issue</option>
                <option value="facility">Facility Problem</option>
                <option value="other">Other</option>
            </select>
            <div class="error-message">Please select a complaint type.</div>

            <label for="details" class="required">Complaint Details:</label>
            <textarea id="details" name="details" rows="5" required></textarea>
            <div class="error-message">Please provide details about your complaint.</div>

            <div class="buttons">
                <button type="button" id="prev3">Previous</button>
                <button type="button" id="next3">Next</button>
            </div>
        </div>

        <div class="step" id="step4">
            <h2>Review & Submit</h2>
            <div id="reviewContent"></div>

            <label for="agreement" class="required">
                <input type="checkbox" id="agreement" name="agreement" required>
                <span>I confirm that the information provided is accurate and true to the best of my knowledge.</span>
            </label>

            <div class="error-message" style="display:none;">Please agree to the terms before submitting.</div>
            <div class="buttons">
                <button type="button" id="prev4">Previous</button>
                <button type="submit"  id="submitComplaint">Submit Complaint</button>
            </div>
        </div>
    </form>
    <div id="thankYouMessage" style="display: none;">
        <h2>Thank You for Your Submission</h2>
        <p>Your complaint has been successfully registered. You will receive a confirmation email shortly with further details about the resolution process.</p>
    </div>

</div>

<script>
    const form = document.getElementById('complaintForm');
    const steps = document.querySelectorAll('.step');
    const progressSteps = document.querySelectorAll('.progress-step');
    const nextButtons = document.querySelectorAll('[id^="next"]');
    const prevButtons = document.querySelectorAll('[id^="prev"]');
    const thankYouMessage = document.getElementById('thankYouMessage');
    // const verifyCodeButton = document.getElementById('verifyCode');

    let currentStep = 0;
    const demoVerificationCode = '1111';

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            if (index === stepIndex) {
                step.classList.add('active');
                progressSteps[index].classList.add('active');
            } else {
                step.classList.remove('active');
                progressSteps[index].classList.remove('active');
            }
        });
    }

    function updateReviewContent() {
        const reviewContent = document.getElementById('reviewContent');
        const formData = new FormData(form);
        let reviewHTML = '<h3>Please review your complaint details:</h3>';

        for (let [key, value] of formData.entries()) {
            if (key !== 'agreement' && key !== 'verificationCode' && key !== '_token') {
                reviewHTML += `<p><strong>${key.charAt(0).toUpperCase() + key.slice(1)}:</strong> ${value}</p>`;
            }
        }

        reviewContent.innerHTML = reviewHTML;
    }


    function validateStep(stepIndex) {
        const currentStepElement = steps[stepIndex];
        const inputs = currentStepElement.querySelectorAll('input, select, textarea');
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                isValid = false;
                input.classList.add('invalid');
            } else {
                input.classList.remove('invalid');
            }
        });

        return isValid;
    }

    function clearValidation(stepIndex) {
        const currentStepElement = steps[stepIndex];
        const inputs = currentStepElement.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.classList.remove('invalid');
        });
    }

    // verifyCodeButton.addEventListener('click', () => {
    //     const enteredCode = document.getElementById('verificationCode').value;
    //     if (enteredCode === demoVerificationCode) {
    //         alert('Email verified successfully!');
    //         currentStep++;
    //         showStep(currentStep);
    //     } else {
    //         alert('Invalid verification code. Please try again.');
    //     }
    // });

    nextButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                currentStep++;
                showStep(currentStep);
                if (currentStep === 3) {
                    updateReviewContent();
                }
            }
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            clearValidation(currentStep);
            currentStep--;
            showStep(currentStep);
        });
    });

    form.addEventListener('submit', (e) => {
        // e.preventDefault();
        if (validateStep(currentStep)) {
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            console.log('Form submitted:', data);
            // Here you would typically send the data to your server

            // Show thank you message
            form.style.display = 'none';
            thankYouMessage.style.display = 'block';
        }
    });

    form.addEventListener('submitComplaint', (e) => {
        e.preventDefault(); // Prevent regular form submission

        if (validateStep(currentStep)) {
            const formData = new FormData(form);

            fetch('{{ route('complaint.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hide form and show the thank you message
                        form.style.display = 'none';
                        document.getElementById('thankYouMessage').style.display = 'block';
                    } else {
                        // Handle validation errors
                        console.error('Validation errors:', data.errors);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

    });
    document.getElementById('next1').addEventListener('click', function () {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        // Validate that the name and email fields are filled
        if (!name || !email) {
            alert('Please enter your name and email.');
            return;
        }

        // Send the name and email to the server to generate and send the verification code
        fetch('{{ route('complaint.sendVerificationCode') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                email: email
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // If the email is sent successfully, proceed to the next step

                    showStep(currentStep);
                } else {
                    // If there was an error, show the error message
                    alert('There was an error sending the verification code. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error sending verification code:', error);
                alert('An error occurred while sending the verification code. Please try again.');
            });
    });
    document.getElementById('verifyCode').addEventListener('click', function () {
        const enteredCode = document.getElementById('verificationCode').value;

        if (!enteredCode) {
            alert('Please enter the verification code.');
            return;
        }

        // Send the verification code to the server via AJAX
        fetch('{{ route('complaint.verifyCode') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                verification_code: enteredCode // Send the entered code to the server
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Move to the next step after successful verification
                    alert("Verification Successfully ")
                    currentStep++;
                    showStep(currentStep); // Move to complaint details step
                }
            })
            .catch(error => {
                console.error('Error during verification:', error);
                alert('An error occurred during verification. Please try again.');
            });
    });



</script>
</body>
</html>

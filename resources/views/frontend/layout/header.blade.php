<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NADRA Customer Care</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#status-form').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                // Clear previous messages
                $('#statusMessageContainer').html('');

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Use the form's action URL
                    data: $(this).serialize(), // Serialize the form data
                    success: function (response) {
                        console.log(response); // For debugging

                        // Check if there is at least one complaint
                        if (response.complaints && response.complaints.length > 0) {
                            let complaintList = '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">';

                            // If only one complaint, handle it properly
                            if (response.complaints.length === 1) {
                                let complaint = response.complaints[0];
                                let finalStatus = complaint.status === 'Forwarded' ? 'In Progress' : complaint.status;

                                let statusMessage = ''; // We'll build the message here
                                let attachment = 'attachments/' + complaint.attachment;
                                if (finalStatus === 'Resolved') {
                                    statusMessage = `Comments: ${complaint.comments || 'No comments available.'}<br>`;
                                    if (complaint.attachment) {
                                        statusMessage += `<a href="${attachment}" class="text-blue-500 underline" target="_blank">Download Attachment</a>`;
                                    }
                                } else {
                                    statusMessage = `${complaint.comments || 'No additional information.'}`;
                                }

                                // Build the final HTML output
                                complaintList += `
                            <p class="font-bold">Complaint found:</p>
                            <ul>
                                <li>
                                    <strong>Complaint ID: ${complaint.id}</strong><br>
                                    <strong>Status:</strong> ${finalStatus}<br>
                                    ${statusMessage}
                                </li>
                            </ul>
                        `;
                            } else {
                                // Handle multiple complaints
                                complaintList += '<p class="font-bold">Multiple complaints found:</p><ul>';

                                response.complaints.forEach(function (complaint) {
                                    let finalStatus = complaint.status === 'Forwarded' ? 'In Progress' : complaint.status;

                                    let statusMessage = '';
                                    let attachment = 'attachments/' + complaint.attachment;
                                    if (finalStatus === 'Resolved') {
                                        statusMessage = `Comments: ${complaint.comments || 'No comments available.'}<br>`;
                                        if (complaint.attachment) {
                                            statusMessage += `<a href="${attachment}" class="text-blue-500 underline" target="_blank">Download Attachment</a>`;
                                        }
                                    } else {
                                        statusMessage = `${complaint.comments || 'No additional information.'}`;
                                    }

                                    complaintList += `
                                <li>
                                    <strong>Complaint ID: ${complaint.id}</strong><br>
                                    <strong>Status:</strong> ${finalStatus}<br>
                                    ${statusMessage}
                                </li>
                                <hr>
                            `;
                                });

                                complaintList += '</ul>';
                            }

                            complaintList += '</div>';

                            // Display the complaint(s) in the container
                            $('#statusMessageContainer').html(complaintList);
                        }
                    },
                    error: function (xhr) {
                        // Handle the error response
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = `
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <p class="font-bold">Please fix the following errors:</p>
                        <ul>`;

                        // Loop through the errors and display them
                        $.each(errors, function (key, value) {
                            errorMessage += `<li>${value[0]}</li>`;
                        });
                        errorMessage += '</ul></div>';

                        // Display the error messages in the container
                        $('#statusMessageContainer').html(errorMessage);
                    }
                });
            });
        });



        $(document).ready(function () {
            // On Send Code click
            $('#sendCode').on('click', function () {
                const email = $('#email').val();
                const name = $('#name').val();

                if (email && name) { // Ensure both email and name are filled
                    $.ajax({
                        type: 'POST',
                        url: '/complaint/send-verification-code', // The route to send the verification code
                        data: {
                            email: email,
                            name: name,
                            _token: $('input[name="_token"]').val() // CSRF token
                        },
                        success: function (response) {
                            if (response.success) {
                                $('#emailStatus').text('Verification code sent successfully. Check your email.');
                                $('#codeVerificationField').slideDown(); // Show the code verification input field
                            } else {
                                $('#emailStatus').text('Failed to send verification code.');
                            }
                        },
                        error: function () {
                            $('#emailStatus').text('Error sending verification code.');
                        }
                    });
                } else {
                    $('#emailStatus').text('Please enter a valid name and email.');
                }
            });

            // On Verify Code click
            $('#verifyCode').on('click', function () {
                const verificationCode = $('#verificationCode').val();

                if (verificationCode) {
                    $.ajax({
                        type: 'POST',
                        url: '/complaint/verify-code', // The route to verify the code
                        data: {
                            verification_code: verificationCode,
                            _token: $('input[name="_token"]').val() // CSRF token
                        },
                        success: function (response) {
                            if (response.success) {
                                $('#verificationStatus').text('Code verified successfully.').css('color', 'green');
                            } else {
                                $('#verificationStatus').text('Invalid verification code.').css('color', 'red');
                            }
                        },
                        error: function () {
                            $('#verificationStatus').text('Error verifying the code.').css('color', 'red');
                        }
                    });
                } else {
                    $('#verificationStatus').text('Please enter the verification code.');
                }
            });
        });


        $(document).ready(function () {
            $('#complaint-form').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                // Clear previous messages
                $('#messageContainer').html('');

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Use the form's action URL
                    data: $(this).serialize(), // Serialize the form data
                    success: function (response) {
                        // Handle the success response
                        $('#messageContainer').html(`
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p class="font-bold">${response.success}</p>
                            <p>Your Complaint ID: <strong>${response.complaint_id}</strong></p>
                            <p>Further information has been sent to your email.</p>
                        </div>
                    `);
                        $('#complaint-form')[0].reset();
                        $('#codeVerificationField').reset();
                        $('#codeVerificationField').hide();
                    },
                    error: function (xhr) {
                        // Handle the error response
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert"><p class="font-bold">Please fix the following errors:</p><ul>';

                        // Loop through the errors and display them
                        $.each(errors, function (key, value) {
                            errorMessage += `<li>${value[0]}</li>`;
                        });
                        errorMessage += '</ul></div>';

                        $('#messageContainer').html(errorMessage);
                    }
                });
            });
        });
    </script>



    <script>
        AOS.init();
    </script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensures the body covers full viewport height */
        }
        .content {
            flex: 1; /* Allows content to grow and take available space */
        }
        @keyframes fadeRight {
            0% {
                opacity: 0;
                transform: translateX(-80px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fade-right {
            animation: fadeRight 1s ease-out;
        }
    </style>
</head>

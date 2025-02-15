@extends('admin.client.edit')
@section('clientcontent')
    
        <livewire:client-item :clientId="$client->id" :clientDetails="$client" />

    
@endsection
@section('script')
    <script>
        // document.addEventListener("DOMContentLoaded", () => {
        //     // Auto-update item name
        //     document.querySelector("#equfax-item_name]").addEventListener("input", function() {
        //         const value = this.value;
        //         document.querySelector("[#experian-item_name").value = value;
        //         document.querySelector("[#experian-item_name").value = value;
        //     });

        //     // Auto-update item type
        //     document.querySelector("[#equfax-item_type").addEventListener("change", function() {
        //         const value = this.value;
        //         document.querySelector("[#experian-item_type").value = value;
        //         document.querySelector("[#experian-item_type").value = value;
        //     });

        //     // Auto-update account number
        //     document.querySelector("[#equfax-account_no").addEventListener("input", function() {
        //         const value = this.value;
        //         document.querySelector("[#experian-account_no").value = value;
        //         document.querySelector("[#experian-account_no").value = value;
        //     });

        //     // Auto-update open date
        //     document.querySelector("[#equfax-open_date").addEventListener("input", function() {
        //         const value = this.value;
        //         document.querySelector("[#experian-open_date").value = value;
        //         document.querySelector("[#experian-open_date").value = value;
        //     });

        //     // Auto-update status
        //     document.querySelector("[#equfax-status").addEventListener("change", function() {
        //         const value = this.value;
        //         document.querySelector("[#experian-status").value = value;
        //         document.querySelector("[#experian-status").value = value;
        //     });

            // document.querySelector('#add-hide-btn').addEventListener("click", function() {
            //     const form = document.querySelector('#dataForm'); // Get the form element
            //     const addHideBtn = document.querySelector('#add-hide-btn'); // Get the button text element

            //     if (form.classList.contains('d-none')) {
            //         // Remove `d-none` to show the form
            //         form.classList.remove('d-none');
            //         // Update the button text to "Hide Item"
            //         addHideBtn.textContent = 'Hide Item Form';
            //     } else {
            //         // Add `d-none` to hide the form
            //         form.classList.add('d-none');
            //         // Update the button text to "Add Item"
            //         addHideBtn.textContent = 'Add Item Form';
            //     }
            // });
        // });
        // document.addEventListener('DOMContentLoaded', function() {
        //     function handleFormSubmission() {
        //         const submitBtn = document.getElementById('submitBtn');
        //         const form = document.querySelector('#client-documents-store');
        //         const formData = new FormData(form);
        //         submitBtn.innerHTML =
        //             '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        //         submitBtn.disabled = true;
        //         const formAction = form.action;

        //         fetch(formAction, {
        //                 method: "POST",
        //                 headers: {
        //                     "X-CSRF-TOKEN": "{{ csrf_token() }}",
        //                     "Accept": "application/json"
        //                 },
        //                 body: formData
        //             })
        //             .then(response => {
        //                 if (!response.ok) {
        //                     return response.json().then(data => {
        //                         throw data;
        //                     });
        //                 }
        //                 return response.json(); // Handle success response
        //             })
        //             .then(data => {
        //                 if (data.status === 'success') {
        //                     swal(data.msg, "", "success")
        //                         .then(() => {
        //                             // window.location.href = data.toUrl;
        //                             submitBtn.innerHTML = 'Submit';
        //                             submitBtn.disabled = false;
        //                         });
        //                 } else {
        //                     swal("Error creating expenditure. Please try again.", "", "error");
        //                     submitBtn.innerHTML = 'Submit';
        //                     submitBtn.disabled = false;
        //                 }
        //             })
        //             .catch(error => {
        //                 if (error.errors) {
        //                     // Clear previous error messages before adding new ones
        //                     document.querySelectorAll('.text-danger').forEach(element => {
        //                         element.remove();
        //                     });

        //                     // Display validation errors next to the respective fields
        //                     for (const [key, messages] of Object.entries(error.errors)) {
        //                         const inputElement = document.querySelector(`[name="${key}"]`);
        //                         if (inputElement) {
        //                             // Only create and append new error messages if they don't exist already
        //                             let errorElement = inputElement.parentElement.querySelector('.text-danger');
        //                             if (!errorElement) {
        //                                 errorElement = document.createElement('span');
        //                                 errorElement.classList.add('text-danger');
        //                                 inputElement.parentElement.appendChild(errorElement);
        //                             }

        //                             errorElement.innerHTML = `<strong>${messages.join(' ')}</strong>`;
        //                         }
        //                     }
        //                 } else {
        //                     swal("Some error occurred. Please try again.", "", "error");
        //                 }

        //                 // Re-enable the submit button
        //                 submitBtn.innerHTML = 'Submit';
        //                 submitBtn.disabled = false;
        //             });
        //     }

        //     // Attach the submit handler to the form submit
        //     const form = document.querySelector('#client-documents-store');
        //     form.addEventListener('submit', function(event) {
        //         event.preventDefault();
        //         handleFormSubmission();
        //     });
        // })
    </script>
@endsection

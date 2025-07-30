<!-- resources/views/includes/footer.blade.php -->
<footer
    style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #f1f1f1; padding: 10px 0;height:32px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                {{-- <p>&copy; {{ date('Y') }} Nerasoft. All rights reserved. Powered by <a href="https://nerasoft.in/"
                        target="_blank">Nerasoft</a></p> --}}
                        <p>Copyright © 2025 {{ @$company->name }}. All rights reserved by KSP Smart Pvt Ltd.
                        Designed and developed by <a href="https://nerasoft.in" target="_blank">Nerasoft</a></p>
            </div>
        </div>
    </div>
</footer>


<script src="{{ asset('assets/js/vendor.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/app.min.js') }}" type="text/javascript"></script>
<!--Datatable--->
<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"
    type="text/javascript"></script>
<script src="{{ asset('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"
    type="text/javascript"></script>
<script src="{{ asset('assets/js/demo/table-manage-default.demo.js') }}" type="text/javascript"></script>
<script>
    var thispageurl = window.location.href;
    console.log(thispageurl)
    $(".find-link .menu-item").children().each(function() {
        if (this.href === thispageurl) {
            $(this).closest(".menu-item").addClass("active")
            $(this).closest(".has-sub").addClass("active")
        }
    });
</script>
<script src="{{ asset('toast.js') }}"></script>
<script>
    $(document).ready(function() {
        // Check for success message in the session
        @if (session('success'))
            $.toast({
                type: 'info', // Set type to 'success'
                title: 'Success!',
                content: "{{ session('success') }}", // Get success message from session
                delay: 5000,
            });
        @endif

        // Check for error message in the session
        @if (session('error'))
            $.toast({
                type: 'error', // Set type to 'error'
                title: 'Error!',
                content: "{{ session('error') }}", // Get error message from session
                delay: 5000,
            });
        @endif
    });
</script>
<script>
    function UserVerified(table_name, id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if ($("#user_verified" + id + "").is(':checked')) {
            var status = 1;
        } else {
            var status = 2;
        }

        $.ajax({
            url: "{{ route('user.verified') }}",
            type: 'post',
            data: {
                _token: csrfToken,
                table_name: table_name,
                id: id,
                status: status
            },
            success: function(response) {
                console.log(response);
            }
        });
        return false;
    }
</script>
<script>
    function ChangeStatus(table_name, id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if ($("#flexSwitchCheckDefault" + id + "").is(':checked')) {
            var status = 1;
        } else {
            var status = 2;
        }

        $.ajax({
            url: "{{ route('change.status') }}",
            type: 'post',
            data: {
                _token: csrfToken,
                table_name: table_name,
                id: id,
                status: status
            },
            success: function(response) {
                console.log(response);
            }
        });
        return false;
    }
</script>
<script>
    fetchNotes();

    function SaveNotes() {
    var notes = $('#notes').val().trim();
    var user_id = $('#user_id').val();
    var status = $('#status').val();
    var lead_id = $('#lead_id').val();
    var hidden_id = $('#hidden_id').val();
    var provider_id = $('#provider_id').val();
    var loan_amount = $('#loan_amount').val(); // Get loan amount
    var fileUpload = $('#file_upload')[0].files[0]; // Get the uploaded file
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    if (notes === '') {
        Swal.fire("Error!", "Notes Title Required!", "error");
        return false;
    }
    if (status === '') {
        Swal.fire("Error!", "Please Select Status!", "error");
        return false;
    }
    if (provider_id === '') {
        Swal.fire("Error!", "Please Select Provider!", "error");
        return false;
    }
    if (loan_amount === '') {
        Swal.fire("Error!", "Loan Amount is Required!", "error");
        return false;
    }

    var formData = new FormData(); // Use FormData to send the file along with other data
    formData.append('_token', csrfToken);
    formData.append('title', notes);
    formData.append('user_id', user_id);
    formData.append('status', status);
    formData.append('lead_id', lead_id);
    formData.append('hidden_id', hidden_id);
    formData.append('provider_id', provider_id);
    formData.append('loan_amount', loan_amount);
    if (fileUpload) {
        formData.append('file_upload', fileUpload); // Append the file
    }

    $.ajax({
        url: "{{ route('notes.create') }}",
        type: 'POST',
        data: formData,
        processData: false,  // Important: prevent jQuery from processing data
        contentType: false,  // Important: let the browser set content type
        success: function(response) {
            if (response == 2) {
                Swal.fire("Error!", "Route Does Not Exist for This Zipcode", "error");
                return false;
            }
            let text_message = "";
            if (status == 7) {
                text_message = "Lead Rejected Successfully";
            }
            if (status == 6) {
                text_message = "Lead Qualified Successfully";
            }
            if (response == 1) {
                Swal.fire({
                    title: "Success!",
                    text: text_message,
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                }).then(function() {
                    var routeUrl = "{{ route('lead') }}";
                    window.location.href = routeUrl;
                });
            }

            let loan_status;
            switch (status) {
                case '1':
                    loan_status = "Pending";
                    break;
                case '2':
                    loan_status = "View";
                    break;
                case '3':
                    loan_status = "Under Discussion";
                    break;
                case '4':
                    loan_status = "Pending Kyc";
                    break;
                case '5':
                    loan_status = "Qualified";
                    break;
                case '6':
                    loan_status = "Rejected";
                    break;
                default:
                    loan_status = "Unknown";
                    break;
            }

            $("#fetch_loan_status").html("<p>" + loan_status + "</p>");
            fetchNotes();
            $("#notes").val('');
            $("#hidden_id").val('');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            Swal.fire("Error!", "An error occurred while saving the note.", "error");
        }
    });
}


    function fetchNotes() {

        var lead_id = $('#lead_id').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('notes.fetch') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                lead_id: lead_id
            },
            success: function(response) {
                $("#note_html").html(response);
                console.log(respone);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while saving the note.");
            }
        });
    }

    function deleteNotes(id) {
        if (confirm('Are you sure you want to delete this note?')) {

            var lead_id = id;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('notes.delete') }}",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    note_id: lead_id
                },
                success: function(response) {
                    fetchNotes();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("An error occurred while saving the note.");
                }
            });
        }
    }

    function editnotes(id) {

        var dataMessage = $('a[onclick="editnotes(' + id + ')"]').data('message');
        $("#notes").val(dataMessage);
        $("#hidden_id").val(id);
    }

    function startDisscussion(id, user_id) {

        var id = id;
        var user_id = user_id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('notes.disscuss') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                id: id,
                user_id: user_id
            },
            success: function(response) {
                window.location.reload();
                fetchNotes();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while saving the note.");
            }
        });
    }

    function ViewrightModal(lead_id) {
        var lead_id = lead_id;

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('viewright.modal') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                lead_id: lead_id,

            },
            success: function(response) {
                $(".job-tracking-vertical").html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while saving the note.");
            }
        });
    }

    function Change_kyc_status(kyc_id) {
        var kyc_status = $("#routeSelect").val();
        if (kyc_status == 3) {
            $("#myModal").modal('show');
        }
        if (kyc_status == 4) {
            $("#RejectModal").modal('show');
        }
        $(".kyc_id").val(kyc_id);
        $(".kyc_status").val(kyc_status);

    }

    function showDropdown() {

    }

    function OpenAssignModal(current_user_id, lead_id,lead_create_user_id) {
        if (current_user_id) {
            $("#lead_create_user_id").val(lead_create_user_id);
            $("#current_user_id").val(current_user_id);
            $("#current_lead_id").val(lead_id);
        }
    }

    function AssignLead() {

        $(".assign_error").text('');
        $(".assign_success").text('');
        var current_user_id = $("#current_user_id").val();
        var assign_user_id = $("#selectOption").val();
        var lead_id = $("#current_lead_id").val();
        var lead_create_user_id = $("#lead_create_user_id").val();
        var rejected = $("#rejected").val();
        if(rejected){
            rejected = rejected
        }else{
            rejected = 0;
        }
        if (!assign_user_id) {
            $(".assign_error").text("Please Select Assign User");
            return false;
        }

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('assign.lead') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                current_user_id: current_user_id,
                rejected: rejected,
                assign_user_id: assign_user_id,
                lead_id: lead_id,
            },
            success: function(response) {
                if(response ==  1){
                $(".assign_error").text("Lead Already Assigned to This User");
                return false;
                }
                $(".assign_error").text('');
                $(".assign_success").text("Lead Assigned Successfully");
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while assigning the lead.");
            }
        });
    }
</script>
<script>
    $('[data-toggle="app-sidebar-mobile"]').on('click', function () {
    $('.app-sidebar').toggleClass('open');
    $('body').toggleClass('sidebar-mobile-open');
});

function LeadApprove(){
    var loan_status = $("#status").val();
    if(loan_status == 5 || loan_status ==  6 ){
        $(".remove_class").removeClass('d-none');
    }else{
        $(".remove_class").addClass('d-none');
    }
}

</script>

</body>

</html>

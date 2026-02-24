@extends('layouts.app')

@section('title', 'Safety Check')
@section('page-title', 'Electrical Safety Check')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">

        <form method="POST" action="{{ route('safetycheck.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card card-primary card-outline">

                <!-- Card Header -->
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bolt mr-2"></i>
                        Safety Inspection Form
                    </h3>
                </div>

                <!-- Card Body -->
                <div class="card-body">

                    <!-- Customer Section -->
                    <h5 class="mb-3 text-primary">
                        <i class="fas fa-user mr-1"></i>
                        Customer Information
                    </h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer</label>
                                <input type="text" name="customer"
                                    class="form-control"
                                    placeholder="Enter customer name"
                                    value="{{ old('customer') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" name="contact"
                                    class="form-control"
                                    placeholder="Enter contact person"
                                    value="{{ old('contact') }}">
                            </div>
                        </div>
                    </div>

                    </br>
                    <hr>
                    </br>

                    <!-- Property Section -->
                    <h5 class="mb-3 text-primary">
                        <i class="fas fa-building mr-1"></i>
                        Property Details
                    </h5>

                    <div class="form-group">
                        <label>Property Address</label>
                        <input type="text" name="property_address"
                            class="form-control"
                            placeholder="Enter property address"
                            value="{{ old('property_address') }}">
                    </div>

                    <div class="form-group">
                        <label>Job Number</label>
                        <input type="text" name="job_number"
                            class="form-control"
                            placeholder="Enter job number"
                            value="{{ old('job_number') }}">
                    </div>

                    <div class="form-group">
                        <label>Previous Inspection (if known)</label>
                        <input type="text" name="previous_inspection"
                            class="form-control"
                            placeholder="Enter previous inspection reference"
                            value="{{ old('previous_inspection') }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Inspection Date</label>
                                <input type="date" name="inspection_date"
                                    class="form-control"
                                    value="{{ old('inspection_date') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Next Inspection Due By</label>
                                <input type="date" name="next_inspection_due"
                                    class="form-control"
                                    value="{{ old('next_inspection_due') }}">
                            </div>
                        </div>
                    </div>

                    </br>
                    <hr>
                    </br>

                    <!-- Property Section -->
                    <h5 class="mb-3 text-primary">
                        <i class="fas fa-building mr-1"></i>
                        Regulation Details
                    </h5>

                    <div class="text-right mb-3">
                        <button type="button" id="addRegulation" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add Regulation
                        </button>
                    </div>

                    <div id="regulationAccordion">
                        <!-- Dynamic regulations will be inserted here -->
                    </div>

                </div>

                <!-- Card Footer -->
                <div class="card-footer text-right">
                    <a href="{{ route('safetycheck.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times mr-1"></i>
                        Back
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>
                        Save Inspection
                    </button>
                </div>

            </div>

        </form>

    </div>

</div>

@endsection

@push('scripts')
<script>
    $(function() {

        let regulationCount = 0;

        function updateTitles() {
            $('.regulation-item').each(function(index) {
                $(this).find('.regulation-title')
                    .text('Regulation #' + (index + 1));
            });
        }

        $('#addRegulation').click(function() {

            if (regulationCount >= 10) {
                alert('Maximum 10 regulations allowed.');
                return;
            }

            $.ajax({
                url: "{{ route('safetycheck.regulationForm') }}?key=" + regulationCount,
                type: "GET",
                success: function(response) {

                    regulationCount++;

                    // Collapse existing cards
                    $('.regulation-item .card-body').slideUp();
                    $('.collapse-btn i')
                        .removeClass('fa-minus')
                        .addClass('fa-plus');

                    // Append new one
                    $('#regulationAccordion').append(response);

                    updateTitles();

                    // Scroll down
                    $('html, body').animate({
                        scrollTop: $('#regulationAccordion')[0].scrollHeight
                    }, 400);
                },
                error: function() {
                    alert('Unable to load regulation form.');
                }
            });

        });

        // Collapse toggle
        $(document).on('click', '.collapse-btn', function() {

            let icon = $(this).find('i');
            let body = $(this).closest('.card').find('.card-body');

            body.slideToggle();
            icon.toggleClass('fa-minus fa-plus');
        });

        // Remove regulation
        $(document).on('click', '.remove-regulation', function() {

            $(this).closest('.regulation-item').remove();
            regulationCount--;
            updateTitles();
        });

        // Load first regulation automatically
        $('#addRegulation').click();

    });
</script>
@endpush
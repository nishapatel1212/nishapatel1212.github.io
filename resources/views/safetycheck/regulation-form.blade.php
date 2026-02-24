<!-- Regulation -->
<div id="regulationTemplate">

    <div class="card card-outline card-secondary regulation-item">

        <div class="card-header">
            <h3 class="card-title regulation-title">
                Regulation #1
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool collapse-btn" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>

                <button type="button" class="btn btn-tool text-danger remove-regulation">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Regulation</label>
                    <input type="text"
                        name="regulation[]"
                        class="form-control"
                        placeholder="Enter regulation (e.g. Regulation 4.2(b))">
                </div>

                <!-- Location -->
                <div class="col-md-6 form-group">
                    <label>Location</label>
                    <input type="text"
                        name="location[]"
                        class="form-control"
                        placeholder="Enter location (e.g. Ensuite)">
                </div>
            </div>

            <!-- Images -->
            <div class="form-group">
                <label>Upload Images</label>
                <div class="custom-file">
                    <input type="file"
                        name="images[{{ $key }}][]"
                        class="custom-file-input"
                        multiple>
                    <label class="custom-file-label">Choose images</label>
                </div>
            </div>

            <!-- Rectification -->
            <div class="form-group">
                <label>Rectification</label>
                <textarea name="rectification[]"
                    class="form-control"
                    rows="3"
                    placeholder="Enter rectification details"></textarea>
            </div>
        </div>

    </div>

</div>
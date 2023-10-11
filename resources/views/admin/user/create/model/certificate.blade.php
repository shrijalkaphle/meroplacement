<div class="modal fade" id="addCertificate" tabindex="-1" role="dialog" aria-labelledby="addEducationTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEducationTitle">Add Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('certificate.store') }}" method="POST">
                @csrf
                <input type="hidden" name="job_seeker_id" value="{{ $user->jobseeker->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title <span style="color:red">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="institute_name">Name of Institute <span style="color:red">*</span></label>
                        <input type="text" name="institute_name" id="institute_name" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="duration">Duration <span style="color:red">*</span></label>
                            <input type="text" name="duration" id="duration" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="obtained_date">Obtained At <span style="color:red">*</span></label>
                            <input type="date" name="obtained_date" id="obtained_date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editCertificate" tabindex="-1" role="dialog" aria-labelledby="editCertificateTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCertificateTitle">Edit Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body edit-body">
                    <div class="form-group">
                        <label for="title">Title <span style="color:red">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="institute_name">Name of Institute <span style="color:red">*</span></label>
                        <input type="text" name="institute_name" id="institute_name" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="duration">Duration <span style="color:red">*</span></label>
                            <input type="text" name="duration" id="duration" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="obtained_date">Obtained At <span style="color:red">*</span></label>
                            <input type="date" name="obtained_date" id="obtained_date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteCertificate" tabindex="-1" role="dialog" aria-labelledby="deleteCertificateTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCertificateTitle">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p>Are You Sure Want to Delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.certificate-edit-model', function() {
        var all = $(this).data('all')
        $('#editCertificate #title').val(all.title)
        $('#editCertificate #institute_name').val(all.institute_name)
        $('#editCertificate #duration').val(all.duration)
        $('#editCertificate #obtained_date').val(all.obtained_date)
        
        var action = '/jobseeker/certificate/'+all.id+'/update'
        $('#editCertificate #editForm').attr("action", action)
    })

    $(document).on('click', '.certificate-delete-model', function() {
        var id = $(this).data('id')
        
        var action = '/jobseeker/certificate/'+id
        $('#deleteEducation #deleteForm').attr("action", action)
    })
</script>
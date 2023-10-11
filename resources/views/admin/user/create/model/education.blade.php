<div class="modal fade" id="addEducation" tabindex="-1" role="dialog" aria-labelledby="addEducationTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEducationTitle">Add Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('education.store') }}" method="POST">
                @csrf
                <input type="hidden" name="job_seeker_id" value="{{ $user->jobseeker->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="program">Education Program <span style="color:red">*</span></label>
                        <input type="text" name="program" id="program" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="qualification_id">Degree/Qualification <span style="color:red">*</span></label>
                            <select name="qualification_id" id="qualification_id" class="form-control" required>
                                @foreach ($qualifications as $q)
                                    <option value="{{ $q->id }}">{{ $q->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="board">Education Board <span style="color:red">*</span></label>
                            <input type="text" name="board" id="board" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="institute_name">Name of Institute <span style="color:red">*</span></label>
                        <input type="text" name="institute_name" id="institute_name" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="start_date">Started Date <span style="color:red">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">End Date <span style="color:red">*</span></label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                            <input type="checkbox" id="currently_studing"> Currently Studing
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

<div class="modal fade" id="editEducation" tabindex="-1" role="dialog" aria-labelledby="editEducationTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEducationTitle">Edit Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body education-edit">
                    <div class="form-group">
                        <label for="program">Education Program <span style="color:red">*</span></label>
                        <input type="text" name="program" id="program" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="qualification_id">Degree/Qualification <span style="color:red">*</span></label>
                            <select name="qualification_id" id="qualification_id" class="form-control" required>
                                @foreach ($qualifications as $q)
                                    <option value="{{ $q->id }}">{{ $q->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="board">Education Board <span style="color:red">*</span></label>
                            <input type="text" name="board" id="board" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="institute_name">Name of Institute <span style="color:red">*</span></label>
                        <input type="text" name="institute_name" id="institute_name" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="start_date">Started Date <span style="color:red">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">End Date <span style="color:red">*</span></label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                            <input type="checkbox" id="currently_studing"> Currently Studing
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

<div class="modal fade" id="deleteEducation" tabindex="-1" role="dialog" aria-labelledby="deleteEducationTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEducationTitle">Confirm Delete</h5>
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
    $(document).on('change', '#addEducation #currently_studing', function() {
            if(this.checked) {
                $('#addEducation #end_date').attr('disabled', true)
                $('#addEducation #end_date').attr('required', false)
            } else {
                $('#addEducation #end_date').attr('disabled', false)
                $('#addEducation #end_date').attr('required', true)
            }
        })
    
        $(document).on('click', '.education-edit-model', function() {
            var all = $(this).data('all')
            $('#editEducation #program').val(all.program)
            $('#editEducation #qualification_id').val(all.qualification_id)
            $('#editEducation #board').val(all.board)
            $('#editEducation #institute_name').val(all.institute_name)
            $('#editEducation #start_date').val(all.start_date)
            if(all.end_date)
                $('.education-edit #end_date').val(all.end_date)
            else
                $('#editEducation #currently_studing').attr('checked', true)
                $('#editEducation #end_date').attr('disabled', true)
                $('#editEducation #end_date').attr('required', false)

            var action = '/jobseeker/education/'+all.id+'/update'
            $('#editEducation #editForm').attr("action", action)
        })
        
        $(document).on('change', '#editEducation #currently_studing', function() {
            if(this.checked) {
                $('#editEducation #end_date').attr('disabled', true)
                $('#editEducation #end_date').attr('required', false)
            } else {
                $('#editEducation #end_date').attr('disabled', false)
                $('#editEducation #end_date').attr('required', true)
            }
        })

        $(document).on('click', '.education-delete-model', function() {
            var id = $(this).data('id')
            
            var action = '/jobseeker/education/'+id
            $('#deleteEducation #deleteForm').attr("action", action)
        })
</script>
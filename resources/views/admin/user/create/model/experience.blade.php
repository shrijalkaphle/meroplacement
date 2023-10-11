<div class="modal fade" id="addExperience" tabindex="-1" role="dialog" aria-labelledby="addExperienceTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExperienceTitle">Add Work Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('experience.store') }}" method="POST">
                @csrf
                <input type="hidden" name="job_seeker_id" value="{{ $user->jobseeker->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="organization_name">Organization Name <span style="color:red">*</span></label>
                        <input type="text" name="organization_name" id="organization_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="organization_nature">Organization Nature <span style="color:red">*</span></label>
                        <select name="organization_nature" id="organization_nature" class="form-control" required>
                            @foreach ($industries as $i)
                                <option value="{{ $i->id }}">{{ $i->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="organization_location">Organization Location <span style="color:red">*</span></label>
                        <input type="text" name="organization_location" id="organization_location" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="position">Position <span style="color:red">*</span></label>
                            <input type="text" name="position" id="position" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="position_level">Position Level<span style="color:red">*</span></label>
                            <select name="position_level" id="position_level" class="form-control" required>
                                <option value="top">Top Level</option>
                                <option value="senior">Senior Level</option>
                                <option value="mid">Mid Level</option>
                                <option value="entry">Entry Level</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="start_date">Started Date <span style="color:red">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">End Date <span style="color:red">*</span></label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                            <input type="checkbox" id="currently_working"> Currently Working
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="responsibilities">Duties & Responsibilities <span style="color:red">*</span></label>
                        <textarea name="responsibilities" id="responsibilities" cols="30" rows="10"></textarea>
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

<div class="modal fade" id="editExperience" tabindex="-1" role="dialog" aria-labelledby="addExperienceTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExperienceTitle">Edit Work Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="organization_name">Organization Name <span style="color:red">*</span></label>
                        <input type="text" name="organization_name" id="organization_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="organization_nature">Organization Nature <span style="color:red">*</span></label>
                        <select name="organization_nature" id="organization_nature" class="form-control" required>
                            @foreach ($industries as $i)
                                <option value="{{ $i->id }}">{{ $i->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="organization_location">Organization Location <span style="color:red">*</span></label>
                        <input type="text" name="organization_location" id="organization_location" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="position">Position <span style="color:red">*</span></label>
                            <input type="text" name="position" id="position" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="position_level">Position Level<span style="color:red">*</span></label>
                            <select name="position_level" id="position_level" class="form-control" required>
                                <option value="top">Top Level</option>
                                <option value="senior">Senior Level</option>
                                <option value="mid">Mid Level</option>
                                <option value="entry">Entry Level</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="start_date">Started Date <span style="color:red">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">End Date <span style="color:red">*</span></label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                            <input type="checkbox" id="currently_working"> Currently Working
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="responsibilities">Duties & Responsibilities <span style="color:red">*</span></label>
                        <textarea name="responsibilities" id="responsibilities" cols="30" rows="10"></textarea>
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

<div class="modal fade" id="deleteExperience" tabindex="-1" role="dialog" aria-labelledby="addExperienceTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExperienceTitle">Confirm Delete</h5>
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
    $(document).on('click', '.experience-edit-model', function() {
        var all = $(this).data('all')
        $('#editExperience #organization_name').val(all.organization_name)
        $('#editExperience #organization_nature').val(all.organization_nature)
        $('#editExperience #organization_location').val(all.organization_location)
        $('#editExperience #position').val(all.position)
        $('#editExperience #position_level').val(all.position_level)
        $('#editExperience #start_date').val(all.start_date)
        if(all.end_date)
            $('#editExperience #end_date').val(all.end_date)
        else
            $('#editExperience #currently_working').attr('checked', true)
            $('#editExperience #end_date').attr('disabled', true)
            $('#editExperience #end_date').attr('required', false)
        const domEditableElement = document.querySelector( '#editExperience .ck-editor__editable' )
        const editorInstance = domEditableElement.ckeditorInstance
        editorInstance.setData(all.responsibilities)

        var action = '/jobseeker/experience/'+all.id+'/update'
        $('#editExperience #editForm').attr("action", action)
    })
    $(document).on('click', '.experience-delete-model', function() {
        var id = $(this).data('id')
        
        var action = '/jobseeker/experience/'+id
        $('#deleteExperience #deleteForm').attr("action", action)
    })
    $(document).on('change', '#editExperience #currently_working', function() {
        if(this.checked) {
            $('#editExperience #end_date').attr('disabled', true)
            $('#editExperience #end_date').attr('required', false)
        } else {
            $('#editExperience #end_date').attr('disabled', false)
            $('#editExperience #end_date').attr('required', true)
        }
    })
    $(document).on('change', '#currently_working', function() {
        if(this.checked) {
            $('#end_date').attr('disabled', true)
            $('#end_date').attr('required', false)
        } else {
            $('#end_date').attr('disabled', false)
            $('#end_date').attr('required', true)
        }
    })
    ClassicEditor.create( document.querySelector( '#responsibilities' )).catch( error => {
        console.error( error );
    } );
    ClassicEditor.create( document.querySelector( '#editExperience #responsibilities' )).catch( error => {
        console.error( error );
    } );
</script>
@extends('layout.app')
@section('title','Tutorial Info')


@section('content')

<div class="container">
<div class="row">
<div class="col-md-12 p-5">
<button id="addNewClass" class="btn btn-sm my-3 btn-danger">Add New Class</button>
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Topic</th>
	  <th class="th-sm">Title</th>
	  <th class="th-sm">Video</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="classroom">
  
	
  </tbody>
</table>

</div>
</div>
</div>



 <div class="modal fade" id="addClassroomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body text-center p-5">
                
        
        <div id="ClassAddForm">
        <h6 class="mb-4">Add New Class</h6>
        <input id="ClassAddTopicId" type="text" id=" " class="form-control mb-4" placeholder="Topic">
        <input id="ClassAddTitleId" type="text" id=" " class="form-control mb-4" placeholder="Title">
        <input id="ClassAddVideoId" type="text" id=" " class="form-control mb-4" placeholder="Video">
        
        </div>
        

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="ClassAddConfirm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="deleteClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body text-center p-3">
        <h5 class="mt-4">Do you want you delete?</h5>
        <h6 id="ClassDeleteId" class="mt-4"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="ClassDeleteConfirm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="editClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div id="ClassEditForm" class="modal-body text-center p-5">
                
        <h6 class="mb-4">Edit Class</h6>
        <h6 id="ClassEditId" class="mt-4"></h6>
        <input id="ClassTopicEditId" type="text" id=" " class="form-control mb-4" placeholder="Topic">
        <input id="ClassTitleEditId" type="text" id=" " class="form-control mb-4" placeholder="Title">
        <input id="ClassVideoEditId" type="text" id=" " class="form-control mb-4" placeholder="Video">

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="ClassEditConfirm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('script')

<script >
 getClass();

</script>

@endsection
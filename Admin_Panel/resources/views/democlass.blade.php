@extends('layout.app')
@section('title','Demo Class')


@section('content')

<div class="container">
<div class="row">
<div class="col-md-12 p-5">
<button id="addNewDemoClass" class="btn btn-sm my-3 btn-danger">Add New Demo Class</button>
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
  <tbody id="democlass-table">
  
	
  </tbody>
</table>

</div>
</div>
</div>



 <div class="modal fade" id="addDemoClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body text-center p-5">
                
        
        <div id="DemoClassAddForm">
        <h6 class="mb-4">Add New Demo Class</h6>
        <input id="DemoClassTopicId" type="text" id=" " class="form-control mb-4" placeholder="Topic">
        <input id="DemoClassTitleId" type="text" id=" " class="form-control mb-4" placeholder="Title">
        <input id="DemoClassVideoId" type="text" id=" " class="form-control mb-4" placeholder="Video">
        
        </div>
        

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="DemoClassAddConfirm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="deleteDemoClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body text-center p-3">
        <h5 class="mt-4">Do you want you delete?</h5>
        <h6 id="DemoClassDeleteId" class="mt-4"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="DemoClassDeleteConfirm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="editDemoClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div id="DemoClassEditForm" class="modal-body text-center p-5">
                
        <h6 class="mb-4">Edit Demo Class</h6>
        <h6 id="DemoClassEditId" class="mt-4"></h6>
        <input id="DemoClassTopicEditId" type="text" id=" " class="form-control mb-4" placeholder="Topic">
        <input id="DemoClassTitleEditId" type="text" id=" " class="form-control mb-4" placeholder="Title">
        <input id="DemoClassVideoEditId" type="text" id=" " class="form-control mb-4" placeholder="Video">

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="DemoClassEditConfirm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('script')

<script >
 getDemoClass();


 //For Demo Class Table
function getDemoClass() {
    axios.get('/getDemoClass')
        .then(function(response) {

            $('#democlass-table').empty();

            var jsonData = response.data;
            $.each(jsonData, function(i, item) {
                $('<tr>').html(
                    "<td>"+jsonData[i].topic+"</td>"+
                    "<td>"+jsonData[i].title+"</td>"+
                    "<td>"+jsonData[i].video+"</td>"+

                    "<td> <a class='DemoClassEditbtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                    "<td> <a class='DemoClassDeletebtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"

                ).appendTo('#democlass-table');
            });

            $('.DemoClassDeletebtn').click(function()
            {
                var id = $(this).data('id');
                $('#DemoClassDeleteId').html(id);
                $('#deleteDemoClassModal').modal('show');
            })

            $('.DemoClassEditbtn').click(function()
            {
                var id = $(this).data('id');
                DemoClassUpdateDetails(id);
                $('#DemoClassEditId').html(id);
                $('#editDemoClassModal').modal('show');
            })
            

        })
            

                .catch(function(error) {

                });


        
}


//Demo Class Add New button
$('#addNewDemoClass').click(function()
{
  $('#addDemoClassModal').modal('show');
});


// Demo Class Add Modal save Button
$('#DemoClassAddConfirm').click(function()
 {
   
    var democlasstopic = $('#DemoClassTopicId').val();
    var democlasstitle = $('#DemoClassTitleId').val();
    var democlassvideo = $('#DemoClassVideoId').val();
    DemoClassAdd(democlasstopic,democlasstitle,democlassvideo);
})




//Demo Class Add
function DemoClassAdd(topic,title,video) {

    if(topic.length==0)
    {
        toastr.error('Topic Name is Empty.');
    }
    else if(title.length==0){
        toastr.error('Title is Empty.');
    }
    else if(video.length==0){
        toastr.error('Video is Empty.');
    }
    else
    {
    axios.post('/DemoClassAdd', {
           
        democlasstopic: topic,
        democlasstitle: title,
        democlassvideo: video,
        })
        .then(function(response) {
            
            if (response.data == 1) {
                $('#addDemoClassModal').modal('hide');
                toastr.success('Add Successful');
                getDemoClass();
            } else {
                $('#addDemoClassModal').modal('hide');
                toastr.error('Add Fail!');
                getDemoClass();
            }
        })
        .catch(function(error) {

        });
    }
}


// Course Delete Modal Yes Button
$('#DemoClassDeleteConfirm').click(function() {
    var id = $('#DemoClassDeleteId').html();
    DemoClassDelete(id);
})

// Demo Class Delete
function DemoClassDelete(deleteID) {
    axios.post('/DemoClassDelete', {
            id: deleteID
        })
        .then(function(response) {
            if (response.data == 1) {
                $('#deleteDemoClassModal').modal('hide');
                toastr.success('Delete Successful');
                getDemoClass();
            } else {
                $('#deleteDemoClassModal').modal('hide');
                toastr.error('Delete Fail!');
                getDemoClass();
            }
        })
        .catch(function(error) {

        });
}


//Demo Class Update Details

function DemoClassUpdateDetails(detailsID) {
    axios.post('/getDemoDetails', {
            id: detailsID
        })
        .then(function(response) {
            if(response.status==200)
            {
                var jsonData = response.data;
                $('#DemoClassTopicEditId').val(jsonData[0].topic);
                $('#DemoClassTitleEditId').val(jsonData[0].title);
                $('#DemoClassVideoEditId').val(jsonData[0].video);
            }
            
        })
        .catch(function(error) {

        });
}


// Demo Class edit Modal save Button
$('#DemoClassEditConfirm').click(function() {
    var id = $('#DemoClassEditId').html();
    var  democlasstopic = $('#DemoClassTopicEditId').val();
    var democlasstitle = $('#DemoClassTitleEditId').val();
    var democlassvideo = $('#DemoClassVideoEditId').val();
    DemoClassUpdate(id,democlasstopic,democlasstitle,democlassvideo);
})

// Demo Class Update 
function DemoClassUpdate(DemoId,DemoTopic,DemoTitle,DemoVideo) {

    if(DemoTopic.length==0)
    {
        toastr.error('Topic is Empty.');
    }
    else if(DemoTitle.length==0){
        toastr.error('Title is Empty.');
    }
    else if(DemoVideo.length==0){
        toastr.error('Video is Empty.');
    }
    else
    {

    axios.post('/DemoClassUpdate', {
        id            : DemoId,
        democlasstopic: DemoTopic,
        democlasstitle: DemoTitle,
        democlassvideo: DemoVideo,
          
        })
        .then(function(response) {
            
            if (response.data == 1) {
                $('#editDemoClassModal').modal('hide');
                toastr.success('Update Successful');
                getDemoClass();
            } else {
                $('#editDemoClassModal').modal('hide');
                toastr.error('Update Fail!');
                getDemoClass();
            }
        })
        .catch(function(error) {

        });
    }
}





</script>




@endsection()
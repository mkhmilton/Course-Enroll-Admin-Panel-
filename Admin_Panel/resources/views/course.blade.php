@extends('layout.app')
@section('title','Course Info')


@section('content')

<div class="container" >
<div class="row">
<div class="col-md-12 p-5">
<button id="addNewBtnId" class="btn btn-sm my-3 btn-danger">Add New Course</button>
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="course_table">
	
  </tbody>
</table>

</div>
</div>
</div>



<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body text-center p-3">
        <h5 class="mt-4">Do you want you delete?</h5>
        <h6 id="courseDeleteId" class="mt-4"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="courseDeleteConfirm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body text-center p-5">
                
        
        <h6 id="courseEditId" class="mt-4"></h6>
        <input id="courseNameID" type="text" id=" " class="form-control mb-4" placeholder="Course Name">
        <input id="courseDesID" type="text" id=" " class="form-control mb-4" placeholder="Course Description">
        <input id="courseImgID" type="text" id=" " class="form-control mb-4" placeholder="Course Image Link">

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="courseEditConfirm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body text-center p-5">
                
        
        <div id="courseAddForm">
        <h6 class="mb-4">Add New Course</h6>
        <input id="courseNameAddID" type="text" id=" " class="form-control mb-4" placeholder="Course Name">
        <input id="courseDesAddID" type="text" id=" " class="form-control mb-4" placeholder="Course Description">
        <input id="courseImgAddID" type="text" id=" " class="form-control mb-4" placeholder="Course Image Link">
        
        </div>
        

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="courseAddConfirm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@endsection


@section('script')

<script >

getCourseData();


//For Course Table
function getCourseData() {
    axios.get('/getCourseData')
        .then(function(response) {

            $('#course_table').empty();

            var jsonData = response.data;
            $.each(jsonData, function(i, item) {
                $('<tr>').html(
                    "<td><img class='table-img' src=" + jsonData[i].course_img + "></td>" +
                    "<td>" + jsonData[i].course_name + "</td>" +
                    "<td>" + jsonData[i].course_des + "</td>" +
                    "<td> <a class='courseEditbtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                    "<td> <a class='courseDeletebtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"

                ).appendTo('#course_table');
            });

            // Course Table Delete Icon
            $('.courseDeletebtn').click(function() {
                var id = $(this).data('id');
                $('#courseDeleteId').html(id);
                $('#deleteModal').modal('show');
            })
            
            

            //Course Table Edit Icon
            $('.courseEditbtn').click(function() {
                var id = $(this).data('id');

                $('#courseEditId').html(id);
                CourseUpdateDetails(id);
                $('#editModal').modal('show');
            })

            

                .catch(function(error) {

                });


        })
}


// Course Delete Modal Yes Button
$('#courseDeleteConfirm').click(function() {
    var id = $('#courseDeleteId').html();
    courseDelete(id);
})
// Course Delete
function courseDelete(deleteID) {
    axios.post('/CourseDelete', {
            id: deleteID
        })
        .then(function(response) {
            if (response.data == 1) {
                $('#deleteModal').modal('hide');
                toastr.success('Delete Successful');
                getCourseData();
            } else {
                $('#deleteModal').modal('hide');
                toastr.success('Delete Fail!');
                getCourseData();
            }
        })
        .catch(function(error) {

        });
}


// Each Course Update Details
function CourseUpdateDetails(detailsID) {
    axios.post('/CourseDetails', {
            id: detailsID
        })
        .then(function(response) {
            if(response.status==200)
            {
                var jsonData = response.data;
                $('#courseNameID').val(jsonData[0].course_name);
                $('#courseDesID').val(jsonData[0].course_des);
                $('#courseImgID').val(jsonData[0].course_img);
            }
            
        })
        .catch(function(error) {

        });
}

// Course edit Modal save Button
$('#courseEditConfirm').click(function() {
    var id = $('#courseEditId').html();
    var name = $('#courseNameID').val();
    var des = $('#courseDesID').val();
    var img = $('#courseImgID').val();
    CourseUpdate(id,name,des,img);
})

// Course Update 
function CourseUpdate(courseID,CourseName,CourseDes,CourseImg) {

    if(CourseName.length==0)
    {
        toastr.error('Course Name is Empty.');
    }
    else if(CourseDes.length==0){
        toastr.error('Course Description is Empty.');
    }
    else if(CourseImg.length==0){
        toastr.error('Course Image is Empty.');
    }
    else
    {

    axios.post('/CourseUpdate', {
            id: courseID,
            name: CourseName,
            des: CourseDes,
            img: CourseImg,
        })
        .then(function(response) {
            
            if (response.data == 1) {
                $('#editModal').modal('hide');
                toastr.success('Update Successful');
                getCourseData();
            } else {
                $('#editModal').modal('hide');
                toastr.success('Update Fail!');
                getCourseData();
            }
        })
        .catch(function(error) {

        });
    }
}

//Course Add New button
$('#addNewBtnId').click(function()
{
  $('#addModal').modal('show');
});


// Course Add Modal save Button
$('#courseAddConfirm').click(function() {
   
    var name = $('#courseNameAddID').val();
    var des = $('#courseDesAddID').val();
    var img = $('#courseImgAddID').val();
    CourseAdd(name,des,img);
})




//Course Add Method

function CourseAdd(CourseName,CourseDes,CourseImg) {

    if(CourseName.length==0)
    {
        toastr.error('Course Name is Empty.');
    }
    else if(CourseDes.length==0){
        toastr.error('Course Description is Empty.');
    }
    else if(CourseImg.length==0){
        toastr.error('Course Image is Empty.');
    }
    else
    {
    axios.post('/CourseAdd', {
           
            name: CourseName,
            des: CourseDes,
            img: CourseImg,
        })
        .then(function(response) {
            
            if (response.data == 1) {
                $('#addModal').modal('hide');
                toastr.success('Add Successful');
                getCourseData();
            } else {
                $('#addModal').modal('hide');
                toastr.success('Add Fail!');
                getCourseData();
            }
        })
        .catch(function(error) {

        });
    }
}




</script>

@endsection()
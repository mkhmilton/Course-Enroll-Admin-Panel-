//For Visitor Page Table
$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});




//For Class Table
function getClass() {
    axios.get('/getClass')
        .then(function(response){

            $('#classroom').empty();

            var jsonData = response.data;
            $.each(jsonData, function(i, item) {
                $('<tr>').html(
                    "<td>"+jsonData[i].classtopic+"</td>"+
                    "<td>"+jsonData[i].classtitle+"</td>"+
                    "<td>"+jsonData[i].classvideo+"</td>"+

                    "<td> <a class='ClassEditbtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                    "<td> <a class='ClassDeletebtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"

                ).appendTo('#classroom');
            });

            $('.ClassDeletebtn').click(function()
            {
                var id = $(this).data('id');
                $('#ClassDeleteId').html(id);
                $('#deleteClassModal').modal('show');
            })

            $('.ClassEditbtn').click(function()
            {
                var id = $(this).data('id');
                ClassUpdateDetails(id);
                $('#ClassEditId').html(id);
                $('#editClassModal').modal('show');
            })
            

        })
            

                .catch(function(error) {

                });


        
}


// Class Add New button
$('#addNewClass').click(function()
{
  $('#addClassroomModal').modal('show');
});


//  Class Add Modal save Button
$('#ClassAddConfirm').click(function()
 {
   
    var Tutorialclasstopic = $('#ClassAddTopicId').val();
    var Tutorialclasstitle = $('#ClassAddTitleId').val();
    var Tutorialclassvideo = $('#ClassAddVideoId').val();
    ClassAdd(Tutorialclasstopic,Tutorialclasstitle,Tutorialclassvideo);
})




// Class Add
function ClassAdd(classtopic,classtitle,classvideo) {

    if(classtopic.length==0)
    {
        toastr.error('Topic Name is Empty.');
    }
    else if(classtitle.length==0){
        toastr.error('Title is Empty.');
    }
    else if(classvideo.length==0){
        toastr.error('Video is Empty.');
    }
    else
    {
    axios.post('/ClassAdd', {
           
        Tutorialclasstopic: classtopic,
        Tutorialclasstitle: classtitle,
        Tutorialclassvideo: classvideo,
        })
        .then(function(response) {
            
            if (response.data == 1) {
                $('#addClassroomModal').modal('hide');
                toastr.success('Add Successful');
                getClass();
            } else {
                $('#addClassroomModal').modal('hide');
                toastr.error('Add Fail!');
                getClass();
            }
        })
        .catch(function(error) {

        });
    }
}


// Course Delete Modal Yes Button
$('#ClassDeleteConfirm').click(function() {
    var id = $('#ClassDeleteId').html();
    ClassDelete(id);
})

//  Class Delete
function ClassDelete(deleteID) {
    axios.post('/ClassDelete', {
            id: deleteID
        })
        .then(function(response) {
            if (response.data == 1) {
                $('#deleteClassModal').modal('hide');
                toastr.success('Delete Successful');
                getClass();
            } else {
                $('#deleteClassModal').modal('hide');
                toastr.error('Delete Fail!');
                getClass();
            }
        })
        .catch(function(error) {

        });
}


//Class Update Details

function ClassUpdateDetails(detailsID) {
    axios.post('/getDetails', {
            id: detailsID
        })
        .then(function(response) {
            if(response.status==200)
            {
                var jsonData = response.data;
                $('#ClassTopicEditId').val(jsonData[0].classtopic);
                $('#ClassTitleEditId').val(jsonData[0].classtitle);
                $('#ClassVideoEditId').val(jsonData[0].classvideo);
            }
            
        })
        .catch(function(error) {

        });
}


// Class edit Modal save Button
$('#ClassEditConfirm').click(function() {
    var id = $('#ClassEditId').html();
    var  Tutorialclasstopic = $('#ClassTopicEditId').val();
    var Tutorialclasstitle = $('#ClassTitleEditId').val();
    var Tutorialclassvideo = $('#ClassVideoEditId').val();
    ClassUpdate(id,Tutorialclasstopic,Tutorialclasstitle,Tutorialclassvideo);
})

// Class Update 
function ClassUpdate(DemoId,DemoTopic,DemoTitle,DemoVideo) {

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

    axios.post('/ClassUpdate', {
        id            : DemoId,
        Tutorialclasstopic: DemoTopic,
        Tutorialclasstitle: DemoTitle,
        Tutorialclassvideo: DemoVideo,
          
        })
        .then(function(response) {
            
            if (response.data == 1) {
                $('#editClassModal').modal('hide');
                toastr.success('Update Successful');
                getClass();
            } else {
                $('#editClassModal').modal('hide');
                toastr.error('Update Fail!');
                getClass();
            }
        })
        .catch(function(error) {

        });
    }
}




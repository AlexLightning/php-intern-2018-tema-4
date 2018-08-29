
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Jazzy Project</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">


    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Jazz Festivals</a>
      <!--<ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="/login">Admin Login</a>
        </li>
      </ul>-->
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link inactive" href="/">
                  <span data-feather="home"></span>
                  Home <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="/organizers">
                  <span data-feather="user"></span>
                  Organizers <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">          

          <h2>Organizers</h2>
          <div class="table-responsive">
            <table id="festable" class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
                <!--body of table here-->
              </tbody>
            </table>
          </div>
          <button type="button" id="add" class="btn btn-success">Add new organizer</button>

          <form style="display: none;" id="formular">
            <h2>Add organizer</h2>
            <p>All fields are required</p>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
              <label for="desc">Description</label>
              <input type="text" class="form-control" name="description" required>
            </div>
            <button id="adddb" type="submit" class="btn btn-primary">Submit</button>
          </form>


          <form style="display: none;" id="formular2">
            <h2>Update organizer</h2>
            <p>All fields are required</p>
            <div class="form-group">
              <label for="name">Name</label>
              <input id="name2" type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
              <label for="desc">Description</label>
              <input id="description2" type="text" class="form-control" name="description" required>
            </div>
            <button id="updb" type="submit" class="btn btn-primary">Submit</button>
          </form>

        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <script>

        //table stuff:
        $(document).ready( function () {
            var table = $('#festable').DataTable(
                {
                    "ajax": "http://jazz.api.local/organizers",
                    "columns": [
                        { "data": "name" },
                        { "data": "description" },
                        { "data": "id",
                          "render": function (data, type, row, meta ) {
                            return '<button id="update" class="btn btn-primary btn-sm" style="width:49%;" data-id="' + data + '" type="button">Update</button>'
                            + ' ' +  '<button id="delete" class="btn btn-danger btn-sm" style="width:49%;" type="button" data-id="' + data + '">Delete</button>' ; }}
                    ],
                      "columnDefs": [ {
                        "className": "dt-center", 
                        "targets": "_all"
                      },
                      {
                        "targets": 2,
                        "orderable": false
                      }
                    ],
                    "scrollY": false
                }
            );
        });


       //delete button:
        $('#festable tbody').on('click', '#delete', function () {
          var x = confirm("Are you sure you want to delete?");
          if(x)
          {
              var id = $(this).attr('data-id');
            $.ajax({url: "http://jazz.api.local/organizers/"+id, type: 'DELETE', success: function(result){
                location.reload(); }});
          }   
        } );


        //add button:
        $(document).on('click', '#add', function () {
          if($('#formular').css('display') == 'none')
            $('#formular').show();
          else
            $('#formular').hide();
          } );
          
        $(document).on('click', '#adddb', function (event) {
          event.preventDefault();
          var myformdata = $('#formular').serialize();
          $.ajax({
          
          url: "http://jazz.api.local/organizers", 
          type: 'POST', 
          data: myformdata,
          success: function(result,data){
            location.reload(); }});
          } );


          //update button: 

          
          $('#festable tbody').on('click', '#update', function () {
            
            if($('#formular2').css('display') == 'none')
            {
             
              $('#formular2').show();
              event.preventDefault();
              var id = $(this).attr('data-id');
              $.ajax({
                  type: "GET",
                  url: "http://jazz.api.local/organizers/"+id,
                  data: [{ "data": "name" },
                        { "data": "description" }],
                  success: function(data){
                      festivalData = JSON.parse(data);
                      $('#name2').val(festivalData.name);
                      $('#description2').val(festivalData.description);
                  }
              });


                $(document).on('click', '#updb', function (event) {
                event.preventDefault();
                var myformdata = $('#formular2').serialize();
              $.ajax({url: "http://jazz.api.local/organizers/"+id, 
                type: 'PUT', 
                data: myformdata,
                success: function(result){
                    location.reload(); }});
                  } );

            }
            else
            {
              $('#formular2').hide();
              $('#name2').val("");
              $('#description2').val("");
            }


             
          } );


          

    </script>
  </body>
</html>

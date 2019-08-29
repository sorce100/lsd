<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Bootstrap -->
    <link href="pages/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="login.css">

    <link href="plugins/bower_components/parsley/parsley.css" rel="stylesheet">
    <link href="plugins/bower_components/toastr/toastr.min.css" rel="stylesheet">

    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
    <style>
      .form-section {
        padding-left: 15px;
        /*border-left: 2px solid #FF851B;*/
        display: none;
      }
      .form-section.current {
        display: inherit;
      }
      .btn-info, .btn-default {
        margin-top: 10px;
      }
      html.codepen body {
        margin: 1em;
      }
    </style>
  </head>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <form class="demo-form">
            <div class="form-section">
              <label for="firstname">First Name:</label>
              <input type="text" class="form-control" name="firstname" required="">

              <label for="lastname">Last Name:</label>
              <input type="text" class="form-control" name="lastname" required="">
            </div>

            <div class="form-section">
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="email" required="">
            </div>

            <div class="form-section">
              <label for="color">Favorite color:</label>
              <input type="text" class="form-control" name="color" required="">
            </div>

            <div class="form-navigation">
              <button type="button" class="previous btn btn-info pull-left">&lt; Previous</button>
              <button type="button" class="next btn btn-info pull-right">Next &gt;</button>
              <input type="submit" class="btn btn-default pull-right">
              <span class="clearfix"></span>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  


<!--  -->
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script type="pages/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/bower_components/parsley/parsley.min.js"></script>
<script src="plugins/bower_components/toastr/toastr.min.js"></script>


<script type="text/javascript">
$(function () {
  var $sections = $('.form-section');

  function navigateTo(index) {
    // Mark the current section with the class 'current'
    $sections
      .removeClass('current')
      .eq(index)
        .addClass('current');
    // Show only the navigation buttons that make sense for the current section:
    $('.form-navigation .previous').toggle(index > 0);
    var atTheEnd = index >= $sections.length - 1;
    $('.form-navigation .next').toggle(!atTheEnd);
    $('.form-navigation [type=submit]').toggle(atTheEnd);
  }

  function curIndex() {
    // Return the current index by looking at which section has the class 'current'
    return $sections.index($sections.filter('.current'));
  }

  // Previous button is easy, just go back
  $('.form-navigation .previous').click(function() {
    navigateTo(curIndex() - 1);
  });

  // Next button goes forward iff current block validates
  $('.form-navigation .next').click(function() {
    $('.demo-form').parsley().whenValidate({
      group: 'block-' + curIndex()
    }).done(function() {
      navigateTo(curIndex() + 1);
    });
  });

  // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
  $sections.each(function(index, section) {
    $(section).find(':input').attr('data-parsley-group', 'block-' + index);
  });
  navigateTo(0); // Start at the beginning
});
</script>
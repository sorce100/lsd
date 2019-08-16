<?php include("header.php");
  require_once("Classes/News.php");
?>

<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">NEWS SETUP PAGE</div>
            <div class="panel-title pull-right">
               <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD NEWS</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <!-- for search -->
            <div class="col-md-12">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="searchInput" autocomplete="off">
                  <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                </div>
            </div>
            <!-- content -->
            <div class="col-md-12">
              <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                   <tbody id="resultsDisplay">
                        <?php
                          $objNews = new News;
                          $news = $objNews->get_news_all();

                          foreach ($news as $row) {
                                  echo "
                                      <tr>
                                        <td>".$row["news_title"]."</td>
                                        <td>".$row["news_category"]."</td>
                                        <td>
                                          <button type='button' id='".trim($row["news_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                        </td>
                                        <td>
                                          <button type='button' id='".trim($row["news_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
                                        </td>
                                      </tr>
                                    ";
                              }
                         ?>
                    </tbody>
                </table>
              </div>
            </div>
            <!-- end of content -->
        </div>
    </div>

</div>

<?php require_once('admin_news_include.php'); ?>
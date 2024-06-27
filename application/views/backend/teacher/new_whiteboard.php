<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Whiteboard</title>
    <script src="<?php echo base_url();?>public/uploads/whiteboard/lib/paper/paper-full.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>public/uploads/whiteboard/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/uploads/whiteboard/lib/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/uploads/whiteboard/css/style.css">
    <script>
        var boardMode = 'draw';
    </script>
</head>
<body>
  <div class="px-1 position-fixed sticky-sidebar scrollbar-hidden">
    <button type="button" id="move" class="mode-btn btn btn-light border p-0">
      <em class="bi bi-arrows-move"></em>
    </button>
    <button type="button" id="draw" class="mode-btn btn btn-light border p-0">
      <em class="bi bi-brush"></em>
    </button>
    <button type="button" id="del" class="mode-btn btn btn-light border p-0">
      <em class="bi bi-eraser"></em>
    </button>
    <button type="button" id="text" class="mode-btn btn btn-light border p-0">
      <em class="bi bi-type"></em>
    </button>
    <hr>
    <input type="text" id="mode" class="d-none" value="draw">
    <input type="color" id="color" class="form-control bg-light p-1" value="#000000">
    <input type="text" id="width" class="form-control bg-light p-1" value="6">
    <hr>
    <button type="button" id="zoom-in" class="btn btn-light border p-0">
      <em class="bi bi-plus"></em>
    </button>
    <button type="button" id="zoom-out" class="btn btn-light border p-0">
      <em class="bi bi-dash"></em>
    </button>
    <hr>
    <button type="button" id="save-load" class="btn btn-light border p-0" data-toggle="modal"
      data-target="#save-load-modal">
      <em class="bi bi-save"></em>
    </button>
    <hr>
    <a class="btn btn-light border p-0" href="javascript:void(0);"  data-toggle="modal" data-target="#exampleModal">
      <em class="bi bi-info-circle"></em>
    </a>
    <a type="button" class="btn btn-light border p-0" href="<?php echo base_url();?>teacher/whiteboards/<?php echo $data;?>/">
      <em class="bi bi-arrow-90deg-left"></em>
    </a>
  </div>
  <div class="modal fade" id="save-load-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="Save and load modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title save-item" id="save-lable">Save your whiteboard</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><em class="bi bi-x"></em></span>
          </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo base_url();?>teacher/saveboard/" method="POST">
                <input type="hidden" name="data" value="<?php echo $data;?>"/>
                <div class="form-group">
                    <label><b>Whiteboard name:</b></label>
                    <input class="form-control" name="board_name" id="whiteboard_name" required="">    
                </div>
                <hr>
                <textarea id="save-textarea" name="board" style="display:none" class="form-control save-item"></textarea>
                <button id="save-load-done" type="submit" class="btn btn-success bnt-lg">
                    <em class="bi bi-arrow-right-circle"></em>
                    Save this board
                </button>
                <a href="javascript:void(0);" id="save-jpeg-button" class="btn btn-light border save-item bnt-lg">
                    <em class="bi bi-file-earmark-image"></em>
                    Download as JPEG
                </a>
            </form>
        </div>
      </div>
    </div>
  </div>
  <div class="main">
    <canvas resize="true" id="whiteboard" data-paper-scope="1"></canvas>
  </div>
  <div class="hud">
    <div id="zoom-percent-container" class="hover-container">
      <button class="btn btn-light"><span id="zoom-percent">100</span>%</button>
    </div>
  </div>
  
   <style>
        .table td, .table th{
            padding: 4px!important;
        }
    </style>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Board help</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Result</th>
                    <th>Shortcut</th>
                    <th>Mode</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Select area</td>
                    <td>Shift</td>
                    <td>Any</td>
                </tr>       
                <tr>
                    <td>Move</td>
                    <td>Mouse 3</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Delete</td>
                    <td>Mouse 2</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Delete selected items</td>
                    <td>Del, Backspace</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Zoom</td>
                    <td>Mouse wheel</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Change stroke width</td>
                    <td>Space + Mouse wheel</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Clear whiteboard</td>
                    <td>Space + Del</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Reset whiteboard (clear the whiteboard and reset values)</td>
                    <td>Space + Backspace</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Change mode to Move</td>
                    <td>Space + 1</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Change mode to Draw</td>
                    <td>Space + 2</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Change mode to Delete</td>
                    <td>Space + 3</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Change mode to Text</td>
                    <td>Space + 4</td>
                    <td>Any</td>
                </tr>
                <tr>
                    <td>Select single item</td>
                    <td>S</td>
                    <td>Move</td>
                </tr>
                <tr>
                    <td>Horizontal move</td>
                    <td>Q</td>
                    <td>Move</td>
                </tr>
                <tr>
                    <td>Vertical move</td>
                    <td>W</td>
                    <td>Move</td>
                </tr>
                <tr>
                    <td>Rotate selected items</td>
                    <td>R</td>
                    <td>Move</td>
                </tr>
                <tr>
                    <td>Draw rectangle</td>
                    <td>Q</td>
                    <td>Draw</td>
                </tr>
                <tr>
                    <td>Draw circle (1:1)</td>
                    <td>W</td>
                    <td>Draw</td>
                </tr>
                <tr>
                    <td>Draw circle</td>
                    <td>W + E</td>
                    <td>Draw</td>
                </tr>
                <tr>
                    <td>Draw straight line</td>
                    <td>A</td>
                    <td>Draw</td>
                </tr>
                <tr>
                    <td>Draw horizontal line</td>
                    <td>A + S</td>
                    <td>Draw</td>
                </tr>
                <tr>
                    <td>Draw vertical line</td>
                    <td>A + D</td>
                    <td>Draw</td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

  <script src="<?php echo base_url();?>public/uploads/whiteboard/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>public/uploads/whiteboard/lib/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>public/uploads/whiteboard/js/whiteboard.js"></script>
  <script src="<?php echo base_url();?>public/uploads/whiteboard/js/file.js"></script>
  <script src="<?php echo base_url();?>public/uploads/whiteboard/js/tools/general.js"></script>
  <script src="<?php echo base_url();?>public/uploads/whiteboard/js/tools/brush.js"></script>
  <script src="<?php echo base_url();?>public/uploads/whiteboard/js/tools/eraser.js"></script>
  <script src="<?php echo base_url();?>public/uploads/whiteboard/js/tools/hand.js"></script>
  <script src="<?php echo base_url();?>public/uploads/whiteboard/js/tools/shape.js"></script>
  <script src="<?php echo base_url();?>public/uploads/whiteboard/js/tools/text.js"></script>
  <script src="<?php echo base_url();?>public/uploads/whiteboard/js/site.js"></script>
</body>

</html>

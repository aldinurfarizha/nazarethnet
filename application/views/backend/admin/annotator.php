<?php 
    $system_name        =	$this->crud->getInfo('system_name');
	$system_title       =	$this->crud->getInfo('system_title');
?>
<!DOCTYPE html>
<html>
<head>
	<?php $pdfFile = $this->db->get_where('homework_files', array('fhomework_file_id' => $fileID))->row()->edited_name;?>
	<title><?php echo $system_name;?> | <?php echo $system_title;?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>public/annotator/prettify.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>public/annotator/styles.css">
	<link href="<?php echo base_url();?>public/style/cms/icon_fonts_assets/picons-thin/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('favicon');?>" rel="icon">
	<link rel="stylesheet" href="<?php echo base_url();?>public/annotator/pdfannotate.css">
	<?php $fileN = base_url().'public/uploads/homework_delivery/'.$pdfFile;?>
	<script>
		var baseUR = '<?php echo base_url();?>admin/';
		var homCode = '<?php echo $homework_code;?>';
		var fName   = '<?php echo $pdfFile;?>';
		var pdfFile = '<?php echo base_url();?>public/uploads/homework_delivery/<?php echo $pdfFile;?>';
		var sizeD   = '<?php echo filesize('public/uploads/homework_delivery/'.$pdfFile);?>'; 
		var fID     = '<?php echo $fileID;?>'; 
	</script>
</head>
<body>
	<input type="hidden" id="wd">
	<input type="hidden" id="hd">
	<div class="toolbar">
		<div class="tool">
			<a href="<?php echo base_url();?>admin/homework_details/<?php echo $homework_code;?>/" class="text-white" style="background:#95c238!important; border-radius:5px;padding:5px;text-decoration:none;"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i> <?php echo getEduAppGTLang('return');?>
			</a>
		</div>
		<div class="tool">
			<span><?php echo $system_name;?></span>
		</div>
		<div class="tool">
			<label for=""><?php echo getEduAppGTLang('brush_size');?></label>
			<select class="form-control" id="brush-size">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="12">13</option>
				<option value="13">14</option>
				<option value="14">15</option>
				<option value="15">16</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
			</select>
		</div>
		<div class="tool">
			<label for=""><?php echo getEduAppGTLang('font_size');?></label>
			<select id="font-size" class="form-control">
				<option value="10">10</option>
				<option value="12">12</option>
				<option value="16" selected>16</option>
				<option value="18">18</option>
				<option value="24">24</option>
				<option value="32">32</option>
				<option value="48">48</option>
				<option value="64">64</option>
				<option value="72">72</option>
				<option value="108">108</option>
			</select>
		</div>
		<div class="tool">
			<button class="color-tool active" style="background-color: #212121;"></button>
			<button class="color-tool" style="background-color: red;"></button>
			<button class="color-tool" style="background-color: blue;"></button>
			<button class="color-tool" style="background-color: green;"></button>
			<button class="color-tool" style="background-color: yellow;"></button>
		</div>
		<div class="tool">
			<button class="tool-button active"><i class="fa fa-hand-paper-o" title="Free Hand" onclick="enableSelector(event)"></i></button>
		</div>
		<div class="tool">
			<button class="tool-button"><i class="fa fa-pencil" title="Pencil" onclick="enablePencil(event)"></i></button>
		</div>
		<div class="tool">
			<button class="tool-button"><i class="fa fa-font" title="Add Text" onclick="enableAddText(event)"></i></button>
		</div>
		<div class="tool">
			<button class="tool-button"><i class="fa fa-long-arrow-right" title="Add Arrow" onclick="enableAddArrow(event)"></i></button>
		</div>
		<div class="tool">
			<button class="tool-button"><i class="fa fa-square-o" title="Add rectangle" onclick="enableRectangle(event)"></i></button>
		</div>
		<div class="tool">
			<button class="tool-button"><i class="fa fa-picture-o" title="Add an Image" onclick="addImage(event)"></i></button>
		</div>
		<div class="tool">
			<button class="btn btn-danger btn-sm" onclick="deleteSelectedObject(event)"><i class="fa fa-trash"></i></button>
		</div>
		<div class="tool">
			<button class="btn btn-danger btn-sm" onclick="clearPage()"><?php echo getEduAppGTLang('clear_document');?></button>
		</div>
		<div class="tool">
			<button class="btn btn-warning btn-sm text-white" onclick="savePDF()"><i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new"></i> <?php echo getEduAppGTLang('save');?></button>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div id="pdf-container"></div>
		</div>
	</div>
	<script src="<?php echo base_url();?>public/annotator/jquery.min.js"></script>
	<script src="<?php echo base_url();?>public/annotator/popper.min.js"></script>
	<script src="<?php echo base_url();?>public/annotator/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>public/annotator/pdf.min.js"></script>
	<script>pdfjsLib.GlobalWorkerOptions.workerSrc = '<?php echo base_url();?>public/annotator/pdf.worker.min.js';</script>
	<script src="<?php echo base_url();?>public/annotator/fabric.min.js"></script>
	<script src="<?php echo base_url();?>public/annotator/jspdf.umd.min.js"></script>
	<script src="<?php echo base_url();?>public/annotator/run_prettify.js"></script>
	<script src="<?php echo base_url();?>public/annotator/prettify.min.js"></script>
	<script src="<?php echo base_url();?>public/annotator/arrow.fabric.js"></script>
	<script src="<?php echo base_url();?>public/annotator/pdfannotate.js"></script>
	<script src="<?php echo base_url();?>public/annotator/script.js"></script>

	<script>
		setInterval(function() {
			var wd = $("#page-1-canvas").width();
			var hd = $("#page-1-canvas").height();
			$('#wd').val(wd);
			$('#hd').val(hd);
		}, 2000);
	</script>
</body>
</html>
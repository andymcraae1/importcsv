 $(document).ready(function(){
  var clear_timer;
  var clear_timer_2;
  $('#sample_form').on('submit', function(event){
   $('#message').html('');
   event.preventDefault();
   $.ajax({
    url:"ajax/upload.php",
    method:"POST",
    data: new FormData(this),
    dataType:"json",
	contentType:false,    
	
    cache:false,
    processData:false,
    beforeSend:function(){
     $('#import').attr('disabled','disabled');
     $('#import').val('Importing');
    },
	success:function(data){
	 if(data.success){    
		$('#total_data').text(data.total_line);
		$('#initial_rows').text(data.initial_rows);
		start_import();
		clear_timer = setInterval(function() { get_imported_data(data.selected_country); }, 1000);
		clear_timer_2 = setInterval(set_realtime_timer , 1000);
     }
     if(data.error){
      $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
	  $('#import').attr('disabled',false);
	  $('#import').val('Import');
	 }
	}
   })
  });
  function start_import(){
   $('#process').css('display', 'block');
   $.ajax({
	url:"ajax/import.php",
    
	success:function(){
	}
   })
  }
  function get_imported_data(selected_country){
   
   $.ajax({
	type: 'POST',
	
	url:"ajax/process.php",
	data: { user_selected_country: selected_country },
	
	success:function(data){
	var total_data = $('#total_data').text();
	var initial_rows = $('#initial_rows').text();
	var width = Math.round(((data-initial_rows)/total_data)*100);
	 if(data.match("Error")){
		 
		 $('.output_logs').text(data);
	 }else{
		 $('.output_logs').text("No errors");
	 }
	 
     $('#process_data').text(data-initial_rows);	 
	 $('.progress-bar').css('width', width + '%');
	 $('.progress-bar').text(width + '%');
	 //$('#duration').text(duration);

     if(width >= 100){
		clearInterval(clear_timer);
		$('#process').css('display', 'none');
		$('#file').val('');     
		$('#message').html('<div class="alert alert-success">Data Successfully Imported</div>');
		$('#import').attr('disabled',false);
		$('#import').val('Import');
     }
    }
   })
  }
   function set_realtime_timer(){
	var width = $('.progress-bar')[0].style.width;
	width = parseInt(width.replace("%",''));	

	var duration = parseInt($('#duration').text());
	duration +=1;
	$('#duration').text(duration);
     if(width >= 100){
		clearInterval(clear_timer_2);
	 }
  }
 });

<?php 
	require_once "FlashMessages.php"; 

			// Start a Session
	if (!session_id()) @session_start();
		
	// Instantiate the class
	$msg = new \Plasticbrain\FlashMessages\FlashMessages();

	// If you need to check for errors (eg: when validating a form) you can:
	if ($msg->hasErrors()) {
		// There ARE errors
	} else {
	  // There are NOT any errors
	}
		
	// Wherever you want to display the messages simply call:
	$msg->display();
	$msg->setCloseBtn('<button type="button" class="close"  
                        data-dismiss="alert" 
                        aria-label="Close">
                        <span id="closeFlash" aria-hidden="true">&amp;times;</span>
                    </button>')


	// Add messages
	/*$msg->info('This is an info message');
	$msg->success('This is a success message');
	$msg->warning('This is a warning message');
	$msg->error('This is an error message');
	*/


?>

<script>
	window.onload = function(){
	    document.getElementById('closeFlash').onclick = function(){
	        this.parentNode.parentNode.removeChild(this.parentNode);
	        return false;
	    };
	};
</script>
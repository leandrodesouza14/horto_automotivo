<?php

if (isset($_SESSION['mensagem'])): ?>

<script>
	
	// Mensagem de sucesso ou erro de cadastrado

	window.onload = function() {
		  M.toast({html: '<?php echo $_SESSION['mensagem']; ?>'})
	}
</script>

<?php 

endif;

 unset($_SESSION['mensagem']);

?>
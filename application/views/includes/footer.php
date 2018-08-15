<?php $info = $this->datamorph->info() ?>

</div><!-- Container ends -->

<hr>

<div class="container" style="margin-bottom:2rem">
	<footer>
		<span class="m-t-md m-r">server: <b><?php echo $info->server ?></b></span> &nbsp
		<span class="m-t-md m-r">platform: <b><?php echo $info->platform ?></b></span> &nbsp
		<span>version: <b><?php echo $info->version ?></b></span>

		<span class="m-t-md pull-right">U0NSSVBUIFNIQVJFRCBPTiBDT0RFTElTVC5DQw==</span>
		<div class="clearfix"></div>
	</footer>
</div>

<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/masonry.pkgd.min.js')?>"></script>
<script>
    $(document).ready(function() {
		$('.grid').masonry({
			// options
			itemSelector: '.grid-item',
		});
        $('[data-toggle="tooltip"]').tooltip();
        //select all checkboxes
        $('input[name="select_all"]').change(function(){  //"select all" change 
            var status = this.checked; // "select all" checked status
            $('input[name="selected[]"]').each(function(){ //iterate all listed checkbox items
                this.checked = status; //change ".checkbox" checked status
            });
        });

        $('input[name="selected[]"]').change(function(){ //".checkbox" change 
            //uncheck "select all", if one of the listed checkbox item is unchecked
            if(this.checked == false){ //if this item is unchecked
                $("#select_all")[0].checked = false; //change "select all" checked status to false
            }

            //check "select all" if all checkbox items are checked
            if ($('input[name="selected[]"]:checked').length == $('input[name="selected[]"]').length ){ 
                $("#select_all")[0].checked = true; //change "select all" checked status to true
            }
        });
    });
</script>

</body>
</html>
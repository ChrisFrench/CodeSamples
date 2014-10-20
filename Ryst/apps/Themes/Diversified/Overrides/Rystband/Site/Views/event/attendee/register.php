<div class="pushdown" style="padding:10px;margin-top:10px;">

		<form method="post" action="/barcodeid/register">
			<fieldset>
                <legend>Register Band</legend><br>
                            <label>Barcode<span class="required">*</span></label>
                                        <div class="input-control text" data-role="input-control">
                                            <input required name="barcode" type="text" placeholder="barcode ID" value="" autofocus>
                                            <input required name="tagid" type="hidden"  value="<?php echo $PARAMS['tagid'];?>" autofocus>
                                        </div>
                                    </fieldset>
                                </form>
</div>
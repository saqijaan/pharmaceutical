<template>


    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">OP Detail</h4>
                </div>
                <div class="modal-body">
        
                	<div class="row">
	                    <div class="form-group">
	                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="title"> Title <span class="required">*</span>
	                        </label>
	                        <div class="col-md-12 col-sm-12 col-xs-12">
	                            <input type="text" id="title" required="required" v-model="record" name="title" class="form-control col-md-7 col-xs-12">
	                        </div>
	                    </div>

	                    <div class="form-group"><!-- textarea start -->
	                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="detail" style="text-align: left">Detail: <span class="required">*</span>
	                        </label>
	                        <div class="col-md-12 col-sm-12 col-xs-12">

	                            <textarea id="detail" class="" name="detail" v-model="detail" placeholder="Slider Detail">

	                            </textarea>
	                        </div>
	                    </div><!-- textarea end -->
                   </div>		


                </div>
                <div class="modal-footer">

                	<button class="btn btn-primary" data-dismiss="modal" v-on:click="addRecord" type="button" >Save</button>
<!-- data-dismiss="modal" -->
                </div>

            </div>
        </div>
    </div>


</template>

<script type="text/javascript">

	export default{
		data(){
			return{
				record:'',
				detail:'',
			}
		},
		methods:{
			addRecord(){
				axios.post('http://localhost/Protech-application/public/top3Cols',{
					'title': this.record,
					'detail': this.detail,
				})
				.then(data => this.$emit('recordadded', data))
				.catch(error => console.log(error))
				this.record='';
				this.detail='';
			}
		}
	};


</script>

<style type="text/css" scoped></style>




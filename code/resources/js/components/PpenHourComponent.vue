<template>
	

	<div class="vc_row wpb_row vc_row-fluid home-color-white vc_custom_1484580719467 vc_row-o-equal-height vc_row-o-content-top vc_row-flex mpc-row">

		<div v-for="(top3Col, index) in top3Cols" class="wpb_column vc_column_container vc_col-sm-4 vc_col-has-fill mpc-column" data-column-id="mpc_column-515bfd05b53654e">
			
			<div v-bind:class="[index == 0 ?'vc_column-inner vc_custom_1484667286222':'',index == 1 ?'vc_column-inner vc_custom_1484574618723':'',index == 2 ?'vc_column-inner vc_custom_1484574990472':'']">

				<div class="wpb_wrapper">
					<div v-bind:data-id="[index == 0 ?'mpc_icon_column-775bfd05b536310':'' || index == 1 ?'mpc_icon_column-615bfd05b53679f':'' || index == 2 ?'mpc_icon_column-345bfd05b536ae2':'']" class="mpc-icon-column mpc-init mpc-parent-hover mpc-transition mpc-icon-column--style_1 mpc-align--center">

						<div v-bind:data-id="[index == 0 ?'mpc_icon-605bfd05b536394':'' || index == 1 ?'mpc_icon-625bfd05b536817':'' || index == 2 ?'mpc_icon-955bfd05b536b5e':'']" class="mpc-icon mpc-init mpc-transition mpc-effect-none mpc-icon-hover ">
							<div class="mpc-icon-wrap">
								<i v-bind:class="['mpc-icon-part mpc-regular mpc-transition  etl ', index == 0 ? 'etl-alarmclock': 'etl-clipboard', index == 2 ? 'etl-speedometer' : '']"></i>
								<i v-bind:class="['mpc-icon-part mpc-hover mpc-transition  etl ', index == 0 ? 'etl-alarmclock': 'etl-clipboard', index == 2 ? 'etl-speedometer' : '']"></i>
							</div>
						</div>
						<div class="mpc-icon-column__content-wrap">
							<div class="mpc-icon-column__content">
								<h3 class="mpc-icon-column__heading mpc-transition">{{top3Col.title}}</h3>
								<div class="mpc-icon-column__description mpc-transition" v-html=" top3Col.detail">
									<p></p>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>


</template>

<script>
    export default {
    	data(){
    		return{
    			top3Cols:{}, 
    		}
    	},
    	methods:{

    	},
        created(){
        	axios.get('http://localhost/Protech-application/public/top3Cols')
        	.then((response) => this.top3Cols = response.data)
        	.catch((error) => console.log(error));
            console.log('Top Three Column successfully loaded.');
        }
    }
</script>
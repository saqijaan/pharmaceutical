<template>



    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title"><!-- page title and search bar column start -->

                <div class="title_left">
                    <div class="col-md-5 col-sm-12 col-xs-12 form-group top_search">

                        <a href="#addModal" class="btn btn-lg btn-primary waves-effect" data-toggle="modal" type="button"> Create New </a>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div><!-- page title and search bar column end -->


            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12"><!-- col start -->
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Accounts   </h2>
                             
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                              

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action dt-responsive nowrap">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">ID </th>
                                        <th class="column-title"> Title: </th>
                                        <th class="column-title"> Detail: </th>
                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                        <tr v-for="top3Col in top3Cols" class="even pointer">
                                            <td class=" "> {{top3Col.id}} </td>
                                            <td class=" "> {{top3Col.title}} </td>
                                            <td class=" " v-html="top3Col.detail">  </td>
                                            <td class=" last">
                                                <a class="btn btn-success" href="">
                                                    View
                                                </a>
                                                <a href="#" class="btn btn-primary">
                                                    <i  class="fa fa-edit"></i>
                                                </a>
                                                <form method="post" enctype="multipart/form-data" action="" style="display: inline">
                                                    <input name="_method" type="hidden" value="DELETE" />
                                                    <input type="hidden" name="_token" value="">
                                                    <button type="submit"  class="btn btn-danger"  style="margin-left: 5px;"  onclick="return confirm('Do you want to delete ?');" ><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </td>
                                        </tr>




                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div><!-- col end -->
            </div><!-- row end -->

    <div id="modal">

        <addTop3Cols @recordadded="refreshRecord"></addTop3Cols>

    </div>



        </div>
    </div>
    <!-- /page content -->



</template>

<script>
    Vue.component('addTop3Cols', require('../addModalComponent.vue'));
    export default {
    	data(){
    		return{
    			top3Cols:{}, 
    		}
    	},
    	methods:{
            refreshRecord(records){
                this.top3Cols = records.data
            }

    	},
        created(){
        	axios.get('http://localhost/Protech-application/public/top3Cols')
        	.then((response) => this.top3Cols = response.data)
        	.catch((error) => console.log(error));
            console.log('Top Three Column successfully loaded.');
        }
    }

</script>
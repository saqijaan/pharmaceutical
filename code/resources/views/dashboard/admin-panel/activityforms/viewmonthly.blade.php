@extends('index')

@section('title', 'ProTech Application')

@section('stylesheet')

    <!-- NProgress -->
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    
@endsection

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title"><!-- page title and search bar column start -->

                @include('partials.message')

            </div><!-- page title and search bar column end -->


            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12"><!-- col start -->
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Monthly Activity Forms  </h2>
                             
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                                <form id="demo-form2" class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[a]"> Doctor Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <input type="text" id="form[a]" required="required" name="form[a]" value="{{$form->data->a }}" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[b]"> Doctor’s specialty <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[b]" required="required" name="form[b]" class="form-control col-md-7 col-xs-12">{{ $form->data->b }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[c]"> Area/Town/City/Address <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[c]" name="form[c]" class="form-control col-md-7 col-xs-12">{{ $form->data->c }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[d]"> Currently Doctor’s daily patient average <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[d]" name="form[d]" class="form-control col-md-7 col-xs-12">{{ $form->data->d }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[e]"> Selected products <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[e]" name="form[e]" class="form-control col-md-7 col-xs-12">{{ $form->data->e }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[f]"> What was your opinion before starting this activity <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[f]" name="form[f]" class="form-control col-md-7 col-xs-12">{{ $form->data->f }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[g]"> What is your opinion on current situation of activity <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[g]" name="form[g]" class="form-control col-md-7 col-xs-12">{{ $form->data->g }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[h]"> In a running year how many activities done on this doctor <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[h]" name="form[h]" class="form-control col-md-7 col-xs-12">{{ $form->data->h }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[i]"> Current activity starting and closing date <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[i]" name="form[i]" class="form-control col-md-7 col-xs-12">{{ $form->data->i }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[j]"> In which month of activity we are now 1st ,2ndor 3rd <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[j]" name="form[j]" class="form-control col-md-7 col-xs-12">{{ $form->data->j }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[k]"> How much business is now till date mature <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[k]" name="form[k]" class="form-control col-md-7 col-xs-12">{{ $form->data->k }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[l]"> How many medical stores cover his prescription, describes their names <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[l]" name="form[l]" class="form-control col-md-7 col-xs-12">{{ $form->data->l }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[m]"> Do you attach distribution sales sheets regarding his current achievement <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[m]" name="form[m]" class="form-control col-md-7 col-xs-12">{{ $form->data->m }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[n]"> How much business is remaining <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[n]" name="form[n]" class="form-control col-md-7 col-xs-12">{{ $form->data->n }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[o]"> How doctor behave on current situation <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[o]" name="form[o]" class="form-control col-md-7 col-xs-12">{{ $form->data->o }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form[p]"> What is your final thought on it <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <textarea type="text" id="form[p]" name="form[p]" class="form-control col-md-7 col-xs-12">{{ $form->data->p }}</textarea>
                                        </div>
                                    </div>
    
    
    
                                </form>
                        </div>
                    </div>
                </div><!-- col end -->
            </div><!-- row end -->



        </div>
    </div>
    <!-- /page content -->



@endsection

@section('bottom_script')


    <script>
            $(function(){
                jQuery($('textarea')).each(function() {
                    var val = jQuery(this).val();
                    jQuery(this).attr("readonly",true);
                });
                $('input').attr('readonly',true);
                
            })
    </script>
@endsection



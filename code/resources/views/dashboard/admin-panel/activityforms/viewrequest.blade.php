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
    <style>
        input {
            width:100% !important;
        }
        table>tbody>tr>td {
            border : 1px solid black;
        }
        table{
            overflow:hidden;
        }
        </style>
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
                            <div data-type="pdf-page" id="pdf-page-0" data-page-num="0" data-layout="responsive" data-ratio="1.293333" class="pdf-page responsive ">
                                    <div class="pde-rect obj_0" style="width:100%;" >
                                        <div class="pde-text">
                                            <h2 class="obj_1" ><span class="obj_2 pdf-obj">REQUEST FORM</span></h2>
                                        </div>
                                        <div class="pde-image " data-type="pdf-image" data-image-width="103" data-ratio="3.433333" style="width:103px;" >
                                            <div data-type="pdf-image-inner" data-image-width="103" class="pde-image-inner obj_4" ></div>
                                        </div>
                                        <div class="pde-table pde-table-form ">
                                            <table class="table table-responsive">
                                                <colgroup>
                                                    <col style="width:8%">
                                                    <col style="width:14%">
                                                    <col style="width:7%">
                                                    <col style="width:3%">
                                                    <col style="width:4%">
                                                    <col style="width:7%">
                                                    <col style="width:4%">
                                                    <col style="width:17%">
                                                    <col style="width:1%">
                                                    <col style="width:3%">
                                                    <col style="width:10%">
                                                    <col style="width:4%">
                                                    <col style="width:2%">
                                                    <col style="width:7%">
                                                    <col style="width:1%">
                                                </colgroup>
                                                <tr>
                                                    <td class="obj_5 " colspan = "1" rowspan = "1" >&nbsp;</td>
                                                    <td class="aright obj_6 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_7" ><span class="obj_8 pdf-obj">ZONE:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_9 " colspan = "3" rowspan = "1" >
                                                        <span>{{ $form->zone }}</span>
                                                    </td>
                                                    <td class="obj_11 " colspan = "3" rowspan = "1" >&nbsp;</td>
                                                    <td class="obj_12 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_13" ><span class="obj_14 pdf-obj">DATE:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_15 " colspan = "2" rowspan = "1" >
                                                        {{ $form->date }}
                                                    </td>
                                                    <td class="obj_17 " colspan = "3" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_18 " colspan = "15" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_19 h4" ><span class="obj_20 pdf-obj">CLIENT DETAILS</span></p>
                                                        </div>
                                                        <hr>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    
                                                    <td class="aright obj_23 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_24" ><span class="obj_25 pdf-obj">CLIENT NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_26 " colspan = "5" rowspan = "1" >
                                                        {{ $form->CLIENT_NAME }}
                                                    </td>
                                                    
                                                    <td class="obj_29 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_30" ><span class="obj_31 pdf-obj">CONTACT NO:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_32 " colspan = "5" rowspan = "1" >
                                                        {{ $form->CONTACT_NO }}
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_35 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_36" ><span class="obj_37 pdf-obj">ADDRESS:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_38 " colspan = "13" rowspan = "1" >
                                                        {{ $form->ADDRESS }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_40 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_41" ><span class="obj_42 pdf-obj">TYPE:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_43 " colspan = "13" rowspan = "1" >
                                                        {{ $form->Type }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_45 " colspan = "15" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_46 h4" ><span class="obj_47 pdf-obj">BANK DETAILS</span></p>
                                                        </div>
                                                        <hr>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td class="aright obj_49 " colspan = "4" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_50" ><span class="obj_51 pdf-obj">MODE OF PAYMENT :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_52 " colspan = "11" rowspan = "1" >
                                                        {{ $form->PaymentType }}
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_55 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_56" ><span class="obj_57 pdf-obj">NAME OF BANK :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_58 " colspan = "5" rowspan = "1" >
                                                        {{ $form->NAME_OF_BANK }}
                                                    </td>
                                                    <td class="aright obj_60 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_61" ><span class="obj_62 pdf-obj">ACCOUNT TITLE :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_63 " colspan = "5" rowspan = "1" >
                                                        {{ $form->ACCOUNT_TITLE }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_66 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_67" ><span class="obj_68 pdf-obj">BRANCH CODE NUMBER :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_69 " colspan = "5" rowspan = "1" >
                                                        {{ $form->BRANCH_CODE_NUMBER }}
                                                    </td>
                                                    <td class="aright obj_71 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_72" ><span class="obj_73 pdf-obj">ACCOUNT NUMBER :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_74 " colspan = "5" >
                                                        {{ $form->ACCOUNT_NUMBER }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_76 " colspan = "15" >
                                                        <div class="pde-text">
                                                            <p class="obj_77 h4" ><span class="obj_78 pdf-obj">INVESTMENT DETAILS</span></p>
                                                        </div>
                                                        <hr>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    
                                                    <td class="aright obj_81 " colspan = "5" >
                                                        <div class="pde-text">
                                                            <p class="obj_82" ><span class="obj_83 pdf-obj">KIND OF INVESTMENT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_84 " colspan = "2" >
                                                        {{ $form->Dropdown4 }}
                                                    </td>
                                                    
                                                    <td class="aright obj_87 " colspan = "4" >
                                                        <div class="pde-text">
                                                            <p class="obj_88" ><span class="obj_89 pdf-obj">TERM OF INVESTMENT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_90 " colspan = "4" >
                                                        {{ $form->TOI }}
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_93 " colspan = "5" >
                                                        <div class="pde-text">
                                                            <p class="obj_94" ><span class="obj_95 pdf-obj">SINCE HOW LONG IS THE CLIENT WITH US </span><span class="obj_96 pdf-obj"><sub>:</sub></span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_97 " colspan = "10" >
                                                        {{ $form->SINCE_HOW_LONG_IS_THE }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_100 " colspan = "2" >
                                                        <div class="pde-text">
                                                            <p class="obj_101 h5" ><span class="obj_102 pdf-obj">INVESTMENT AMOUNT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_103 " colspan = "9" >
                                                        {{ $form->INV }}
                                                    </td>
                                                    <td class="obj_105 " colspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_106" ><span class="obj_107 pdf-obj">%</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_108 " colspan = "3" >
                                                        {{ $form->Perc }}
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="obj_111 " colspan = "2" >
                                                        <div class="pde-text">
                                                            <p class="obj_112 h5" ><span class="obj_113 pdf-obj">EXPECTED FUTURE SALE:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_114 " colspan = "13" >
                                                        {{ $form->SALE }}
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_118 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_119" ><span class="obj_120 pdf-obj">PRODUCTS INVOLVED ON THIS INVESTMENT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_121 " colspan = "5" rowspan = "1" >
                                                        {{ $form->PRODUCTS_INVOLVED }}
                                                    </td>
                                                    <td class="aright obj_123 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_124" ><span class="obj_125 pdf-obj">EXPECTED DATE OF NEXT INVESTMENT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_126 " colspan = "5" rowspan = "1" >
                                                        {{ $form->EXPECTED_DATE_OF }}
                                                    </td>
    
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_129 " colspan = "2">
                                                        <div class="pde-text">
                                                            <p class="obj_130" ><span class="obj_131 pdf-obj">WHO WILL FOLLOW IT:</span></p>
                                                            <p>(Name of Persons)</p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_132 " colspan = "13" >
                                                        {{ $form->WHO_WILL_FOLLOW_IT }}
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="obj_137 " colspan = "15" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_138 h4" ><span class="obj_139 pdf-obj">AREA SALES DETAILS</span></p>
                                                        </div>
                                                        <hr>
                                                    </td>
                                                </tr>
                                                <tr>
  
                                                    <td class="aright obj_142 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_143" ><span class="obj_144 pdf-obj">CLIENT&#39;S PERSONAL CHEMIST NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_145 " colspan = "5" rowspan = "1" >
                                                        {{ $form->CLIENTS_PERSONAL }}
                                                    </td>

                                                    <td class="aright obj_147 " colspan = "3" rowspan = "1" >
                                                    <div class="pde-text">
                                                        <p class="obj_148" ><span class="obj_149 pdf-obj">CLIENTS PERSONAL CHEMIST PRESENT SALES:</span></p>
                                                    </div>
                                                    </td>
                                                    <td class="obj_150 " colspan = "6" rowspan = "1" >
                                                        {{ $form->CLIENTS_PERSONAL_2 }}
                                                    </td>
                                                    
                                                </tr>
                                                
                                                <tr>
                                                    <td class="aright obj_159 " colspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_160" ><span class="obj_161 pdf-obj">PRESENT SALES OF THE NEARBY CHEMIST:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_162 " colspan = "5" >
                                                        {{ $form->PRESENT_SALES_OF_THE }}
                                                    </td>
                                                    <td class="aright obj_164 " colspan = "3" rowspan = "1">
                                                        <div class="pde-text">
                                                            <p class="obj_165" ><span class="obj_166 pdf-obj">CLIENT&#39;S NEAR BY CHEMIST NAMES:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_167 " colspan = "6" rowspan = "1" >
                                                        {{ $form->CLIENTS_NEAR_BY }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_169 " colspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_170" ><span class="obj_171 pdf-obj">CLIENT&#39;S AREA NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_172 " colspan = "5" >
                                                        {{ $form->CLIENTS_AREA_NAME }}
                                                    </td>
                                                    <td class="aright obj_174 " colspan = "3" >
                                                        <div class="pde-text">
                                                            <p class="obj_175" ><span class="obj_176 pdf-obj">TOTAL SALES OF CLIENT&#39;S AREA:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_177 " colspan = "6" >
                                                        {{ $form->TOTAL_SALES_OF }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_179 " colspan = "5" >
                                                        <div class="pde-text">
                                                            <p class="obj_180" ><span class="obj_181 pdf-obj">NAMES OF ALL THE CLIENTS PRESCRIBING OUR PRODUCTS IN THIS AREA:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_182 " colspan = "10" >
                                                        {{ $form->NAMES_OF_ALL_THE_CLIENTS_PRESCRIBING }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_184 " colspan = "15" >
                                                        <div class="pde-text">
                                                            <p class="obj_185 h4" ><span class="obj_186 pdf-obj">PREVIUOS PAYMENT DETAILS</span></p>
                                                        </div>
                                                        <hr>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="obj_188 " colspan = "2" >
                                                        <div class="pde-text">
                                                            <p class="obj_189" ><span class="obj_190 pdf-obj">PREVIOUS PAYMENT DATE:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_191 " colspan = "5" >
                                                        {{ $form->PREVIOUS_PAYMENT_DATE }}
                                                    </td>
                                                    <td class="aright obj_193 " colspan = "8" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_194 " colspan = "2" >
                                                        <div class="pde-text">
                                                            <p class="obj_195" ><span class="obj_196 pdf-obj">PREVIOUS PAID AMOUNT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_197 " colspan = "13" >
                                                        {{ $form->PREVIOUS_PAID_AMOUNT }}
                                                    </td>
 
                                                </tr>
                                                <tr>
                          
                                                    <td class="aright obj_201 " colspan = "2" >
                                                        <div class="pde-text">
                                                            <p class="obj_202" ><span class="obj_203 pdf-obj">SALES ACHIEVED ON PREVIOUS PAYMENT :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_204 " colspan = "13" >
                                                        {{ $form->SALES_ACHIEVED_ON }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_206 " colspan = "15" >
                                                        <div class="pde-text">
                                                            <p class="obj_207 h4" ><span class="obj_208 pdf-obj">OTHER DETAILS</span></p>
                                                        </div>
                                                        <hr>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="aright obj_211 " colspan = "3" >
                                                        <div class="pde-text">
                                                            <p class="obj_212" ><span class="obj_213 pdf-obj">DOES THIS CLIENT GO FOR CME </span><span class="obj_214 pdf-obj">‐ </span><span class="obj_215 pdf-obj">TOURS</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_216 " colspan = "12" >
                                                        {{ $form->Dropdown7 }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_219 " colspan = "3" >
                                                        <div class="pde-text">
                                                            <p class="obj_220" ><span class="obj_221 pdf-obj">ANY OTHER COMMENTS:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_222 " colspan = "12" >
                                                        {{ $form->ANY_OTHER_COMMENTS }}
                                                    </td>

                                                </tr>
                                                
                                                <tr>
                            
                                                    <td class="aright obj_227 " colspan = "2" >
                                                        <div class="pde-text">
                                                            <p class="obj_228" ><span class="obj_229 pdf-obj">FORM FILLED BY:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_230 " colspan = "5" >
                                                        {{ $form->FORM_FILLED_BY }}
                                                    </td>
                                                    <td class="aright obj_232 " colspan = "3" >
                                                        <div class="pde-text">
                                                            <p class="obj_233" ><span class="obj_234 pdf-obj">SUB MANAGER NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_235 " colspan = "5" >
                                                        {{ $form->SUB_MANAGER_NAME }}
                                                    </td>
                     
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_238 " colspan = "2" >
                                                        <div class="pde-text">
                                                            <p class="obj_239" ><span class="obj_240 pdf-obj">MANAGER NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_241 " colspan = "5" >
                                                        {{ $form->MANAGER_NAME }}
                                                    </td>
                                                    <td class="aright obj_243 " colspan = "3" >
                                                        <div class="pde-text">
                                                            <p class="obj_244" ><span class="obj_245 pdf-obj">BUH / BUM / SSM NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_246 " colspan = "5" >
                                                        {{ $form->BUH_BUM_SSM_NAME }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_248 " colspan = "15" >
                                                        <div class="pde-text">
                                                            <p class="obj_249" ><span class="obj_250 pdf-obj">NOTE: Immediadtely Inform Head Office when you hand over this requisition</span></p>
                                                        </div>
                                                    </td>
    
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div><!-- col end -->
            </div><!-- row end -->



        </div>
    </div>
    <!-- /page content -->



@endsection

@section('bottom_script')

    <!-- FastClick -->
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>

    <script>
            $(function(){
                jQuery($('input')).each(function() {
                    var val = jQuery(this).val();
                    jQuery(this).replaceWith("<p>"+val+"</p>");
                });
                
            })
    </script>
@endsection



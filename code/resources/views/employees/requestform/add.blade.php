@extends('employees.layouts.master')
@section('title', 'Biomerge Application')
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
<!-- bootstrap-datetimepicker -->
<!-- bootstrap-daterangepicker -->
<link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
<style>
    input {
        width:100% !important;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        border : 0px;
    }
</style>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <!-- page title and search bar column start -->
            <div class="title_left">
                <h3> Clinical Request Form </h3>
            </div>
        </div>
        <!-- page title and search bar column end -->
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @include('partials.message')
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Create New    </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="pdf-document" data-type="pdf-document" data-num-pages="1" data-layout="responsive" >
                            <form id="acroform" action="{{ route('clinical-request-form.store') }}"method="POST">
                                @csrf
                                <div data-type="pdf-page" id="pdf-page-0" data-page-num="0" data-layout="responsive" data-ratio="1.293333" class="pdf-page responsive ">
                                    <div class="pde-rect obj_0" style="width:100%;" >
                                        <div class="pde-text">
                                            <h2 class="obj_1" ><span class="obj_2 pdf-obj">REQUEST FORM</span></h2>
                                        </div>
                                        <div class="pde-image " data-type="pdf-image" data-image-width="103" data-ratio="3.433333" style="width:103px;" >
                                            <div data-type="pdf-image-inner" data-image-width="103" class="pde-image-inner obj_4" ></div>
                                        </div>
                                        <div class="pde-table pde-table-form ">
                                            <table class="table">
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
                                                        <select form="acroform" class="pde-form-field pdf-annot obj_10  pdf-obj acroform-field " name="zone" data-field-id="16148016" data-annot-id="16471960" data-default-value="-" >
                                                            <option value="-">-</option>
                                                            <option value="A-1 N">A-1 N</option>
                                                            <option value="A-1 L">A-1 L</option>
                                                            <option value="K-1 N">K-1 N</option>
                                                            <option value="K-1 L">K-1 L</option>
                                                            <option value="K-2 NL">K-2 NL</option>
                                                            <option value="K-3 NL">K-3 NL</option>
                                                            <option value="K-4 NL">K-4 NL</option>
                                                            <option value="K-5 NL">K-5 NL</option>
                                                            <option value="K-6 NL">K-6 NL</option>
                                                            <option value="K-7 NL">K-7 NL</option>
                                                            <option value="K-8 NL">K-8 NL</option>
                                                            <option value="K-9 NL">K-9 NL</option>
                                                            <option value="Z-1 N">Z-1 N</option>
                                                            <option value="Z-1 L">Z-1 L</option>
                                                            <option selected value="Z-2 N">Z-2 N</option>
                                                            <option value="Z-2 L">Z-2 L</option>
                                                            <option value="Z-3 N">Z-3 N</option>
                                                            <option value="Z-3 L">Z-3 L</option>
                                                            <option value="Z-4 N">Z-4 N</option>
                                                            <option value="Z-4 L">Z-4 L</option>
                                                            <option value="Z-5 N">Z-5 N</option>
                                                            <option value="Z-5 L">Z-5 L</option>
                                                            <option value="Z-6 N (A)">Z-6 N (A)</option>
                                                            <option value="Z-6 N (B)">Z-6 N (B)</option>
                                                            <option value="Z-6 L">Z-6 L</option>
                                                            <option value="Z-7 N">Z-7 N</option>
                                                            <option value="Z-7 L">Z-7 L</option>
                                                            <option value="Z-8 N (A)">Z-8 N (A)</option>
                                                            <option value="Z-8 N (B)">Z-8 N (B)</option>
                                                            <option value="Z-8 L (A)">Z-8 L (A)</option>
                                                            <option value="Z-8 L (B)">Z-8 L (B)</option>
                                                        </select>
                                                    </td>
                                                    <td class="obj_11 " colspan = "3" rowspan = "1" >&nbsp;</td>
                                                    <td class="obj_12 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_13" ><span class="obj_14 pdf-obj">DATE:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_15 " colspan = "2" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_16  pdf-obj acroform-field " value="{{ date('Y-m-d') }}" name="date" data-field-id="16063720" data-annot-id="16471024" value="" type="text" >
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
                                                    <td class="aleft obj_21 " colspan = "13" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_22 " colspan = "1" rowspan = "3" >&nbsp;</td>
                                                    <td class="aright obj_23 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_24" ><span class="obj_25 pdf-obj">CLIENT NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_26 " colspan = "6" rowspan = "1" ><input form="acroform" class="pde-form-field pdf-annot obj_27  pdf-obj acroform-field " name="CLIENT_NAME" data-field-id="16063976" data-annot-id="16471312" value="" type="text" ></td>
                                                    <td class="obj_28 " colspan = "2" rowspan = "1" >&nbsp;</td>
                                                    <td class="obj_29 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_30" ><span class="obj_31 pdf-obj">CONTACT NO:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_32 " colspan = "3" rowspan = "1" ><input form="acroform" class="pde-form-field pdf-annot obj_33  pdf-obj acroform-field " name="CONTACT_NO" data-field-id="16063912" data-annot-id="16471744" value="" type="text" ></td>
                                                    <td class="obj_34 " colspan = "1" rowspan = "2" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_35 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_36" ><span class="obj_37 pdf-obj">ADDRESS:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_38 " colspan = "12" rowspan = "1" ><input form="acroform" class="pde-form-field pdf-annot obj_39  pdf-obj acroform-field " name="ADDRESS" data-field-id="16062696" data-annot-id="16472248" value="" type="text" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_40 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_41" ><span class="obj_42 pdf-obj">TYPE:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_43 " colspan = "13" rowspan = "1" >
                                                        <select form="acroform" class="pde-form-field pdf-annot obj_44  pdf-obj acroform-field " name="Type" data-field-id="16064424" data-annot-id="16470808" data-default-value="-" >
                                                            <option value="-">-</option>
                                                            <option selected value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                        </select>
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
                                                    <td class="obj_48 " colspan = "1" rowspan = "3" >&nbsp;</td>
                                                    <td class="aright obj_49 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_50" ><span class="obj_51 pdf-obj">MODE OF PAYMENT :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_52 " colspan = "3" rowspan = "1" >
                                                        <select form="acroform" class="pde-form-field pdf-annot obj_53  pdf-obj acroform-field " name="PaymentType" data-field-id="16064296" data-annot-id="16471816" data-default-value="-" >
                                                            <option value="-">-</option>
                                                            <option value="CHEQUE">CHEQUE</option>
                                                            <option selected value="CASH">CASH</option>
                                                        </select>
                                                    </td>
                                                    <td class="obj_54 " colspan = "10" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_55 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_56" ><span class="obj_57 pdf-obj">NAME OF BANK :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_58 " colspan = "5" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_59  pdf-obj acroform-field " name="NAME_OF_BANK" data-field-id="16062888" data-annot-id="16470880" value="" type="text" ></td>
                                                    <td class="aright obj_60 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_61" ><span class="obj_62 pdf-obj">ACCOUNT TITLE :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_63 " colspan = "4" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_64  pdf-obj acroform-field " name="ACCOUNT_TITLE" data-field-id="16063400" data-annot-id="16471384" value="" type="text" ></td>
                                                    <td class="obj_65 " colspan = "1" rowspan = "2" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_66 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_67" ><span class="obj_68 pdf-obj">BRANCH CODE NUMBER :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_69 " colspan = "5" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_70  pdf-obj acroform-field " name="BRANCH_CODE_NUMBER" data-field-id="16063272" data-annot-id="16471528" value="" type="text" ></td>
                                                    <td class="aright obj_71 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_72" ><span class="obj_73 pdf-obj">ACCOUNT NUMBER :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_74 " colspan = "4" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_75  pdf-obj acroform-field " name="ACCOUNT_NUMBER" data-field-id="16062824" data-annot-id="16471888" value="" type="text" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_76 " colspan = "15" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_77 h4" ><span class="obj_78 pdf-obj">INVESTMENT DETAILS</span></p>
                                                        </div>
                                                        <hr>
                                                    </td>
                                                    <td class="aleft obj_79 " colspan = "13" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_80 " colspan = "1" rowspan = "2" >&nbsp;</td>
                                                    <td class="aright obj_81 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_82" ><span class="obj_83 pdf-obj">KIND OF INVESTMENT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_84 " colspan = "3" rowspan = "1" >
                                                        <select form="acroform" class="pde-form-field pdf-annot obj_85  pdf-obj acroform-field " name="Dropdown4" data-field-id="16064488" data-annot-id="16472104" data-default-value="-" >
                                                            <option value="-">-</option>
                                                            <option selected value="RENEWAL">RENEWAL</option>
                                                            <option value="NEW">NEW</option>
                                                        </select>
                                                    </td>
                                                    <td class="obj_86 " colspan = "2" rowspan = "1" >&nbsp;</td>
                                                    <td class="aright obj_87 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_88" ><span class="obj_89 pdf-obj">TERM OF INVESTMENT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_90 " colspan = "3" rowspan = "1" >
                                                        <select form="acroform" class="pde-form-field pdf-annot obj_91  pdf-obj acroform-field " name="TOI" data-field-id="16064040" data-annot-id="16471456" data-default-value="-" >
                                                            <option selected value="-">-</option>
                                                            <option value="3 Months">3 Months</option>
                                                            <option value="6 Months">6 Months</option>
                                                            <option value="1 Year">1 Year</option>
                                                        </select>
                                                    </td>
                                                    <td class="obj_92 " colspan = "2" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_93 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_94" ><span class="obj_95 pdf-obj">SINCE HOW LONG IS THE CLIENT WITH US </span><span class="obj_96 pdf-obj"><sub>:</sub></span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_97 " colspan = "5" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_98  pdf-obj acroform-field " name="SINCE_HOW_LONG_IS_THE" data-field-id="16064168" data-annot-id="16472032" value="" type="text" ></td>
                                                    <td class="aright obj_99 " colspan = "8" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_100 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_101 h5" ><span class="obj_102 pdf-obj">INVESTMENT AMOUNT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_103 " colspan = "9" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_104  pdf-obj acroform-field " name="INV" data-field-id="16147632" data-annot-id="15868904" value="" type="text" ></td>
                                                    <td class="obj_105 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_106" ><span class="obj_107 pdf-obj">%</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_108 " colspan = "2" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_109  pdf-obj acroform-field " name="Perc" data-field-id="16147056" data-annot-id="16677304" value="0" type="text" ></td>
                                                    <td class="obj_110 " colspan = "1" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_111 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_112 h5" ><span class="obj_113 pdf-obj">EXPECTED FUTURE SALE:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_114 " colspan = "9" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_115  pdf-obj acroform-field " name="SALE" data-field-id="16147760" data-annot-id="16676368" value="" type="text" ></td>
                                                    <td class="obj_116 " colspan = "4" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_117 " colspan = "1" rowspan = "3" >&nbsp;</td>
                                                    <td class="aright obj_118 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_119" ><span class="obj_120 pdf-obj">PRODUCTS INVOLVED ON THIS INVESTMENT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_121 " colspan = "5" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_122  pdf-obj acroform-field " name="PRODUCTS_INVOLVED" data-field-id="16148144" data-annot-id="16676728" value="" type="text" ></td>
                                                    <td class="aright obj_123 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_124" ><span class="obj_125 pdf-obj">EXPECTED DATE OF NEXT INVESTMENT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_126 " colspan = "4" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_127  pdf-obj acroform-field " name="EXPECTED_DATE_OF" data-field-id="16063528" data-annot-id="16677592" value="" type="text" ></td>
                                                    <td class="obj_128 " colspan = "1" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_129 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_130" ><span class="obj_131 pdf-obj">WHO WILL FOLLOW IT:</span></p>
                                                            <p>(Name of Persons)</p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_132 " colspan = "8" rowspan = "2" >
                                                        <input form="acroform" style="width:100%" class="pde-form-field pdf-annot obj_133  pdf-obj acroform-field " name="WHO_WILL_FOLLOW_IT" data-field-id="16063464" data-annot-id="16677880" value="" type="text" ></td>
                                                    <td class="obj_134 " colspan = "7" rowspan = "2" >&nbsp;</td>
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
                                                    <td class="obj_141 " colspan = "1" rowspan = "5" >&nbsp;</td>
                                                    <td class="aright obj_142 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_143" ><span class="obj_144 pdf-obj">CLIENT&#39;S PERSONAL CHEMIST NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_145 " colspan = "5" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_146  pdf-obj acroform-field " name="CLIENTS_PERSONAL" data-field-id="16063656" data-annot-id="16676800" value="" type="text" ></td>
                                                    <td class="aright obj_147 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_148" ><span class="obj_149 pdf-obj">CLIENTS PERSONAL CHEMIST PRESENT SALES:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_150 " colspan = "5" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_151  pdf-obj acroform-field " name="CLIENTS_PERSONAL_2" data-field-id="16063592" data-annot-id="16677952" value="" type="text" ></td>
                                                    <td class="obj_152 " colspan = "1" rowspan = "5" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_159 " colspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_160" ><span class="obj_161 pdf-obj">PRESENT SALES OF THE NEARBY CHEMIST:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_162 " colspan = "5" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_163  pdf-obj acroform-field " name="PRESENT_SALES_OF_THE" data-field-id="16063208" data-annot-id="16678096" value="" type="text" ></td>
                                                    <td class="aright obj_164 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_165" ><span class="obj_166 pdf-obj">CLIENT&#39;S NEAR BY CHEMIST NAMES:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_167 " colspan = "4" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_168  pdf-obj acroform-field " name="CLIENTS_NEAR_BY" data-field-id="16064232" data-annot-id="16677088" value="" type="text" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_169 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_170" ><span class="obj_171 pdf-obj">CLIENT&#39;S AREA NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_172 " colspan = "5" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_173  pdf-obj acroform-field " name="CLIENTS_AREA_NAME" data-field-id="16063336" data-annot-id="16676656" value="" type="text" ></td>
                                                    <td class="aright obj_174 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_175" ><span class="obj_176 pdf-obj">TOTAL SALES OF CLIENT&#39;S AREA:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_177 " colspan = "4" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_178  pdf-obj acroform-field " name="TOTAL_SALES_OF" data-field-id="16063144" data-annot-id="16676512" value="" type="text" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_179 " colspan = "5" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_180" ><span class="obj_181 pdf-obj">NAMES OF ALL THE CLIENTS PRESCRIBING OUR PRODUCTS IN THIS AREA:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_182 " colspan = "8" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_183  pdf-obj acroform-field " name="NAMES_OF_ALL_THE_CLIENTS_PRESCRIBING" data-field-id="16063784" data-annot-id="16676584" value="" type="text" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_184 " colspan = "15" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_185 h4" ><span class="obj_186 pdf-obj">PREVIUOS PAYMENT DETAILS</span></p>
                                                        </div>
                                                        <hr>
                                                    </td>
                                                    <td class="aleft obj_187 " colspan = "13" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_188 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_189" ><span class="obj_190 pdf-obj">PREVIOUS PAYMENT DATE:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_191 " colspan = "5" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_192  pdf-obj acroform-field " name="PREVIOUS_PAYMENT_DATE" data-field-id="16062952" data-annot-id="16677664" value="" type="text" ></td>
                                                    <td class="aright obj_193 " colspan = "8" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_194 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_195" ><span class="obj_196 pdf-obj">PREVIOUS PAID AMOUNT:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_197 " colspan = "12" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_198  pdf-obj acroform-field " name="PREVIOUS_PAID_AMOUNT" data-field-id="16062760" data-annot-id="16676872" value="" type="text" ></td>
                                                    <td class="obj_199 " colspan = "1" rowspan = "2" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_200 " colspan = "1" rowspan = "1" >&nbsp;</td>
                                                    <td class="aright obj_201 " colspan = "4" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_202" ><span class="obj_203 pdf-obj">SALES ACHIEVED ON PREVIOUS PAYMENT :</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_204 " colspan = "12" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_205  pdf-obj acroform-field " name="SALES_ACHIEVED_ON" data-field-id="16063016" data-annot-id="16677232" value="" type="text" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_206 " colspan = "15" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_207 h4" ><span class="obj_208 pdf-obj">OTHER DETAILS</span></p>
                                                        </div>
                                                        <hr>
                                                    </td>
                                                    <td class="aleft obj_209 " colspan = "13" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_210 " colspan = "1" rowspan = "2" >&nbsp;</td>
                                                    <td class="aright obj_211 " colspan = "2" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_212" ><span class="obj_213 pdf-obj">DOES THIS CLIENT GO FOR CME </span><span class="obj_214 pdf-obj">‐ </span><span class="obj_215 pdf-obj">TOURS</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_216 " colspan = "3" rowspan = "1" >
                                                        <select form="acroform" class="pde-form-field pdf-annot obj_217  pdf-obj acroform-field " name="Dropdown7" data-field-id="16147312" data-annot-id="16678528" data-default-value="-" >
                                                            <option value="-">-</option>
                                                            <option value="YES">YES</option>
                                                            <option selected value="NO">NO</option>
                                                        </select>
                                                    </td>
                                                    <td class="obj_218 " colspan = "11" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_219 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_220" ><span class="obj_221 pdf-obj">ANY OTHER COMMENTS:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_222 " colspan = "12" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_223  pdf-obj acroform-field " name="ANY_OTHER_COMMENTS" data-field-id="16064552" data-annot-id="16676944" value="" type="text" ></td>
                                                    <td class="obj_224 " colspan = "1" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_225 " colspan = "15" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="15">
                                                        <hr>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_226 " colspan = "1" rowspan = "2" >&nbsp;</td>
                                                    <td class="aright obj_227 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_228" ><span class="obj_229 pdf-obj">FORM FILLED BY:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_230 " colspan = "5" rowspan = "1" >
                                                        <input form="acroform" class="pde-form-field pdf-annot obj_231  pdf-obj acroform-field " name="FORM_FILLED_BY" data-field-id="16064616" data-annot-id="16677376" value="" type="text" ></td>
                                                    <td class="aright obj_232 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_233" ><span class="obj_234 pdf-obj">SUB MANAGER NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_235 " colspan = "4" rowspan = "1" ><input form="acroform" class="pde-form-field pdf-annot obj_236  pdf-obj acroform-field " name="SUB_MANAGER_NAME" data-field-id="16064360" data-annot-id="16677448" value="" type="text" ></td>
                                                    <td class="obj_237 " colspan = "1" rowspan = "2" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="aright obj_238 " colspan = "1" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_239" ><span class="obj_240 pdf-obj">MANAGER NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="aleft obj_241 " colspan = "5" rowspan = "1" ><input form="acroform" class="pde-form-field pdf-annot obj_242  pdf-obj acroform-field " name="MANAGER_NAME" data-field-id="16063080" data-annot-id="16678024" value="" type="text" ></td>
                                                    <td class="aright obj_243 " colspan = "3" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_244" ><span class="obj_245 pdf-obj">BUH / BUM / SSM NAME:</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_246 " colspan = "4" rowspan = "1" ><input form="acroform" class="pde-form-field pdf-annot obj_247  pdf-obj acroform-field " name="BUH_BUM_SSM_NAME" data-field-id="16063848" data-annot-id="16677520" value="" type="text" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_248 " colspan = "13" rowspan = "1" >
                                                        <div class="pde-text">
                                                            <p class="obj_249" ><span class="obj_250 pdf-obj">NOTE: Immediadtely Inform Head Office when you hand over this requisition</span></p>
                                                        </div>
                                                    </td>
                                                    <td class="obj_251 " colspan = "2" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="obj_252 " colspan = "3" rowspan = "1" >&nbsp;</td>
                                                    <td class="obj_253 " colspan = "6" rowspan = "1" >
                                                        <button form="acroform" class="pde-form-field pdf-annot obj_254  pdf-obj acroform-field " name="SubmitButton1" type="submit" >
                                                        Submit Form
                                                        </button>
                                                    </td>
                                                    <td class="obj_255 " colspan = "6" rowspan = "1" >&nbsp;</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- first column end -->
        </div>
        <!-- rown end -->
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
<!-- bootstrap-datetimepicker -->
<script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
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


@endsection
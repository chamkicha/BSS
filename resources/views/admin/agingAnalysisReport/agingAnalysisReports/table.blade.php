
{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/colReorder.bootstrap4.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/rowReorder.bootstrap4.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/scroller.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-slider/css/bootstrap-slider.min.css') }}" />
    <link href="{{ asset('vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/tables.css') }}" />
    <style>
        .tooltip.tooltip-main {
            margin-top: -40px;
        }
        .slider-handle:hover .tooltip{
            opacity: 1;
        }
        .slider-horizontal .slider-handle:hover .slider-horizontal .tooltip.show{
            opacity:1;
        }
        .opacity-0{
            opacity: 0;
        }
        label.btn{
            padding-left: 0;
            padding-right: 14px;
        }

    </style>
@stop


<div class="row">
    <div class="col-md-12 text-center">
    <form>
        <label class="control-label">Age :</label><br>
        <label class="radio-inline">
            &nbsp;<input type="radio" class="custom-radio" name="radioAge[]" id="radio_one" value="50" dusk="radio11">&nbsp; 30 days</label>
        <label class="radio-inline">
            <input type="radio" class="custom-radio" name="radioAge[]" id="radio_two" value="60" dusk="radio12">&nbsp;60 days</label>
        <label class="radio-inline">
            <input type="radio" class="custom-radio" name="radioAge[]" id="radio_three" value="90" dusk="radio13">&nbsp; 90 days</label>
        <label class="radio-inline">
            <input type="radio" checked class="custom-radio" name="radioAge[]"
                    id="radio_four" value="all" dusk="radio14">&nbsp; 91+ days</label>
    </form>
</div>

<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
<table class="table table-striped table-bordered" id="table2" width="100%">
    <thead>
     <tr>
        <th>Customer Name</th>
        <th>Customer No</th>
        <th>Total</th>
        <th >Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($PaymentAndDue as $agingAnalysisReport)
        <tr>
            <td>{!! $agingAnalysisReport->customer_name !!}</td>
            <td>{!! $agingAnalysisReport->customer_no !!}</td>
            <td>{!! $agingAnalysisReport->balance !!}</td>
            <td>
                 <a href="{{ route('admin.agingAnalysisReport.agingAnalysisReports.show', collect($agingAnalysisReport)->first() ) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view agingAnalysisReport"></i>
                 </a>
                 <a href="{{ route('admin.agingAnalysisReport.agingAnalysisReports.edit', collect($agingAnalysisReport)->first() ) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit agingAnalysisReport"></i>
                 </a>
                 <a href="{{ route('admin.agingAnalysisReport.agingAnalysisReports.confirm-delete', collect($agingAnalysisReport)->first() ) }}" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('admin.agingAnalysisReport.agingAnalysisReports.delete', collect($agingAnalysisReport)->first() ) }}">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete agingAnalysisReport"></i>

                 </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@section('footer_scripts')

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                                <h4 class="modal-title" id="deleteLabel">Delete Item</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                Are you sure to delete this Item? This operation is irreversible.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a  type="button" class="btn btn-danger Remove_square">Delete</a>
                            </div>
            </div>
        </div>
    </div>
    <script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
 <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}">
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>

    <script>
        $('#table2').DataTable({
                      responsive: true,
                      pageLength: 10
                  });
                  $('#table2').on( 'page.dt', function () {
                     setTimeout(function(){
                           $('.livicon').updateLivicon();
                     },500);
                  } );
                  $('#table2').on( 'length.dt', function ( e, settings, len ) {
                     setTimeout(function(){
                            $('.livicon').updateLivicon();
                     },500);
                  } );

                  $('#delete_confirm').on('show.bs.modal', function (event) {
                      var button = $(event.relatedTarget)
                       var $recipient = button.data('id');
                      var modal = $(this);
                      modal.find('.modal-footer a').prop("href",$recipient);
                  })



                  

            var table2 = $('#table2').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! URL::to('admin/table/radioData') !!}',
                    data: function (d) {
                        d.ageRadio=ageRadio;
                    }
                },
                columns: [
                    { data: 'customer_name', name: 'customer_name' },
                    { data: 'customer_no', name: 'customer_no' },
                    { data: 'balance', name: 'balance' },
                ]
            });
            table2.on( 'draw', function () {
                $('.livicon').each(function(){
                    $(this).updateLivicon();
                });
            } );
            $("input[type='radio'].custom-radio").on('ifChanged', function (event) {
                ageRadio =  $(this).val();
                table2.draw();
            });

       </script>

@stop




<section class="content indexpage pr-3 pl-3">
    <div class="row">
        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="lightbluebg bg-primary text-white no-radius">
                <div class="card-body squarebox square_boxs cardpaddng">
                    <div class="row">
                        <div class="col-12 float-left nopadmar">
                            <div class="row">
                                <div class="square_box col-12 text-right">
                                    <span>Total Amount (TZS)</span>

                                    <div class="number">{{ number_format($total_amount,2)}} </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
            <!-- Trans label pie charts strats here-->
            <div class="redbg no-radius">
                <div class="card-body bg-danger text-white squarebox square_boxs cardpaddng">
                    <div class="row">
                        <div class="col-12 float-left nopadmar">
                            <div class="row">
                                <div class="square_box col-12 float-left">
                                    <span>Total Days</span>

                                    <div class="number">{{ $aging_date}} Days</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
</section>



    <form action="{{ route('admin.agingAnalysisReport.aginganalysisreports.index') }}" method = "get"> 
        <div class="row float-right form-group">
            
             <label for="fname" class="radio-inline">Select Days:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <label for="fname" class="radio-inline"><span><input type="radio" id="aging_date" name="aging_date" value="30"></span>&nbsp;0-30 Days</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <label for="fname" class="radio-inline"><span><input type="radio" id="aging_date" name="aging_date" value="60"></span>&nbsp;60 Days</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <label for="fname" class="radio-inline"><span><input type="radio" id="aging_date" name="aging_date" value="90"></span>&nbsp;90 Days</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <label for="fname" class="radio-inline"><span><input type="radio" id="aging_date" name="aging_date" value="120"></span>&nbsp;120 Days</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <label for="fname" class="radio-inline"><span><input type="radio" id="aging_date" name="aging_date" value="150"></span>&nbsp;150 Days</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div >
             
                <button type="submit" id=""name="" class="btn btn-success  waves-light" style="float: right;"><i class="icofont icofont-check-circled"></i>Search</button>
  
            </div>
        </div>
    </form>

<table class="table table-bordered table-hover" id="aginganalysisreports-table">
    <thead class="thead-light">
     <tr>
        <th>No</th>
        <th>Customer Name</th>
        <th>Invoice Number</th>
        <th>Amount Due</th>
        <th>Invoice Due Date</th>
        <th>Days</th>
     </tr>
    </thead>
    <tbody>
    @foreach($aginganalysisreports as $aginganalysisreport)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{!! $aginganalysisreport['cusromer_name'] !!}</td>
            <td>{!! $aginganalysisreport['invoice_number'] !!}</td>
            <td>{!! number_format($aginganalysisreport['current_charges'],2) !!}</td>
            <td>{!! \Carbon\Carbon::parse($aginganalysisreport['invoice_due_date'])->format('d-M-y') !!}</td>
            <td>{!! $aginganalysisreport['diff_in_days'] !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@section('footer_scripts')
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>

    
    <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css') }}">

    <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js') }}" ></script>

    <script>
                  $('#aginganalysisreports-table').DataTable({
                      responsive: true,
                      pageLength: 10,
                      dom: 'Bfrtip',
                      lengthMenu: [
                                        [ 10, 25, 50, -1 ],
                                        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                                    ],
                        buttons: [
                             'excel', 'pdf', 'print','pageLength'
                        ]
                  });
                  $('#aginganalysisreports-table').on( 'page.dt', function () {
                     setTimeout(function(){
                           $('.livicon').updateLivicon();
                     },500);
                  } );
                  $('#aginganalysisreports-table').on( 'length.dt', function ( e, settings, len ) {
                     setTimeout(function(){
                            $('.livicon').updateLivicon();
                     },500);
                  } );

                  $('#delete_confirm').on('show.bs.modal', function (event) {
                      var button = $(event.relatedTarget)
                       var $recipient = button.data('id');
                      var modal = $(this);
                      modal.find('.modal-footer a').prop("href",$recipient);
                  });

                  

                  

       </script>

@stop

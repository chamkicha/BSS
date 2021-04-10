
<li class="{{ Request::is('admin/agingAnalysisReport/agingAnalysisReports*') ? 'active' : '' }}">
    <a href="{!! route('admin.agingAnalysisReport.agingAnalysisReports.index') !!}">
    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="dashboard" data-size="18"
               data-loop="true"></i>
               AgingAnalysisReports
    </a>
</li>

<li class="{{ Request::is('admin/revenuePerCustomerReport/revenuePerCustomerReports*') ? 'active' : '' }}">
    <a href="{!! route('admin.revenuePerCustomerReport.revenuePerCustomerReports.index') !!}">
    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="dashboard" data-size="18"
               data-loop="true"></i>
               RevenuePerCustomerReports
    </a>
</li>


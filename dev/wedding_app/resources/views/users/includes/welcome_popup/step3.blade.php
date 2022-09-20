<form id="thirdEventCreate" action="{{url(route('steps.second'))}}">
    @csrf
    <div class="formFileds">
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">Vendor Services* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Vendor Services of Event"></i></label>
                <div class="messages"  id="hideDiv3" style="color:red"></div>
                <div class="row" id="all-services">
                </div>
            </div>
        </div>
    </div>
    <div class="btn-wrap text-right">
        <button class="cstm-btn solid-btn btn-back-step" data-action="step2" data-step="2" type="button">Back</button>
        <button class="cstm-btn solid-btn">Next</button>
    </div>
</form>

 <script type="text/javascript">
   $(function() {
setTimeout(function() { $("#hideDiv3").fadeOut(12000); }, 20000)

}) 
  </script>

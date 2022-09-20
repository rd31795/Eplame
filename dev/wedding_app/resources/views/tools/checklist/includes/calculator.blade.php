<style type="text/css">
  .calculator_modal  .calculator .operators div {
        padding: 5px!important;
    margin: 10px 4px 10px 0!important;

  }
  .calculator_modal  .calculator .numbers div {
    padding: 5px!important;
    margin: 5px 18px 10px 0!important;
  }
     
.calculator_modal  .calculator div.equal {
    padding: 90px 10px!important;
    margin: 10px 0!important;
    }
   .calculator_modal   .calculator {
      margin: 0 auto!important;
    }
    .calculator_modal .modal-header {
    padding: 0;
    border: none;
}
</style>
<div class="modal fade calculator_modal" id="calculator_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                 <div class="calculator">
                    <div class="input" id="input"></div>
                    <div class="buttons">
                        <div class="operators">
                            <div>+</div>
                            <div>-</div>
                            <div>&times;</div>
                            <div>&divide;</div>
                        </div>
                        <div class="leftPanel">
                            <div class="numbers">
                                <div>7</div>
                                <div>8</div>
                                <div>9</div>
                            </div>
                            <div class="numbers">
                                <div>4</div>
                                <div>5</div>
                                <div>6</div>
                            </div>
                            <div class="numbers">
                                <div>1</div>
                                <div>2</div>
                                <div>3</div>
                            </div>
                            <div class="numbers">
                                <div>0</div>
                                <div>.</div>
                                <div id="clear">C</div>
                            </div>
                        </div>
                        <div class="equal" id="result">=</div>
                    </div>
                </div>
       </div>
     
    </div>
  </div>
</div>


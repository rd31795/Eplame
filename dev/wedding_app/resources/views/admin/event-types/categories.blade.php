@extends('layouts.admin')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
               <h1>Budget Management</h1> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ url('master/') }}">Dashboard</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
       <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">


            <div class="card-body">
              @include('admin.error_message')
                
              @if(isset($cate[0]->label))
                  @foreach($cate as $cat)
             <form id="catBudgetForm" method="POST" action="{{route('update_budget', $slug)}}">
              @csrf
             <div id="wedding-cate-accr" class="faq-accordion wedding-cate-accr">
               
              <div class="acrdn-card">
              <div class="acrdn-header" id="headingOne">
                 <div class="flex-center-row">
                  <div class="input-on-accordion">
                    <h3 class="mr-3">{{$cat->label}}</h3>
                    
                    <div class="input-group" style="max-width: 120px;">
                      <input type="text" class="form-control comment" name="cat[{{$cat->id}}]" value="{{defaultBudget($slug, $cat->id)}}" maxlength="6">
                        <div class="input-group-append">
                          <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                      </div>
                  </div>
                  <button class="w-auto btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#accordion-{{$cat->id}}" aria-expanded="false" aria-controls="collapseOne">
                    <h3><span class="fa-stack fa-sm mr-3">
                      <i class="fas fa-circle fa-stack-2x"></i>
                      <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                    </span></h3>          
                  </button>
                </div>

              </div>
              <div id="accordion-{{$cat->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#wedding-cate-accr">
                <div class="card-body">
                    
                  <div class="row">
                    @if(isset($cat->subCategory[0]->label))
                      @foreach($cat->subCategory as $subCat)
                        <div class="col-lg-6">
                          <div class="form-group"> 
                            <label class="form-label">{{$subCat->label}}</label>  
                            <div class="input-group">
                              <input type="text" name="cat[{{$subCat->id}}]" class="form-control comment" value="{{defaultBudget($slug, $subCat->id)}}" maxlength="6">
                              <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    @else
                      <div class="alert alert-info closer-step" role="alert" style="width: 100%;">
                        <i class="fa fa-info-circle"></i> No Sub-catagory Found
                      </div>
                    @endif
                  </div>
              
                </div>
              </div>


          </div>

                  
             </div>

              @endforeach
              <div class="btn-wrap">
               <button class="btn btn-primary" id="catBudgetFormSbt">Save</button>
             </div>
              </form>
                  @else
                  <div class="alert alert-info closer-step" role="alert" style="width: 100%;">
                        <i class="fa fa-info-circle"></i> No Data Found
                      </div>
                @endif
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('#catBudgetForm').on('submit', function(event) {

            // adding rules for inputs with class 'comment'
            $('input.comment').each(function() {
                $(this).rules("add", 
                    {
                        maxlength:6,
                        number: true,
                        max: 100
                    })
            });            

            // test if form is valid 
        })

        // initialize the validator
        $('#catBudgetForm').validate();

   });
</script>

@endsection
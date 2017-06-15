{{ content() }}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Talent
        <small>profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Profile</a></li>
        <li>Basic Info</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
			<div class="row">
				<div class="col-md-2">
					<h3 class="box-title" style="vertical-align: -webkit-baseline-middle;">Basic Info</h3>
				</div>
			  <div class="col-md-10">
					<a href="{{url('talent/edit')}}" class="btn tomboledit">EDIT</a>
			  </div>
			</div>
        </div>
        <div class="box-body">
            
			<div class="tab-pane" id="settings">
                
                  <div class="row">
                    <label class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <div>{{talentDTO.name}}</div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                       <div>{{talentDTO.email}}</div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-10">
                      <div>{{talentDTO.phone}}</div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 control-label">City</label>

                    <div class="col-sm-10">
                      <div>{{talentDTO.queryCityDTO.name}}</div>
                    </div>
                  </div>
                  <div class="row">
                    <label  class="col-sm-2 control-label">Track</label>

                    <div class="col-sm-10">
                      <div>{{talentDTO.queryTrackDTO.name}}</div>
                    </div>
                  </div>
				  <div class="row">
                    <label  class="col-sm-2 control-label">Birth Date</label>

                    <div class="col-sm-10">
                      <div>{{talentDTO.birthDate}}</div>
                    </div>
                  </div> 
				  <div class="row">
                    <label  class="col-sm-2 control-label">City of Origin</label>

                    <div class="col-sm-10">
                      <div>{{talentDTO.cityOfOrigin}}</div>
                    </div>
                  </div> 
			</div>       
                
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
	
<!-- jQuery 2.2.0 -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
  integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
  crossorigin="anonymous"></script>

	
<script>
	$('#profileMenu').addClass('active');
	$('#basicinfoMenu').css('color','#fff');
</script>
 
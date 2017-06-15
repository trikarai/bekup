<?php use Phalcon\Tag; ?>

{{ content() }}

<section class="content-header">
      <h1>
        <a href="<?php echo $this->url->get('personnel');?>" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Personnel</li>
		<li>Edit Personnel</li>
      </ol>
</section>

<section class="content">

	<div class="box">
		<div class="box-body">
		
			<div class="box-header with-border">
				<div style="font-size: 30px;">
					Edit Personnel									
				</div>
			</div>
			
		<div class="box-body">	
			
			<form action="{{url('personnel/update')}}" method="post">
				<div class="row">
					<div class="form-group col-md-6">
                                                {{hidden_field("id","class":"form-control")}}						
						<div class="form-group">
							<label for="name">Name</label>
                                                        {{ text_field("name", "class":"form-control", "max-lenght":20, "required":"required") }}
						</div>
						<div class="form-group">
							<label for="email">email</label>
                                                        {{ text_field("email", "class":"form-control", "max-lenght":20, "required":"required") }}
						</div>
						
						<div class="form-group">
						<label for="role_name">Role:</label>
						<?php 
						$roleList = ['Direktur'=>'Direktur','Koordinator Track'=>'Koordinator Track', 'Koordinator Wilayah'=>'Koordinator Wilayah', 'Tutor'=>'Tutor'];
						
						echo Tag::selectStatic(array('class'=> 'form-control', 'id' => 'selectError', 'data-rel' => 'chosen', 
							"role_name", $roleList)); ?>  
						</div>
						
						<div class="form-group">
						<?php 
					//        $role = trim($personelDTO->queryRoleDTO()->name());
					//        if($role == 'Direktur' or $role == 'Koordinator Wilayah'){
					//            echo Tag::hiddenField(array('track_id')); 
					//        }else{
								$trackList = [];
								foreach($trackDTOs as $track){
										$trackList[$track->id()] = $track->name();
								}
								echo '<label class="control-label" for="track_id">Track</label>';
								echo Tag::selectStatic(array('class'=> 'form-control', 'id' => 'selectError', 'data-rel' => 'chosen', 
										"track_id", $trackList));
					//        }
						?>                                         
				 </div>
				
				<div class="form-group">
				
				<?php 
			//        if($role == 'Direktur' or $role =='Koordinator Track'){
			//            echo Tag::hiddenField(array('city_id')); 
			//        }else{
						$cityList = [];
						foreach($cityDTOs as $city){
					$cityList[$city->id()] = $city->name();
						}
						echo '<label class="control-label" for="city_id">City:</label>';
						echo Tag::selectStatic(array('class'=> 'form-control', 'id' => 'selectError', 'data-rel' => 'chosen', 
					"city_id", $cityList));
			//        }
				
				?>
				</div>
				</div>				
			</div>
			<div class="row">
					<div class="form-group col-md-6">			
                                                {{submit_button("Update" , "type":"submit", "class":"btn btn-default")}}
					</div>
			</div>
				
			</form>
			</div>
			
		</div>
	</div>
		
</section>

<script src="https://code.jquery.com/jquery-2.2.0.min.js"
  integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
  crossorigin="anonymous"></script>
<script>
	$('#personelMenu').addClass('active');	
</script>
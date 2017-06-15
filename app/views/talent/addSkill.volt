<?php use Phalcon\Tag; ?>

{{ content() }}

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <a href="{{url('talent/skill')}}" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Talent
        <small>profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Profile</a></li>
        <li>Add Skill Set</li>
      </ol>    
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Skill Set</h3>
        </div>
        <div class="box-body">
            
       <div style="width:50%; margin:10px">
           <form action="{{url('talent/saveSkill')}}" method="post">
        
               <div class="form-group">
                   <label class="control-label">Skill</label>
                   <?php 
                        $skillList = [];
                        foreach($skillDTOs as $skill){
                                $skillList[$skill->id()] = $skill->name();
                        }
                        echo Tag::selectStatic(array('class'=> 'form-control', 'id' => 'selectError', 'data-rel' => 'chosen', 
                                "referenceSkillId", $skillList)) 
                    ?>
        </div>
        <div class="form-group">
                    <label for="score">Score:</label>
                    {{numeric_field("score","min":1,"max":5, "placeholder":"Score" , "required":"required" ,"class": "form-control")}}
        </div>
       
        <button type="submit" class="btn btn-default">Submit</button>
        
        </form>
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
	$('#skillMenu').css('color','#fff');
</script>
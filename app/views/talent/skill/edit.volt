<?php use Phalcon\Tag; ?>

{{ content() }}
<style>
    .rating {
        float:left;
        width:300px;
    }
    .rating span { float:right; position:relative; }
    .rating span input {
        position:absolute;
        top:0px;
        left:0px;
        opacity:0;
    }
    .rating span label {
        display:inline-block;
        width:30px;
        height:30px;
        text-align:center;
        color:#FFF;
        background-image:url("{{url('public/img/star_off.png')}}");
{#        background-color: #ccc;#}
        font-size:30px;
        margin-right:2px;
        line-height:30px;
        border-radius:50%;
        -webkit-border-radius:50%;
    }
    .rating span:hover ~ span label,
    .rating span:hover label,
    .rating span.checked label,
    .rating span.checked ~ span label {
        background-image:url("{{url('public/img/star_on.png')}}");
        color:#FFF;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{url('talent/skill/index')}}" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Talent
        <small>profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Profile</a></li>
        <li>Edit Skill Score</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Skill Score</h3>
        </div>
        <div class="box-body">

            <div class="col-md-6">
                <form action="{{url('talent/skill/update')}}" method="post">
                    {{hidden_field("id")}}
                    <div class="form-group">
                        <label class="control-label">Skill</label>
                        {{text_field("skill", "class": "form-control", "readonly": "readonly")}}
                    </div>
                    {#<div class="form-group">
                        <label for="score">Score:</label>
                        {{numeric_field("score","min":1,"max":5, "placeholder":"Score" , "required":"required" ,"class": "form-control")}}
                    </div>#}
                    
                    <div class="rating">
                        <span><input type="radio" name="score" id="str5" value="5"><label for="str5"></label></span>
                        <span><input type="radio" name="score" id="str4" value="4"><label for="str4"></label></span>
                        <span><input type="radio" name="score" id="str3" value="3"><label for="str3"></label></span>
                        <span><input type="radio" name="score" id="str2" value="2"><label for="str2"></label></span>
                        <span><input type="radio" name="score" id="str1" value="1"><label for="str1"></label></span>
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
    $(document).ready(function () {
//  Check Radio-box
        $(".rating input:radio").attr("checked", false);
        $('.rating input').click(function () {
            $(".rating span").removeClass('checked');
            $(this).parent().addClass('checked');
        });

        {#$('input:radio').change(
                function () {
                    var userRating = this.value;
                    alert(userRating);
                });#}
    });
</script>

<script>
    $('#profileMenu').addClass('active');
    $('#skillMenu').css('color', '#fff');
</script>
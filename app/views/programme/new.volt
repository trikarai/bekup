<?php use Phalcon\Tag; ?>

{{ content() }}

<div>
    <form action={{url('programme/add')}} method='post'>
        <div class='form-group'>
            <label for="name">Name</label>
            {{text_field('name', 'required': 'required')}}
        </div>
		<div class='form-group'>
            <label for="description">Deskripsi</label>
            {{text_field('description', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label for="registration_start_date">Registration Start Date</label>
            {{text_field('registration_start_date', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label for="registration_end_date">Registration End Date</label>
            {{text_field('registration_end_date', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label for="operation_start_date">Operation Start Date</label>
            {{text_field('operation_start_date','class':'form-control', 'required': 'required')}}
        </div>
            <label for="operation_end_date">Operation End Date</label>
        <div class='form-group'>
            {{text_field('operation_end_date', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <button type='submit'> Submit </button>
        </div>
    </form>
</div>

        <!-- jQuery 2.2.0
<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>-->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-datepicker.js')}}"></script>

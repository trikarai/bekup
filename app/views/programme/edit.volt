<?php use Phalcon\Tag; ?>

{{ content() }}

<div class="box-body">
    <form action={{url('programme/update')}} method="post">
        {{hidden_field("id")}}
        <div class='form-group'>
            <label for="name">Name</label>
            {{text_field('name', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label for="registration_start_date">Registration Start Date</label>
            {{date_field('registration_start_date', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label for="registration_end_date">Registration End Date</label>
            {{date_field('registration_end_date', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label for="operation_start_date">Operation Start Date</label>
            {{date_field('operation_start_date', 'required': 'required')}}
        </div>
            <label for="operation_end_date">Operation End Date</label>
        <div class='form-group'>
            {{date_field('operation_end_date', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <button type='submit'> Submit </button>
        </div>
    </form>
</div>

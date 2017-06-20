{{ content() }}

<?php use Phalcon\Tag; ?>

<div>
    <form action={{url('team/idea/add')}} method='post'>
        <div class='form-group'>
            <label>Name</label>
            {{text_field('name', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Description</label>
            {{text_area('description', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Target Customer</label>
            {{text_area('target_customer', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Problem Faced</label>
            {{text_area('problem_faced', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Value Proposed</label>
            {{text_area('value_proposed', 'required': 'required')}}
        </div>
		<div class='form-group'>
            <label>Revenue Model</label>
            {{text_area('revenue_model', 'required': 'required')}}
        </div>
		<div class='form-group'>
            <label>Superhero</label>
            {{select_static('superhero_id', superheroList)}}
        </div>
            <button type='submit'> Submit </button>
        </div>
    </form>
</div>

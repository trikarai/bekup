{{ content() }}

<?php use Phalcon\Tag; ?>

<div>
    <form action={{url('talent/entrepreneurship/update')}} method='post'>
		{{hidden_field('id')}}
        <div class='form-group'>
            <label>Name</label>
            {{text_field('name', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Business Field</label>
            {{text_field('business_field', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Business Category</label>
            {{select_static('business_category', businessCategoryList)}}
        </div>
        <div class='form-group'>
            <label>Position</label>
            {{text_field('position', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Start Year</label>
            {{numeric_field('start_year', 'required': 'required')}}
        </div>
		<div class='form-group'>
            <label>End Year</label>
            {{numeric_field('end_year')}}
        </div>
        </div>
            <button type='submit'> Submit </button>
        </div>
    </form>
</div>

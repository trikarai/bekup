{{ content() }}
<?php use Phalcon\Tag; ?>


<div class="box-body">
    <form action={{url('talent/superhero/update')}} method="post">
        {{hidden_field("id")}}
<div class='form-group'>
            <label>Name</label>
            {{text_field('name', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Main Duty</label>
            {{text_area('main_duty', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Special Ability</label>
            {{date_field('special_ability', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Daily Activity</label>
            {{date_field('daily_activity', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <label>Alternative Technology</label>
            {{date_field('alternative_technology', 'required': 'required')}}
        </div>
        <div class='form-group'>
            <button type='submit'> Submit </button>
        </div>
    </form>
</div>

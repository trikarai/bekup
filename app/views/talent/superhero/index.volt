{{ content() }}
<div>
    <a href={{url('talent/superhero/new')}}> add superhero </a>
</div>
<div class="box">
    <table class="table table-hover">
        <thead>
            <tr>
                <td>Superhero</td>
                <td>Main Duty</td>
                <td>Special Ability</td>
                <td>Daily Activity</td>
                <td>Alternative Technology</td>
                <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
			{% if superheroRdos is empty %}
			<tr>
				<h2>No Superhero Data</h2>
			</tr>
			{% endif %}
            {% for rdo in superheroRdos %}
                <tr>
                    <td> {{rdo.getName()}}</td>
                    <td> {{rdo.getMainDuty()}}</td>
                    <td> {{rdo.getSpecialAbility()}}</td>
                    <td> {{rdo.getDailyActivity()}}</td>
                    <td> {{rdo.getAlternativeTechnology()}}</td>
                    <td data-title="Action">
                        <a href="{{url('talent/superhero/edit/')}}{{rdo.getId()}}" class="btn tomboledit">Edit</a>
                    </td>
                    <td>
                        <a href="{{url('talent/superhero/remove/')}}{{rdo.getId()}}" class="btn tomboledit">Remove</a>
                    </td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
</div>